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
        Schema::create('laporan_akhir', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mhs_id');
            $table->string('laporan_akhir');
            $table->timestamps();

            $table->foreign('mhs_id')->references('id')->on('mahasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_akhir');
    }
};
