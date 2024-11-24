<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id('id_membership');
            $table->string('jenis_membership');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->string('status');
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_jenis_membership');
            $table->timestamps();

            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggans')->onDelete('cascade');
            $table->foreign('id_jenis_membership')->references('id_jenis_membership')->on('jenis_memberships')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('memberships');
    }
};
