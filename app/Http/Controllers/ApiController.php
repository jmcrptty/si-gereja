<?php

namespace App\Http\Controllers;

use App\Models\Umat;
use App\Models\Invitation;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function get_email_pernikahan_pria(Request $request)
    {
        $email = $request->input('email'); // or $request->email
        $umat = Umat::where('email', $email)->where('jenis_kelamin', 'Pria')->first();
        $token = $request->input('token');

        $invitation = Invitation::select('email')->where('token', $token)->where('aktif', true)->first();

        if(!$invitation){
            return redirect('pernikahan');
        }

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

    public function get_email_pernikahan_wanita(Request $request)
    {
        $email = $request->input('email'); // or $request->email
        $umat = Umat::where('email', $email)->where('jenis_kelamin', 'Wanita')->first();
        $token = $request->input('token');

        $invitation = Invitation::select('email')->where('token', $token)->where('aktif', true)->first();

        if(!$invitation){
            return redirect('pernikahan');
        }

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

