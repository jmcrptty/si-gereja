<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KetlingController extends Controller
{
    // Menampilkan semua akun ketua lingkungan
    public function index()
    {
        $ketuas = User::where('role', 'ketua lingkungan')->get();
        return view('layouts.manajemanketling', compact('ketuas'));
    }

    // Menyimpan data akun ketua lingkungan (role fixed)
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'lingkungan' => 'required|string|max:100',
            'role'       => 'required|string|in:ketua lingkungan',
            'password'   => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'lingkungan' => $request->lingkungan,
            'role'       => $request->role,
            'password'   => Hash::make($request->password),
        ]);

        return redirect()->route('sekretaris.ketling.index')->with('success', 'Akun Ketua Lingkungan berhasil ditambahkan.');
    }

    // Menghapus akun ketua lingkungan
    public function destroy($id)
    {
        $user = User::where('role', 'ketua lingkungan')->findOrFail($id);
        $user->delete();

        return redirect()->route('sekretaris.ketling.index')->with('success', 'Akun Ketua Lingkungan berhasil dihapus.');
    }
}
