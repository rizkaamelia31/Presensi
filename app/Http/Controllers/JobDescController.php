<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobDesc;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Perusahaan;

class JobDescController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        // Jika pengguna adalah seorang mahasiswa
        if ($user->role_id == 1) {
            $mahasiswa_id = $user->mahasiswa->id;
            $jobdescs = JobDesc::where('mhs_id', $mahasiswa_id)->get();
    
            return view('jobdescs.index', compact('jobdescs'));
        }
    
        $perusahaan_id = $user->perusahaan->id;
        $mahasiswas = Mahasiswa::where('perusahaan_id', $perusahaan_id)->get();
        $jobdescs = JobDesc::whereIn('mhs_id', $mahasiswas->pluck('id'))->get();
    
        return view('jobdescs.index', compact('mahasiswas', 'jobdescs'));
    }
    public function create()
    {
        return view('jobdescs.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'mhs_id' => 'required|exists:mahasiswa,id',
        'file_job' => 'required|mimes:pdf|max:2048',
    ]);

    $file_job = null; // Inisialisasi variabel $file_job

    if ($request->hasFile('file_job')) {
        $file_job = $request->file('file_job');
        $path = 'jobdescs'; // Menentukan direktori penyimpanan
        $namaFile = date('YmdHis') . "." . $file_job->getClientOriginalExtension(); // Membuat nama unik untuk file
        $file_job->move($path, $namaFile); // Memindahkan file ke direktori penyimpanan

        // Simpan nama file unik ke dalam database
        JobDesc::create([
            'mhs_id' => $request->mhs_id,
            'file_job' => $namaFile,
        ]);
    }

    return redirect()->route('jobdescs.index')->with('success', 'Job description berhasil disimpan.');
}

    public function show(JobDesc $jobdesc)
    {
        return view('jobdescs.show', compact('jobdesc'));
    }

    public function edit(JobDesc $jobdesc)
    {
        return view('jobdescs.edit', compact('jobdesc'));
    }

    public function update(Request $request, JobDesc $jobdesc)
    {
        $request->validate([
            'file_job' => 'required|mimes:pdf|max:2048',
            'mhs_id' => 'required|exists:mahasiswa,id',
        ]);

        $file_job = $request->file('file_job')->store('jobdescs');

        $jobdesc->update([
            'mhs_id' => $request->mhs_id,
            'file_job' => $file_job,
        ]);

        return redirect()->route('jobdescs.index')->with('success', 'Job description berhasil diperbarui.');
    }

    public function destroy(JobDesc $jobdesc)
    {
        $jobdesc->delete();
        return redirect()->route('jobdescs.index')->with('success', 'Job description berhasil dihapus.');
    }
}
