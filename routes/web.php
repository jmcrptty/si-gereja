<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KetlingController;
use App\Http\Controllers\LingkunganController;
use App\Http\Controllers\UmatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// rute-rute bagian admin
// Route::middleware(['auth'])->get('/dashboard', [KetlingController::class, 'index'])->name('Dashboard Ketua Lingkungan');
// kalau sudah ada login baru pakai ini

Route::get('/dashboard', [KetlingController::class, 'index'])->name('ketling_dashboard');
//nama rute reource = lingkungan.index, lingkungan.create, dll
Route::resource('/lingkungan', LingkunganController::class);
Route::resource('/umat', UmatController::class);




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
