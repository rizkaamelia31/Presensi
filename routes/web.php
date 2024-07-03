<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\KriteriaPenilaianController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\PenilaianAkhirController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\JobDescController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\SettingMagangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('penilaian', PenilaianController::class);
    Route::get('penilaian/create/{mhs_id}/{type}', [PenilaianController::class, 'create'])->name('penilaian.createWithId');
    Route::get('penilaian/edit/{mhs_id}/{type}', [PenilaianController::class, 'edit'])->name('penilaian.editPenilaian');
    Route::get('penilaian/detail/{mhs_id}', [PenilaianController::class, 'detail'])->name('penilaian.detail');
    Route::get('job', [JobDescController::class, 'index'])->name('jobdescs.index');
    Route::get('job/create', [JobDescController::class, 'create'])->name('jobdescs.create');
    Route::post('job', [JobDescController::class, 'store'])->name('jobdescs.store');
    Route::get('job/{id}', [JobDescController::class, 'show'])->name('jobdescs.show');
    Route::get('job/{id}/edit', [JobDescController::class, 'edit'])->name('jobdescs.edit');
    Route::put('job/{id}', [JobDescController::class, 'update'])->name('jobdescs.update');
    Route::delete('job/{id}', [JobDescController::class, 'destroy'])->name('jobdescs.destroy');
});

Route::middleware(['auth', 'role:4'])->group(function () {
    Route::get('/dosen/rekap_logbook', [DosenController::class, 'rekap_logbook'])->name('dosen.rekap_logbook.index');
    Route::get('/dosen/laporan_akhir', [DosenController::class, 'laporanAkhir'])->name('dosen.laporan_akhir.index');
    Route::get('/dosen/detail_rekap_logbook/{id}', [DosenController::class, 'detail_rekap_logbook'])->name('dosen.rekap_logbook.detail');
    Route::get('/dosen/penilaian_akhir', [DosenController::class, 'penilaian_akhir'])->name('dosen.penilaian_akhir.index');
    Route::get('/dosen/detail_penilaian_akhir', [DosenController::class, 'detail_penilaian_akhir'])->name('dosen.penilaian_akhir.detail');
    Route::get('/dosen/riwayat', [DosenController::class, 'riwayat'])->name('riwayat.index');
    // Route::get('/dosen/user', [UserController::class, 'index'])->name('users.index');
    // Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/dosen/penilaian_akhir', [DosenController::class, 'penilaian_akhir'])->name('dosen.penilaian_akhir.index');
});

Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/mahasiswa/logbook', [MahasiswaController::class, 'logbook'])->name('mahasiswa.logbook.index');
    Route::get('/mahasiswa/profil', [MahasiswaController::class, 'profil'])->name('mahasiswa.profil');
    Route::match(['post', 'put'], '/update-profile', [MahasiswaController::class, 'updateProfil'])->name('update-profile');
    Route::post('/mahasiswa/logbook/store', [MahasiswaController::class, 'logbookStore'])->name('mahasiswa.logbook.store');
    Route::get('/mahasiswa/laporan_akhir', [MahasiswaController::class, 'laporan_akhir'])->name('mahasiswa.laporan_akhir.index');
    Route::get('/mahasiswa/nilaimagang', [MahasiswaController::class, 'nilaiMagang'])->name('mahasiswa.nilai_magang.index');
    Route::get('/mahasiswa/penilaian_akhir', [MahasiswaController::class, 'penilaian_akhir'])->name('mahasiswa.penilaian_akhir.index');
    Route::post('/upload-laporan', [MahasiswaController::class, 'uploadLaporan'])->name('mahasiswa.upload.laporan');

    Route::get('/mahasiswa/nilai-magang/pdf', [PdfController::class, 'generatePdf'])->name('mahasiswa.nilai-magang.pdf');
});


Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/mitra/rekap_logbook', [MitraController::class, 'rekap_logbook'])->name('mitra.rekap_logbook.index');
    Route::get('/mitra/logbook', [MitraController::class, 'logbook'])->name('mitra.logbook.detail');
    Route::get('/mitra/penilaian_akhir', [MitraController::class, 'penilaian_akhir'])->name('mitra.penilaian_akhir.index');
    Route::get('/mitra/logbook', [MitraController::class, 'logbookMitra'])->name('mitra.logbook.index');
    Route::put('/mitra/logbook/confirm/{id}', [MitraController::class, 'confirm'])->name('logbook.confirm');
    Route::get('mitra/logbook/{mahasiswa}', [MitraController::class, 'logbookShow'])->name('mitra.logbook.show');
});


Route::middleware(['auth', 'role:2'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('kriteria-penilaian', KriteriaPenilaianController::class);
    Route::resource('settings_magang', SettingMagangController::class);
});
Auth::routes();
