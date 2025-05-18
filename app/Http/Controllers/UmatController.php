<?php

namespace App\Http\Controllers;

use App\Models\Lingkungan;
use App\Models\Umat;
use Illuminate\Http\Request;

class UmatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $test = Umat::select('nama_lengkap','lingkungan_id', 'alamat')->get();
        // dd($test);
        return view('layouts.ketualingkungan.umat.index', [
            'umats' => Umat::select('nama_lengkap','lingkungan', 'no_hp', 'alamat')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.ketualingkungan.umat.create', [
            //
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request_valid = $request->validate([
            // 'email' => 'required|email:dns|unique:users',
            'nama' => 'required|max:255',
            'alamat' => 'required|max:255',
            'no_telpon' => 'required|numeric|digits:12|unique:pasiens',
            'tanggal_lahir' => 'required',
            'asuransi_id' => 'required',
        ]);

        // masukkan data
        Umat::create($request_valid);
        // balik ke index
        return redirect()->route('pasien.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Umat $umat)
    {
        return view('layouts.ketualingkungan.umat.show', [

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Umat $umat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Umat $umat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Umat $umat)
    {
        //
    }
}
