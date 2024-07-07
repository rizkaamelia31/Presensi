<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = "dosen";
    protected $fillable = [
        'user_id',
        'nidn',
        'gambar',
    ];

    
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'dosen_id');
    }

    public function mahasiswaDinilai()
    {
        return $this->belongsToMany(Mahasiswa::class, 'setting_mahasiswa', 'dosen_id', 'mhs_id');
    }
}
