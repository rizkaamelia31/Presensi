<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = "mahasiswa";
    protected $fillable = [
        'user_id',
        'tanggal_lahir',
        'magang_batch',
        'perusahaan_id',
        'gambar',
        'nama_supervisor',
        'no_hp_supervisor',
    ];
}
