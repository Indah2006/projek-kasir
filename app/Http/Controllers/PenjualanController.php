<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\DetailPenjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with('pelanggan')->get();
        return view('penjualan.index', compact('penjualans'));
    }

    public function create()
{
    $pelanggans = \App\Models\Pelanggan::all(); // Ambil semua data pelanggan
    $produk = \App\Models\Produk::all(); // Ambil semua data produk

    return view('penjualan.create', compact('pelanggans', 'produk'));
}


public function store(Request $request)
{
    $request->validate([
        'Pelangganid'       => 'required|exists:pelanggans,Pelangganid',
        'TanggalPenjualan'  => 'required|date',
        'produkid'          => 'required|array|min:1',
        'produkid.*'        => 'exists:produks,Produkid',
        'jumlah_produk'     => 'required|array',
        'jumlah_produk.*'   => 'integer|min:1',
        'TotalHarga'        => 'required|numeric|min:0',
        'UangBayar'         => 'required|numeric|min:0',
        'UangKembali'       => 'required|numeric|min:0',
    ]);

    DB::beginTransaction();
    try {
        $penjualan = Penjualan::create([
            'Pelangganid'      => $request->Pelangganid,
            'TanggalPenjualan' => $request->TanggalPenjualan,
            'TotalHarga'       => $request->TotalHarga,
            'UangBayar'        => $request->UangBayar,
            'UangKembali'      => $request->UangKembali,
        ]);

        foreach ($request->produkid as $index => $produkid) {
            $produk = Produk::findOrFail($produkid);
            $jumlahTerjual = (int) $request->jumlah_produk[$index];

            // Cek apakah stok cukup sebelum mengurangi
            if ($produk->Stok < $jumlahTerjual) {
                DB::rollBack(); // Batalkan transaksi jika stok kurang
                return redirect()->back()->with('error', 'Stok produk ' . $produk->NamaProduk . ' tidak mencukupi.');
            }

            // Kurangi stok produk
            $produk->Stok -= $jumlahTerjual;
            $produk->save();

            // Simpan detail penjualan
            DetailPenjualan::create([
                'Penjualanid'   => $penjualan->Penjualanid,
                'Produkid'      => $produkid,
                'jumlah_produk' => $jumlahTerjual,
                'subtotal'      => $jumlahTerjual * $produk->Harga,
            ]);
        }

        DB::commit(); // Simpan semua perubahan ke database

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil disimpan.');
    } catch (\Exception $e) {
        DB::rollBack(); // Kembalikan perubahan jika ada error
        return back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
    }
}

    public function show($id)
{
    $penjualan = Penjualan::with(['pelanggan', 'detailPenjualan.produk'])->findOrFail($id);
    return view('penjualan.show', compact('penjualan'));
}
    

    public function edit($id)
    {
        $pelanggans = Pelanggan::all();
        $penjualan = Penjualan::findOrFail($id);
        return view('penjualan.edit', compact('penjualan', 'pelanggans'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'Pelangganid'       => 'required|exists:pelanggans,Pelangganid',
        'TanggalPenjualan'  => 'required|date',
        'produkid'          => 'required|array|min:1',
        'produkid.*'        => 'exists:produks,Produkid',
        'jumlah_produk'     => 'required|array',
        'jumlah_produk.*'   => 'integer|min:1',
        'TotalHarga'        => 'required|numeric|min:0',
    ]);

    DB::transaction(function () use ($request, $id) {
        $penjualan = Penjualan::findOrFail($id);

        // 🔄 Kembalikan stok produk sebelum update
        foreach ($penjualan->detailPenjualan as $detail) {
            $produk = Produk::find($detail->Produkid);
            if ($produk) {
                $produk->update(['Stok' => $produk->Stok + $detail->jumlah_produk]);
            }
        }

        // Hapus detail penjualan lama
        DetailPenjualan::where('Penjualanid', $id)->delete();

        // Update data penjualan
        $penjualan->update([
            'Pelangganid'       => $request->Pelangganid,
            'TanggalPenjualan'  => $request->TanggalPenjualan,
            'TotalHarga'        => $request->TotalHarga,
        ]);

        // Tambahkan detail penjualan baru & kurangi stok produk
        foreach ($request->produkid as $index => $produkid) {
            $produk = Produk::findOrFail($produkid);
            $jumlahBaru = $request->jumlah_produk[$index];

            if ($produk->Stok < $jumlahBaru) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Stok produk ' . $produk->NamaProduk . ' tidak mencukupi.');
            }

            // Kurangi stok produk
            $produk->update(['Stok' => $produk->Stok - $jumlahBaru]);

            // Simpan detail penjualan baru
            DetailPenjualan::create([
                'Penjualanid'   => $penjualan->Penjualanid,
                'Produkid'      => $produkid,
                'jumlah_produk' => $jumlahBaru,
                'subtotal'      => $jumlahBaru * $produk->Harga,
            ]);
        }
    });

    return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil diperbarui.');
}

    public function destroy($id)
{
    DB::beginTransaction();
    try {
        $penjualan = Penjualan::findOrFail($id);
        $detailPenjualans = DetailPenjualan::where('Penjualanid', $id)->get();

        // Kembalikan stok produk sebelum menghapus detail penjualan
        foreach ($detailPenjualans as $detail) {
            $produk = Produk::find($detail->Produkid);
            if ($produk) {
                $produk->Stok += $detail->jumlah_produk;
                $produk->save();
            }
        }

        // Hapus detail penjualan
        DetailPenjualan::where('Penjualanid', $id)->delete();

        // Hapus penjualan
        $penjualan->delete();

        DB::commit();
        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dihapus.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
    }
}

    public function struk($Penjualanid)
{
    $penjualan = Penjualan::findOrFail($Penjualanid);
    return view('penjualan.struk', compact('penjualan'));
}


public function laporan(Request $request)
    {
    // Ambil bulan & tahun dari request (default: bulan & tahun sekarang)
       $bulan = $request->input('bulan', date('m'));
       $tahun = $request->input('tahun', date('Y'));
       $minggu = $request->input('minggu', 'all');


    // Ambil data penjualan berdasarkan bulan & tahun
        $penjualans = Penjualan::whereYear('TanggalPenjualan', $tahun)
        ->whereMonth('TanggalPenjualan', $bulan);
        if ($minggu !== 'all') {
            $penjualans->whereRaw(
                'WEEK(TanggalPenjualan, 1) - WEEK(DATE_SUB(TanggalPenjualan, INTERVAL DAYOFMONTH(TanggalPenjualan)-1 DAY), 1) + 1 = ?',
                [$minggu]
            );
        }
    
        $penjualans = $penjualans->get();


        return view('penjualan.laporan', compact('penjualans','bulan', 'tahun', 'minggu'));
    }

    public function cetakLaporan(Request $request)
    {
       $bulan = $request->input('bulan', date('m'));
       $tahun = $request->input('tahun', date('Y'));
       $minggu = $request->input('minggu', 'all');


    // Ambil data penjualan berdasarkan bulan & tahun
       $penjualans = Penjualan::whereYear('TanggalPenjualan', $tahun)
        ->whereMonth('TanggalPenjualan', $bulan);
        if ($minggu !== 'all') {
            $penjualans->whereRaw(
                'WEEK(TanggalPenjualan, 1) - WEEK(DATE_SUB(TanggalPenjualan, INTERVAL DAYOFMONTH(TanggalPenjualan)-1 DAY), 1) + 1 = ?',
                [$minggu]
            );
        }
    
        $penjualans =$penjualans->get();
    // Generate PDF
        $pdf = Pdf::loadView('penjualan.cetak-laporan',compact('penjualans', 'bulan', 'tahun', 'minggu'));

        return $pdf->download("Laporan_Penjualan_{$bulan}_{$tahun}_minggu_{$minggu}.pdf");
    }
}