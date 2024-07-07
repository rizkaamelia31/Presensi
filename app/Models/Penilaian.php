<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian';
    protected $fillable = [
        'mhs_id',
        'kriteria_penilaian_id',
        'dosen_id',
        'perusahaan_id',
        'nilai',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function kriteriaPenilaian()
    {
        return $this->belongsTo(KriteriaPenilaian::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'mhs_id');
    }
}
