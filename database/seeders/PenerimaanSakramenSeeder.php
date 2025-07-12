<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Umat;
use App\Models\Sakramen;
use Illuminate\Support\Facades\DB;

class PenerimaanSakramenSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // 1. Tambahkan data sakramen
            $baptis = Sakramen::firstOrCreate(['nama_sakramen' => 'Baptis']);
            $krisma = Sakramen::firstOrCreate(['nama_sakramen' => 'Krisma']);

            // 2. Tambahkan data umat
            $umat = Umat::create([
                'nama_lengkap' => 'Andreas Kristanto',
                'nik' => '1234567890123456',
                'jenis_kelamin' => 'Pria',
                'nama_ayah' => 'Yohanes Kristanto',
                'nama_ibu' => 'Maria Kristanti',
                'tempat_lahir' => 'Merauke',
                'ttl' => '2000-01-01',
                'alamat' => 'Jl. Gereja No. 123',
                'lingkungan' => 'Santo Petrus',
                'status_pendaftaran' => 'Diterima',
                'no_hp' => '081234567890',
                'email' => 'andreas@example.com',
                'kk_file' => null,
                'akte_file' => null,
            ]);

            // 3. Tambahkan data penerimaan sakramen
            DB::table('penerimaan_sakramen')->insert([
                [
                    'umat_id' => $umat->id,
                    'sakramen_id' => $baptis->id,
                    'tanggal_terima' => '2010-06-15',
                    'tempat_terima' => 'Gereja Katedral',
                    'keterangan' => 'Baptis masa anak',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'umat_id' => $umat->id,
                    'sakramen_id' => $krisma->id,
                    'tanggal_terima' => '2016-08-20',
                    'tempat_terima' => 'Gereja St. Yoseph',
                    'keterangan' => 'Krisma remaja',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        });
    }
}
