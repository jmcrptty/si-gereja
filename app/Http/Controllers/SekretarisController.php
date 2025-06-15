<?php

namespace App\Http\Controllers;

use App\Models\Umat;
use Illuminate\Http\Request;

class SekretarisController extends Controller
{
    public function index(){
        return view('layouts.sekretaris.dashboard');
    }

    // umat
    public function umat_index(){
        return view('layouts.sekretaris.umat.index', [
            'umats' => Umat::select('id','nama_lengkap','lingkungan', 'no_hp', 'alamat')->where('status_pendaftaran', 'Diterima')->get()
        ]);
    }
}
