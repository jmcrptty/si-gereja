<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SertifikatSakramen;
use App\Models\Umat;
use App\Models\Sakramen;

class SertifikatSakramenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data umat dan sakramen dari database
        $umatAlice = Umat::where('nama_lengkap', 'Alice')->first();
        $umatBudi = Umat::where('nama_lengkap', 'Budi')->first();
        $umatCitra = Umat::where('nama_lengkap', 'Citra')->first();

        $sakramenBaptis = Sakramen::where('nama_sakramen', 'Baptis')->first();
        $sakramenKomuni = Sakramen::where('nama_sakramen', 'Komuni')->first();
        $sakramenKrisma = Sakramen::where('nama_sakramen', 'Krisma')->first();

        // Data sertifikat contoh
        $sertifikats = [
            [
                'umat_id' => $umatAlice ? $umatAlice->id : null,
                'sakramen_id' => $sakramenBaptis ? $sakramenBaptis->id : null,
                'tanggal_penerimaan' => '2005-01-01',
                'file_sertifikat' => 'sertifikat/baptis_alice.jpg',
                'keterangan' => 'Sertifikat Baptis Alice',
            ],
            [
                'umat_id' => $umatAlice ? $umatAlice->id : null,
                'sakramen_id' => $sakramenKomuni ? $sakramenKomuni->id : null,
                'tanggal_penerimaan' => '2010-05-10',
                'file_sertifikat' => 'sertifikat/komuni_alice.jpg',
                'keterangan' => 'Sertifikat Komuni Alice',
            ],
            [
                'umat_id' => $umatBudi ? $umatBudi->id : null,
                'sakramen_id' => $sakramenBaptis ? $sakramenBaptis->id : null,
                'tanggal_penerimaan' => '1990-03-15',
                'file_sertifikat' => 'sertifikat/baptis_budi.jpg',
                'keterangan' => null,
            ],
            [
                'umat_id' => $umatCitra ? $umatCitra->id : null,
                'sakramen_id' => $sakramenKrisma ? $sakramenKrisma->id : null,
                'tanggal_penerimaan' => '2015-09-20',
                'file_sertifikat' => 'sertifikat/krisma_citra.jpg',
                'keterangan' => 'Sertifikat Krisma Citra',
            ],
        ];

        foreach ($sertifikats as $sertifikat) {
            // Pastikan umat_id dan sakramen_id tidak null sebelum insert
            if ($sertifikat['umat_id'] && $sertifikat['sakramen_id']) {
                SertifikatSakramen::create($sertifikat);
            }
        }
    }
}
