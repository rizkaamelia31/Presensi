<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;
    protected $fillable = [
        'mhs_id',
        'deskripsi',
        'lampiran',
        'status',
    ];

    // Relasi dengan model User (Mahasiswa)
    public function user()
    {
        return $this->belongsTo(User::class, 'mhs_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mhs_id');
    }
}
