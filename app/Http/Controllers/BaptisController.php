<?php

namespace App\Http\Controllers;

use App\Models\Baptis;
use App\Models\Invitation;
use App\Models\Umat;
use Illuminate\Http\Request;

class BaptisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        // ke halaman utama pendaftaran umat
        // dd(Baptis::all());
        return view('layouts.baptis.baptis');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($token)
    {
        $invitation = Invitation::select('email')->where('token', $token)->where('aktif', true)->first();

        // kemudian hari, tambah logic untuk tolak jika umat sudah pernah kirim ( menunggu persetujuan )

        if(!$invitation){
            return redirect('baptis')->with('Pemberitahuan', 'Undangan yang anda masukan sudah kadaluarsa. Mohon isi kembali email pada form di bawah');
        }
        // jika ada, tampilkan halaman login
        return view('layouts.baptis.create', [
            'umat' => Umat::select('nama_lengkap','email')->where('email', $invitation->email)->first(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request_valid = $request->validate([
            // Biodata Umat
            'nama_baptis' => ['required', 'string', 'max:100'],

            // Berkas Orang Tua
            'fotokopi_ktp_ortu' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
            'surat_pernikahan_katolik_ortu' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],

            // Wali Baptis Tunggal
            'nama_wali_baptis' => ['nullable', 'string', 'max:100', 'required_without_all:nama_wali_baptis_pria,nama_wali_baptis_wanita'],
            'surat_krisma_wali_baptis' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000', 'required_without:surat_pernikahan_wali_baptis'],

            // Wali Baptis Pasangan
            'nama_wali_baptis_pria' => ['nullable', 'string', 'max:100', 'required_without:nama_wali_baptis'],
            'nama_wali_baptis_wanita' => ['nullable', 'string', 'max:100', 'required_without:nama_wali_baptis'],
            'surat_pernikahan_wali_baptis' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000', 'required_without:surat_krisma_wali_baptis'],
        ],
        [
            // Biodata Umat
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.max' => 'Nama lengkap maksimal 100 karakter.',
            'nama_lengkap.string' => 'Nama lengkap harus berupa teks.',

            'nama_baptis.required' => 'Nama baptis wajib diisi.',
            'nama_baptis.max' => 'Nama baptis maksimal 100 karakter.',
            'nama_baptis.string' => 'Nama baptis harus berupa teks.',

            // Berkas Orang Tua
            'fotokopi_ktp_ortu.required' => 'File KTP orang tua wajib diunggah.',
            'fotokopi_ktp_ortu.file' => 'File KTP orang tua harus berupa dokumen atau gambar.',
            'fotokopi_ktp_ortu.mimes' => 'File KTP orang tua harus berformat PDF, JPG, JPEG, atau PNG.',
            'fotokopi_ktp_ortu.max' => 'Ukuran file KTP orang tua maksimal 25MB.',

            'surat_pernikahan_katolik_ortu.required' => 'File surat pernikahan katolik orang tua wajib diunggah.',
            'surat_pernikahan_katolik_ortu.file' => 'File surat pernikahan harus berupa dokumen atau gambar.',
            'surat_pernikahan_katolik_ortu.mimes' => 'File surat pernikahan harus berformat PDF, JPG, JPEG, atau PNG.',
            'surat_pernikahan_katolik_ortu.max' => 'Ukuran file surat pernikahan maksimal 25MB.',

            // Wali Baptis Tunggal
            'nama_wali_baptis.required_without_all' => 'Nama wali baptis tunggal wajib diisi jika tidak mengisi nama wali baptis pria dan wanita.',
            'nama_wali_baptis.string' => 'Nama wali baptis harus berupa teks.',
            'nama_wali_baptis.max' => 'Nama wali baptis maksimal 100 karakter.',

            'surat_krisma_wali_baptis.required_without' => 'File surat krisma wajib diunggah jika tidak mengunggah surat pernikahan wali baptis.',
            'surat_krisma_wali_baptis.file' => 'File surat krisma harus berupa dokumen atau gambar.',
            'surat_krisma_wali_baptis.mimes' => 'File surat krisma harus berformat PDF, JPG, JPEG, atau PNG.',
            'surat_krisma_wali_baptis.max' => 'Ukuran file surat krisma maksimal 25MB.',

            // Wali Baptis Pasangan
            'nama_wali_baptis_pria.required_without' => 'Nama wali baptis pria wajib diisi jika tidak mengisi wali baptis tunggal.',
            'nama_wali_baptis_pria.string' => 'Nama wali baptis pria harus berupa teks.',
            'nama_wali_baptis_pria.max' => 'Nama wali baptis pria maksimal 100 karakter.',

            'nama_wali_baptis_wanita.required_without' => 'Nama wali baptis wanita wajib diisi jika tidak mengisi wali baptis tunggal.',
            'nama_wali_baptis_wanita.string' => 'Nama wali baptis wanita harus berupa teks.',
            'nama_wali_baptis_wanita.max' => 'Nama wali baptis wanita maksimal 100 karakter.',

            'surat_pernikahan_wali_baptis.required_without' => 'File surat pernikahan wali baptis wajib diunggah jika tidak mengunggah surat krisma.',
            'surat_pernikahan_wali_baptis.file' => 'File surat pernikahan wali baptis harus berupa dokumen atau gambar.',
            'surat_pernikahan_wali_baptis.mimes' => 'File surat pernikahan wali baptis harus berformat PDF, JPG, JPEG, atau PNG.',
            'surat_pernikahan_wali_baptis.max' => 'Ukuran file surat pernikahan wali baptis maksimal 25MB.',
        ]);

        // validasi tambahan
        $hasTunggal = $request->filled('nama_wali_baptis');
        $hasPasangan = $request->filled('nama_wali_baptis_pria') || $request->filled('nama_wali_baptis_wanita');

        if ($hasTunggal && $hasPasangan) {
            return back()->withErrors([
                'nama_wali_baptis' => 'Harap isi salah satu: Wali Baptis Tunggal atau Wali Baptis Pasangan.',
                'nama_wali_baptis_pria' => 'Harap isi salah satu: Wali Baptis Tunggal atau Wali Baptis Pasangan.',
                'nama_wali_baptis_wanita' => 'Harap isi salah satu: Wali Baptis Tunggal atau Wali Baptis Pasangan.',
            ])->withInput();
        }

        $hasSuratKrisma = $request->hasFile('surat_krisma_wali_baptis');
        $hasSuratPernikahan = $request->hasFile('surat_pernikahan_wali_baptis');

        if ($hasSuratKrisma && $hasSuratPernikahan) {
            return back()->withErrors([
                'surat_krisma_wali_baptis' => 'Harap isi salah satu: Surat krisma Wali Baptis atau Surat Pernikahan Wali Baptis.',
                'surat_pernikahan_wali_baptis' => 'Harap isi salah satu: Surat krisma Wali Baptis atau Surat Pernikahan Wali Baptis.',
            ])->withInput();
        }

        // masukkan file
        if($request->hasFile('fotokopi_ktp_ortu') ){
            $ktpOrtuPath = $request->file('fotokopi_ktp_ortu')->store('umats/fotokopi_ktp_ortu', 'local');
            $request_valid['fotokopi_ktp_ortu'] = $ktpOrtuPath;
        }
        if($request->hasFile('surat_pernikahan_katolik_ortu')){
            $suratPernikahanOrtuPath = $request->file('surat_pernikahan_katolik_ortu')->store('umats/surat_pernikahan_katolik_ortu', 'local');
            $request_valid['surat_pernikahan_katolik_ortu'] = $suratPernikahanOrtuPath;
        }
        if($request->hasFile('surat_krisma_wali_baptis')){
            $suratKrismaPath = $request->file('surat_krisma_wali_baptis')->store('umats/surat_krisma_wali_baptis', 'local');
            $request_valid['surat_krisma_wali_baptis'] = $suratKrismaPath;
        }
        if($request->hasFile('surat_pernikahan_wali_baptis')){
            $suratPernikahanPath = $request->file('surat_pernikahan_wali_baptis')->store('umats/surat_pernikahan_wali_baptis', 'local');
            $request_valid['surat_pernikahan_wali_baptis'] = $suratPernikahanPath;
        }

        // masukkan id umat
        $umat_id = Umat::where('email', $request->email)->value('id');

        $sudah_daftar = Baptis::where('umat_id', $umat_id)->first();
        if($sudah_daftar){
            return redirect('baptis')->with('Pemberitahuan', 'Anda telah terdaftar. Mohon tunggu pengumuman lebih lanjut');
        }

        $request_valid['umat_id'] = $umat_id;

        // masukkan gereja tempat baptis umat
        $request_valid['gereja_tempat_baptis'] = "Gereja Katedral Santo Fransiskus Xaverius Merauke";

        // cek kebenaran token
        $invitation = Invitation::where('token', $request->token)->where('aktif', true)->first();
        // kalo gak ada kembalikan ke halaman utama
        if(!$invitation){
            return redirect('baptis')->with('Pemberitahuan', 'Terjadi Kesalahan, mohon coba lagi');
        }

        // buat token expire
        $invitation->update(['aktif'=> false]);

        // masukkan data
        Baptis::create($request_valid);

        // balik ke index
        return redirect()->route('baptis')->with('success', 'Anda berhasil mendaftar! Tunggu informasi lebih lanjut pada pengumuman');
    }

    /**
     * Display the specified resource.
     */
    public function show(Baptis $baptis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Baptis $baptis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Baptis $baptis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Baptis $baptis)
    {
        //
    }
}
