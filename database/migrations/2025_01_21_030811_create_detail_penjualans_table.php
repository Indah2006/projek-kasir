<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenjualansTable extends Migration
{
    public function up()
    {
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->id('detailid');
            $table->unsignedBigInteger('Penjualanid');
            $table->unsignedBigInteger('Produkid');
            $table->integer('jumlah_produk')->default(1);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('detail_penjualans');
    }
}
