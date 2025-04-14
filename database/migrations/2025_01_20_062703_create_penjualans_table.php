<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id('Penjualanid');
            $table->date('TanggalPenjualan');
            $table->unsignedBigInteger('Pelangganid');
            $table->decimal('UangBayar', 15, 2);
            $table->decimal('UangKembali', 15, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penjualans');
    }
}
