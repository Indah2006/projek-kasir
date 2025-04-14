<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $table = 'detail_penjualans';
    protected $primaryKey = 'Detailid';
    public $timestamps = false;

    protected $fillable = [
        'Penjualanid',
        'Produkid',
        'jumlah_produk', // Pastikan ini ada!
        'subtotal'
    ];
    

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'Penjualanid', 'Penjualanid');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'Produkid', 'Produkid');
    }
}
