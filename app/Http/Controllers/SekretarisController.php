<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Umat;
use App\Models\Baptis;
use App\Models\Komuni;
use App\Models\Krisma;
use App\Models\Pernikahan;
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
        // Load all sakramens related to this Umat
        $umat->load(['baptis', 'komuni', 'krisma']);

        // Conditionally load pernikahan relationship
        if ($umat->jenis_kelamin == 'Pria') {
            $umat->load(['pernikahanPria']);
        } else {
            $umat->load(['pernikahanWanita']);
        }

        // Format tanggal_terima if the sakramen exists
        $formattedSakramen = [
            'Baptis' => $umat->baptis ? optional($umat->baptis)->tanggal_terima?->format('Y-m-d') : null,
            'Komuni' => $umat->komuni ? optional($umat->komuni)->tanggal_terima?->format('Y-m-d') : null,
            'Krisma' => $umat->krisma ? optional($umat->krisma)->tanggal_terima?->format('Y-m-d') : null,
            'Pernikahan' => null,
        ];

        // Handle pernikahan date
        if ($umat->jenis_kelamin == 'Pria' && $umat->pernikahanPria) {
            $formattedSakramen['Pernikahan'] = optional($umat->pernikahanPria)->tanggal_terima?->format('Y-m-d');
        } elseif ($umat->jenis_kelamin == 'Wanita' && $umat->pernikahanWanita) {
            $formattedSakramen['Pernikahan'] = optional($umat->pernikahanWanita)->tanggal_terima?->format('Y-m-d');
        }

        return view('layouts.sekretaris.umat.show', [
            'umat' => $umat,
            'tanggal_terima' => $formattedSakramen
        ]);
    }


    public function downloadFile($type, $filename)
    {
        $path = "private/umats/{$type}/{$filename}";

        return response()->file(storage_path("app/{$path}"));
    }

    public function downloadFilePernikahan($type, $filename)
    {
        $path = "private/pernikahans/{$type}/{$filename}";

        return response()->file(storage_path("app/{$path}"));
    }

    // SAKRAMEN -> PENDAFTARAN
    public function pendaftaranSakramen(){

        $baptis = Baptis::with(['umat:id,nama_lengkap,email,no_hp'])->where('status_pendaftaran', 'Pending')->get(['id', 'umat_id', 'tanggal_daftar']);

        $komuni = Komuni::with(['umat:id,nama_lengkap,email,no_hp'])->where('status_pendaftaran', 'Pending')->get(['id', 'umat_id', 'tanggal_daftar']);

        $krisma = Krisma::with(['umat:id,nama_lengkap,email,no_hp'])->where('status_pendaftaran', 'Pending')->get(['id', 'umat_id', 'tanggal_daftar']);

        $pernikahan = Pernikahan::with(['umatPria:id,nama_lengkap,email,no_hp', 'umatWanita:id,nama_lengkap,email,no_hp'])->where('status_pendaftaran', 'Pending')->where('status_penerimaan', 'Pending')->get(['id', 'umat_id_pria', 'umat_id_wanita', 'nama_lengkap_pria', 'nama_lengkap_wanita', 'tanggal_daftar', 'tanggal_terima']);

        return view('layouts.pendaftaransakramen', [
            'baptis' => $baptis,
            'komuni' => $komuni,
            'krisma' => $krisma,
            'pernikahan' => $pernikahan,
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
        // tolak kalau tidak ada baptis yang status pendaftarannya belum disetujui
        $baptis = Baptis::where('umat_id', $komuni->umat_id)->first();
        if (!$baptis || $baptis->status_pendaftaran !== 'Diterima') {
            return back()->with('status_error', 'Gagal memverifikasi karena data baptis belum disetujui.');
        }

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
        // tolak kalau tidak ada baptis atau komuni yang status pendaftarannya belum disetujui
        $baptis = Baptis::where('umat_id', $krisma->umat_id)->first();
        $komuni = Komuni::where('umat_id', $krisma->umat_id)->first();

        if ((!$baptis || $baptis->status_pendaftaran !== 'Diterima') && (!$komuni || $komuni->status_penerimaan !== 'Diterima')) {
            return back()->with('status_error', 'Gagal memverifikasi karena data baptis dan komuni belum disetujui.');
        }

        if (!$baptis || $baptis->status_pendaftaran !== 'Diterima') {
            return back()->with('status_error', 'Gagal memverifikasi karena data baptis belum disetujui.');
        }

        if (!$komuni || $komuni->status_pendaftaran !== 'Diterima') {
            return back()->with('status_error', 'Gagal memverifikasi karena data komuni belum disetujui.');
        }

        $krisma->update(['status_pendaftaran' => 'Diterima']);

        return redirect()->route('sekretaris.pendaftaransakramen')->with('status', 'Umat berhasil diverifikasi!');
    }

    public function tolakPendaftaranKrisma(Krisma $krisma)
    {
        $krisma->update(['status_pendaftaran' => 'Ditolak']);

        return redirect()->route('sekretaris.pendaftaransakramen')->with('status', 'Data umat ditolak!');
    }

    // SAKRAMEN -> PENDAFTARAN -> Pernikahan

    public function pernikahan_show(Pernikahan $pernikahan)
    {
        return view('layouts.sekretaris.sakramen.pernikahanShow', [
            'pernikahan' => $pernikahan
        ]);
    }

    public function setujuPendaftaranPernikahan(Pernikahan $pernikahan)
    {
        $pernikahan->update(['status_pendaftaran' => 'Diterima']);

        return redirect()->route('sekretaris.pendaftaransakramen')->with('status', 'Umat berhasil diverifikasi!');
    }

    public function tolakPendaftaranPernikahan(Pernikahan $pernikahan)
    {
        $pernikahan->update(['status_pendaftaran' => 'Ditolak']);

        return redirect()->route('sekretaris.pendaftaransakramen')->with('status', 'Data umat ditolak!');
    }

    // SAKRAMEN -> PENERIMAAN
    public function penerimaanSakramen(){

        $baptis = Baptis::with(['umat:id,nama_lengkap,email,no_hp'])->where('status_pendaftaran', 'Diterima')->where('status_penerimaan', 'Pending')->get(['id', 'umat_id', 'tanggal_daftar']);

        $komuni = Komuni::with(['umat:id,nama_lengkap,email,no_hp'])->where('status_pendaftaran', 'Diterima')->where('status_penerimaan', 'Pending')->get(['id', 'umat_id', 'tanggal_daftar']);

        $krisma = Krisma::with(['umat:id,nama_lengkap,email,no_hp'])->where('status_pendaftaran', 'Diterima')->where('status_penerimaan', 'Pending')->get(['id', 'umat_id', 'tanggal_daftar']);

        $pernikahan = Pernikahan::with(['umatPria:id,nama_lengkap,email,no_hp', 'umatWanita:id,nama_lengkap,email,no_hp'])->where('status_pendaftaran', 'Diterima')->where('status_penerimaan', 'Pending')->get(['id', 'umat_id_pria', 'umat_id_wanita', 'nama_lengkap_pria', 'nama_lengkap_wanita', 'tanggal_daftar',]);

        return view('layouts.penerimaansakramen', [
            'baptis' => $baptis,
            'komuni' => $komuni,
            'krisma' => $krisma,
            'pernikahan' => $pernikahan,
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
        // tolak kalau tidak ada baptis yang status penerimaanya belum disetujui
        $baptis = Baptis::where('umat_id', $komuni->umat_id)->first();
        if (!$baptis || $baptis->status_penerimaan !== 'Diterima') {
            return back()->with('status_error', 'Gagal memverifikasi karena umat belum menerima sakramen baptis.');
        }

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
        // tolak kalau tidak ada baptis atau komuni yang status pendaftarannya belum disetujui
        $baptis = Baptis::where('umat_id', $krisma->umat_id)->first();
        $komuni = Komuni::where('umat_id', $krisma->umat_id)->first();

        if ((!$baptis || $baptis->status_penerimaan !== 'Diterima') && (!$komuni || $komuni->status_penerimaan !== 'Diterima')) {
            return back()->with('status_error', 'Gagal memverifikasi karena umat belum menerima sakramen baptis dan komuni.');
        }

        if (!$baptis || $baptis->status_penerimaan !== 'Diterima') {
            return back()->with('status_error', 'Gagal memverifikasi karena umat belum menerima sakramen baptis.');
        }

        if (!$komuni || $komuni->status_penerimaan !== 'Diterima') {
            return back()->with('status_error', 'Gagal memverifikasi karena umat belum menerima sakramen komuni.');
        }

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

    // SAKRAMEN -> penerimaan -> PERNIKAHAN

    public function setujuPenerimaanPernikahan(Pernikahan $pernikahan)
    {
        $pernikahan->update(['status_penerimaan' => 'Diterima']);

        return redirect()->route('sekretaris.penerimaansakramen')->with('status', 'Umat telah menerima sakramen!');
    }

    public function tolakPenerimaanPernikahan(Pernikahan $pernikahan)
    {
        $pernikahan->update(['status_penerimaan' => 'Ditolak']);

        return redirect()->route('sekretaris.penerimaansakramen')->with('status', 'Data umat ditolak!');
    }
}
