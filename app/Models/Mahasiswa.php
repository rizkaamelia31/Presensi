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
        'dosen_id',
    ];
    
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
public function dosen()
{
    return $this->belongsTo(User::class, 'dosen_id');
}



public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'mhs_id');
    }


}
