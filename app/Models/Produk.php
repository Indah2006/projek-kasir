<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';
    protected $primaryKey = 'Produkid';
    public $timestamps = false;

    protected $fillable = ['NamaProduk', 'Harga', 'Stok'];

    public function penjualans()
    {
        return $this->belongsToMany(Penjualan::class, 'detail_penjualans', 'Produkid', 'Penjualanid');
    }
}

