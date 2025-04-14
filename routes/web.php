<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;


Route::get('/', function () {
    return view('welcome');
});

// 🔹 ROUTE UNTUK ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Kelola Pelanggan
   
    Route::get('pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
    Route::post('pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
    Route::get('pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
    Route::put('pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
    Route::delete('pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

    // Kelola Produk

    Route::get('produk', [ProdukController::class, 'index'])->name('produk.index'); // Menampilkan daftar produk
    Route::get('produk/create', [ProdukController::class, 'create'])->name('produk.create'); // Form tambah produk
    Route::post('produk', [ProdukController::class, 'store'])->name('produk.store'); // Menyimpan produk baru
    Route::get('produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit'); // Form edit produk
    Route::put('produk/{id}', [ProdukController::class, 'update'])->name('produk.update'); // Memperbarui produk
    Route::delete('produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy'); // Menghapus produk

    // Kelola Detail Penjualan
    
});

// 🔹 ROUTE UNTUK KASIR


// 🔹 ROUTE YANG BISA DIAKSES SEMUA USER (LOGIN, REGISTER, DASHBOARD)
Route::get('/penjualan/struk/{Penjualanid}',[PenjualanController::class, 'Struk'])->name('penjualan.struk');
Route::get('/penjualan/laporan', [PenjualanController::class,'laporan'])->name('penjualan.laporan');
Route::get('/penjualan/laporan/cetak',[PenjualanController::class,'cetakLaporan'])->name('penjualan.cetakLaporan');
Route::get('/penjualan', [PenjualanController::class,'index'])->name('penjualan.index'); Route::get('/penjualan/laporan', [PenjualanController::class,'laporan'])->name('penjualan.laporan');
Route::get('/penjualan/laporan/cetak',[PenjualanController::class,'cetakLaporan'])->name('penjualan.cetakLaporan');
Route::get('produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('pages.register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::resource('detail-penjualan', DetailPenjualanController::class);
Route::resource('penjualan', PenjualanController::class);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/search', [SearchController::class, 'search'])->name('search');
