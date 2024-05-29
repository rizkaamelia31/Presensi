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
        Schema::create('kriteria_penilaian', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kriteria');
            $table->decimal('bobot', 5, 2);
            $table->enum('jenis', ['internal', 'eksternal']);
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
        Schema::dropIfExists('kriteria_penilaians');
    }
};
