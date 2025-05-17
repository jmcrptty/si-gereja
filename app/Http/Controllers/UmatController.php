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
        return view('ketua_lingkungan.umat.index', [
            'umats' => Umat::select('nama_lengkap','lingkungan_id', 'alamat')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Umat $umat)
    {
        //
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
