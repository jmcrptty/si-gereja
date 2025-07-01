<?php

namespace App\Http\Controllers;

use App\Models\Umat;
use App\Models\Lingkungan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UmatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $userLingkungan = Auth::user()->lingkungan;

    $umats = Umat::where('status_pendaftaran', 'Pending')
        ->where('lingkungan', $userLingkungan)
        ->get();

    $umatsDiterima = Umat::where('status_pendaftaran', 'Diterima')
        ->where('lingkungan', $userLingkungan)
        ->get();

    $umatsDitolak = Umat::where('status_pendaftaran', 'Ditolak')
        ->where('lingkungan', $userLingkungan)
        ->get();

    return view('layouts.ketualingkungan.umat.index', compact('umats', 'umatsDiterima', 'umatsDitolak'));
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
        // Biodata
        'nama_lengkap' => ['required', 'string', 'max:100'],
        'nik' => ['required', 'string', 'max:20', 'unique:umat,nik'],
        'jenis_kelamin' => ['required', 'in:Pria,Wanita'],
        'nama_ayah' => ['required', 'string'],
        'nama_ibu' => ['required', 'string'],
        'tempat_lahir' => ['required', 'string'],
        'ttl' => ['required', 'date'],
        'alamat' => ['required', 'string'],

        // Kontak
        'no_hp' => ['required', 'string', 'max:15', 'unique:umat,no_hp'],
        'email' => ['required', 'email:rfc,dns', 'max:50', 'unique:umat,email'],

        // Berkas
        'kk_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
        'akte_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
    ], [
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

    // Tambahkan lingkungan berdasarkan user login (ketua lingkungan)
    $request_valid['lingkungan'] = Auth::user()->lingkungan;

    // Upload file jika ada
    if ($request->hasFile('kk_file')) {
        $kkPath = $request->file('kk_file')->store('umats/kk', 'local');
        $request_valid['kk_file'] = $kkPath;
    }

    if ($request->hasFile('akte_file')) {
        $aktePath = $request->file('akte_file')->store('umats/akte', 'local');
        $request_valid['akte_file'] = $aktePath;
    }

    // Simpan data
    Umat::create($request_valid);

    return redirect()->route('ketualingkungan.umat.index')->with('success', 'Data Umat berhasil ditambahkan!');
}


    /**
     * Display the specified resource.
     */
    public function show(Umat $umat)
{
    $user = Auth::user();

    // Batasi akses jika role ketua lingkungan dan lingkungan tidak cocok
    if ($user->role === 'ketua lingkungan' && $user->lingkungan !== $umat->lingkungan) {
        abort(403, 'Anda tidak memiliki akses ke data umat ini.');
    }

    $umat->load(['baptis', 'komuni', 'krisma']);

    if ($umat->jenis_kelamin == 'Pria') {
        $umat->load(['pernikahanPria']);
    } else {
        $umat->load(['pernikahanWanita']);
    }

    $formattedSakramen = [
        'Baptis' => $umat->baptis ? optional($umat->baptis)->tanggal_terima?->format('Y-m-d') : null,
        'Komuni' => $umat->komuni ? optional($umat->komuni)->tanggal_terima?->format('Y-m-d') : null,
        'Krisma' => $umat->krisma ? optional($umat->krisma)->tanggal_terima?->format('Y-m-d') : null,
        'Pernikahan' => null,
    ];

    if ($umat->jenis_kelamin == 'Pria' && $umat->pernikahanPria) {
        $formattedSakramen['Pernikahan'] = optional($umat->pernikahanPria)->tanggal_terima?->format('Y-m-d');
    } elseif ($umat->jenis_kelamin == 'Wanita' && $umat->pernikahanWanita) {
        $formattedSakramen['Pernikahan'] = optional($umat->pernikahanWanita)->tanggal_terima?->format('Y-m-d');
    }

    return view('layouts.ketualingkungan.umat.show', [
        'umat' => $umat,
        'tanggal_terima' => $formattedSakramen
    ]);
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Umat $umat)
    {
         if (Auth::user()->role === 'ketua lingkungan' && Auth::user()->lingkungan !== $umat->lingkungan) {
        abort(403, 'Anda tidak bisa mengedit umat dari lingkungan lain.');
    }
        return view('layouts.ketualingkungan.umat.edit',[
            'umat' => $umat,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Umat $umat)
    {
        if (Auth::user()->role === 'ketua lingkungan' && Auth::user()->lingkungan !== $umat->lingkungan) {
        abort(403, 'Anda tidak bisa memperbarui umat dari lingkungan lain.');
    }
        $request_valid = $request->validate([
            // Biodata
            'nama_lengkap' => ['required', 'string', 'max:100'],
            'nik' => ['required', 'string', 'max:20', Rule::unique('umat', 'nik')->ignore($umat->id)],
            'jenis_kelamin' => ['required', 'in:Pria,Wanita'],
            'nama_ayah' => ['required', 'string'],
            'nama_ibu' => ['required', 'string'],
            'tempat_lahir' => ['required', 'string'],
            'ttl' => ['required', 'date'],
            'alamat' => ['required', 'string'],
            'lingkungan' => ['required'],

            // Kontak
            'no_hp' => ['required', 'string', 'max:15', Rule::unique('umat', 'no_hp')->ignore($umat->id)],
            'email' => ['required', 'email:rfc,dns', 'max:50', Rule::unique('umat', 'email')->ignore($umat->id)],

            // Berkas
            'kk_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
            'akte_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
        ], [
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

        // masukkan data
        Umat::where('id', $umat->id)->update($request_valid);
        // balik ke index
        return redirect()->route('ketualingkungan.umat.index')->with('success', 'Data umat berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Umat $umat)
    {
         if (Auth::user()->role === 'ketua lingkungan' && Auth::user()->lingkungan !== $umat->lingkungan) {
        abort(403, 'Anda tidak bisa menghapus umat dari lingkungan lain.');
    }
        Umat::destroy($umat->id);
        return redirect()->back()->with('delete_success', 'Data Berhasil Dihapus');
    }


    // tambahan

    public function persetujuan()
{
    $user = Auth::user();

    // Jika ketua lingkungan, hanya ambil umat dari lingkungannya
    if ($user->role === 'ketua lingkungan') {
        $umats = Umat::where('status_pendaftaran', 'Pending')
                    ->where('lingkungan', $user->lingkungan)
                    ->get();

        $umats_tolak = Umat::where('status_pendaftaran', 'Ditolak')
                    ->where('lingkungan', $user->lingkungan)
                    ->get();

        $jumlahPending = Umat::where('status_pendaftaran', 'Pending')
                    ->where('lingkungan', $user->lingkungan)
                    ->count();
    } else {
        // Untuk role lain (misalnya sekretaris atau pastor), tampilkan semua
        $umats = Umat::where('status_pendaftaran', 'Pending')->get();
        $umats_tolak = Umat::where('status_pendaftaran', 'Ditolak')->get();
        $jumlahPending = Umat::where('status_pendaftaran', 'Pending')->count();
    }

    return view('layouts.ketualingkungan.umat.persetujuan.persetujuan', [
        'umats' => $umats,
        'umats_tolak' => $umats_tolak,
        'jumlahPending' => $jumlahPending
    ]);
}


   public function setuju(Umat $umat)
{
    if (Auth::user()->role === 'ketua lingkungan' && Auth::user()->lingkungan !== $umat->lingkungan) {
        abort(403, 'Anda tidak berhak menyetujui umat ini.');
    }

    $umat->update(['status_pendaftaran' => 'Diterima']);

    return redirect()->route('ketualingkungan.umat.persetujuan')->with('status', 'Umat berhasil diverifikasi!');
}

public function tolak(Umat $umat)
{
    if (Auth::user()->role === 'ketua lingkungan' && Auth::user()->lingkungan !== $umat->lingkungan) {
        abort(403, 'Anda tidak berhak menolak umat ini.');
    }

    $umat->update(['status_pendaftaran' => 'Ditolak']);

    return redirect()->route('ketualingkungan.umat.persetujuan')->with('status', 'Data umat ditolak!');
}


    public function downloadFile($type, $filename)
    {
        $path = "private/umats/{$type}/{$filename}";

        // if (!Storage::disk('local')->exists("app/{$path}")) {
        //     abort(404, 'File not found');
        // }
        // mungkin sebaiknya perlu error handling yang lebih bagus, tapi untuk sekarang nonaktifkan linknya aja

        return response()->file(storage_path("app/{$path}"));
    }

    public function downloadFilePernikahan($type, $filename)
    {
        $path = "private/pernikahans/{$type}/{$filename}";

        return response()->file(storage_path("app/{$path}"));
    }

}
