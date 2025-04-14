<?php

// app/Models/Penjualan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualans';
    protected $primaryKey = 'Penjualanid';
    public $timestamps = false;

    protected $fillable = [
        'Pelangganid',
        'TanggalPenjualan',
        'TotalHarga',
        'UangBayar',  // Pastikan ini ada
        'UangKembali'
    ];
    
    // Relasi ke DetailPenjualan
    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'Penjualanid', 'Penjualanid');
    }

    // ✅ Tambahkan relasi ke Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'Pelangganid', 'Pelangganid');
    }
}

