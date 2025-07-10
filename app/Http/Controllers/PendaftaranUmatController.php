<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\User;
use App\Models\Umat;
use Illuminate\Http\Request;

class PendaftaranUmatController extends Controller
{
    public function create($token) {

        // aktifkan untuk cek database saja
        // dd(Invitation::all());

        // ambil data email dari tabel invitation, dimana tokennya seperti ini dan statusnya aktif
        $invitation = Invitation::select('email')->where('token', $token)->where('aktif', true)->first();

        // jika tidak ada, kembalikan ke halaman utama
        if(!$invitation){
            return redirect('pendaftaran-umat')->with('Pemberitahuan', 'formulir yang anda masukan sudah kadaluarsa. Mohon isi kembali email pada form di bawah');
        }
        // jika ada, tampilkan halaman login
        return view('layouts.pendaftaranumat.create', [
            'email' => $invitation->email
        ]);
    }

    public function store(Request $request)
    {
        $request_valid = $request->validate([
        // Biodata
        'nama_lengkap' => ['required', 'string', 'max:100'],
        'nik' => ['required', 'string', 'max:20', 'unique:umat,nik'],
        'jenis_kelamin' => ['required', 'in:Pria,Wanita'],
        'nama_ayah' => ['required', 'string'],
        'nama_ibu' => ['required', 'string'],
        'tempat_lahir' => ['required', 'string'],
        'ttl' => ['required', 'date'],
        'alamat' => ['required', 'string'],
        'lingkungan' => ['required'],

        // Kontak
        'no_hp' => ['required', 'string', 'max:15', 'unique:umat,no_hp'],
        'email' => ['required', 'email:rfc,dns', 'max:50', 'unique:umat,email'],

        // Berkas
        'kk_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
        'akte_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],

        ],
        [
            // Pesan error
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.max' => 'NIK maksimal 20 karakter.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Pria atau Wanita.',
            'nama_ayah.required' => 'Nama ayah wajib diisi.',
            'nama_ibu.required' => 'Nama ibu wajib diisi.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'ttl.required' => 'Tanggal lahir wajib diisi.',
            'ttl.date' => 'Format tanggal lahir tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',
            'lingkungan.required' => 'Lingkungan wajib dipilih.',
            'status_pendaftaran.in' => 'Status pendaftaran tidak valid.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.max' => 'Nomor HP maksimal 15 karakter.',
            'no_hp.unique' => 'Nomor HP sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 50 karakter.',
            'email.unique' => 'Email sudah terdaftar.',
            'kk_file.file' => 'File KK harus berupa dokumen atau gambar.',
            'kk_file.mimes' => 'File KK harus berupa PDF, JPG, JPEG, atau PNG.',
            'kk_file.max' => 'Ukuran file KK maksimal 25MB.',
            'akte_file.file' => 'File Akte harus berupa dokumen atau gambar.',
            'akte_file.mimes' => 'File Akte harus berupa PDF, JPG, JPEG, atau PNG.',
            'akte_file.max' => 'Ukuran file Akte maksimal 25MB.',
        ]);

        // dimasukan hanya kalau ada filenya. kalau tidak nilainya tetap null
        if($request->hasFile('kk_file') ){
            $kkPath = $request->file('kk_file')->store('umats/kk', 'local');
            $request_valid['kk_file'] = $kkPath;
        }
        if($request->hasFile('akte_file')){
            $aktePath = $request->file('akte_file')->store('umats/akte', 'local');
            $request_valid['akte_file'] = $aktePath;
        }

        // cek kebenaran token
        $invitation = Invitation::select('email')->where('token', $request->token)->where('aktif', true)->first();
        // kalo gak ada kembalikan ke halaman utama
        if(!$invitation){
            return redirect('pendaftaran-umat')->with('Pemberitahuan', 'Terjadi Kesalahan, mohon coba lagi');
        }

        // buat token expire
        $invitation->update(['aktif'=> false]);

        // masukkan data
        Umat::create($request_valid);

        // balik ke index
        return redirect()->route('pendaftaran-umat')->with('success', 'Anda berhasil mendaftar! Mohon menunggu konfirmasi dari ketua lingkungan dalam waktu maksimal 2 hari kerja.');
    }

}
