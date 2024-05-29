<?php

namespace App\Http\Controllers;

use App\Models\KriteriaPenilaian;
use App\Models\Mahasiswa;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $penilaian = Penilaian::all();
        return view('mitra.penilaian.index', compact('penilaian'));
    }

    public function create()
{
    $mahasiswa = Mahasiswa::all();
    $kriteriaPenilaian = KriteriaPenilaian::all();
    return view('mitra.penilaian.create', compact('mahasiswa', 'kriteriaPenilaian'));
}

    public function store(Request $request)
    {
        $request->validate([
            'mhs_id' => 'required|exists:mahasiswa,id',
            'kriteria_penilaian_id' => 'required|exists:kriteria_penilaian,id',
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        Penilaian::create($request->all());

        return redirect()->route('penilaian.index')
                        ->with('success', 'Penilaian berhasil ditambahkan.');
    }

    public function edit($id)
{
    $penilaian = Penilaian::findOrFail($id);
    $mahasiswa = Mahasiswa::all();
    $kriteriaPenilaian = KriteriaPenilaian::all();
    return view('mitra.penilaian.edit', compact('penilaian', 'mahasiswa', 'kriteriaPenilaian'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'mhs_id' => 'required|exists:mahasiswa,id',
            'kriteria_penilaian_id' => 'required|exists:kriteria_penilaian,id',
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        $penilaian = Penilaian::findOrFail($id);
        $penilaian->update($request->all());

        return redirect()->route('penilaian.index')
                        ->with('success', 'Penilaian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();

        return redirect()->route('penilaian.index')
                        ->with('success', 'Penilaian berhasil dihapus.');
    }
}
