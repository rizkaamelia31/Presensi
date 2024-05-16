<?php

namespace App\Http\Controllers;

use App\Models\LaporanAkhir;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Logbook;
use App\Models\Mahasiswa;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    public function beranda()
    {
    // Logika untuk bagian beranda
    return view("home");
    }

    public function logbook()
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa->id;
        
        $logbook = Logbook::where('mhs_id', $mahasiswa )
    ->orderBy('created_at', 'desc')
    ->get();
        $hariIni = Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY');
        return view("mahasiswa.logbook.index",compact('logbook','hariIni'));
    }
    public function logbookStore(Request $request)
    {
        // Validasi data dari request
        $validatedData = $request->validate([
            'deskripsi' => 'required|string|min:20',
        ],[
            'min' => 'Deskripsi minimal 20 Karakter',
            'required' => 'Deskripsi wajib diisi'
        ]);
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;
        
    
        $mhs_id = $mahasiswa->id;
        
        $today = Carbon::now()->format('Y-m-d');
        $existingLogbook = Logbook::where('mhs_id', $mhs_id)->whereDate('created_at', $today)->first();
    
        if ($existingLogbook) {
            return redirect()->back()->with('error', 'Anda hanya dapat membuat satu logbook dalam satu hari.');
        }

        $logbook = new Logbook([
            'mhs_id' => $mhs_id,
            'deskripsi' => $validatedData['deskripsi'],
        ]);
    
        $logbook->save();
    
        return redirect()->route('mahasiswa.logbook.index')->with('success', 'Logbook berhasil disimpan.');
    }

    public function laporan_akhir()
    {
       
        $laporanAkhir = LaporanAkhir::whereHas('mahasiswa', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->first();
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        return view('mahasiswa.laporan_akhir.index',compact('mahasiswa','laporanAkhir'));
    }
    public function penilaian_akhir()
    {
        // Logika untuk bagian penilaian akhir
        return view("mahasiswa.penilaian_akhir.index");
    }

    public function uploadLaporan(Request $request)
    {
       
        $request->validate([
            'laporan_akhir' => 'required', 
        ]);

        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa not found');
        }

        $file = $request->file('laporan_akhir');
        $path = $file->storeAs('laporan', $file->getClientOriginalName());

        $laporanAkhir = new LaporanAkhir();
        $laporanAkhir->mhs_id = $mahasiswa->id;
        $laporanAkhir->laporan_akhir = $path;
        $laporanAkhir->save();

        return redirect()->back()->with('success', 'Laporan berhasil diupload');
    }

    public function profil()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();
        $perusahaanList = Perusahaan::all(); // Ambil semua data perusahaan
        return view('mahasiswa.profil', compact('mahasiswa', 'perusahaanList'));
    }

  

public function updateProfil(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'nullable|string|min:8',
        'tanggal_lahir' => 'required|date',
        'magang_batch' => 'required|string',
        'perusahaan_id' => 'required|string',
        'nama_supervisor' => 'required|string',
        'no_hp_supervisor' => 'required|string',
        'gambar' => 'nullable|image|max:2048', 
    ]);

    $user = Auth::user();
    $mahasiswa = Mahasiswa::where('user_id', $user->id)->firstOrFail();

    $userUpdates = [];
    $mahasiswaUpdates = [];

    if ($request->filled('name')) {
        $userUpdates['name'] = $request->input('name');
    }

    if ($request->filled('email')) {
        $userUpdates['email'] = $request->input('email');
    }

    if ($request->filled('password')) {
        $userUpdates['password'] = bcrypt($request->input('password'));
    }

    $mahasiswaUpdates = $request->except(['_token', '_method', 'name', 'email', 'password']);

    if ($request->hasFile('gambar')) {
        if ($mahasiswa->gambar && Storage::exists($mahasiswa->gambar)) {
            Storage::delete($mahasiswa->gambar);
        }
    
        $image = $request->file('gambar');
        $path = 'images';
        $namaGambar = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($path, $namaGambar);

        $mahasiswaUpdates['gambar'] = $namaGambar;
    }

    if (!empty($userUpdates)) {
        $user->update($userUpdates);
    }

    // Update data pada tabel Mahasiswa
    if (!empty($mahasiswaUpdates)) {
        $mahasiswa->update($mahasiswaUpdates);
    }

    return redirect()->route('mahasiswa.profil')->with('success', 'Profil berhasil diperbarui.');
}

}