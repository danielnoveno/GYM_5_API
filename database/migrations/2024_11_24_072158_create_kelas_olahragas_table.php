<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kelas_olahragas', function (Blueprint $table) {
            $table->id('id_kelas');
            $table->string('judul');
            $table->string('harga');
            $table->string('image_path');
            $table->json('deskripsi');
            $table->json('kelas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelas_olahragas');
    }
};
