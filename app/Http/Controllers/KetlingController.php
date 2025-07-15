<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class KetlingController extends Controller
{
    // Menampilkan semua akun ketua lingkungan
    public function index()
    {
        $ketuas = User::where('role', 'ketua lingkungan')->get();
        return view('layouts.Manajemanketling', compact('ketuas'));
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


    // pengaturan akun (untuk role ketua lingkungan)
    public function editAkunKetling(User $user)
    {
        // dd($user->lingkungan);
        return view('layouts.ketualingkungan.pengaturan.manajemenakun', ['ketling' => $user]);
    }

    public function storeEditAkunKetling(Request $request)
    {
        $user_lama = User::findOrFail($request->id);

        $data_sama = ($request->name === $user_lama->name) && ($request->email === $user_lama->email) && empty($request->password);

        if($data_sama){
            return back()->with('error', 'Tidak ada data yang diganti');
        }

        $request_valid = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => ['required', 'email', Rule::unique('users')->ignore($request->id)],
            'password'   => 'nullable|string|min:6|confirmed',
        ], [
            // Pesan error dalam Bahasa Indonesia
            'name.required'        => 'Nama wajib diisi.',
            'name.string'          => 'Nama harus berupa teks.',
            'name.max'             => 'Nama tidak boleh lebih dari 255 karakter.',

            'email.required'       => 'Email wajib diisi.',
            'email.email'          => 'Format email tidak valid.',
            'email.unique'         => 'Email sudah digunakan.',

            'password.string'      => 'Password harus berupa teks.',
            'password.min'         => 'Password minimal terdiri dari 6 karakter.',
            'password.confirmed'   => 'Password yang dimasukkan belum sama.',
        ]);

        User::where('id', $request->id)->update([
            'name'       => $request_valid['name'],
            'email'      => $request_valid['email'],
        ]);

        // update password tidak wajib
        if (!empty($request_valid['password'])) {
            User::where('id', $request->id)->update([
            'password' => bcrypt($request_valid['password'])
        ]);
        }

        return redirect()->route('ketualingkungan.edit.akun', $request->id)->with('success', 'Data akun berhasil diperbarui!');
    }
}
