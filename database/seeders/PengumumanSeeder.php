<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengumuman;

class PengumumanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'jenis_pengumuman' => 'Mingguan',
                'title' => 'Misa Syukur Awal Bulan',
                'sub' => 'Semua umat diundang hadir',
                'content' => 'Misa syukur awal bulan akan dilaksanakan pada hari Jumat, 7 Mei pukul 18:00 di Gereja Paroki.',
                'image' => null, // Gambar opsional
            ],
            [
                'jenis_pengumuman' => 'Laporan_Keuangan',
                'title' => 'Pertemuan Lingkungan St. Yohanes',
                'sub' => 'Dihadiri oleh pengurus baru',
                'content' => 'Pertemuan lingkungan akan diadakan pada hari Rabu, 10 Mei pukul 19:30 di rumah Bapak Antonius.',
                'image' => null, // Gambar opsional
            ],
            [
                'jenis_pengumuman' => 'Pengumuman_Lainnya',
                'title' => 'Jadwal Misa Hari Minggu',
                'sub' => null,
                'content' => 'Misa hari Minggu akan diadakan seperti biasa pada pukul 06:00, 08:00, dan 17:00. Mohon hadir tepat waktu.',
                'image' => null, // Gambar opsional
            ],
        ];

        foreach ($data as $item) {
            Pengumuman::create($item);
        }
    }
}
