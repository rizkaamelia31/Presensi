<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Logbook;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function rekap_logbook()
    {
        $user = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->first();
        
        // Pastikan dosen ditemukan
        if(!$dosen) {
            return redirect()->back()->with('error', 'Dosen tidak ditemukan.');
        }
    
        $mahasiswa = Mahasiswa::where('dosen_id', $dosen->id)->get();
        
        // Hari ini dalam format yang diinginkan
        $hariIni = Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY');
        
        return view('dosen.rekap_logbook.index', compact('mahasiswa', 'hariIni'));
    }
    
    
    public function LaporanAkhir()
    {
        $laporanAkhir = Logbook::whereHas('mahasiswa', function ($query) {
            $query->whereNotNull('laporan_akhir');
        })->with('mahasiswa.user')->get();

        return view('dosen.laporan_akhir.index', compact('laporanAkhir'));
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
    

    public function riwayat(Request $request)
{
    $magang_batches = Mahasiswa::distinct()->pluck('magang_batch')->toArray();
    
    // Default filter batch
    $default_batch = 1;

    $query = Mahasiswa::with(['user', 'perusahaan']);

    // Apply filter based on the request
    if ($request->has('magang_batch') && $request->magang_batch !== '') {
        $query->where('magang_batch', $request->magang_batch);
    } else {
        // Apply default batch filter when no batch is selected
        $query->where('magang_batch', $default_batch);
    }

    $mahasiswa = $query->get();

    // Return JSON response if the request is AJAX
    if ($request->ajax()) {
        return response()->json($mahasiswa);
    }
    
    return view('dosen.riwayat.index', compact('mahasiswa', 'magang_batches'));
}



   


}
