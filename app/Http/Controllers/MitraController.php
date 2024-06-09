<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use Illuminate\Http\Request;

use Carbon\Carbon;

class MitraController extends Controller
{
    public function logbookMitra()
    {
        $user = auth()->user();
        $perusahaan = $user->perusahaan->id;
        $logbooks = Logbook::whereHas('mahasiswa', function ($query) use ($perusahaan) {
            $query->where('perusahaan_id', $perusahaan);
        })->with('mahasiswa')->get();
        $hariIni = Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY');

        return view("mitra.logbook.index", compact('logbooks', 'hariIni'));
    }
    public function confirm($id)
{
    $logbook = Logbook::findOrFail($id);
    $logbook->status = 'Disetujui';
    $logbook->save();

    return redirect()->back()->with('success', 'Logbook berhasil dikonfirmasi');
}

    public function detail_logbook()
{
    return view('mitra.logbook.detail');
}

public function JobdescMitra()
{
    return view("mitra.jobdesc.index");
}
}
