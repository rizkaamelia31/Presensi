<?php
namespace App\Http\Controllers;

use App\Models\SettingMahasiswa;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;

class SettingMahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('user', 'dosenPenilai.user')->get();
        $dosens = Dosen::with('user')->get();

        return view('setting_mahasiswa.index', compact('mahasiswa', 'dosens'));
    }

    public function create(Request $request)
    {
        $mhs_id = $request->query('mhs_id');
        $mahasiswa = Mahasiswa::with('dosenPenilai.user')->findOrFail($mhs_id);
        $dosens = Dosen::with('user')->get();
        return view('setting_mahasiswa.create', compact('mahasiswa', 'dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mhs_id' => 'required|exists:mahasiswa,id',
            'dosen_id' => 'required|array',
            'dosen_id.*' => 'exists:dosen,id',
        ]);

        foreach ($request->dosen_id as $dosenId) {
            SettingMahasiswa::create([
                'mhs_id' => $request->mhs_id,
                'dosen_id' => $dosenId,
            ]);
        }

        return redirect()->route('setting_mahasiswa.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::with('dosenPenilai.user')->findOrFail($id);
        $dosens = Dosen::with('user')->get();
        return view('setting_mahasiswa.edit', compact('mahasiswa', 'dosens'));
    }

    public function show($id)
    {
        $setting = SettingMahasiswa::findOrFail($id);
        return view('setting_mahasiswa.show', compact('setting'));
    }   


    public function update(Request $request, $id)
    {
        $request->validate([
            'mhs_id' => 'required|exists:mahasiswa,id',
            'dosen_id.*' => 'required|exists:dosen,id'
        ]);

        // Remove existing dosenPenilai
        SettingMahasiswa::where('mhs_id', $request->mhs_id)->delete();

        // Add new dosenPenilai
        foreach ($request->dosen_id as $dosenId) {
            SettingMahasiswa::create([
                'mhs_id' => $request->mhs_id,
                'dosen_id' => $dosenId
            ]);
        }

        return redirect()->route('setting_mahasiswa.index')->with('success', 'Dosen updated successfully.');
    }

    public function destroy($id)
    {
        $settingMahasiswas = SettingMahasiswa::where('mhs_id', $id)->get();

        // Loop melalui semua entri dan hapus satu per satu
        foreach ($settingMahasiswas as $settingMahasiswa) {
            $settingMahasiswa->delete();
        }
    
        return redirect()->route('setting_mahasiswa.index')->with('success', 'Dosen deleted successfully.');
    }
}

