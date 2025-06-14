<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\BaptisController;
use App\Http\Controllers\UmatController;
use App\Http\Controllers\KetlingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendaftaranUmat_InvController;
use App\Http\Controllers\PendaftaranBaptis_InvController;
use App\Http\Controllers\PendaftaranKomuni_InvController;
use App\Http\Controllers\PendaftaranKrisma_InvController;
use App\Http\Controllers\LingkunganController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\InformasiMisaController;
use App\Http\Controllers\PendaftaranUmatController;
use App\Http\Controllers\ForumUmatController;
use App\Http\Controllers\KomuniController;
use App\Http\Controllers\KrismaController;
use App\Http\Controllers\PendaftaranPernikahan_InvController;
use App\Http\Controllers\PernikahanController;
use App\Http\Controllers\LaporanController;

Route::middleware('guest')->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/', [PengumumanController::class, 'showWelcome'])->name('welcome');
    Route::get('/pengumuman/{jenis}', [PengumumanController::class, 'showByJenis'])->name('pengumuman.jenis');

    Route::get('/pengumuman/{jenis}', [PengumumanController::class, 'showByJenis'])
        ->where('jenis', 'mingguan|laporan-keuangan|pengumuman-lainnya')
        ->name('pengumuman.show');

    //  Daftar layanan

    // 1. Baptis
    Route::get('/baptis', [BaptisController::class, 'index'])->name('baptis');
    Route::post('/baptis/send', [PendaftaranBaptis_InvController::class, 'sendEmailPendaftaran'])->name('baptis.mail');
    Route::get('/baptis/formulir/{token}', [BaptisController::class, 'create' ])->name('baptis.create');
    Route::post('/baptis/formulir/', [BaptisController::class, 'store' ])->name('baptis.store');

    // 2. Komuni
    Route::get('/komuni-pertama', [KomuniController::class, 'index'])->name('komuni-pertama');
    Route::post('/komuni-pertama/send',[PendaftaranKomuni_InvController::class, 'sendEmailPendaftaran'])->name('komuni-pertama.mail');
    Route::get('/komuni-pertama/formulir/{token}',[KomuniController::class, 'create'])->name('komuni-pertama.create');
    Route::post('/komuni-pertama/formulir',[KomuniController::class, 'store'])->name('komuni-pertama.store');

    // 3. Krisma
    Route::get('/krisma', [KrismaController::class, 'index'])->name('krisma');
    Route::post('/krisma/send', [PendaftaranKrisma_InvController::class, 'sendEmailPendaftaran'])->name('krisma.mail');
    Route::get('/krisma/formulir/{token}', [KrismaController::class, 'create'])->name('krisma.create');
    Route::post('/krisma/formulir/', [KrismaController::class, 'store'])->name('krisma.store');

    // 4. Pernikahan
    Route::get('/pernikahan', [PernikahanController::class, 'index'])->name('pernikahan');
    Route::get('/pernikahan/send', [PernikahanController::class, 'index'])->name('pernikahan.mail');
    Route::post('/pernikahan/send', [PendaftaranPernikahan_InvController::class, 'sendEmailPendaftaran'])->name('pernikahan.mail');
    Route::get('/pernikahan/formulir/{token}', [PernikahanController::class, 'create'])->name('pernikahan.create');
    Route::post('/pernikahan/formulir/', [PernikahanController::class, 'store'])->name('pernikahan.store');
    Route::post('api/cek_email_pernikahan_pria', [ApiController::class, 'get_email_pernikahan_pria'])->middleware('throttle:10,1'); // batasi pencarian hanya 10 NIK/Menit untuk setiap IP
    Route::post('api/cek_email_pernikahan_wanita', [ApiController::class, 'get_email_pernikahan_wanita'])->middleware('throttle:10,1');

    // 5. Pendaftaran Umat
    Route::get('/pendaftaran-umat', [PendaftaranUmat_InvController::class, 'index'])->name('pendaftaran-umat');
    Route::post('/pendaftaran-umat/send', [PendaftaranUmat_InvController::class, 'sendStatusPendaftaranEmail'])->name('pendaftaran-umat.mail');
    Route::get('/pendaftaran-umat/formulir/{token}', [PendaftaranUmatController::class, 'create'])->name('pendaftaran-umat.create'); // kalau ubah ini, jangan lupa untuk ubah link di PendaftaranUmat_InvController
    Route::post('/pendaftaran-umat/formulir', [PendaftaranUmatController::class, 'store'])->name('pendaftaran-umat.store');
    // Route::post('api/cek_nik', [ApiController::class, 'get_nik'])->middleware('throttle:10,1'); // batasi pencarian hanya 10 NIK/Menit untuk setiap IP

    //6.forum Umat
    Route::get('/forum', [ForumUmatController::class, 'umatIndex'])->name('forum.index');
Route::post('/forum', [ForumUmatController::class, 'store'])->name('forum.store');

    Route::get('/tentang-paroki', function () {
        return view('layouts.tentangparoki');
    })->name('tentang-paroki');

    Route::get('/kontak', function () {
        return view('layouts.kontak');
    })->name('kontak');
});


// rute-rute user yang telah diautentikasi

// dashboard
Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// sekretaris
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

    // view tanggal pembukaan sakramen
   Route::get('/pembukaan_pendaftaran', function () {
        return view('layouts.pembukaan_pendaftaran');
    })->name('sakramen.index');


    // forum umat
     Route::get('/forum', [ForumUmatController::class, 'sekretarisIndex'])->name('forum');
     Route::post('/forum/{id}/answer', [ForumUmatController::class, 'answer'])->name('forum.answer');
     Route::delete('/forum/{id}', [ForumUmatController::class, 'destroy'])->name('forum.destroy');


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

// ketua lingkungan
Route::middleware(['auth'])->prefix('ketualingkungan')->name('ketualingkungan.')->group(function () {
    Route::resource('/lingkungan', LingkunganController::class);
    Route::get('/umat/persetujuan', [UmatController::class, 'persetujuan'])->name('umat.persetujuan');
    Route::post('/umat/setuju/{umat}', [UmatController::class, 'setuju'])->name('umat.setuju');
    Route::post('/umat/tolak/{umat}', [UmatController::class, 'tolak'])->name('umat.tolak');
    Route::get('/umat/file/{type}/{filename}', [UmatController::class, 'downloadFile'])->name('umat.downloadFile');
    Route::resource('/umat', UmatController::class);
});

// pastor paroki
Route::middleware(['auth'])->prefix('pastorparoki')->name('pastorparoki.')->group(function () {
    // Dashboard pastor
    Route::get('/dashboard', function () {
        return view('layouts.pastor.dashboard');
    })->name('dashboard');

    //laporan sakramen
    Route::get('/laporan/sakramen', [LaporanController::class, 'sakramen'])->name('laporan.sakramen');

    // Laporan Data Umat
    Route::get('/laporan/umat', [LaporanController::class, 'umat'])->name('laporan.umat');
    Route::get('/laporan/umat/export', [LaporanController::class, 'exportUmat'])->name('laporan.umat.export');
});

// lain
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
