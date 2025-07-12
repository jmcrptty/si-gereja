<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\InformasiMisa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $default = Pengumuman::where('jenis_pengumuman', 'Mingguan')->first();

        $pengumuman = [
            'mingguan' => Pengumuman::where('jenis_pengumuman', 'Mingguan')->get(),
            'laporan_keuangan' => Pengumuman::where('jenis_pengumuman', 'Laporan_Keuangan')->get(),
            'pengumuman_lainnya' => Pengumuman::where('jenis_pengumuman', 'Pengumuman_Lainnya')->get(),
        ];

        return view('layouts.pengumuman', compact('pengumuman', 'default'));
    }

    public function showWelcome()
    {
        $informasiMisa = [
            'Harian' => InformasiMisa::where('jenis_misa', 'Harian')->first(),
            'Jumat_Pertama' => InformasiMisa::where('jenis_misa', 'Jumat_Pertama')->first(),
            'Minggu' => InformasiMisa::where('jenis_misa', 'Minggu')->first(),
        ];

        $pengumuman = [
            'mingguan' => Pengumuman::where('jenis_pengumuman', 'Mingguan')->latest()->get(),
            'laporan_keuangan' => Pengumuman::where('jenis_pengumuman', 'Laporan_Keuangan')->latest()->get(),
            'pengumuman_lainnya' => Pengumuman::where('jenis_pengumuman', 'Pengumuman_Lainnya')->latest()->get(),
        ];

        return view('welcome', compact('pengumuman', 'informasiMisa'));
    }

    public function getByJenis($jenis)
    {
        $pengumuman = Pengumuman::where('jenis_pengumuman', $jenis)->first();

        if ($pengumuman) {
            $pengumuman->image_url = $pengumuman->image ? asset('storage/' . $pengumuman->image) : null;
            return response()->json($pengumuman);
        } else {
            return response()->json(['message' => 'Pengumuman tidak ditemukan'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_pengumuman' => 'required|in:Mingguan,Laporan_Keuangan,Pengumuman_Lainnya',
            'title' => 'required|string|max:255',
            'sub' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $pengumuman = new Pengumuman();
        $pengumuman->jenis_pengumuman = $request->jenis_pengumuman;
        $pengumuman->title = $request->title;
        $pengumuman->sub = $request->sub;
        $pengumuman->content = $request->content;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('pengumuman_images', 'public');
            $pengumuman->image = $path;
        }

        $pengumuman->save();

        return redirect()->route('sekretaris.pengumuman')
            ->with('success', 'Pengumuman berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_pengumuman' => 'required|in:Mingguan,Laporan_Keuangan,Pengumuman_Lainnya',
            'title' => 'required|string|max:255',
            'sub' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->jenis_pengumuman = $request->jenis_pengumuman;
        $pengumuman->title = $request->title;
        $pengumuman->sub = $request->sub;
        $pengumuman->content = $request->content;

        if ($request->hasFile('image')) {
            if ($pengumuman->image) {
                Storage::disk('public')->delete($pengumuman->image);
            }

            $path = $request->file('image')->store('pengumuman_images', 'public');
            $pengumuman->image = $path;
        }

        $pengumuman->save();

        return redirect()->route('sekretaris.pengumuman')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function showByJenis($jenis)
    {
        $type = match ($jenis) {
            'laporan-keuangan' => 'Laporan_Keuangan',
            'pengumuman-lainnya' => 'Pengumuman_Lainnya',
            default => 'Mingguan',
        };

        $pengumuman = [
            str_replace('-', '_', $jenis) => Pengumuman::where('jenis_pengumuman', $type)
                ->latest()
                ->get()
        ];

        return view('layouts.pengumuman.' . ucfirst(str_replace('-', '_', $jenis)), compact('pengumuman'));
    }
}
