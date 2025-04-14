<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index()
    {
        $jumlahProduk = Produk::count();
        $jumlahPenjualan = Penjualan::count();
        $jumlahPelanggan = Pelanggan::count();
    
        return view('home', compact('jumlahProduk', 'jumlahPenjualan', 'jumlahPelanggan'));
    }
    }
