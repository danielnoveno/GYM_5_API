<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->date('tanggal_transaksi');
            $table->decimal('jumlah_transaksi', 10, 2);
            $table->string('metode_pembayaran');
            $table->string('status_pembayaran');
            $table->unsignedBigInteger('id_layanan');
            $table->unsignedBigInteger('id_pelanggan');
            $table->timestamps();

            $table->foreignId('id_layanan')->constrained()->onDelete('cascade');
            $table->foreignId('id_pelanggan')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
};
