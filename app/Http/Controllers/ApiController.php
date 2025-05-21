<?php

namespace App\Http\Controllers;

use App\Models\Umat;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function get_nik(Request $request)
    {
        $nik = $request->input('nik'); // or $request->nik
        $nik_umat = Umat::where('nik', $nik)->value('nik');

        if ($nik_umat) {
            return response()->json([
                'status' => 'found',
                'nik' => $nik_umat,
            ]);
        } else {
            return response()->json([
                'status' => 'not_found',
                'nik' => null,
            ]);
        }
    }
}

