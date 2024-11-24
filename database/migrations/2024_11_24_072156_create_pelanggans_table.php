<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id('id_pelanggan'); // id_pelanggan harusnya defaultnya unsignedBigInteger
            $table->string('nama');
            $table->integer('umur');
            $table->string('alamat');
            $table->string('no_telepon');
            $table->string('email');
            $table->unsignedBigInteger('id_jadwal');
            $table->timestamp('tanggal_daftar')->useCurrent();
            $table->timestamps();

            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwals')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelanggans');
    }
};
