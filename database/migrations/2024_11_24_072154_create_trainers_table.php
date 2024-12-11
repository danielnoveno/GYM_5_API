<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->id('id_trainer');
            $table->string('title');
            $table->string('duration');
            $table->string('imagePath');
            $table->string('email');
            $table->string('description');
            $table->string('specialization');
            $table->double('price');
            // // Tambahkan foreign key
            // $table->unsignedBigInteger('id_paket_personal_trainer');

            // $table->foreign('id_paket_personal_trainer')->references('id_paket_personal_trainer')->on('personal_trainers')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trainers');
    }
};
