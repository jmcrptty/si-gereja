<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Umat;
use App\Models\Baptis;
use App\Models\Komuni;
use App\Models\Invitation;
use Illuminate\Http\Request;
use App\Models\PengaturanSakramen;

class KomuniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaturan = PengaturanSakramen::where('jenis_sakramen', 'Komuni')->first();

        $now = Carbon::now();
        $pendaftaran_dibuka = false;

        if ($pengaturan) {
            if ($pengaturan->override_status === 'on') {
                $pendaftaran_dibuka = true;
            } elseif ($pengaturan->tanggal_mulai && $pengaturan->tanggal_selesai) {
                $pendaftaran_dibuka = $now->between($pengaturan->tanggal_mulai, $pengaturan->tanggal_selesai);
            }
        }
        return view('layouts.komuni.komuni', compact('pendaftaran_dibuka'));
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

        $sudah_daftar = Komuni::where('umat_id', $umat_id)->first();
        if($sudah_daftar){
            return redirect('komuni-pertama')->with('Pemberitahuan', 'Anda telah terdaftar. Mohon tunggu pengumuman lebih lanjut');
        }

        $data_baptis = Baptis::select('nama_baptis','fotokopi_ktp_ortu', 'surat_pernikahan_katolik_ortu', 'gereja_tempat_baptis', 'tanggal_terima', 'surat_baptis',)->where('status_penerimaan', 'Diterima')->where('umat_id', $umat_id)->first();

        $data_baptis = Baptis::where('status_penerimaan', 'Diterima')->where('umat_id', $umat_id)->first();


        return view('layouts.komuni.create', [
            'umat' => Umat::select('nama_lengkap', 'alamat', 'nama_ayah', 'nama_ibu', 'email')->where('email', $invitation->email)->first(),
            'data_baptis' => $data_baptis
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // buat variabel umat_id dan cek apakah umat sudah terdaftar
        $umat_id = Umat::where('email', $request->email)->value('id');
        if (!$umat_id) {
            return back()->withErrors(['email' => 'Email tidak ditemukan di database umat.'])->withInput();
        }
        $sudah_daftar = Komuni::where('umat_id', $umat_id)->first();
        if($sudah_daftar){
            return redirect('komuni-pertama')->with('Pemberitahuan', 'Anda telah terdaftar. Mohon tunggu pengumuman lebih lanjut');
        }

        // cek kebenaran token
        $invitation = Invitation::where('token', $request->token)->where('aktif', true)->first();
        if(!$invitation){
            return redirect('komuni-pertama')->with('Pemberitahuan', 'Terjadi Kesalahan, mohon coba lagi');
        }

        $baptis = Baptis::where('umat_id', $umat_id)->first();
        $request_valid = $request->validate([
            // Data Sakramen Baptis
            'tanggal_baptis' => ['required', 'date'],
            'surat_baptis' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
            'nama_baptis' => ['required', 'string'],
            'gereja_tempat_baptis' => ['required', 'string'],

            // Berkas Orang Tua
            'fotokopi_ktp_ortu' => [!$baptis?->fotokopi_ktp_ortu ? 'required' : 'nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
            'surat_pernikahan_katolik_ortu' => [!$baptis?->surat_pernikahan_katolik_ortu ? 'required' : 'nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
        ],
        [
            // Data Sakramen Baptis
            'tanggal_baptis.required' => 'Tanggal pembaptisan wajib diisi.',
            'tanggal_baptis.date' => 'Format tanggal pembaptisan tidak valid.',

            'surat_baptis.file' => 'File surat Baptis harus berupa dokumen atau gambar.',
            'surat_baptis.required' => 'Mohon isi file surat Baptis',
            'surat_baptis.mimes' => 'File surat Baptis harus berformat PDF, JPG, JPEG, atau PNG.',
            'surat_baptis.max' => 'Ukuran file surat krisma maksimal 25MB.',

            'nama_baptis.required' => 'Mohon isi nama baptis',
            'gereja_tempat_baptis.required' => 'Mohon isi nama gereja tempat pembaptisan',

            // Berkas Orang Tua
            'fotokopi_ktp_ortu.file' => 'File KTP orang tua harus berupa dokumen atau gambar.',
            'fotokopi_ktp_ortu.mimes' => 'File KTP orang tua harus berformat PDF, JPG, JPEG, atau PNG.',
            'fotokopi_ktp_ortu.max' => 'Ukuran file KTP orang tua maksimal 25MB.',
            'fotokopi_ktp_ortu.required' => 'Mohon Upload KTP Orang Tua.',

            'surat_pernikahan_katolik_ortu.file' => 'File surat pernikahan harus berupa dokumen atau gambar.',
            'surat_pernikahan_katolik_ortu.mimes' => 'File surat pernikahan harus berformat PDF, JPG, JPEG, atau PNG.',
            'surat_pernikahan_katolik_ortu.max' => 'Ukuran file surat pernikahan maksimal 25MB.',
            'surat_pernikahan_katolik_ortu.required' => 'Mohon Upload Surat Pernikahan Orang Tua.',
        ]);
        $request_valid['umat_id'] = $umat_id;

        // buat token expire
        // $invitation->update(['aktif'=> false]);

        // masukkan data
        // buat variabel
        $tanggal_terima_baptis = null;
        $ktpOrtuPath = null;
        $suratNikahPath = null;
        $suratBaptisPath = null;
        if($request->hasFile('surat_baptis')){
            $suratBaptisPath = $request->file('surat_baptis')->store('umats/surat_baptis', 'local');
        }

        $sudahBaptis = Baptis::where('umat_id', $umat_id)->first();

        // SANITASI DATA BAPTIS
        if ($sudahBaptis && (
                $sudahBaptis->status_pendaftaran === 'Pending' ||
                $sudahBaptis->status_penerimaan === 'Pending'
            )) {
            // Hapus record kalau masih ada tapi pending. biar bisa ganti baru
            $sudahBaptis->delete();
            $sudahBaptis = null;
        }

        if(!$sudahBaptis){
            # jika belum baptis buat record baru
            $tanggal_terima_baptis = $request_valid['tanggal_baptis'];
            if($request->hasFile('fotokopi_ktp_ortu') ){
            $ktpOrtuPath = $request->file('fotokopi_ktp_ortu')->store('umats/fotokopi_ktp_ortu', 'local');
            }
            if($request->hasFile('surat_pernikahan_katolik_ortu')){
                $suratNikahPath = $request->file('surat_pernikahan_katolik_ortu')->store('umats/surat_pernikahan_katolik_ortu', 'local');
            }
            Baptis::create([
                'umat_id' => $umat_id,
                'nama_baptis' => $request_valid['nama_baptis'],
                'gereja_tempat_baptis' => $request_valid['gereja_tempat_baptis'],
                'fotokopi_ktp_ortu' => $ktpOrtuPath,
                'surat_pernikahan_katolik_ortu' => $suratNikahPath,
                'tanggal_terima' => $tanggal_terima_baptis,
                'surat_baptis' => $suratBaptisPath,
            ]);
        }
        else{
            # jika sudah baptis update tanggal dan surat baptis
            Baptis::where('umat_id', $umat_id)->update([
                // 'tanggal_baptis' => $request_valid['tanggal_baptis'],
                'surat_baptis' => $suratBaptisPath,
            ]);
        }

        Komuni::create([
            'umat_id' => $umat_id,
            'gereja_tempat_komuni' => 'Gereja Katedral Santo Fransiskus Xaverius Merauke',
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
