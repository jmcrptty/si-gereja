<?php

namespace App\Http\Controllers;

use App\Models\InformasiMisa;
use Illuminate\Http\Request;

class InformasiMisaController extends Controller
{
    public function index()
    {
        $default = InformasiMisa::where('jenis_misa', 'Harian')->first();
        
        $informasiMisa = [
            'Harian' => InformasiMisa::where('jenis_misa', 'Harian')->first(),
            'Jumat_Pertama' => InformasiMisa::where('jenis_misa', 'Jumat_Pertama')->first(),
            'Minggu' => InformasiMisa::where('jenis_misa', 'Minggu')->first(),
        ];

        return view('layouts.InformasiMisa', compact('informasiMisa', 'default'));
    }

    public function getByJenis($jenis)
    {
        $informasiMisa = InformasiMisa::where('jenis_misa', $jenis)->first();

        if ($informasiMisa) {
            return response()->json($informasiMisa);
        } else {
            return response()->json(['message' => 'Jadwal misa tidak ditemukan'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_misa' => 'required|in:Harian,Jumat_Pertama,Minggu',
            'jadwal_misa' => 'required|string',
        ]);

        $informasiMisa = InformasiMisa::findOrFail($id);
        $informasiMisa->update($request->all());

        return redirect()->route('sekretaris.informasi_misa')
            ->with('success', 'Jadwal misa berhasil diperbarui.');
    }
}