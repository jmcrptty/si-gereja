<?php

namespace App\Http\Controllers;

use App\Models\Umat;
use App\Models\Baptis;
use App\Models\Krisma;
use App\Models\Invitation;
use App\Models\Komuni;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class KrismaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.krisma.krisma');
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

        return view('layouts.krisma.create', [
            'umat' => Umat::select('nama_lengkap', 'alamat', 'nama_ayah', 'nama_ibu', 'email')->where('email', $invitation->email)->first(),
            'data_baptis' => Baptis::select('nama_baptis','fotokopi_ktp_ortu', 'surat_pernikahan_katolik_ortu', 'gereja_tempat_baptis', 'tanggal_baptis', 'surat_baptis',)->where('umat_id', $umat_id)->first(),
            'data_komuni' => Komuni::select('gereja_tempat_komuni', 'tanggal_komuni',)->where('umat_id', $umat_id)->first()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // buat variabel umat_id dan cek apakah umat sudah terdaftar
        $umat_id = Umat::where('email', $request->email)->value('id');
        if (!$umat_id) {
            return back()->withErrors(['email' => 'Email tidak ditemukan di database umat.'])->withInput();
        }
        $sudah_daftar = Krisma::where('umat_id', $umat_id)->first();
        if($sudah_daftar){
            return redirect('krisma')->with('Pemberitahuan', 'Anda telah terdaftar. Mohon tunggu pengumuman lebih lanjut');
        }

        // cek kebenaran token
        $invitation = Invitation::where('token', $request->token)->where('aktif', true)->first();
        if(!$invitation){
            return redirect('komuni-pertama')->with('Pemberitahuan', 'Terjadi Kesalahan, mohon coba lagi');
        }

        $baptis = Baptis::where('umat_id', $umat_id)->first();
        $komuni = Komuni::where('umat_id', $umat_id)->first();
        $request_valid = $request->validate([
            // Berkas Orang Tua
            'fotokopi_ktp_ortu' => [!$baptis?->fotokopi_ktp_ortu ? 'required' : 'nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
            'surat_pernikahan_katolik_ortu' => [!$baptis?->surat_pernikahan_katolik_ortu ? 'required' : 'nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],

            // Data Sakramen Baptis
            'tanggal_baptis' => [!$baptis?->tanggal_baptis ? 'required' : 'nullable', 'date'],
            'surat_baptis' => [!$baptis?->surat_baptis ? 'required' : 'nullable', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
            'nama_baptis' => [!$baptis?->nama_baptis ? 'required' : 'nullable', 'string'],
            'gereja_tempat_baptis' => [!$baptis?->gereja_tempat_baptis ? 'required' : 'nullable', 'string'],

            // Data Skaramen Komuni
            'tanggal_komuni' => [!$komuni?->tanggal_komuni ? 'required' : 'nullable', 'date'],
            'surat_komuni' => [!$komuni?->fotokopi_ksurat_komunitp_ortu ? 'required' : 'nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
            'gereja_tempat_komuni' => [!$komuni?->gereja_tempat_komuni ? 'required' : 'nullable', 'string'],

        ],
        [
            // Data Sakramen Baptis
            'nama_baptis.required' => 'Mohon isi nama Baptis',
            'gereja_tempat_baptis.required' => 'Mohon isi nama gereja tempat pembaptisan',

            'tanggal_baptis.required' => 'Tanggal pembaptisan wajib diisi.',
            'tanggal_baptis.date' => 'Format tanggal pembaptisan tidak valid.',

            'surat_baptis.file' => 'File surat baptis harus berupa dokumen atau gambar.',
            'surat_baptis.required' => 'Mohon isi file surat baptis',
            'surat_baptis.mimes' => 'File surat baptis harus berformat PDF, JPG, JPEG, atau PNG.',
            'surat_baptis.max' => 'Ukuran file surat baptis maksimal 25MB.',

            // Data Sakramen Komuni
            'gereja_tempat_komuni.required' => 'Mohon isi nama gereja tempat menerima komuni pertama',

            'surat_komuni.required' => 'Tanggal komuni pertama wajib diisi.',
            'surat_komuni.date' => 'Format tanggal komuni pertama tidak valid.',

            'surat_komuni.file' => 'File surat komuni pertama harus berupa dokumen atau gambar.',
            'surat_komuni.required' => 'Mohon isi file surat komuni',
            'surat_komuni.mimes' => 'File surat komuni harus berformat PDF, JPG, JPEG, atau PNG.',
            'surat_komuni.max' => 'Ukuran file surat komuni maksimal 25MB.',

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
        // dd($request);
        $request_valid['umat_id'] = $umat_id;

        // buat token expire
        $invitation->update(['aktif'=> false]);

        // masukkan data
        // buat variabel
        $ktpOrtuPath = null;
        $suratNikahPath = null;
        $suratBaptisPath = null;
        if($request->hasFile('surat_baptis')){
            $suratBaptisPath = $request->file('surat_baptis')->store('umats/surat_baptis', 'local');
        }
        if($request->hasFile('surat_komuni')){
            $surat_komuni = $request->file('surat_komuni')->store('umats/surat_komuni', 'local');
        }

        $sudahBaptis = Baptis::where('umat_id', $umat_id)->first();
        if(!$sudahBaptis){
            # jika baptis di katedral, buat record baru
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
                'tanggal_baptis' => $request_valid['tanggal_baptis'],
                'surat_baptis' => $suratBaptisPath,
            ]);
        }
        else{
            # jika baptis di katedral update tanggal dan surat baptis
            Baptis::where('umat_id', $umat_id)->update([
                'tanggal_baptis' => $request_valid['tanggal_baptis'],
                'surat_baptis' => $suratBaptisPath,
            ]);
        }

        $sudahKomuni = Komuni::where('umat_id', $umat_id)->first();
        if(!$sudahKomuni){
            # jika tidak komuni pertama di katedral, buat record baru
            Komuni::create([
                'umat_id' => $umat_id,
                'gereja_tempat_komuni' => $request_valid['gereja_tempat_komuni'],
                'tanggal_komuni' => $request_valid['tanggal_komuni'],
                'surat_komuni' => $surat_komuni,
            ]);
        }
        else{
            # jika komuni di katedral update tanggal dan surat komuni
            Komuni::where('umat_id', $umat_id)->update([
                'tanggal_komuni' => $request_valid['tanggal_komuni'],
                'surat_komuni' => $surat_komuni,
            ]);
        }

        Krisma::create([
            'umat_id' => $umat_id,
            'gereja_tempat_krisma' => 'Gereja Katedral Santo Fransiskus Xaverius Merauke',
        ]);

        // balik ke index
        return redirect()->route('krisma')->with('success', 'Anda berhasil mendaftar! Tunggu informasi lebih lanjut pada pengumuman');
    }

    /**
     * Display the specified resource.
     */
    public function show(Krisma $krisma)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Krisma $krisma)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Krisma $krisma)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Krisma $krisma)
    {
        //
    }
}
