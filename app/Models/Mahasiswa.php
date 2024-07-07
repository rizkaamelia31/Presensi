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
        'nim',
        'angkatan',
    ];
    
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}
public function dosen()
{
    return $this->belongsTo(User::class, 'dosen_id');
}



public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'mhs_id');
    }

    public function settingMagang()
    {
        return $this->belongsTo(SettingMagang::class, 'magang_batch', 'magang_batch');
    }

    public function dosenPenilai()
    {
        return $this->belongsToMany(Dosen::class, 'setting_mahasiswa', 'mhs_id', 'dosen_id');
    }

   


}
