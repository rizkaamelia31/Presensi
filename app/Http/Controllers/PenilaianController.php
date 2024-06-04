<?php

namespace App\Http\Controllers;

use App\Models\KriteriaPenilaian;
use App\Models\Mahasiswa;
use App\Models\Penilaian;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        if ($user->role_id == 3) {
            $perusahaan = $user->perusahaan;
    
            $mahasiswa = Mahasiswa::where('perusahaan_id', $perusahaan->id)
                ->with(['user', 'penilaians'])
                ->get();
    
            return view('mitra.penilaian.index', compact('mahasiswa'));
        } else {
            $dosen = $user->dosen;
    
            $mahasiswa = Mahasiswa::where('dosen_id', $dosen->id)
                ->with(['user', 'penilaians'])
                ->get();
    
            return view('mitra.penilaian.index', compact('mahasiswa'));
        } 
        
    }
    

    public function create($mhs_id)
    {
        // Mengambil data mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::with('user')->findOrFail($mhs_id);

        // Mengambil semua kriteria penilaian dan mengelompokkannya berdasarkan jenis
        $kriteriaPenilaian = KriteriaPenilaian::all()->groupBy('jenis');

        return view('mitra.penilaian.create', compact('mahasiswa', 'kriteriaPenilaian'));
    }
    public function store(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'mhs_id' => 'required|exists:mahasiswa,id',
        'nilai_*' => 'required|numeric|min:0|max:100'
    ]);

    // Mendapatkan user yang sedang login
    $user = auth()->user();

    // Loop melalui semua input yang dimulai dengan 'nilai_'
    foreach ($request->all() as $key => $value) {
        if (strpos($key, 'nilai_') === 0) {
            $kriteriaId = str_replace('nilai_', '', $key);
            $kriteria = KriteriaPenilaian::find($kriteriaId);

            // Memeriksa apakah kriteria ditemukan
            if (!$kriteria) {
                return redirect()->route('penilaian.index')->with('error', 'Kriteria tidak ditemukan.');
            }

            // Memeriksa role_id dan jenis kriteria
            if ($user->role_id == 3 && $kriteria->jenis != 'eksternal') {
                return redirect()->route('penilaian.index')->with('error', 'Anda hanya dapat memasukkan kriteria dengan jenis external.');
            }

            if ($user->role_id == 4 && $kriteria->jenis != 'internal') {
                return redirect()->route('penilaian.index')->with('error', 'Anda hanya dapat memasukkan kriteria dengan jenis internal.');
            }

            // Menghitung nilai bobot
            $nilaiBobot = $value * ($kriteria->bobot / 100); // Mengalikan nilai dengan bobot

            // Menyimpan penilaian
            Penilaian::create([
                'mhs_id' => $request->mhs_id,
                'kriteria_penilaian_id' => $kriteriaId,
                'nilai' => $nilaiBobot // Menyimpan nilai setelah dikali bobot
            ]);
        }
    }

    // Mengarahkan kembali dengan pesan sukses
    return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil ditambahkan.');
}

    
    public function edit($id)
{
    $mahasiswa = Mahasiswa::findOrFail($id);
    $penilaian = Penilaian::where('mhs_id', $id)->get();

    return view('mitra.penilaian.edit', compact('mahasiswa', 'penilaian'));
}

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            // Validasi disesuaikan dengan kebutuhan
        ]);
    
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'nilai_') === 0) {
                $nilaiId = str_replace('nilai_', '', $key);
                Penilaian::where('id', $nilaiId)->update(['nilai' => $value]);
            }
        }
    
        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil diperbarui');
    }

    public function destroy($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();

        return redirect()->route('penilaian.index')
                        ->with('success', 'Penilaian berhasil dihapus.');
    }

    public function detail($mhs_id)
{
    // Mengambil data mahasiswa beserta penilaiannya berdasarkan ID
    $mahasiswa = Mahasiswa::with(['user', 'penilaians.kriteriaPenilaian'])->findOrFail($mhs_id);

    return view('mitra.penilaian.detail', compact('mahasiswa'));
}
}
