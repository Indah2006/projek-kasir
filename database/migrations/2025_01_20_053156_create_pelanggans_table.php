<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelanggansTable extends Migration
{
    public function up()
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id('Pelangganid');
            $table->string('NamaPelanggan');
            $table->string('Alamat');
            $table->string('NomorTelepon');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelanggans');
    }
}
