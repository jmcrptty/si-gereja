<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Umat;
use App\Models\Sakramen;
use Illuminate\Http\Request;
use App\Models\PenerimaanSakramen;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function sakramen(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $sakramen_id = $request->get('sakramen_id');
        $search = $request->get('search');

        $sakramen_list = collect([
            (object)['id' => 'baptis', 'nama_sakramen' => 'Baptis'],
            (object)['id' => 'komuni', 'nama_sakramen' => 'Komuni'],
            (object)['id' => 'krisma', 'nama_sakramen' => 'Krisma'],
            (object)['id' => 'pernikahan', 'nama_sakramen' => 'Pernikahan'],
        ]);

        // Query Baptis
        $baptis = DB::table('baptis')
            ->join('umat', 'umat.id', '=', 'baptis.umat_id')
            ->select(
                'umat.nama_lengkap',
                'umat.lingkungan',
                DB::raw("'Baptis' as nama_sakramen"),
                'baptis.tanggal_terima',
                DB::raw('NULL as tempat_terima'),
                DB::raw('NULL as keterangan'),
                DB::raw('baptis.tanggal_terima as tanggal_sort')
            )
            ->where('baptis.status_penerimaan', 'Diterima')
            ->whereYear('baptis.tanggal_terima', $year)
            ->where('baptis.gereja_tempat_baptis', 'Gereja Katedral Santo Fransiskus Xaverius Merauke');

        // Query Komuni
        $komuni = DB::table('komuni')
            ->join('umat', 'umat.id', '=', 'komuni.umat_id')
            ->select(
                'umat.nama_lengkap',
                'umat.lingkungan',
                DB::raw("'Komuni' as nama_sakramen"),
                'komuni.tanggal_terima',
                DB::raw('NULL as tempat_terima'),
                DB::raw('NULL as keterangan'),
                DB::raw('komuni.tanggal_terima as tanggal_sort')
            )
            ->where('komuni.status_penerimaan', 'Diterima')
            ->whereYear('komuni.tanggal_terima', $year)
            ->where('komuni.gereja_tempat_komuni', 'Gereja Katedral Santo Fransiskus Xaverius Merauke');

        // Query Krisma
        $krisma = DB::table('krisma')
            ->join('umat', 'umat.id', '=', 'krisma.umat_id')
            ->select(
                'umat.nama_lengkap',
                'umat.lingkungan',
                DB::raw("'Krisma' as nama_sakramen"),
                'krisma.tanggal_terima',
                DB::raw('NULL as tempat_terima'),
                DB::raw('NULL as keterangan'),
                DB::raw('krisma.tanggal_terima as tanggal_sort')
            )
            ->where('krisma.status_penerimaan', 'Diterima')
            ->whereYear('krisma.tanggal_terima', $year)
            ->where('krisma.gereja_tempat_krisma', 'Gereja Katedral Santo Fransiskus Xaverius Merauke');

        // Query Pernikahan (tidak ada gereja tempat, tetap disertakan)
        $pernikahan = DB::table('pernikahans')
            ->leftJoin('umat as pria', 'pernikahans.umat_id_pria', '=', 'pria.id')
            ->leftJoin('umat as wanita', 'pernikahans.umat_id_wanita', '=', 'wanita.id')
            ->select(
                DB::raw("COALESCE(pria.nama_lengkap, '-') || ' & ' || COALESCE(wanita.nama_lengkap, '-') as nama_lengkap"),
                DB::raw("COALESCE(pria.lingkungan, '-') || ' & ' || COALESCE(wanita.lingkungan, '-') as lingkungan"),
                DB::raw("'Pernikahan' as nama_sakramen"),
                'pernikahans.tanggal_terima',
                DB::raw('NULL as tempat_terima'),
                DB::raw('NULL as keterangan'),
                DB::raw('pernikahans.tanggal_terima as tanggal_sort')
            )
            ->where('pernikahans.status_penerimaan', 'Diterima')
            ->whereYear('pernikahans.tanggal_terima', $year);

        if ($sakramen_id === 'baptis') {
            $query = $baptis;
        } elseif ($sakramen_id === 'komuni') {
            $query = $komuni;
        } elseif ($sakramen_id === 'krisma') {
            $query = $krisma;
        } elseif ($sakramen_id === 'pernikahan') {
            $query = $pernikahan;
        } else {
            $query = $baptis->unionAll($komuni)->unionAll($krisma)->unionAll($pernikahan);
        }

        $query = DB::table(DB::raw("({$query->toSql()}) as x"))
            ->mergeBindings($baptis)
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('nama_lengkap', 'like', "%{$search}%")
                        ->orWhere('lingkungan', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('tanggal_sort');

        $perPage = 10;
        $page = $request->get('page', 1);
        $total = $query->count();
        $results = $query->forPage($page, $perPage)->get();

        $penerimaan = new \Illuminate\Pagination\LengthAwarePaginator(
            $results,
            $total,
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $totalPenerimaan = $total;

        return view('layouts.Laporan.Sakramen', compact(
            'penerimaan',
            'sakramen_list',
            'year',
            'sakramen_id',
            'search',
            'totalPenerimaan'
        ));
    }
}
