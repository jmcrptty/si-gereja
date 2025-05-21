<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Umat;
use Illuminate\Http\Request;

class PendaftaranUmatController extends Controller
{
    public function index() {
        return view('layouts.pendaftaranumat.pendaftaranumat');
    }

    public function store(Request $request)
    {
        $request_valid = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:16', 'unique:users,nik'],
            'ttl' => ['required', 'date'],
            'alamat' => ['required', 'string'],
            'no_hp' => ['required', 'string', 'max:12', 'unique:users,no_hp'],
            'email' => ['required', 'email:rfc,dns', 'unique:users,email'],
            'lingkungan' => ['required', 'string'],

            // rencana
            // 'kk_file' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'], // ~25MB
            // 'akte_file' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
        ], [
            // pesan error
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'ttl.required' => 'Tanggal lahir wajib diisi.',
            'ttl.date' => 'Format tanggal lahir tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.unique' => 'Nomor HP sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'lingkungan.required' => 'Lingkungan wajib dipilih.',

            // pesan error rencana
            // 'kk_file.required' => 'File KK wajib diunggah.',
            // 'akte_file.required' => 'File Akte wajib diunggah.',
            // 'kk_file.max' => 'Ukuran file KK maksimal 25MB.',
            // 'akte_file.max' => 'Ukuran file Akte maksimal 25MB.',
        ]);

        // masukkan data
        Umat::create($request_valid);
        // balik ke index
        return redirect()->route('pendaftaran-umat')->with('success', 'Anda berhasil mendaftar!');
    }

    public function create() {
        return view('layouts.pendaftaranumat.create');
    }
}
