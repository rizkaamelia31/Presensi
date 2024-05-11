<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanAkhir extends Model
{
    use HasFactory;
    protected $table = 'laporan_akhir';

    protected $fillable = [
        'mhs_id',
        'laporan_akhir',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mhs_id');
    }
}
