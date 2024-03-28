<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function absensi()
    {
        
        return view('admin.absensi.index');
    }
    public function logbook()
    {
        
        return view('admin.logbook.index');
    }
    public function laporan_akhir()
    {
        
        return view('admin.laporan_akhir.index');
    }
    public function detail_logbook()
    {
        
        return view('admin.logbook.detail');
    }
    public function detail_absensi()
    {
        
        return view('admin.absensi.detail');
    }
    
}
