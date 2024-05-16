<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DosenController extends Controller
{
    public function rekap_logbook()
    {
        $logbooks = Logbook::with('mahasiswa.user')->get();
    
        $groupedData = $logbooks->groupBy('mhs_id')->map(function($logbooks, $mhs_id) {
            $mahasiswa = $logbooks->first()->mahasiswa;
            $firstLogbookDate = Carbon::parse($logbooks->min('created_at')); // Get the earliest logbook date
            $today = Carbon::today();

            $jumlah_hadir = $logbooks->count();
            $jumlah_tidak_hadir = $today->diffInDays($firstLogbookDate);

            return [
                'gambar' => $mahasiswa ? $mahasiswa->gambar : 'default.jpg',
                'nama' => $mahasiswa->user->name,
                'jumlah_hadir' =>$jumlah_hadir,
                'jumlah_tidak_hadir' => $jumlah_tidak_hadir,
                'id' => $logbooks->first()->id 
            ];
        });

        $hariIni = Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY');
    
        // Pass the processed data to the view
        return view('dosen.rekap_logbook.index', [
            'logbookData' => $groupedData,
            'hariIni' => $hariIni,
        ]);
    }
    


    public function laporan_akhir()
    {
        
        return view('dosen.laporan_akhir.index');
    }
    public function ujian_akhir()
    {
        
        return view('dosen.ujian_akhir.index');
    }
    public function detail_rekap_logbook()
    {
        
        return view('dosen.rekap_logbook.detail');
    }
    
}
