<?php

namespace App\Http\Controllers;

use App\Models\Umat;
use App\Models\Baptis;
use App\Models\Komuni;
use App\Models\Invitation;
use Illuminate\Http\Request;

class KomuniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.komuni.komuni');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($token)
    {
        $invitation = Invitation::select('email')->where('token', $token)->where('aktif', true)->first();

        if(!$invitation){
            return redirect('komuni-pertama')->with('Pemberitahuan', 'Undangan yang anda masukan sudah kadaluarsa. Mohon isi kembali email pada form di bawah');
        }

        // ambil id umat
        $umat_id = Umat::where('email', $invitation->email)->value('id');

        return view('layouts.komuni.create', [
            'umat' => Umat::select('nama_lengkap', 'alamat', 'nama_ayah', 'nama_ibu', 'email')->where('email', $invitation->email)->first(),
            'data_baptis' => Baptis::select('nama_baptis','fotokopi_ktp_ortu', 'surat_pernikahan_katolik_ortu')->where('umat_id', $umat_id)->first()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request_valid = $request->validate([
            // Data Sakramen Baptis
            'tanggal_pembaptisan' => ['required', 'date'],
            'surat_baptis' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
            'nama_baptis' => ['required', 'string'],

            // Berkas Orang Tua
            'fotokopi_ktp_ortu' => ['file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
            'surat_pernikahan_katolik_ortu' => ['file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
        ],
        [
            // Data Sakramen Baptis
            'tanggal_pembaptisan.required' => 'Tanggal pembaptisan wajib diisi.',
            'tanggal_pembaptisan.date' => 'Format tanggal pembaptisan tidak valid.',

            'surat_baptis.file' => 'File surat Baptis harus berupa dokumen atau gambar.',
            'surat_baptis.required' => 'Mohon isi file surat Baptis',
            'surat_baptis.mimes' => 'File surat Baptis harus berformat PDF, JPG, JPEG, atau PNG.',
            'surat_baptis.max' => 'Ukuran file surat krisma maksimal 25MB.',

            'nama_baptis.required' => 'Mohon isi nama baptis',

            // Berkas Orang Tua
            'fotokopi_ktp_ortu.file' => 'File KTP orang tua harus berupa dokumen atau gambar.',
            'fotokopi_ktp_ortu.mimes' => 'File KTP orang tua harus berformat PDF, JPG, JPEG, atau PNG.',
            'fotokopi_ktp_ortu.max' => 'Ukuran file KTP orang tua maksimal 25MB.',

            'surat_pernikahan_katolik_ortu.file' => 'File surat pernikahan harus berupa dokumen atau gambar.',
            'surat_pernikahan_katolik_ortu.mimes' => 'File surat pernikahan harus berformat PDF, JPG, JPEG, atau PNG.',
            'surat_pernikahan_katolik_ortu.max' => 'Ukuran file surat pernikahan maksimal 25MB.',
        ]);

        // validasi berkas kalau tidak baptis di gereja katedal

        // masukkan id umat
        $umat_id = Umat::where('email', $request->email)->value('id');

        if (!$umat_id) {
            return back()->withErrors(['email' => 'Email tidak ditemukan di database umat.'])->withInput();
        }

        $has_fotokopi_ktp_ortu = $request->hasFile('fotokopi_ktp_ortu') || Baptis::where('umat_id', $umat_id)->value('fotokopi_ktp_ortu');
        $has_surat_pernikahan_katolik_ortu = $request->hasFile('surat_pernikahan_katolik_ortu') || Baptis::where('umat_id', $umat_id)->value('surat_pernikahan_katolik_ortu');

        if (!$has_fotokopi_ktp_ortu && !$has_surat_pernikahan_katolik_ortu) {
            return back()->withErrors([
                'fotokopi_ktp_ortu' => 'Harap upload KTP orang tua.',
                'surat_pernikahan_katolik_ortu' => 'Harap upload surat pernikahan orang tua.'
            ])->withInput();
        }
        if (!$has_fotokopi_ktp_ortu) {
            return back()->withErrors([
                'fotokopi_ktp_ortu' => 'Harap upload KTP orang tua.'
            ])->withInput();
        }
        if (!$has_surat_pernikahan_katolik_ortu) {
            return back()->withErrors([
                'surat_pernikahan_katolik_ortu' => 'Harap upload surat pernikahan orang tua.'
            ])->withInput();
        }

        $sudah_daftar = Komuni::where('umat_id', $umat_id)->first();
        if($sudah_daftar){
            return redirect('komuni-pertama')->with('Pemberitahuan', 'Anda telah terdaftar. Mohon tunggu pengumuman lebih lanjut');
        }

        $request_valid['umat_id'] = $umat_id;

        // cek kebenaran token
        $invitation = Invitation::where('token', $request->token)->where('aktif', true)->first();
        // kalo gak ada kembalikan ke halaman utama
        if(!$invitation){
            return redirect('komuni-pertama')->with('Pemberitahuan', 'Terjadi Kesalahan, mohon coba lagi');
        }

        // buat token expire
        $invitation->update(['aktif'=> false]);

        // masukkan data

        // buat variabel
        $ktpOrtuPath = null;
        $suratNikahPath = null;
        $suratBaptisPath = null;

        // tidak baptis di gereja ini?
        $sudahBaptis = Baptis::where('umat_id', $umat_id)->first();
        if(!$sudahBaptis){

            if($request->hasFile('fotokopi_ktp_ortu') ){
            $ktpOrtuPath = $request->file('fotokopi_ktp_ortu')->store('umats/fotokopi_ktp_ortu', 'local');
            }
            if($request->hasFile('surat_pernikahan_katolik_ortu')){
                $suratNikahPath = $request->file('surat_pernikahan_katolik_ortu')->store('umats/surat_pernikahan_katolik_ortu', 'local');
            }
            Baptis::create([
                'umat_id' => $umat_id,
                'nama_baptis' => $request->nama_baptis,
                'fotokopi_ktp_ortu' => $ktpOrtuPath,
                'surat_pernikahan_katolik_ortu' => $suratNikahPath,
            ]);
        }

        if($request->hasFile('surat_baptis')){
            $suratBaptisPath = $request->file('surat_baptis')->store('umats/surat_baptis', 'local');
        }
        Komuni::create([
            'umat_id' => $umat_id,
            'tanggal_pembaptisan' => $request_valid['tanggal_pembaptisan'],
            'surat_baptis' => $suratBaptisPath,
        ]);

        // balik ke index
        return redirect()->route('komuni-pertama')->with('success', 'Anda berhasil mendaftar! Tunggu informasi lebih lanjut pada pengumuman');
    }

    /**
     * Display the specified resource.
     */
    public function show(Komuni $komuni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Komuni $komuni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Komuni $komuni)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Komuni $komuni)
    {
        //
    }
}
