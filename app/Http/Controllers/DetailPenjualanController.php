<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class DetailPenjualanController extends Controller
{
    public function index()
    {
        $detailPenjualans = DetailPenjualan::with(['penjualan', 'produk'])->get();
        return view('detail-penjualan.index', compact('detailPenjualans'));
    }

    public function create()
    {
        $penjualans = Penjualan::with('pelanggan')->get();
        $produks = Produk::all();
        return view('detail-penjualan.create', compact('penjualans', 'produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Penjualanid' => 'required|exists:penjualans,Penjualanid',
            'Produkid' => 'required|exists:produks,Produkid',
            'JumlahProduk' => 'required|integer|min:1',
            'Subtotal' => 'required|numeric|min:0',
        ]);

        DetailPenjualan::create($request->all());

        return redirect()->route('detail-penjualan.index')->with('success', 'Detail Penjualan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $detailPenjualan = DetailPenjualan::findOrFail($id);
        $penjualans = Penjualan::all();
        $produks = Produk::all();
        return view('detail-penjualan.edit', compact('detailPenjualan', 'penjualans', 'produks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Penjualanid' => 'required|exists:penjualans,Penjualanid',
            'Produkid' => 'required|exists:produks,Produkid',
            'JumlahProduk' => 'required|integer|min:1',
            'Subtotal' => 'required|numeric|min:0',
        ]);

        $detailPenjualan = DetailPenjualan::findOrFail($id);
        $detailPenjualan->update($request->all());

        return redirect()->route('detail-penjualan.index')->with('success', 'Detail Penjualan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $detailPenjualan = DetailPenjualan::findOrFail($id);
        
        // Kembalikan stok produk sebelum menghapus detail penjualan
        $produk = Produk::find($detailPenjualan->Produkid);
        if ($produk) {
            $produk->Stok += $detailPenjualan->JumlahProduk;
            $produk->save();
        }
    
        // Hapus detail penjualan
        $detailPenjualan->delete();
    
        return redirect()->route('detail-penjualan.index')->with('success', 'Detail Penjualan berhasil dihapus.');
    }    
}