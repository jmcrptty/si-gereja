<?php

namespace App\Http\Controllers;

use App\Models\Umat;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function get_email_pernikahan(Request $request)
    {
        $email = $request->input('email'); // or $request->email
        $umat = Umat::where('email', $email)->where('jenis_kelamin', 'Pria')->first();

        if ($umat) {
            return response()->json([
                'status' => 'found',
                'email' => $umat->email,
                'nama_lengkap' => $umat->nama_lengkap,
                'alamat' => $umat->alamat,
                'tempat_lahir' => $umat->tempat_lahir,
                'ttl' => $umat->ttl,
                'akte_file' => $umat->akte_file ?? '',
                'agama' => 'Katolik',
                'lingkungan' => $umat->lingkungan,
            ]);
        } else {
            return response()->json([
                'status' => 'not_found',
                'email' => null,
            ]);
        }
    }
}

