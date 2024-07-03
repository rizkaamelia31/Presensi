<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;
    protected $table = "perusahaan";
    protected $fillable = [
        'user_id',
        'nama_perusahaan',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'perusahaan_id');
    }
}
