<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use Illuminate\Http\Request;

use Carbon\Carbon;

class MitraController extends Controller
{
    public function logbookMitra()
    {
        $logbooks = Logbook::with('mahasiswa')->get(); // Ambil semua logbook beserta data mahasiswa terkait
        $hariIni = Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY');
        return view("mitra.logbook.index",compact('logbooks','hariIni'));
    }
}
