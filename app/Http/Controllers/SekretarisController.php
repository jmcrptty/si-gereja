<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Umat;
use App\Models\Baptis;
use App\Models\Komuni;
use App\Models\Krisma;
use Illuminate\Http\Request;

class SekretarisController extends Controller
{
    public function index(){
        return view('layouts.sekretaris.dashboard');
    }

    // UMAT
    public function umat_index(){
        return view('layouts.sekretaris.umat.index', [
            'umats' => Umat::select('id','nama_lengkap','lingkungan', 'no_hp', 'alamat')->where('status_pendaftaran', 'Diterima')->get()
        ]);
    }

    public function umat_show(Umat $umat)
    {
        $umat->load(['baptis', 'komuni', 'krisma']);

        if($umat->jenis_kelamin == 'Pria'){
            $umat->load(['pernikahanPria']);
        }else{
            $umat->load(['pernikahanWanita']);
        }

        return view('layouts.sekretaris.umat.show', [
            'umat' => $umat
        ]);
    }

    public function downloadFile($type, $filename)
    {
        $path = "private/umats/{$type}/{$filename}";

        return response()->file(storage_path("app/{$path}"));
    }

    // SAKRAMEN -> PENDAFTARAN
    public function pendaftaranSakramen(){

        $baptis = Baptis::with(['umat:id,nama_lengkap,email,no_hp'])->where('status_pendaftaran', 'Pending')->get(['id', 'umat_id', 'tanggal_daftar']);
        // $baptis = Baptis::with(['umat:id,nama_lengkap,email,no_hp'])->get(['id', 'umat_id', 'tanggal_daftar']);

        $baptis = $baptis->map(function ($item) {
            $item->tanggal_daftar = Carbon::parse($item->tanggal_daftar)->format('d M Y');
            return $item;
        });

        $komuni = Komuni::with(['umat:id,nama_lengkap,email,no_hp'])->where('status_pendaftaran', 'Pending')->get(['id', 'umat_id', 'tanggal_daftar']);

        $komuni = $komuni->map(function ($item) {
            $item->tanggal_daftar = Carbon::parse($item->tanggal_daftar)->format('d M Y');
            return $item;
        });

        $krisma = Krisma::with(['umat:id,nama_lengkap,email,no_hp'])->where('status_pendaftaran', 'Pending')->get(['id', 'umat_id', 'tanggal_daftar']);

        $krisma = $krisma->map(function ($item) {
            $item->tanggal_daftar = Carbon::parse($item->tanggal_daftar)->format('d M Y');
            return $item;
        });

        return view('layouts.pendaftaransakramen', [
            'baptis' => $baptis,
            'komuni' => $komuni,
            'krisma' => $krisma
        ]);
    }

    // SAKRAMEN -> PENDAFTARAN -> BAPTIS

    public function baptis_show(umat $umat)
    {
        $umat->load(['baptis']);

        return view('layouts.sekretaris.sakramen.baptisShow', [
            'umat' => $umat
        ]);
    }

    public function setujuPendaftaranBaptis(Baptis $baptis)
    {
        $baptis->update(['status_pendaftaran' => 'Diterima']);

        return redirect()->route('sekretaris.pendaftaransakramen')->with('status', 'Umat berhasil diverifikasi!');
    }

    public function tolakPendaftaranBaptis(Baptis $baptis)
    {
        $baptis->update(['status_pendaftaran' => 'Ditolak']);

        return redirect()->route('sekretaris.pendaftaransakramen')->with('status', 'Data umat ditolak!');
    }

    // SAKRAMEN -> PENDAFTARAN -> KOMUNI

    public function komuni_show(umat $umat)
    {
        $umat->load(['komuni']);

        return view('layouts.sekretaris.sakramen.komuniShow', [
            'umat' => $umat
        ]);
    }

    public function setujuPendaftaranKomuni(Komuni $komuni)
    {
        $komuni->update(['status_pendaftaran' => 'Diterima']);

        return redirect()->route('sekretaris.pendaftaransakramen')->with('status', 'Umat berhasil diverifikasi!');
    }

    public function tolakPendaftaranKomuni(Komuni $komuni)
    {
        $komuni->update(['status_pendaftaran' => 'Ditolak']);

        return redirect()->route('sekretaris.pendaftaransakramen')->with('status', 'Data umat ditolak!');
    }

    // SAKRAMEN -> PENDAFTARAN -> KRISMA

    public function krisma_show(umat $umat)
    {
        $umat->load(['krisma']);

        return view('layouts.sekretaris.sakramen.krismaShow', [
            'umat' => $umat
        ]);
    }

    public function setujuPendaftaranKrisma(Krisma $krisma)
    {
        $krisma->update(['status_pendaftaran' => 'Diterima']);

        return redirect()->route('sekretaris.pendaftaransakramen')->with('status', 'Umat berhasil diverifikasi!');
    }

    public function tolakPendaftaranKrisma(Krisma $krisma)
    {
        $krisma->update(['status_pendaftaran' => 'Ditolak']);

        return redirect()->route('sekretaris.pendaftaransakramen')->with('status', 'Data umat ditolak!');
    }


    // SAKRAMEN -> PENERIMAAN
    public function penerimaanSakramen(){

        $baptis = Baptis::with(['umat:id,nama_lengkap,email,no_hp'])->where('status_pendaftaran', 'Diterima')->where('status_penerimaan', 'Pending')->get(['id', 'umat_id', 'tanggal_terima']);
        // $baptis = Baptis::with(['umat:id,nama_lengkap,email,no_hp'])->get(['id', 'umat_id', 'tanggal_daftar']);

        $baptis = $baptis->map(function ($item) {
            $item->tanggal_daftar = Carbon::parse($item->tanggal_daftar)->format('d M Y');
            return $item;
        });

        $komuni = Komuni::with(['umat:id,nama_lengkap,email,no_hp'])->where('status_pendaftaran', 'Diterima')->where('status_penerimaan', 'Pending')->get(['id', 'umat_id', 'tanggal_terima']);

        $komuni = $komuni->map(function ($item) {
            $item->tanggal_daftar = Carbon::parse($item->tanggal_daftar)->format('d M Y');
            return $item;
        });

        $krisma = Krisma::with(['umat:id,nama_lengkap,email,no_hp'])->where('status_pendaftaran', 'Diterima')->where('status_penerimaan', 'Pending')->get(['id', 'umat_id', 'tanggal_terima']);

        $krisma = $krisma->map(function ($item) {
            $item->tanggal_daftar = Carbon::parse($item->tanggal_daftar)->format('d M Y');
            return $item;
        });

        return view('layouts.penerimaansakramen', [
            'baptis' => $baptis,
            'komuni' => $komuni,
            'krisma' => $krisma,
        ]);
    }

    // SAKRAMEN -> penerimaan -> BAPTIS

    public function baptis_penerimaan_show(umat $umat)
    {
        $umat->load(['baptis']);

        return view('layouts.sekretaris.sakramen.baptisShow', [
            'umat' => $umat
        ]);
    }

    public function setujuPenerimaanBaptis(Baptis $baptis)
    {
        $baptis->update([
            'status_penerimaan' => 'Diterima',
            'tanggal_terima' => now()
        ]);

        return redirect()->route('sekretaris.penerimaansakramen')->with('status', 'Umat telah menerima sakramen!');
    }

    public function tolakPenerimaanBaptis(Baptis $baptis)
    {
        $baptis->update(['status_penerimaan' => 'Ditolak']);

        return redirect()->route('sekretaris.penerimaansakramen')->with('status', 'Data umat ditolak!');
    }

    // SAKRAMEN -> penerimaan -> KOMUNI

    public function komuni_penerimaan_show(umat $umat)
    {
        $umat->load(['komuni']);

        return view('layouts.sekretaris.sakramen.komuniShow', [
            'umat' => $umat
        ]);
    }

    public function setujuPenerimaanKomuni(Komuni $komuni)
    {
        $komuni->update([
            'status_penerimaan' => 'Diterima',
            'tanggal_terima' => now()
        ]);

        return redirect()->route('sekretaris.penerimaansakramen')->with('status', 'Umat telah menerima sakramen!');
    }

    public function tolakPenerimaanKomuni(Komuni $komuni)
    {
        $komuni->update(['status_penerimaan' => 'Ditolak']);

        return redirect()->route('sekretaris.penerimaansakramen')->with('status', 'Data umat ditolak!');
    }

    // SAKRAMEN -> penerimaan -> KRISMA

    public function krisma_penerimaan_show(umat $umat)
    {
        $umat->load(['krisma']);

        return view('layouts.sekretaris.sakramen.krismaShow', [
            'umat' => $umat
        ]);
    }

    public function setujuPenerimaanKrisma(Krisma $krisma)
    {
        $krisma->update([
            'status_penerimaan' => 'Diterima',
            'tanggal_terima' => now()
        ]);

        return redirect()->route('sekretaris.penerimaansakramen')->with('status', 'Umat telah menerima sakramen!');
    }

    public function tolakPenerimaanKrisma(Krisma $krisma)
    {
        $krisma->update(['status_penerimaan' => 'Ditolak']);

        return redirect()->route('sekretaris.penerimaansakramen')->with('status', 'Data umat ditolak!');
    }
}
