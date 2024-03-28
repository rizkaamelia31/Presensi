<?php

use App\Http\Controllers\LogbookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


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

Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/admin/absensi', [AdminController::class, 'absensi'])->name('admin.absensi.index');
    Route::get('/admin/logbook', [AdminController::class, 'logbook'])->name('admin.logbook.index');
    Route::get('/admin/laporan_akhir', [AdminController::class, 'laporan_akhir'])->name('admin.laporan_akhir.index');
    Route::get('/admin/detail_logbook', [AdminController::class, 'detail_logbook'])->name('admin.detail_logbook.index');
    Route::get('/admin/detail_absensi', [AdminController::class, 'detail_absensi'])->name('admin.detail_absensi.index');
    Route::get('/admin/user', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

});

Route::middleware(['auth', 'role:1'])->group(function () {
   Route::get('/mahasiswa/logbook', [LogbookController::class, 'index'])->name('mahasiswa.logbook.index');
   Route::post('/logbook', [LogbookController::class, 'store'])->name('logbook.store');

});

Route::middleware(['auth', 'role:3'])->group(function () {
  
});


Auth::routes();

