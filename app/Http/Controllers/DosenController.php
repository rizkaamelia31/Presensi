<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DosenController extends Controller
{
    public function rekap_logbook()
    {
        $mahasiswa = Mahasiswa::all();
    
        $hariIni = Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY');
    
        return view('dosen.rekap_logbook.index',compact('mahasiswa','hariIni') );
    }
    


    public function laporan_akhir()
    {
        
        return view('dosen.laporan_akhir.index');
    }
    public function penilaian_akhir()
    {
        
        return view('dosen.penilaian_akhir.index');
    }
    public function detail_rekap_logbook($id)
    {
        $logbook = Logbook::where('status', 'Disetujui')
            ->where('mhs_id', $id) // Sesuaikan dengan field yang sesuai dalam tabel logbook
            ->get(); 
            $mahasiswa = Mahasiswa::findOrFail($id);
        return view('dosen.rekap_logbook.detail', compact('logbook','mahasiswa'));
    }
    
    
}
