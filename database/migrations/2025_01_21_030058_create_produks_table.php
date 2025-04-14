<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->bigIncrements('Produkid'); // Menggunakan bigIncrements agar sesuai dengan Laravel
            $table->string('NamaProduk', 255);
            $table->decimal('Harga', 10, 2);
            $table->integer('Stok');
            $table->timestamps(); // Jika ingin pakai timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('produks');
    }
}
