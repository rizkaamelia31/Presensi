<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;

use App\Models\Mahasiswa;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;


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
        $groupedPenilaian = [];
    
        // Grouping the penilaian based on the criteria
        foreach ($penilaians as $penilaian) {
            $kriteria = $penilaian->kriteriaPenilaian->nama_kriteria;
            $jenis = $penilaian->kriteriaPenilaian->jenis;
            $bobot = $penilaian->kriteriaPenilaian->bobot;
    
            if (!isset($groupedPenilaian[$kriteria])) {
                $groupedPenilaian[$kriteria] = [
                    'total_nilai' => 0,
                    'count' => 0,
                    'jenis' => $jenis,
                    'bobot' => $bobot,
                ];
            }
    
            $groupedPenilaian[$kriteria]['total_nilai'] += $penilaian->nilai;
            $groupedPenilaian[$kriteria]['count'] += 1;
        }
    
        $totalEksternal = 0;
        $totalInternal = 0;
    
        // Calculate the average and the total score
        foreach ($groupedPenilaian as $kriteria => $data) {
            $averageNilai = $data['total_nilai'] / $data['count'];
            $weightedScore = $averageNilai * $data['bobot'] / 100;
    
            if ($data['jenis'] === 'eksternal') {
                $totalEksternal += $weightedScore;
            } elseif ($data['jenis'] === 'internal') {
                $totalInternal += $weightedScore;
            }
        }
    
        // Calculate the final score with weights
        $totalNilaiAkhir = ($totalEksternal * 0.7) + ($totalInternal * 0.3);
    
        $pdf = PDF::loadView('mahasiswa.nilai_magang.pdf', compact('groupedPenilaian', 'totalNilaiAkhir'));
        return $pdf->download('nilai_magang_mahasiswa.pdf');
    }
    
    
}
