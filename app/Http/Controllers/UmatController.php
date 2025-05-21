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
        return view('layouts.ketualingkungan.umat.index', [
            'umats' => Umat::select('id','nama_lengkap','lingkungan', 'no_hp', 'alamat')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.ketualingkungan.umat.create', [

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
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
        return redirect()->route('umat.index')->with('success', 'Data Umat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Umat $umat)
    {
        return view('layouts.ketualingkungan.umat.show', [
            'umat' => $umat
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Umat $umat)
    {
        return view('layouts.ketualingkungan.umat.edit',[
            'umat' => $umat,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Umat $umat)
    {
        // simpan ini buat lebih gampang testing
        // $request_valid = $request->validate([
        //     // 'email' => 'required|email:dns|unique:users',
        //     'nama_lengkap' => 'required|max:255',
        //     'nik' => 'required|unique:users|max:16',
        //     'ttl' => 'required',
        //     'alamat' => 'required',
        //     'no_hp' => 'required|unique:users|max:12',
        //     'email' => 'required|unique:users',
        //     'lingkungan' => 'required',
        //     // file-file nanti
        //     // 'kk_file' => 'required', 'max:'25000'
        //     // 'akte_file' => 'required', 'max:'25000'
        // ]);

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
        Umat::where('id', $umat->id)->update($request_valid);
        // balik ke index
        return redirect()->route('umat.index')->with('success', 'Data umat berhasil diperbarui!');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Umat $umat)
    {
        Umat::destroy($umat->id);
        return redirect()->route('umat.index')->with('delete_success', 'Data Berhasil Dihapus');
    }
}
