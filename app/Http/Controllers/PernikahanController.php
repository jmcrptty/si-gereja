<?php

namespace App\Http\Controllers;

use App\Models\Umat;
use App\Models\Invitation;
use App\Models\Pernikahan;
use Illuminate\Http\Request;

class PernikahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.pernikahan.pernikahan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($token)
    {
        $invitation = Invitation::select('email')->where('token', $token)->where('aktif', true)->first();

        if(!$invitation){
            return redirect('pernikahan')->with('Pemberitahuan', 'Undangan yang anda masukan sudah kadaluarsa. Mohon isi kembali email pada form di bawah');
        }

        return view('layouts.pernikahan.create', [
            'umat' => Umat::select('nama_lengkap', 'alamat','tempat_lahir', 'email', 'akte_file', 'jenis_kelamin', 'ttl', 'lingkungan', 'email')->where('email', $invitation->email)->first(),
        ]);
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
    public function show(Pernikahan $pernikahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pernikahan $pernikahan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pernikahan $pernikahan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pernikahan $pernikahan)
    {
        //
    }
}
