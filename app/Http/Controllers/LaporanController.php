<?php

namespace App\Http\Controllers;

use App\Models\Umat;
use App\Models\Sakramen;
use App\Models\PenerimaanSakramen;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function umat(Request $request)
    {
        // Get selected year and search query
        $year = $request->get('year', date('Y'));
        $search = $request->get('search');
        
        // Query builder with search and year filter
        $umat = Umat::query()
            ->whereYear('created_at', $year)
            ->where('status_pendaftaran', 'Diterima')
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%{$search}%")
                      ->orWhere('lingkungan', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Get total accepted umat for the selected year
        $totalUmat = Umat::whereYear('created_at', $year)
                         ->where('status_pendaftaran', 'Diterima')
                         ->count();

        return view('layouts.Laporan.Umat', compact('umat', 'year', 'totalUmat', 'search'));
    }

    public function detail($id)
    {
        $umat = Umat::findOrFail($id);
        return view('layouts.Laporan.UmatDetail', compact('umat'));
    }

    public function sakramen(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $sakramen_id = $request->get('sakramen_id');
        $search = $request->get('search');

        // Get sakramen list for dropdown
        $sakramen_list = Sakramen::select('id', 'nama_sakramen')
            ->orderBy('id')
            ->get();

        // Query using Umat model with sakramenYangDiterima relationship
        $penerimaan = Umat::with(['sakramenYangDiterima' => function($query) use ($year, $sakramen_id) {
                $query->whereYear('penerimaan_sakramen.tanggal_terima', $year);
                if($sakramen_id) {
                    $query->where('sakramen.id', $sakramen_id);
                }
            }])
            ->whereHas('sakramenYangDiterima', function($query) use ($year, $sakramen_id) {
                $query->whereYear('penerimaan_sakramen.tanggal_terima', $year);
                if($sakramen_id) {
                    $query->where('sakramen.id', $sakramen_id);
                }
            })
            ->where('status_pendaftaran', 'Diterima')
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%{$search}%")
                      ->orWhere('lingkungan', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        // Calculate total
        $totalPenerimaan = Umat::whereHas('sakramenYangDiterima', function($query) use ($year, $sakramen_id) {
                $query->whereYear('penerimaan_sakramen.tanggal_terima', $year);
                if($sakramen_id) {
                    $query->where('sakramen.id', $sakramen_id);
                }
            })
            ->where('status_pendaftaran', 'Diterima')
            ->count();

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
