<?php

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

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/absensi', [AdminController::class, 'absensi'])->name('admin.absensi.index');
    Route::get('/admin/logbook', [AdminController::class, 'logbook'])->name('admin.logbook.index');
    Route::get('/admin/laporan_akhir', [AdminController::class, 'laporan_akhir'])->name('admin.laporan_akhir.index');
    Route::get('/admin/detail_logbook', [AdminController::class, 'detail_logbook'])->name('admin.detail_logbook.index');
    Route::get('/admin/detail_absensi', [AdminController::class, 'detail_absensi'])->name('admin.detail_absensi.index');


});

Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
   


});

Route::middleware(['auth', 'role:mitra'])->group(function () {
  
});


Auth::routes();

