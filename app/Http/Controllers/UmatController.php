<?php

namespace App\Http\Controllers;

use App\Models\Lingkungan;
use App\Models\Umat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UmatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Umat::all());
        // $test = Umat::select('nama_lengkap','lingkungan_id', 'alamat')->get();
        // dd($test);
        return view('layouts.ketualingkungan.umat.index', [
            'umats' => Umat::select('id','nama_lengkap','lingkungan', 'no_hp', 'alamat')->where('status_pendaftaran', 'Diterima')->get()
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
            'nik' => ['required', 'string', 'max:16', 'unique:umat,nik'],
            'ttl' => ['required', 'date'],
            'alamat' => ['required', 'string'],
            'no_hp' => ['required', 'string', 'max:12', 'unique:umat,no_hp'],
            'email' => ['required', 'email:rfc,dns', 'unique:umat,email'],
            'lingkungan' => ['required', 'string'],

            // rencana
            'kk_file' => ['file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'], // ~25MB
            'akte_file' => ['file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
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
            'kk_file.max' => 'Ukuran file KK maksimal 25MB.',
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

        // masukkan data
        Umat::create($request_valid);
        // balik ke index
        return redirect()->route('ketualingkungan.umat.index')->with('success', 'Data Umat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Umat $umat)
    {
        // dd($umat);
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
        $request_valid = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:16', 'unique:umat,nik' . $umat->id], // harus unik, kecuali untuk umat dengan id berikut....
            'ttl' => ['required', 'date'],
            'alamat' => ['required', 'string'],
            'no_hp' => ['required', 'string', 'max:12', 'unique:umat,no_hp' . $umat->id],
            'email' => ['required', 'email:rfc,dns', 'unique:umat,email'. $umat->id],
            'lingkungan' => ['required', 'string'],

            // rencana
            'kk_file' => ['file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'], // ~25MB
            'akte_file' => ['file', 'mimes:pdf,jpg,jpeg,png', 'max:25000'],
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
            'kk_file.max' => 'Ukuran file KK maksimal 25MB.',
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
        Umat::destroy($umat->id);
        return redirect()->back()->with('delete_success', 'Data Berhasil Dihapus');
    }


    // tambahan

    public function persetujuan(){
        return view('layouts.ketualingkungan.umat.persetujuan.persetujuan', [
            'umats' => Umat::select('id','nama_lengkap','lingkungan', 'no_hp', 'alamat')->where('status_pendaftaran', 'Pending')->get(),
            'umats_tolak' => Umat::select('id','nama_lengkap','lingkungan', 'no_hp', 'alamat')->where('status_pendaftaran', 'Ditolak')->get(),
            'jumlahPending' => Umat::where('status_pendaftaran', 'Pending')->count()
        ]);
    }

    public function setuju(Umat $umat)
    {
        $umat->update(['status_pendaftaran' => 'Diterima']);

        return redirect()->route('ketualingkungan.umat.persetujuan')->with('status', 'Umat berhasil diverifikasi!');
    }

    public function tolak(Umat $umat)
    {
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

}
