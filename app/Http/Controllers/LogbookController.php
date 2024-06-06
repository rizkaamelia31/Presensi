<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logbook;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    public function index(){
        return view("mahasiswa.logbook.index");
    }
    public function store(Request $request)
    {
       
        $request->validate([
            'deskripsi' => 'required',
        ]);

    $mhs_id = Auth::user()->id;

    // Membuat logbook dengan mhs_id yang sudah diperoleh
    Logbook::create([
        'mhs_id' => $mhs_id,
        'deskripsi' => $request->deskripsi,
    ]);

        Logbook::create($request->all());

        return redirect()->back()->with('success', 'Logbook created successfully.');
    }
}
