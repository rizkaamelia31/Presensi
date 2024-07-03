<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingMagang;

class SettingMagangController extends Controller
{
    public function index()
    {
        $settingsMagang = SettingMagang::all();
        return view('settings_magang.index', compact('settingsMagang'));
    }

    public function create()
    {
        return view('settings_magang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'magang_batch' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        SettingMagang::create($request->all());

        return redirect()->route('settings_magang.index')->with('success', 'Batch created successfully.');
    }

    public function edit($id)
    {
        $settingMagang = SettingMagang::find($id);
        return view('settings_magang.edit', compact('settingMagang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'magang_batch' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $settingMagang = SettingMagang::find($id);
        $settingMagang->update($request->all());

        return redirect()->route('settings_magang.index')->with('success', 'Batch updated successfully.');
    }

    public function destroy($id)
    {
        $settingMagang = SettingMagang::find($id);
        $settingMagang->delete();

        return redirect()->route('settings_magang.index')->with('success', 'Batch deleted successfully.');
    }
}
