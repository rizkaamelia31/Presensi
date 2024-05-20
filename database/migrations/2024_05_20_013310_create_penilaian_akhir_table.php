<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianAkhirTable extends Migration
{
    public function up()
    {
        Schema::create('penilaian_akhir', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Assuming user_id refers to the student or assessor
            $table->decimal('criteria1', 5, 2);
            $table->decimal('criteria2', 5, 2);
            $table->decimal('criteria3', 5, 2);
            $table->decimal('criteria4', 5, 2);
            $table->decimal('criteria5', 5, 2);
            $table->decimal('criteria6', 5, 2);
            $table->decimal('criteria7', 5, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penilaian_akhir');
    }
}