<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingMagang extends Model
{
    use HasFactory;

    protected $table = 'settings_magang';

    protected $fillable = [
        'magang_batch',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'magang_batch', 'magang_batch');
    }
}
