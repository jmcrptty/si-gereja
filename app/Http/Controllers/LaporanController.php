<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Umat;
use App\Models\Sakramen;
use Illuminate\Http\Request;
use App\Models\PenerimaanSakramen;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class LaporanController extends Controller
{
    public function umat(Request $request)
    {
        $tahun = $request->get('tahun', date('Y'));
        $search = $request->get('search');

        $umatQuery = Umat::query()->whereYear('tanggal_daftar', $tahun)->where('status_pendaftaran', 'Diterima');

        // Apply search if provided
        if ($search) {
            $umatQuery->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                ->orWhere('lingkungan', 'like', "%{$search}%");
            });
        }

        // Paginate the results
        $umat = $umatQuery->latest()->paginate(10)->withQueryString();

        // Count total accepted umat for summary card (same base conditions)
        $totalUmat = $umatQuery->count();

        // dd($umat);

        // Return view with all required data
        return view('layouts.Laporan.Umat', compact('umat', 'tahun', 'totalUmat', 'search'));
    }

    public function umat_show(Umat $umat)
    {
        $umat->load(['baptis', 'komuni', 'krisma']);

        if ($umat->jenis_kelamin == 'Pria') {
            $umat->load(['pernikahanPria']);
        } else {
            $umat->load(['pernikahanWanita']);
        }

        $formattedSakramen = [
            'Baptis' => $umat->baptis ? optional($umat->baptis)->tanggal_terima?->format('Y-m-d') : null,
            'Komuni' => $umat->komuni ? optional($umat->komuni)->tanggal_terima?->format('Y-m-d') : null,
            'Krisma' => $umat->krisma ? optional($umat->krisma)->tanggal_terima?->format('Y-m-d') : null,
            'Pernikahan' => null,
        ];

        if ($umat->jenis_kelamin == 'Pria' && $umat->pernikahanPria) {
            $formattedSakramen['Pernikahan'] = optional($umat->pernikahanPria)->tanggal_terima?->format('Y-m-d');
        } elseif ($umat->jenis_kelamin == 'Wanita' && $umat->pernikahanWanita) {
            $formattedSakramen['Pernikahan'] = optional($umat->pernikahanWanita)->tanggal_terima?->format('Y-m-d');
        }


        return view('layouts.Laporan.showUmat', [
            'umat' => $umat,
            'tanggal_terima' => $formattedSakramen
        ]);
    }

    public function downloadFile($type, $filename)
    {
        $path = "private/umats/{$type}/{$filename}";

        return response()->file(storage_path("app/{$path}"));
    }

    public function downloadFilePernikahan($type, $filename)
    {
        $path = "private/pernikahans/{$type}/{$filename}";

        return response()->file(storage_path("app/{$path}"));
    }

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
            ->whereYear('baptis.tanggal_terima', $year);

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
            ->whereYear('komuni.tanggal_terima', $year);

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
            ->whereYear('krisma.tanggal_terima', $year);

        // Query Pernikahan
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

        // Selectively apply query based on sakramen_id
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

        // Wrap subquery
        $query = DB::table(DB::raw("({$query->toSql()}) as x"))
            ->mergeBindings($baptis) // merge from base query to support binding
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('nama_lengkap', 'like', "%{$search}%")
                        ->orWhere('lingkungan', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('tanggal_sort');

        // Manual Pagination
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
