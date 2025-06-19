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
use App\Http\Controllers\SekretarisController;

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
    Route::post('api/cek_email_pernikahan_pria', [ApiController::class, 'get_email_pernikahan_pria'])->middleware('throttle:10,1'); // batasi pencarian hanya 10 email/Menit untuk setiap IP
    Route::post('api/cek_email_pernikahan_wanita', [ApiController::class, 'get_email_pernikahan_wanita'])->middleware('throttle:10,1');

    // 5. Pendaftaran Umat
    Route::get('/pendaftaran-umat', [PendaftaranUmat_InvController::class, 'index'])->name('pendaftaran-umat');
    Route::post('/pendaftaran-umat/send', [PendaftaranUmat_InvController::class, 'sendStatusPendaftaranEmail'])->name('pendaftaran-umat.mail');
    Route::get('/pendaftaran-umat/formulir/{token}', [PendaftaranUmatController::class, 'create'])->name('pendaftaran-umat.create'); // kalau ubah ini, jangan lupa untuk ubah link di PendaftaranUmat_InvController
    Route::post('/pendaftaran-umat/formulir', [PendaftaranUmatController::class, 'store'])->name('pendaftaran-umat.store');

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
Route::middleware(['auth', 'roles:sekretaris'])->prefix('sekretaris')->name('sekretaris.')->group(function () {

    Route::get('/dashboard', [SekretarisController::class, 'index'])->name('dashboard');

        // sekretaris -> umat
        Route::get('/umat', [SekretarisController::class, 'umat_index'])->name('umat.index');
        Route::get('/umat/{umat}', [SekretarisController::class, 'umat_show'])->name('umat.show'); // <- ingat kalo ada (Umat $umat) di controller, nama idnya harus sesuai (route model binding)
        Route::get('/umat/file/{type}/{filename}', [SekretarisController::class, 'downloadFile'])->name('umat.downloadFile');
        Route::get('/pernikahan/file/{type}/{filename}', [SekretarisController::class, 'downloadFilePernikahan'])->name('pernikahan.downloadFile');

        // sekretaris -> pendaftaran sakramen
        Route::get('/pendaftaransakramen', [SekretarisController::class, 'pendaftaranSakramen'])->name('pendaftaransakramen');
        // sekertaris->sakramen->baptis
        Route::get('/detail_sakramen/baptis/{umat}', [SekretarisController::class, 'baptis_show'])->name('detailBaptis');
        Route::post('/persetujuan/baptis/setuju/{baptis}', [SekretarisController::class, 'setujuPendaftaranBaptis'])->name('setujuBaptis');
        Route::post('/persetujuan/baptis/tolak/{baptis}', [SekretarisController::class, 'tolakPendaftaranBaptis'])->name('tolakBaptis');
        // sekertaris->sakramen->komuni
        Route::get('/detail_sakramen/komuni/{umat}', [SekretarisController::class, 'komuni_show'])->name('detailKomuni');
        Route::post('/persetujuan/komuni/setuju/{komuni}', [SekretarisController::class, 'setujuPendaftaranKomuni'])->name('setujuKomuni');
        Route::post('/persetujuan/komuni/tolak/{komuni}', [SekretarisController::class, 'tolakPendaftaranKomuni'])->name('tolakKomuni');
        // sekretaris->sakramen->krisma
        Route::get('/detail_sakramen/krisma/{umat}', [SekretarisController::class, 'krisma_show'])->name('detailKrisma');
        Route::post('/persetujuan/krisma/setuju/{krisma}', [SekretarisController::class, 'setujuPendaftaranKrisma'])->name('setujuKrisma');
        Route::post('/persetujuan/krisma/tolak/{krisma}', [SekretarisController::class, 'tolakPendaftaranKrisma'])->name('tolakKrisma');
        // sekretaris->sakramen->pernikahan
        Route::get('/detail_sakramen/pernikahan/{pernikahan}', [SekretarisController::class, 'pernikahan_show'])->name('detailPernikahan');
        Route::post('/persetujuan/pernikahan/setuju/{pernikahan}', [SekretarisController::class, 'setujuPendaftaranPernikahan'])->name('setujuPernikahan');
        Route::post('/persetujuan/pernikahan/tolak/{pernikahan}', [SekretarisController::class, 'tolakPendaftaranPernikahan'])->name('tolakPernikahan');

        // sekretaris -> penerimaan sakramen
        Route::get('/penerimaansakramen', [SekretarisController::class, 'penerimaansakramen'])->name('penerimaansakramen');
        // sekertaris->sakramen->baptis
        Route::get('/detail_sakramen/penerimaan/baptis/{umat}', [SekretarisController::class, 'baptis_penerimaan_show'])->name('detailBaptis.penerimaan');
        Route::post('/penerimaan/baptis/setuju/{baptis}', [SekretarisController::class, 'setujuPenerimaanBaptis'])->name('setujuBaptis.penerimaan');
        Route::post('/penerimaan/baptis/tolak/{baptis}', [SekretarisController::class, 'tolakPenerimaanBaptis'])->name('tolakBaptis.penerimaan');
        // sekertaris->sakramen->komuni
        Route::get('/detail_sakramen/penerimaan/komuni/{umat}', [SekretarisController::class, 'komuni_penerimaan_show'])->name('detailKomuni.penerimaan');
        Route::post('/penerimaan/komuni/setuju/{komuni}', [SekretarisController::class, 'setujuPenerimaanKomuni'])->name('setujuKomuni.penerimaan');
        Route::post('/penerimaan/komuni/tolak/{komuni}', [SekretarisController::class, 'tolakPenerimaanKomuni'])->name('tolakKomuni.penerimaan');
        // sekertaris->sakramen->krisma
        Route::get('/detail_sakramen/penerimaan/krisma/{umat}', [SekretarisController::class, 'krisma_penerimaan_show'])->name('detailKrisma.penerimaan');
        Route::post('/penerimaan/krisma/setuju/{krisma}', [SekretarisController::class, 'setujuPenerimaanKrisma'])->name('setujuKrisma.penerimaan');
        Route::post('/penerimaan/krisma/tolak/{krisma}', [SekretarisController::class, 'tolakPenerimaanKrisma'])->name('tolakKrisma.penerimaan');
        // sekretaris->sakramen->pernikahan
        Route::post('/penerimaan/pernikahan/setuju/{pernikahan}', [SekretarisController::class, 'setujuPenerimaanPernikahan'])->name('setujuPernikahan.penerimaan');
        Route::post('/penerimaan/pernikahan/tolak/{pernikahan}', [SekretarisController::class, 'tolakPenerimaanPernikahan'])->name('tolakPernikahan.penerimaan');

    // view tanggal pembukaan sakramen
    Route::get('pembukaan_pendaftaran', function (){
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
Route::middleware(['auth', 'roles:ketua lingkungan'])->prefix('ketualingkungan')->name('ketualingkungan.')->group(function () {

    Route::resource('/lingkungan', LingkunganController::class);
    Route::get('/umat/persetujuan', [UmatController::class, 'persetujuan'])->name('umat.persetujuan');
    Route::post('/umat/setuju/{umat}', [UmatController::class, 'setuju'])->name('umat.setuju');
    Route::post('/umat/tolak/{umat}', [UmatController::class, 'tolak'])->name('umat.tolak');
    Route::get('/umat/file/{type}/{filename}', [UmatController::class, 'downloadFile'])->name('umat.downloadFile');
    Route::resource('/umat', UmatController::class);

});

// pastor paroki
Route::middleware(['auth', 'roles:pastor paroki'])->prefix('pastorparoki')->name('pastorparoki.')->group(function () {
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
