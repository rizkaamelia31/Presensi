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
                ->with(['user', 'penilaians.kriteriaPenilaian'])
                ->get();

            return view('mitra.penilaian.index', compact('mahasiswa'));
        } else {
            $dosen = $user->dosen;

            $mahasiswa = Mahasiswa::with(['user', 'penilaians.kriteriaPenilaian'])
                ->get();

            return view('mitra.penilaian.index', compact('mahasiswa'));
        }
    }



    public function create($mhs_id)
    {
        $mahasiswa = Mahasiswa::with('user')->findOrFail($mhs_id);

        // Mendapatkan kriteria penilaian sesuai dengan role_id pengguna saat ini
        $kriteriaPenilaian = KriteriaPenilaian::where(function ($query) {
            $role_id = Auth::user()->role_id;

            if ($role_id == 3) {
                // Jika role_id adalah 3 (external), ambil kriteria eksternal
                $query->where('jenis', 'eksternal');
            } elseif ($role_id == 4) {
                // Jika role_id adalah 4 (internal), ambil kriteria internal
                $query->where('jenis', 'internal');
            }
        })->get();

        // Ambil dosen_id dari pengguna saat ini jika rolenya adalah dosen (role_id 4)
        $dosen_id = null;
        if (Auth::user()->role_id == 4) {
            $dosen_id = Auth::user()->dosen->id;
        }

        return view('mitra.penilaian.create', compact('mahasiswa', 'kriteriaPenilaian', 'dosen_id'));
    }

   

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'mhs_id' => 'required|exists:mahasiswa,id',
            'nilai_*' => 'required|numeric|min:0|max:100'
        ]);

        $user = auth()->user();

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
                    return redirect()->route('penilaian.index')->with('error', 'Anda hanya dapat memasukkan kriteria dengan jenis eksternal.');
                }

                if ($user->role_id == 4 && $kriteria->jenis != 'internal') {
                    return redirect()->route('penilaian.index')->with('error', 'Anda hanya dapat memasukkan kriteria dengan jenis internal.');
                }

                // Menentukan kolom dosen_id atau perusahaan_id berdasarkan role_id
                $data = [
                    'mhs_id' => $request->mhs_id,
                    'kriteria_penilaian_id' => $kriteriaId,
                    'nilai' => $value
                ];

                if ($user->role_id == 3) {
                    $data['perusahaan_id'] = $user->perusahaan->id;
                } else {
                    $data['dosen_id'] = $user->dosen->id;
                }

                Penilaian::create($data);
            }
        }

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil ditambahkan.');
    }


    public function edit($mhs_id, $type)
    {
        $mahasiswa = Mahasiswa::findOrFail($mhs_id);
        $penilaian = Penilaian::where('mhs_id', $mhs_id)
                              ->where('dosen_id', auth()->user()->dosen->id)
                              ->whereHas('kriteriaPenilaian', function($query) use ($type) {
                                  $query->where('jenis', $type);
                              })->get();

        $kriteriaPenilaian = KriteriaPenilaian::where('jenis', $type)->get();

        return view('mitra.penilaian.edit', compact('mahasiswa', 'penilaian', 'kriteriaPenilaian'));
    }

    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
       
    ]);

    $user = auth()->user();
    $dosen_id = $user->role_id == 4 ? $user->dosen->id : null;
    $perusahaan_id = $user->role_id == 3 ? $user->perusahaan->id : null;

    foreach ($request->all() as $key => $value) {
        if (strpos($key, 'nilai_') === 0) {
            $nilaiId = str_replace('nilai_', '', $key);
            $penilaian = Penilaian::findOrFail($nilaiId);

            // Memeriksa apakah pengguna memiliki izin untuk mengedit penilaian
            if (($user->role_id == 4 && $penilaian->dosen_id != $dosen_id) || ($user->role_id == 3 && $penilaian->perusahaan_id != $perusahaan_id)) {
                return redirect()->route('penilaian.index')->with('error', 'Anda tidak memiliki izin untuk mengedit penilaian ini.');
            }

            $penilaian->update(['nilai' => $value]);
        }
    }

    return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil diperbarui.');
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
