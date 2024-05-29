<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KriteriaPenilaian;

class KriteriaPenilaianController extends Controller
{
   
    public function index()
    {
        $kriteriaPenilaian = KriteriaPenilaian::all();
        return view('mitra.kriteria-penilaian.index', compact('kriteriaPenilaian'));
    }

    public function create()
    {
        return view('mitra.kriteria-penilaian.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required|string|max:255',
            'bobot' => 'required|numeric|min:0|max:100',
            'jenis' => 'required|in:internal,eksternal',
        ]);

        KriteriaPenilaian::create($request->all());

        return redirect()->route('kriteria-penilaian.index')
                        ->with('success', 'Kriteria penilaian berhasil ditambahkan.');
    }

    public function show($id)
    {
        //
    }

    public function edit(KriteriaPenilaian $kriteriaPenilaian)
    {
        return view('mitra.kriteria-penilaian.edit', compact('kriteriaPenilaian'));
    }

    public function update(Request $request, KriteriaPenilaian $kriteriaPenilaian)
    {
        $request->validate([
            'nama_kriteria' => 'required|string|max:255',
            'bobot' => 'required|numeric|min:0|max:100',
            'jenis' => 'required|in:internal,eksternal',
        ]);

        $kriteriaPenilaian->update($request->all());

        return redirect()->route('kriteria-penilaian.index')
                        ->with('success', 'Kriteria penilaian berhasil diperbarui.');
    }

    public function destroy(KriteriaPenilaian $kriteriaPenilaian)
    {
        $kriteriaPenilaian->delete();

        return redirect()->route('kriteria-penilaian.index')
                        ->with('success', 'Kriteria penilaian berhasil dihapus.');
    }
}
