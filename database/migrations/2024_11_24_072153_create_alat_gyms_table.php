<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('alat_gyms', function (Blueprint $table) {
            $table->id('id_alat');
            $table->string('image_path');
            $table->string('nama_alat');
            $table->string('deskripsi');
            $table->decimal('harga', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alat_gyms');
    }
};
