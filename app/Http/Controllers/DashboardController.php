<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Umat;

class DashboardController extends Controller
{
   public function index()
{
    $user = Auth::user();
    $year = request()->query('year', date('Y'));
    $availableYears = collect(range(date('Y'), date('Y') - 9))->sortDesc()->values();

    if (in_array($user->role, ['sekretaris', 'pastor paroki'])) {
        // Total umat yang diterima tahun ini
        $totalUmat = Umat::where('status_pendaftaran', 'Diterima')
            ->whereYear('tanggal_daftar', $year)
            ->count();

        // Hanya sakramen yang dilakukan di Gereja Katedral Santo Fransiskus Xaverius Merauke
        $sakramen = [
            'baptis' => DB::table('baptis')
                ->where('status_penerimaan', 'Diterima')
                ->whereYear('tanggal_terima', $year)
                ->where('gereja_tempat_baptis', 'Gereja Katedral Santo Fransiskus Xaverius Merauke')
                ->count(),

            'komuni' => DB::table('komuni')
                ->where('status_penerimaan', 'Diterima')
                ->whereYear('tanggal_terima', $year)
                ->where('gereja_tempat_komuni', 'Gereja Katedral Santo Fransiskus Xaverius Merauke')
                ->count(),

            'krisma' => DB::table('krisma')
                ->where('status_penerimaan', 'Diterima')
                ->whereYear('tanggal_terima', $year)
                ->where('gereja_tempat_krisma', 'Gereja Katedral Santo Fransiskus Xaverius Merauke')
                ->count(),

            'pernikahan' => DB::table('pernikahans')
                ->where('status_penerimaan', 'Diterima')
                ->whereYear('tanggal_terima', $year)
                ->count(), // Pernikahan tidak disaring berdasarkan gereja
        ];

        return view('layouts.pastor.dashboard', compact('user', 'totalUmat', 'sakramen', 'year', 'availableYears'));
    }

    // Untuk ketua lingkungan tetap seperti sebelumnya (lingkungan spesifik)
    if ($user->role === 'ketua lingkungan') {
        $lingkungan = $user->lingkungan;

        $totalUmat = Umat::where('status_pendaftaran', 'Diterima')
            ->where('lingkungan', $lingkungan)
            ->whereYear('tanggal_daftar', $year)
            ->count();

        $sakramen = [
            'baptis' => DB::table('baptis')
                ->join('umat', 'umat.id', '=', 'baptis.umat_id')
                ->where('baptis.status_penerimaan', 'Diterima')
                ->whereYear('baptis.tanggal_terima', $year)
                ->where('umat.lingkungan', $lingkungan)
                ->where('baptis.gereja_tempat_baptis', 'Gereja Katedral Santo Fransiskus Xaverius Merauke')
                ->count(),

            'komuni' => DB::table('komuni')
                ->join('umat', 'umat.id', '=', 'komuni.umat_id')
                ->where('komuni.status_penerimaan', 'Diterima')
                ->whereYear('komuni.tanggal_terima', $year)
                ->where('umat.lingkungan', $lingkungan)
                ->where('komuni.gereja_tempat_komuni', 'Gereja Katedral Santo Fransiskus Xaverius Merauke')
                ->count(),

            'krisma' => DB::table('krisma')
                ->join('umat', 'umat.id', '=', 'krisma.umat_id')
                ->where('krisma.status_penerimaan', 'Diterima')
                ->whereYear('krisma.tanggal_terima', $year)
                ->where('umat.lingkungan', $lingkungan)
                ->where('krisma.gereja_tempat_krisma', 'Gereja Katedral Santo Fransiskus Xaverius Merauke')
                ->count(),

            'pernikahan' => DB::table('pernikahans')
                ->leftJoin('umat as pria', 'pria.id', '=', 'pernikahans.umat_id_pria')
                ->leftJoin('umat as wanita', 'wanita.id', '=', 'pernikahans.umat_id_wanita')
                ->where('pernikahans.status_penerimaan', 'Diterima')
                ->whereYear('pernikahans.tanggal_terima', $year)
                ->where(function ($q) use ($lingkungan) {
                    $q->where('pria.lingkungan', $lingkungan)
                      ->orWhere('wanita.lingkungan', $lingkungan);
                })
                ->count(),
        ];

        return view('layouts.ketualingkungan.dashboard', compact('user', 'totalUmat', 'sakramen', 'lingkungan', 'year', 'availableYears'));
    }

    abort(403, 'Akses tidak diizinkan.');
}

}
