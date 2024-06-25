<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNimAndAngkatanToMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->string('nim')->after('user_id'); // Menambahkan kolom nim setelah kolom user_id
            $table->year('angkatan')->after('nim'); // Menambahkan kolom angkatan setelah kolom nim
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropColumn('nim');
            $table->dropColumn('angkatan');
        });
    }
};
