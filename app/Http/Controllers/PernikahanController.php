<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Umat;
use App\Models\Invitation;
use App\Models\Pernikahan;
use Illuminate\Http\Request;
use App\Models\PengaturanSakramen;
use Illuminate\Support\Facades\Storage;

class PernikahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaturan = PengaturanSakramen::where('jenis_sakramen', 'Pernikahan')->first();

        $now = Carbon::now();
        $pendaftaran_dibuka = false;

        if ($pengaturan) {
            if ($pengaturan->override_status === 'on') {
                $pendaftaran_dibuka = true;
            } elseif ($pengaturan->tanggal_mulai && $pengaturan->tanggal_selesai) {
                $pendaftaran_dibuka = $now->between($pengaturan->tanggal_mulai, $pengaturan->tanggal_selesai);
            }
        }

        return view('layouts.pernikahan.pernikahan', compact('pendaftaran_dibuka'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($token)
    {
        $invitation = Invitation::select('email')->where('token', $token)->where('aktif', true)->first();

        if(!$invitation){
            return redirect('pernikahan')->with('Pemberitahuan', 'Undangan yang anda masukan sudah kadaluarsa. Mohon isi kembali email pada form di bawah');
        }

        return view('layouts.pernikahan.create', [
            'umat' => Umat::select('nama_lengkap', 'alamat','tempat_lahir', 'email', 'akte_file', 'jenis_kelamin', 'ttl', 'lingkungan', 'email')->where('email', $invitation->email)->first(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'email_default_pendaftar' => ['email:rfc,dns', 'max:50',],
            'jenis_kelamin_umat' => ['required', 'in:Pria,Wanita'],
            'email_pria' => ['required', 'email:rfc,dns', 'max:50'],
            'email_wanita' => ['required', 'email:rfc,dns', 'max:50'],
        ],
        [
            'email_wanita.required' => 'Email calon wanita wajib diisi.',
            'email_wanita.email' => 'Email calon wanita tidak valid.',
            'email_wanita.max' => 'Email calon wanita tidak boleh lebih dari 50 karakter.',

            'email_pria.required' => 'Email calon pria wajib diisi.',
            'email_pria.email' => 'Email calon pria tidak valid.',
            'email_pria.max' => 'Email calon pria tidak boleh lebih dari 50 karakter.',
        ]);

        // ambil id umat (id ini bakal dipakai di mana-mana)
        $umat_id = Umat::where('email', $request->email_default_pendaftar)->value('id');

        if (!$umat_id) {
            return back()->withErrors(['email' => 'Email tidak ditemukan di database umat.'])->withInput();
        }

        // cek apakah sudah daftar
       $sudah_daftar = Pernikahan::where('umat_id_pria', $umat_id)
    ->orWhere('umat_id_wanita', $umat_id)
    ->first();
        if($sudah_daftar){
            return redirect('krisma')->with('Pemberitahuan', 'Anda telah terdaftar. Mohon tunggu pengumuman lebih lanjut');
        }

        // cek kebenaran token
        $invitation = Invitation::where('token', $request->token)->where('aktif', true)->first();
        if(!$invitation){
            return redirect('pernikahan')->with('Pemberitahuan', 'Terjadi Kesalahan, mohon coba lagi');
        }

        // periksa apakah masing-masing adalah umat
        $pria_adalah_umat = Umat::where('email', $request->email_pria)->value('id');
        $wanita_adalah_umat = Umat::where('email', $request->email_wanita)->value('id');

        // VALIDASI PRIA STARTS HERE
        if($pria_adalah_umat){
            // PRIA MERUPAKAN UMAT GEREJA
            $request_valid_pria = $request->validate([
                // Calon pria
                'email_pria' => ['required', 'email:rfc,dns', 'max:50'],
                'nama_lengkap_pria' => ['required', 'string', 'max:100'],
                'alamat_pria' => ['required', 'string', 'max:100'],
                'tempat_lahir_pria' => ['required', 'string', 'max:100'],
                'akte_pria' => ['required_without:akte_path_pria', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
                'akte_path_pria' => ['required_without:akte_pria', 'string'],
                'ttl_pria' => ['required', 'date'],
                'lingkungan_pria' => ['required'],
            ],
            [
                // Calon pria
                'email_pria.required' => 'Email calon pria wajib diisi.',
                'email_pria.email' => 'Email calon pria tidak valid.',
                'email_pria.max' => 'Email calon pria tidak boleh lebih dari 50 karakter.',

                'nama_lengkap_pria.required' => 'Nama lengkap calon pria wajib diisi.',
                'nama_lengkap_pria.string' => 'Nama lengkap calon pria harus berupa teks.',
                'nama_lengkap_pria.max' => 'Nama lengkap calon pria tidak boleh lebih dari 100 karakter.',

                'alamat_pria.required' => 'Alamat calon pria wajib diisi.',
                'alamat_pria.string' => 'Alamat calon pria harus berupa teks.',
                'alamat_pria.max' => 'Alamat calon pria tidak boleh lebih dari 100 karakter.',

                'tempat_lahir_pria.required' => 'Tempat lahir calon pria wajib diisi.',
                'tempat_lahir_pria.string' => 'Tempat lahir calon pria harus berupa teks.',
                'tempat_lahir_pria.max' => 'Tempat lahir calon pria tidak boleh lebih dari 100 karakter.',

                'ttl_pria.required' => 'Tanggal lahir calon pria wajib diisi.',
                'ttl_pria.date' => 'Tanggal lahir calon pria harus berupa format tanggal yang valid.',

                'akte_pria.required' => 'Berkas akte kelahiran calon pria wajib diunggah.',
                'akte_pria.file' => 'Berkas akte calon pria harus berupa file.',
                'akte_pria.mimes' => 'Berkas akte calon pria harus berformat PDF, JPG, JPEG, atau PNG.',
                'akte_pria.max' => 'Ukuran berkas akte calon pria tidak boleh lebih dari 25MB.',

                'lingkungan_pria.required' => 'Lingkungan calon pria wajib diisi.',
            ]);

            // pria yang merupakan umat mengupload manual -> sudah pasti lewat akte_pria yang berupa file
            $fileAktepria = null;

            if($request->hasFile('akte_pria')){
                // UPLOAD MANUAL -> LANGSUNG SIMPAN
                $fileAktepria = $request->file('akte_pria')->store('pernikahans/akte', 'local');

                // up path ke db
                $request_valid_pria['akte_file_pria'] = $fileAktepria;
            }
            elseif ($request->filled('akte_path_pria')){
                // UPLOAD OTOMATIS -> COPY FILE -> SIMPAN
                $path_lama_akte_pria = $request->input('akte_path_pria'); // ambil path dari data umat

                if (Storage::disk('local')->exists($path_lama_akte_pria)) {
                    $nama_file = basename($path_lama_akte_pria);
                    $path_baru_akte_pria = 'pernikahans/akte/' . uniqid() . '_' . $nama_file;
                    Storage::disk('local')->copy($path_lama_akte_pria, $path_baru_akte_pria);
                    $fileAktepria = $path_baru_akte_pria;

                    // up path ke db
                    $request_valid_pria['akte_file_pria'] = $fileAktepria;
                }
            }

            $request_valid_pria['umat_id_pria'] = $pria_adalah_umat;
            $request_valid_pria['agama_pria'] = 'Katolik';
        }
        else {
            // PRIA BUKAN UMAT GEREJA
            if ($request->agama_pria == 'Katolik' && !$pria_adalah_umat) { // pastikan beragama katolik dan bukan umat
                $request->merge([
                    'lingkungan_pria' => $request->input('lingkungan_pria_manual') // masukkan field lingkungan manual ke lingkungan_pria
                ]);
            }
            $request_valid_pria = $request->validate([
                // Calon pria
                'email_pria' => ['required', 'email:rfc,dns', 'max:50'],
                'nama_lengkap_pria' => ['required', 'string', 'max:100'],
                'alamat_pria' => ['required', 'string', 'max:100'],
                'tempat_lahir_pria' => ['required', 'string', 'max:100'],
                'ttl_pria' => ['required', 'date'],
                'akte_pria' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
                'agama_pria' => ['required'],
                'lingkungan_pria' => ['required_if:agama_pria,Katolik'],
            ],
            [
                // Calon pria
                'email_pria.required' => 'Email calon pria wajib diisi.',
                'email_pria.email' => 'Email calon pria tidak valid.',
                'email_pria.max' => 'Email calon pria tidak boleh lebih dari 50 karakter.',

                'nama_lengkap_pria.required' => 'Nama lengkap calon pria wajib diisi.',
                'nama_lengkap_pria.string' => 'Nama lengkap calon pria harus berupa teks.',
                'nama_lengkap_pria.max' => 'Nama lengkap calon pria tidak boleh lebih dari 100 karakter.',

                'alamat_pria.required' => 'Alamat calon pria wajib diisi.',
                'alamat_pria.string' => 'Alamat calon pria harus berupa teks.',
                'alamat_pria.max' => 'Alamat calon pria tidak boleh lebih dari 100 karakter.',

                'tempat_lahir_pria.required' => 'Tempat lahir calon pria wajib diisi.',
                'tempat_lahir_pria.string' => 'Tempat lahir calon pria harus berupa teks.',
                'tempat_lahir_pria.max' => 'Tempat lahir calon pria tidak boleh lebih dari 100 karakter.',

                'ttl_pria.required' => 'Tanggal lahir calon pria wajib diisi.',
                'ttl_pria.date' => 'Tanggal lahir calon pria harus berupa format tanggal yang valid.',

                'akte_pria.required' => 'Berkas akte kelahiran calon pria wajib diunggah.',
                'akte_pria.file' => 'Berkas akte calon pria harus berupa file.',
                'akte_pria.mimes' => 'Berkas akte calon pria harus berformat PDF, JPG, JPEG, atau PNG.',
                'akte_pria.max' => 'Ukuran berkas akte calon pria tidak boleh lebih dari 25MB.',

                'agama_pria.required' => 'Agama calon pria wajib dipilih.',
                'lingkungan_pria.required_if' => 'Lingkungan calon pria wajib diisi.',
            ]);

            if($request->input('lingkungan_pria') == null){
                $request_valid_pria['lingkungan_pria'] = null;
            }

            // pria yang bukan umat sudah pasti upload manual
            $fileAktepria = null;
            $fileAktepria = $request->file('akte_pria')->store('pernikahans/akte', 'local');

            $request_valid_pria['umat_id_pria'] = $pria_adalah_umat;
            $request_valid_pria['akte_file_pria'] = $fileAktepria;
        }

        // VALIDASI WANITA STARTS HERE
        if($wanita_adalah_umat){
            // WANITA MERUPAKAN UMAT GEREJA
            $request_valid_wanita = $request->validate([
                // Calon Wanita
                'email_wanita' => ['required', 'email:rfc,dns', 'max:50'],
                'nama_lengkap_wanita' => ['required', 'string', 'max:100'],
                'alamat_wanita' => ['required', 'string', 'max:100'],
                'tempat_lahir_wanita' => ['required', 'string', 'max:100'],
                'ttl_wanita' => ['required', 'date'],
                'akte_wanita' => ['required_without:akte_path_wanita', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
                'akte_path_wanita' => ['required_without:akte_wanita', 'string'],
                'lingkungan_wanita' => ['required'],
            ],
            [
                // Calon Wanita
                'email_wanita.required' => 'Email calon wanita wajib diisi.',
                'email_wanita.email' => 'Email calon wanita tidak valid.',
                'email_wanita.max' => 'Email calon wanita tidak boleh lebih dari 50 karakter.',

                'nama_lengkap_wanita.required' => 'Nama lengkap calon wanita wajib diisi.',
                'nama_lengkap_wanita.string' => 'Nama lengkap calon wanita harus berupa teks.',
                'nama_lengkap_wanita.max' => 'Nama lengkap calon wanita tidak boleh lebih dari 100 karakter.',

                'alamat_wanita.required' => 'Alamat calon wanita wajib diisi.',
                'alamat_wanita.string' => 'Alamat calon wanita harus berupa teks.',
                'alamat_wanita.max' => 'Alamat calon wanita tidak boleh lebih dari 100 karakter.',

                'tempat_lahir_wanita.required' => 'Tempat lahir calon wanita wajib diisi.',
                'tempat_lahir_wanita.string' => 'Tempat lahir calon wanita harus berupa teks.',
                'tempat_lahir_wanita.max' => 'Tempat lahir calon wanita tidak boleh lebih dari 100 karakter.',

                'ttl_wanita.required' => 'Tanggal lahir calon wanita wajib diisi.',
                'ttl_wanita.date' => 'Tanggal lahir calon wanita harus berupa format tanggal yang valid.',

                'akte_wanita.required' => 'Berkas akte kelahiran calon wanita wajib diunggah.',
                'akte_wanita.file' => 'Berkas akte calon wanita harus berupa file.',
                'akte_wanita.mimes' => 'Berkas akte calon wanita harus berformat PDF, JPG, JPEG, atau PNG.',
                'akte_wanita.max' => 'Ukuran berkas akte calon wanita tidak boleh lebih dari 25MB.',

                'lingkungan_wanita.required' => 'Lingkungan calon wanita wajib diisi.',
            ]);

            // wanita yang merupakan umat mengupload manual -> sudah pasti lewat akte_wanita yang berupa file
            $fileAkteWanita = null;

            if($request->hasFile('akte_wanita')){
                // UPLOAD MANUAL -> LANGSUNG SIMPAN
                $fileAkteWanita = $request->file('akte_wanita')->store('pernikahans/akte', 'local');

                // up path ke db
                $request_valid_wanita['akte_file_wanita'] = $fileAkteWanita;
            }
            elseif ($request->filled('akte_path_wanita')){
                // UPLOAD OTOMATIS -> COPY FILE
                $path_lama_akte_wanita = $request->input('akte_path_wanita'); // ambil path dari data umat

                if (Storage::disk('local')->exists($path_lama_akte_wanita)) {
                    $nama_file = basename($path_lama_akte_wanita);
                    $path_baru_akte_wanita = 'pernikahans/akte/' . uniqid() . '_' . $nama_file;
                    Storage::disk('local')->copy($path_lama_akte_wanita, $path_baru_akte_wanita);
                    $fileAkteWanita = $path_baru_akte_wanita;

                    // up path ke db
                    $request_valid_wanita['akte_file_wanita'] = $fileAkteWanita;
                }
            }

            $request_valid_wanita['umat_id_wanita'] = $wanita_adalah_umat;
            $request_valid_wanita['agama_wanita'] = 'Katolik';
        }
        else {
            // WANITA BUKAN UMAT GEREJA
            if ($request->agama_wanita == 'Katolik' && !$wanita_adalah_umat) { // pastikan beragama katolik dan bukan umat
                $request->merge([
                    'lingkungan_wanita' => $request->input('lingkungan_wanita_manual') // masukkan field lingkungan manual ke lingkungan_wanita
                ]);
            }
            $request_valid_wanita = $request->validate([
                // Calon Wanita
                'email_wanita' => ['required', 'email:rfc,dns', 'max:50'],
                'nama_lengkap_wanita' => ['required', 'string', 'max:100'],
                'alamat_wanita' => ['required', 'string', 'max:100'],
                'tempat_lahir_wanita' => ['required', 'string', 'max:100'],
                'ttl_wanita' => ['required', 'date'],
                'akte_wanita' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
                'agama_wanita' => ['required'],
                'lingkungan_wanita' => ['required_if:agama_wanita,Katolik'],
            ],
            [
                // Calon Wanita
                'email_wanita.required' => 'Email calon wanita wajib diisi.',
                'email_wanita.email' => 'Email calon wanita tidak valid.',
                'email_wanita.max' => 'Email calon wanita tidak boleh lebih dari 50 karakter.',

                'nama_lengkap_wanita.required' => 'Nama lengkap calon wanita wajib diisi.',
                'nama_lengkap_wanita.string' => 'Nama lengkap calon wanita harus berupa teks.',
                'nama_lengkap_wanita.max' => 'Nama lengkap calon wanita tidak boleh lebih dari 100 karakter.',

                'alamat_wanita.required' => 'Alamat calon wanita wajib diisi.',
                'alamat_wanita.string' => 'Alamat calon wanita harus berupa teks.',
                'alamat_wanita.max' => 'Alamat calon wanita tidak boleh lebih dari 100 karakter.',

                'tempat_lahir_wanita.required' => 'Tempat lahir calon wanita wajib diisi.',
                'tempat_lahir_wanita.string' => 'Tempat lahir calon wanita harus berupa teks.',
                'tempat_lahir_wanita.max' => 'Tempat lahir calon wanita tidak boleh lebih dari 100 karakter.',

                'ttl_wanita.required' => 'Tanggal lahir calon wanita wajib diisi.',
                'ttl_wanita.date' => 'Tanggal lahir calon wanita harus berupa format tanggal yang valid.',

                'akte_wanita.required' => 'Berkas akte kelahiran calon wanita wajib diunggah.',
                'akte_wanita.file' => 'Berkas akte calon wanita harus berupa file.',
                'akte_wanita.mimes' => 'Berkas akte calon wanita harus berformat PDF, JPG, JPEG, atau PNG.',
                'akte_wanita.max' => 'Ukuran berkas akte calon wanita tidak boleh lebih dari 25MB.',

                'agama_wanita.required' => 'Agama calon wanita wajib dipilih.',
                'lingkungan_wanita.required_if' => 'Lingkungan calon wanita wajib diisi.',
            ]);

            if($request->input('lingkungan_wanita') == null){
                $request_valid_wanita['lingkungan_wanita'] = null;
            }

            $fileAkteWanita = null;
            $fileAkteWanita = $request->file('akte_wanita')->store('pernikahans/akte', 'local');

            $request_valid_wanita['umat_id_wanita'] = $wanita_adalah_umat;
            $request_valid_wanita['akte_file_wanita'] = $fileAkteWanita;

        }

        // this is where the validation ends!

        // buat token expire
        // $invitation->update(['aktif'=> false]);

        // SIMPAN KE DATABASE
        $request_valid = array_merge($request_valid_pria, $request_valid_wanita);

        // dd($request_valid['akte_file_wanita'], $request_valid['akte_file_pria']);
        // dd($request->hasFile('akte_pria'), $request->file('akte_pria'));

        Pernikahan::create([
            'umat_id_pria' => $request_valid['umat_id_pria'],
            'umat_id_wanita' => $request_valid['umat_id_wanita'],

            'email_pria' => $request_valid['email_pria'],
            'nama_lengkap_pria' => $request_valid['nama_lengkap_pria'],
            'alamat_pria' => $request_valid['alamat_pria'],
            'tempat_lahir_pria' => $request_valid['tempat_lahir_pria'],
            'ttl_pria' => $request_valid['ttl_pria'],
            'akte_file_pria' => $request_valid['akte_file_pria'],
            'agama_pria' => $request_valid['agama_pria'],
            'lingkungan_pria' => $request_valid['lingkungan_pria'],

            'email_wanita' => $request_valid['email_wanita'],
            'nama_lengkap_wanita' => $request_valid['nama_lengkap_wanita'],
            'alamat_wanita' => $request_valid['alamat_wanita'],
            'tempat_lahir_wanita' => $request_valid['tempat_lahir_wanita'],
            'ttl_wanita' => $request_valid['ttl_wanita'],
            'akte_file_wanita' => $request_valid['akte_file_wanita'],
            'agama_wanita' => $request_valid['agama_wanita'],
            'lingkungan_wanita' => $request_valid['lingkungan_wanita'],

            'tanggal_daftar' => now()
        ]);

        return redirect()->route('pernikahan')->with('success', 'Anda berhasil mendaftar! Tunggu informasi lebih lanjut di email anda');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pernikahan $pernikahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pernikahan $pernikahan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pernikahan $pernikahan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pernikahan $pernikahan)
    {
        //
    }
}
