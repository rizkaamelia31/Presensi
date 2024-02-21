<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('tanggal_lahir');
            $table->string('magang_batch');
            $table->unsignedBigInteger('perusahaan_id');
            $table->foreign('perusahaan_id')->references('id')->on('perusahaan')->onDelete('cascade');
            $table->string('gambar')->nullable();
            $table->string('nama_supervisor');
            $table->string('no_hp_supervisor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
};
