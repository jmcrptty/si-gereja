<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KetlingController;
use App\Http\Controllers\LingkunganController;
use App\Http\Controllers\UmatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PendaftaranUmatController;
use App\Http\Controllers\InformasiMisaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [PengumumanController::class, 'showWelcome'])->name('welcome');
Route::get('/pengumuman/{jenis}', [PengumumanController::class, 'showByJenis'])->name('pengumuman.jenis');

Route::get('/pengumuman/{jenis}', [PengumumanController::class, 'showByJenis'])
    ->where('jenis', 'mingguan|laporan-keuangan|pengumuman-lainnya')
    ->name('pengumuman.show');

//  layanan
    Route::get('/baptis', function () {
    return view('layouts.baptis');
})->name('baptis');

 Route::get('/komuni-pertama', function () {
    return view('layouts.komunipertama');
})->name('komuni-pertama');

 Route::get('/krisma', function () {
    return view('layouts/krisma');
    })->name('krisma');

    Route::get('/pernikahan', function () {
        return view('layouts.pernikahan');
    })->name('pernikahan');

    Route::get('/komuni-pertama', function () {
        return view('layouts.komunipertama');
    })->name('komuni-pertama');

    Route::get('/tentang-paroki', function () {
        return view('layouts.tentangparoki');
    })->name('tentang-paroki');


    Route::get('/kontak', function () {
        return view('layouts.kontak');
    })->name('kontak');

    Route::get('/pendaftaran-umat', [PendaftaranUmatController::class, 'index'])->name('pendaftaran-umat.index');


Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::resource('/lingkungan', LingkunganController::class);
Route::resource('/umat', UmatController::class);



Route::middleware(['auth'])->prefix('sekretaris')->name('sekretaris.')->group(function () {

    Route::get('/dashboard', function () {
    return view('layouts.sekretaris.dashboard');
    })->name('dashboard');

    Route::get('/dataumat', function () {
        return view('layouts.Dataumat_sekretaris');
    })->name('dataumat');

    Route::get('/penerimaansakramen', function () {
        return view('layouts.penerimaansakramen');
    })->name('penerimaansakramen');


    Route::get('/pendaftaransakramen', function () {
        return view('layouts.pendaftaransakramen');
    })->name('pendaftaransakramen');


    // rute informasi misa
    Route::get('/informasi-misa', [InformasiMisaController::class, 'index'])->name('informasi_misa');
    Route::get('/informasi-misa/get-by-jenis/{jenis}', [InformasiMisaController::class, 'getByJenis']);
    Route::put('/informasi-misa/{id}', [InformasiMisaController::class, 'update'])->name('informasi_misa.update');

    // rute pengumuman
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
    Route::get('/pengumuman/get-by-jenis/{jenis}', [PengumumanController::class, 'getByJenis']);
    Route::put('/pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::get('/pengumuman/image/{filename}', [PengumumanController::class, 'showImage'])->name('sekretaris.pengumuman.image');
    Route::get('/image/{filename}', [PengumumanController::class, 'showImage'])->name('image.show');


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
