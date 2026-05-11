<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\PengumumanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('dashboard');
Route::get('/home/beranda', function () {
    return view('pages.beranda');
})->name('beranda');
Route::get('/home/proyek', function () {
    return view('pages.proyek');
})->name('proyek');
Route::get('/home/panduan', function () {
    return view('pages.panduan');
})->name('panduan');
Route::get('/home/lapor', function () {
    return view('pages.lapor');
})->name('lapor');
Route::get('/admin', function () {
    return view('admin.admin');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/',        [PageController::class, 'beranda'])   ->name('beranda');
Route::get('/proyek',  [PageController::class, 'proyek'])    ->name('proyek');
Route::get('/panduan', [PageController::class, 'panduan'])   ->name('panduan');
Route::get('/lapor',   [PageController::class, 'lapor'])     ->name('lapor');
Route::post('/lapor',  [PageController::class, 'laporStore'])->name('lapor.store');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Laporan
    Route::get('/laporan',             [LaporanController::class, 'index'])       ->name('laporan.index');
    Route::patch('/laporan/{laporan}', [LaporanController::class, 'updateStatus'])->name('laporan.updateStatus');

    // Fasilitas — full CRUD
    Route::resource('fasilitas', FasilitasController::class)->except(['show']);

    // Pengumuman — full CRUD
    Route::resource('pengumuman', PengumumanController::class)->except(['show']);
});


require __DIR__.'/auth.php';
