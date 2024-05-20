<?php

namespace App\Http\Controllers;
use App\Models\Logbook;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $logbookCountApprove = 0;
        $logbooksPendingApproval = 0;

        if ($user->role_id === 1) {
            $mahasiswaId = $user->mahasiswa->id;
            $logbookCountApprove = Logbook::where('mhs_id', $mahasiswaId)->where('status', 'Disetujui')->count();
            $logbooksPendingApproval = Logbook::where('mhs_id', $mahasiswaId)->where('status', 'Menunggu Persetujuan')->count();
        }

        return view('home', compact('logbookCountApprove', 'logbooksPendingApproval'));
    }
}
