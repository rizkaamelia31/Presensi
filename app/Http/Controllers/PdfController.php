<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;

use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use PDF;


class PdfController extends Controller
{
    public function generatePdf()
    {
        $user = Auth::id();
        $mahasiswa = Mahasiswa::where('user_id', $user)->first();
    
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan');
        }
    
        $mahasiswaId = $mahasiswa->id;
        $penilaians = Penilaian::where('mhs_id', $mahasiswaId)->with('kriteriaPenilaian')->get();
        $totalEksternal = 0;
        $totalInternal = 0;
    
        // Menghitung total nilai eksternal dan internal
        foreach ($penilaians as $penilaian) {
            if ($penilaian->kriteriaPenilaian->jenis === 'eksternal') {
                $totalEksternal += $penilaian->nilai * $penilaian->kriteriaPenilaian->bobot / 100;
            } elseif ($penilaian->kriteriaPenilaian->jenis === 'internal') {
                $totalInternal += $penilaian->nilai * $penilaian->kriteriaPenilaian->bobot / 100;
            }
        }
    
        // Menghitung total nilai akhir dengan bobot 70% eksternal dan 30% internal
        $totalNilaiAkhir = ($totalEksternal * 0.7) + ($totalInternal * 0.3);
    
        $pdf = PDF::loadView('mahasiswa.nilai_magang.pdf', compact('penilaians', 'totalNilaiAkhir'));
        return $pdf->download('nilai_magang_mahasiswa.pdf');
    }
    
}
