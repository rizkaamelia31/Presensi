<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mhs_id');
            $table->unsignedBigInteger('kriteria_penilaian_id');
            $table->foreign('mhs_id')->references('id')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('kriteria_penilaian_id')->references('id')->on('kriteria_penilaian')->onDelete('cascade');
            $table->decimal('nilai', 5, 2);
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
        Schema::dropIfExists('penilaian');
    }
};
