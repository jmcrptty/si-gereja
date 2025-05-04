<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        switch ($user->role) {
            case 'pastor paroki':
                // Menuju ke view dashboard untuk pastor
                return view('layouts.pastor.dashboard', compact('user'));
            case 'ketua lingkungan':
                // Menuju ke view dashboard untuk ketua lingkungan
                return view('layouts.ketualingkungan.dashboard', compact('user'));
            case 'sekretaris':
                // Menuju ke view dashboard untuk sekretaris
                return view('layouts.sekretaris.dashboard', compact('user'));
            default:
                // Jika role tidak dikenali, tampilkan error 403
                abort(403, 'Akses tidak diizinkan.');
        }
    }
}

