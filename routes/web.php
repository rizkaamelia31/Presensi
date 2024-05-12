<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MitraController;

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
    

});

Route::middleware(['auth', 'role:4'])->group(function () {
    Route::get('/dosen/absensi', [DosenController::class, 'absensi'])->name('dosen.absensi.index');
    Route::get('/dosen/logbook', [DosenController::class, 'logbook'])->name('dosen.logbook.index');
    Route::get('/dosen/laporan_akhir', [DosenController::class, 'laporan_akhir'])->name('dosen.laporan_akhir.index');
    Route::get('/dosen/detail_logbook', [DosenController::class, 'detail_logbook'])->name('dosen.detail_logbook.index');
    Route::get('/dosen/detail_absensi', [DosenController::class, 'detail_absensi'])->name('dosen.detail_absensi.index');
    // Route::get('/dosen/user', [UserController::class, 'index'])->name('users.index');
    // Route::post('/users', [UserController::class, 'store'])->name('users.store');

});

Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/mahasiswa/logbook', [MahasiswaController::class, 'logbook'])->name('mahasiswa.logbook.index');
    Route::get('/mahasiswa/profil', [MahasiswaController::class, 'profil'])->name('mahasiswa.profil');
    Route::match(['post', 'put'], '/update-profile', [MahasiswaController::class, 'updateProfil'])->name('update-profile');


    Route::post('/mahasiswa/logbook/store', [MahasiswaController::class, 'logbookStore'])->name('mahasiswa.logbook.store');
    Route::get('/mahasiswa/laporan_akhir', [MahasiswaController::class, 'laporan_akhir'])->name('mahasiswa.laporan_akhir.index');
    Route::get('/mahasiswa/penilaian_akhir', [MahasiswaController::class, 'penilaian_akhir'])->name('mahasiswa.penilaian_akhir.index');
    Route::post('/upload-laporan', [MahasiswaController::class, 'uploadLaporan'])->name('mahasiswa.upload.laporan');
 });
 

Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/mitra/logbook', [MitraController::class, 'logbook'])->name('mitra.logbook.index');
    Route::get('/mitra/jobdesc', [MitraController::class, 'jobdesc'])->name('mitra.jobdesc.index');
    Route::get('/mitra/penilaian_akhir', [MitraController::class, 'penilaian_akhir'])->name('mitra.penilaian_akhir.index');

});


Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/admin/beranda', [AdminController::class, 'beranda'])->name('admin.beranda.index');
    Route::resource('users', UserController::class);


});


Auth::routes();

