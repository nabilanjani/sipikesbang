<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('staf', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip')->unique();
            $table->string('email');
            $table->unsignedBigInteger('bidang_id'); // Foreign Key ke bidang
            $table->timestamps();

            $table->foreign('bidang_id')->references('id')->on('bidang')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('staf');
    }
};
