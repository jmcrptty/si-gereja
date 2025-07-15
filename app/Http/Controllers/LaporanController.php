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
use App\Models\Pernikahan;
use Illuminate\Support\Facades\Redirect;

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


    // Download PDF for Umat

    public function downloadUmatPdf(Request $request)
{
    $tahun = $request->input('tahun', date('Y'));
    $search = $request->input('search');

    $umatQuery = Umat::query()
        ->whereYear('tanggal_daftar', $tahun)
        ->where('status_pendaftaran', 'Diterima');

    if ($search) {
        $umatQuery->where(function ($q) use ($search) {
            $q->where('nama_lengkap', 'like', "%{$search}%")
              ->orWhere('lingkungan', 'like', "%{$search}%");
        });
    }

    $umat = $umatQuery->get();

    $pdf = Pdf::loadView('layouts.Laporan.pdf.umat', [
        'umat' => $umat,
        'tahun' => $tahun,
    ])->setPaper('a4', 'portrait');

    return $pdf->stream("laporan-umat-{$tahun}.pdf");
}


// Download PDF for Sakramen
public function downloadSakramenPdf(Request $request)
{
    $year = $request->input('year', date('Y'));
    $search = $request->input('search');
    $sakramen_id = $request->input('sakramen_id');

    $data = collect();

    if ($sakramen_id === 'baptis' || is_null($sakramen_id)) {
        $query = DB::table('baptis')
            ->join('umat', 'umat.id', '=', 'baptis.umat_id')
            ->where('baptis.status_penerimaan', 'Diterima')
            ->whereYear('baptis.tanggal_terima', $year)
            ->where('baptis.gereja_tempat_baptis', 'Gereja Katedral Santo Fransiskus Xaverius Merauke')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($s) use ($search) {
                    $s->where('umat.nama_lengkap', 'like', "%$search%")
                      ->orWhere('umat.lingkungan', 'like', "%$search%");
                });
            })
            ->select(
                'umat.nama_lengkap',
                'umat.lingkungan',
                DB::raw("'Baptis' as nama_sakramen"),
                'baptis.tanggal_terima'
            )
            ->get();

        $data = $data->merge($query);
    }

    if ($sakramen_id === 'komuni' || is_null($sakramen_id)) {
        $query = DB::table('komuni')
            ->join('umat', 'umat.id', '=', 'komuni.umat_id')
            ->where('komuni.status_penerimaan', 'Diterima')
            ->whereYear('komuni.tanggal_terima', $year)
            ->where('komuni.gereja_tempat_komuni', 'Gereja Katedral Santo Fransiskus Xaverius Merauke')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($s) use ($search) {
                    $s->where('umat.nama_lengkap', 'like', "%$search%")
                      ->orWhere('umat.lingkungan', 'like', "%$search%");
                });
            })
            ->select(
                'umat.nama_lengkap',
                'umat.lingkungan',
                DB::raw("'Komuni' as nama_sakramen"),
                'komuni.tanggal_terima'
            )
            ->get();

        $data = $data->merge($query);
    }

    if ($sakramen_id === 'krisma' || is_null($sakramen_id)) {
        $query = DB::table('krisma')
            ->join('umat', 'umat.id', '=', 'krisma.umat_id')
            ->where('krisma.status_penerimaan', 'Diterima')
            ->whereYear('krisma.tanggal_terima', $year)
            ->where('krisma.gereja_tempat_krisma', 'Gereja Katedral Santo Fransiskus Xaverius Merauke')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($s) use ($search) {
                    $s->where('umat.nama_lengkap', 'like', "%$search%")
                      ->orWhere('umat.lingkungan', 'like', "%$search%");
                });
            })
            ->select(
                'umat.nama_lengkap',
                'umat.lingkungan',
                DB::raw("'Krisma' as nama_sakramen"),
                'krisma.tanggal_terima'
            )
            ->get();

        $data = $data->merge($query);
    }

    if ($sakramen_id === 'pernikahan' || is_null($sakramen_id)) {
        $query = DB::table('pernikahans')
            ->leftJoin('umat as pria', 'pernikahans.umat_id_pria', '=', 'pria.id')
            ->leftJoin('umat as wanita', 'pernikahans.umat_id_wanita', '=', 'wanita.id')
            ->where('pernikahans.status_penerimaan', 'Diterima')
            ->whereYear('pernikahans.tanggal_terima', $year)
            ->when($search, function ($q) use ($search) {
                $q->where(function ($s) use ($search) {
                    $s->where('pria.nama_lengkap', 'like', "%$search%")
                      ->orWhere('pria.lingkungan', 'like', "%$search%")
                      ->orWhere('wanita.nama_lengkap', 'like', "%$search%")
                      ->orWhere('wanita.lingkungan', 'like', "%$search%");
                });
            })
            ->select(
                DB::raw("CONCAT_WS(' & ', pria.nama_lengkap, wanita.nama_lengkap) as nama_lengkap"),
                DB::raw("CONCAT_WS(' & ', pria.lingkungan, wanita.lingkungan) as lingkungan"),
                DB::raw("'Pernikahan' as nama_sakramen"),
                'pernikahans.tanggal_terima'
            )
            ->get();

        $data = $data->merge($query);
    }

    $sorted = $data->sortByDesc('tanggal_terima')->values();

    if (is_null($sakramen_id)) {
        return PDF::loadView('layouts.laporan.pdf.semua_sakramen', [
            'data' => $sorted,
            'year' => $year
        ])->setPaper('a4', 'portrait')
        ->stream("laporan_semua_sakramen_{$year}.pdf");
    }

    return PDF::loadView('layouts.laporan.pdf.sakramen', [
        'data' => $sorted,
        'year' => $year,
        'sakramen' => ucfirst($sakramen_id)
    ])->setPaper('a4', 'portrait')
    ->stream("laporan_sakramen_{$sakramen_id}_{$year}.pdf");
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

    $queries = [];
    $bindings = [];

    if (is_null($sakramen_id) || $sakramen_id === 'baptis') {
        $baptis = DB::table('baptis')
            ->join('umat', 'umat.id', '=', 'baptis.umat_id')
            ->select(
                'baptis.umat_id',
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

        $queries[] = $baptis->toSql();
        $bindings = array_merge($bindings, $baptis->getBindings());
    }

    if (is_null($sakramen_id) || $sakramen_id === 'komuni') {
        $komuni = DB::table('komuni')
            ->join('umat', 'umat.id', '=', 'komuni.umat_id')
            ->select(
                'komuni.umat_id',
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

        $queries[] = $komuni->toSql();
        $bindings = array_merge($bindings, $komuni->getBindings());
    }

    if (is_null($sakramen_id) || $sakramen_id === 'krisma') {
        $krisma = DB::table('krisma')
            ->join('umat', 'umat.id', '=', 'krisma.umat_id')
            ->select(
                'krisma.umat_id',
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

        $queries[] = $krisma->toSql();
        $bindings = array_merge($bindings, $krisma->getBindings());
    }

    if (is_null($sakramen_id) || $sakramen_id === 'pernikahan') {
        $pernikahan = DB::table('pernikahans')
            ->leftJoin('umat as pria', 'pernikahans.umat_id_pria', '=', 'pria.id')
            ->leftJoin('umat as wanita', 'pernikahans.umat_id_wanita', '=', 'wanita.id')
            ->select(
                DB::raw("NULL as umat_id"),
                DB::raw("COALESCE(pria.nama_lengkap, pernikahans.nama_lengkap_pria, '-') || ' & ' || COALESCE(wanita.nama_lengkap, pernikahans.nama_lengkap_wanita, '-') as nama_lengkap"),
                DB::raw("
                    CASE
                        WHEN pria.lingkungan IS NOT NULL AND wanita.lingkungan IS NOT NULL THEN pria.lingkungan || ' & ' || wanita.lingkungan
                        WHEN pria.lingkungan IS NOT NULL THEN pria.lingkungan
                        WHEN wanita.lingkungan IS NOT NULL THEN wanita.lingkungan
                        ELSE '-'
                    END as lingkungan
                "),
                DB::raw("'Pernikahan' as nama_sakramen"),
                'pernikahans.tanggal_terima',
                DB::raw('NULL as tempat_terima'),
                DB::raw('NULL as keterangan'),
                DB::raw('pernikahans.tanggal_terima as tanggal_sort')
            )
            ->where('pernikahans.status_penerimaan', 'Diterima')
            ->whereYear('pernikahans.tanggal_terima', $year);

        $queries[] = $pernikahan->toSql();
        $bindings = array_merge($bindings, $pernikahan->getBindings());
    }

    $unionSql = implode(' union all ', $queries);
    $baseQuery = DB::table(DB::raw("({$unionSql}) as x"))->setBindings($bindings);

    // Filter search
    if ($search) {
        $baseQuery->where(function ($q) use ($search) {
            $q->where('nama_lengkap', 'like', "%{$search}%")
              ->orWhere('lingkungan', 'like', "%{$search}%");
        });
    }

    $baseQuery->orderByDesc('tanggal_sort');

    // Pagination
    $perPage = 10;
    $page = $request->get('page', 1);
    $total = $baseQuery->count();
    $results = $baseQuery->forPage($page, $perPage)->get();

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



    public function tambahTanggalPernikahan(Request $request, Pernikahan $pernikahan)
    {
        // dd($pernikahan);
        $request->validate([
            'tanggal_terima' => 'required|date',
        ]);

        $pernikahan->update([
            'tanggal_terima' => Carbon::createFromFormat('Y-m-d', $request->tanggal_terima)->startOfDay(),
        ]);

        return redirect()->back()->with('status', 'Tanggal pernikahan berhasil ditambahkan.');
    }
}
