<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengaturanSakramen;
use Illuminate\Support\Facades\Validator;

class PenganturanSakramen extends Controller
{
    public function index(){

        $pengaturan_sakramen = PengaturanSakramen::select('jenis_sakramen', 'tanggal_mulai', 'tanggal_selesai', 'override_status')->get();

        return view('layouts.pembukaan_pendaftaran', [
            'pengaturan_sakramen' => $pengaturan_sakramen
        ]);
    }

    public function updatePengaturanSakramen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_sakramen' => 'required|in:Baptis,Komuni,Krisma,Pernikahan',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
        ]);

        $hasMulai = $request->filled('tanggal_mulai');
        $hasSelesai = $request->filled('tanggal_selesai');
        $isAlwaysOn = $request->has('selalu_aktif');

        $validator->after(function ($validator) use ($request, $hasMulai, $hasSelesai, $isAlwaysOn) {
            if (!($isAlwaysOn || ($hasMulai && $hasSelesai))) {
                $validator->errors()->add('tanggal_mulai', 'Isi tanggal mulai & selesai atau centang "Selalu Aktif".');
            }

            if ($hasMulai && $hasSelesai) {
                if (strtotime($request->tanggal_mulai) > strtotime($request->tanggal_selesai)) {
                    $validator->errors()->add('tanggal_mulai', 'Tanggal mulai tidak boleh lebih besar dari tanggal selesai.');
                }
            }
        });

        // If fails, redirect with status_error
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('status_error', implode(' ', $validator->errors()->all()));
        }

        // Save or update logic here
        PengaturanSakramen::updateOrCreate(
            ['jenis_sakramen' => $request->nama_sakramen],
            [
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'override_status' => $isAlwaysOn ? 'on' : 'off',
            ]
        );

        return back()->with('status', 'Pengaturan sakramen berhasil diperbarui.');
    }


    // public function updatePageKomuni(){
    //     return view('layouts.pembukaan_pendaftaran');
    // }

    // public function updatePageKrisma(){
    //     return view('layouts.pembukaan_pendaftaran');
    // }

    // public function updatePagePernikahan(){
    //     return view('layouts.pembukaan_pendaftaran');
    // }
}
