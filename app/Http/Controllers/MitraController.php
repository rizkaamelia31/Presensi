<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

use Carbon\Carbon;

class MitraController extends Controller
{
    public function logbookMitra(Request $request)
    {
        $user = auth()->user();
        $perusahaan = $user->perusahaan->id;
        $batch = $request->input('magang_batch');
    
        $batches = Mahasiswa::distinct()->pluck('magang_batch');
        $logbooksQuery = Logbook::whereHas('mahasiswa', function ($query) use ($perusahaan, $batch) {
            $query->where('perusahaan_id', $perusahaan);
            if ($batch) {
                $query->where('magang_batch', $batch);
            }
        })->with('mahasiswa.user');
    
        $logbooks = $logbooksQuery->get();
    
        $groupedLogbooks = $logbooks->groupBy('mhs_id');
        
        $hariIni = Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY');
    
        return view("mitra.logbook.index", compact('groupedLogbooks', 'hariIni', 'batches', 'batch'));
    }

    public function confirm($id)
{
    $logbook = Logbook::findOrFail($id);
    $logbook->status = 'Disetujui';
    $logbook->save();

    return redirect()->back()->with('success', 'Logbook berhasil dikonfirmasi');
}


public function JobdescMitra()
{
    return view("mitra.jobdesc.index");
}

public function logbookShow($mahasiswa)
{
    $mahasiswa = Mahasiswa::find($mahasiswa);
    $logbooks = Logbook::where('mhs_id', $mahasiswa->id)->with('mahasiswa.user')->get();
    return view('mitra.logbook.detail', compact('logbooks', 'mahasiswa'));
}
}
