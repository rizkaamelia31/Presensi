<?php

namespace App\Http\Controllers;

use App\Models\LaporanAkhir;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Logbook;
use App\Models\Penilaian;
use App\Models\Perusahaan;
use App\Models\Mahasiswa;
use App\Models\SettingMagang;
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
        $mahasiswa = $user->mahasiswa;
    
        $magangBatch = $mahasiswa->magang_batch;
        $settingsMagang = SettingMagang::where('magang_batch', $magangBatch)->first();
    
        $tanggalMulai = $settingsMagang ? $settingsMagang->tanggal_mulai : null;
    
        $logbook = Logbook::where('mhs_id', $mahasiswa->id)
            ->orderBy('created_at', 'desc')
            ->get();
    
        $hariIni = Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY');
    
        return view("mahasiswa.logbook.index", compact('logbook', 'hariIni', 'tanggalMulai'));
    }
    
    public function logbookStore(Request $request)
    {
        // Validasi data dari request
        $validatedData = $request->validate([
            'deskripsi' => 'required|string|min:20',
            'lampiran' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx,xls,xlsx|max:2048',
        ], [
            'min' => 'Deskripsi minimal 20 Karakter',
            'required' => 'Deskripsi wajib diisi',
            'file' => 'Lampiran harus berupa file',
            'mimes' => 'Lampiran harus berupa file dengan tipe: jpeg, png, jpg, gif, svg, pdf, doc, docx, xls, xlsx',
            'max' => 'Lampiran maksimal 2MB'
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

        if ($request->hasFile('lampiran')) {
            $image = $request->file('lampiran');
            $path = 'lampiran';
            $namaGambar = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($path, $namaGambar);
            $logbook->lampiran = $namaGambar;
        }

        $logbook->save();

        return redirect()->route('mahasiswa.logbook.index')->with('success', 'Logbook berhasil disimpan.');
    }



    public function laporan_akhir()
    {

        $laporanAkhir = LaporanAkhir::whereHas('mahasiswa', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->first();
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        return view('mahasiswa.laporan_akhir.index', compact('mahasiswa', 'laporanAkhir'));
    }
    public function penilaian_akhir()
    {
        // Logika untuk bagian penilaian akhir
        return view("mahasiswa.penilaian_akhir.index");
    }

    public function uploadLaporan(Request $request)
    {
        $request->validate([
            'laporan_akhir' => 'required|mimes:pdf|max:2048',
        ]);

        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa not found');
        }

        if ($request->hasFile('laporan_akhir')) {
            $file = $request->file('laporan_akhir');
            $path = 'laporan_akhir';
            $namaFile = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move(public_path($path), $namaFile);

            $laporanAkhir = new LaporanAkhir();
            $laporanAkhir->mhs_id = $mahasiswa->id;
            $laporanAkhir->laporan_akhir = $path . '/' . $namaFile;
            $laporanAkhir->save();

            return redirect()->back()->with('success', 'Laporan berhasil diupload');
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }
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

    public function nilaiMagang()
    {
        $user = Auth::id();
        $mahasiswa = Mahasiswa::where('user_id', $user)->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan');
        }

        $mahasiswaId = $mahasiswa->id;
        $penilaians = Penilaian::where('mhs_id', $mahasiswaId)->with('kriteriaPenilaian')->get();
        $groupedPenilaian = [];

        // Grouping the penilaian based on the criteria
        foreach ($penilaians as $penilaian) {
            $kriteria = $penilaian->kriteriaPenilaian->nama_kriteria;
            $jenis = $penilaian->kriteriaPenilaian->jenis;
            $bobot = $penilaian->kriteriaPenilaian->bobot;

            if (!isset($groupedPenilaian[$kriteria])) {
                $groupedPenilaian[$kriteria] = [
                    'total_nilai' => 0,
                    'count' => 0,
                    'jenis' => $jenis,
                    'bobot' => $bobot,
                ];
            }

            $groupedPenilaian[$kriteria]['total_nilai'] += $penilaian->nilai;
            $groupedPenilaian[$kriteria]['count'] += 1;
        }

        $totalEksternal = 0;
        $totalInternal = 0;

        // Calculate the average and the total score
        foreach ($groupedPenilaian as $kriteria => $data) {
            $averageNilai = $data['total_nilai'] / $data['count'];
            $weightedScore = $averageNilai * $data['bobot'] / 100;

            if ($data['jenis'] === 'eksternal') {
                $totalEksternal += $weightedScore;
            } elseif ($data['jenis'] === 'internal') {
                $totalInternal += $weightedScore;
            }
        }

        // Calculate the final score with weights
        $totalNilaiAkhir = ($totalEksternal * 0.7) + ($totalInternal * 0.3);

        return view('mahasiswa.nilai_magang.index', compact('penilaians', 'totalNilaiAkhir'));
    }
}
