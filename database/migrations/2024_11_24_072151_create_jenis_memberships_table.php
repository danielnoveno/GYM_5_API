<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jenis_memberships', function (Blueprint $table) {
            $table->id();
            $table->string('membership_title');
            $table->string('type');
            $table->json('description');
            $table->string('price');
            $table->string('total');
            $table->timestamps();

            // $table->foreign('membership_title')
            //     ->references('title')
            //     ->on('memberships')
            //     ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jenis_memberships');
    }
};
