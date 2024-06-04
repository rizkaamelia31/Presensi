<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RiwayatController extends Controller
{


public function riwayat()
    {
        return view('dosen.riwayat.index');
    }

}