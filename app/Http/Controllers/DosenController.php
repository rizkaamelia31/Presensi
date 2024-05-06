<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function absensi()
    {
        
        return view('dosen.absensi.index');
    }
    public function logbook()
    {
        
        return view('dosen.logbook.index');
    }
    public function laporan_akhir()
    {
        
        return view('dosen.laporan_akhir.index');
    }
    public function detail_logbook()
    {
        
        return view('dosen.logbook.detail');
    }
    public function detail_absensi()
    {
        
        return view('dosen.absensi.detail');
    }
    
}
