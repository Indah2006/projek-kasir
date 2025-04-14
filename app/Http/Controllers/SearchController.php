<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;   
use App\Models\Produk;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        // Cari di Produk
        $produk = Produk::where('NamaProduk', 'like', "%{$query}%")->first();
        if ($produk) {
            return redirect()->route('produk.index', ['search' => $query]);
        }

        // Cari di Pelanggan
        $pelanggan = Pelanggan::where('NamaPelanggan', 'like', "%{$query}%")->first();
        if ($pelanggan) {
            return redirect()->route('pelanggan.index', ['search' => $query]);
        }

        // Kalau tidak ketemu, kembali ke halaman sebelumnya
        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }
}
