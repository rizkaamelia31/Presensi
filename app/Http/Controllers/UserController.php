<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Perusahaan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Mitra;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.index',compact("users"));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::all();
        $perusahaan = Perusahaan::all();
        return view('admin.user.create',compact('roles','perusahaan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

     public function store(Request $request)
    {
        // Validasi data inputan di sini jika diperlukan
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;
        $user->save();

        // Handle image upload if a file is uploaded
        if ($request->hasFile('gambar_dosen') && $request->role_id == 2) {
            $gambar = $request->file('gambar_dosen');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $path = $gambar->storeAs('public/gambar', $nama_gambar);

            $dosen = new Dosen();
            $dosen->user_id = $user->id;
            $dosen->nidn = $request->nidn;
            $dosen->perusahaan_id = $request->perusahaan_id;
            $dosen->gambar = $path;
            $dosen->save();
        }

        if ($request->hasFile('gambar_mahasiswa') && $request->role_id == 1) {
            $gambar = $request->file('gambar_mahasiswa');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $path = $gambar->storeAs('public/gambar', $nama_gambar);

            $mahasiswa = new Mahasiswa();
            $mahasiswa->user_id = $user->id;
            $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
            $mahasiswa->magang_batch = $request->magang_batch;
            $mahasiswa->perusahaan_id = $request->perusahaan_id_mhs;
            $mahasiswa->nama_supervisor = $request->nama_supervisor;
            $mahasiswa->no_hp_supervisor = $request->no_hp_supervisor;
            $mahasiswa->gambar = $path;
            $mahasiswa->save();
        }

        if ($request->role_id == 3) {
            $mitra = new Perusahaan();
            $mitra->user_id = $user->id;
            $mitra->nama_perusahaan = $request->nama_perusahaan;
            $mitra->alamat = $request->alamat;
            $mitra->save();
        }

        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil disimpan.');
    }
     
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
