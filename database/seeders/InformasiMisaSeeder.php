<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformasiMisaSeeder extends Seeder
{
    public function run()
    {
        DB::table('informasi_misa')->insert([
            [
                'jenis_misa' => 'Harian',
                'jadwal_misa' => 'Misa Pagi: 08:00 - 09:00, Misa Sore: 17:00 - 18:00',
            ],
            [
                'jenis_misa' => 'Jumat_Pertama',
                'jadwal_misa' => 'Misa Pagi: 08:00 - 09:00, Misa Malam: 19:00 - 20:00',
            ],
            [
                'jenis_misa' => 'Minggu',
                'jadwal_misa' => 'Misa Pagi: 08:00 - 09:00, Misa Siang: 10:00 - 11:00, Misa Sore: 17:00 - 18:00',
            ]
        ]);
    }
}
