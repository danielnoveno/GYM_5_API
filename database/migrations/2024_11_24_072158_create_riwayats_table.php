<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id('id_riwayat');
            $table->date('tanggal_riwayat');
            $table->string('jenis_layanan');
            $table->unsignedBigInteger('id_detail_transaksi');
            $table->unsignedBigInteger('id_layanan');
            $table->timestamps();

            $table->foreignId('id_detail_transaksi')->constrained('detail_transaksis', 'id_detail_transaksi')->onDelete('cascade'); // Sesuaikan kolom yang direferensikan
            $table->foreignId('id_layanan')->constrained('layanans')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('riwayats');
    }
};
