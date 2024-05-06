<?php

use App\Http\Controllers\LogbookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;

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
    Route::get('/dosen/user', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

});

Route::middleware(['auth', 'role:1'])->group(function () {
   Route::get('/mahasiswa/logbook', [LogbookController::class, 'index'])->name('mahasiswa.logbook.index');
   Route::post('/logbook', [LogbookController::class, 'store'])->name('logbook.store');

});

Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/mitra/absensi', [MitraController::class, 'logbook'])->name('mitra.logbook.index');
});


Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/admin/beranda', [AdminController::class, 'beranda'])->name('admin.beranda.index');
    Route::resource('users', UserController::class);
});


Auth::routes();

