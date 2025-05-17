<?php

namespace Database\Seeders;

use App\Models\Lingkungan;
use App\Models\Umat;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Data default pengguna dengan berbagai role
        User::create([
            'name' => 'Pastor Paroki',
            'email' => 'pastor@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'pastor paroki',
        ]);

        User::create([
            'name' => 'Ketua Lingkungan St.petrus',
            'email' => 'st.petrus@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'ketua lingkungan',
        ]);

        User::create([
            'name' => 'Ketua Lingkungan St.antonius',
            'email' => 'st.antonius@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'ketua lingkungan',
        ]);

        User::create([
            'name' => 'Sekretaris',
            'email' => 'sekretaris@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'sekretaris',
        ]);

        Lingkungan::create([
            'nama_lingkungan' => 'Stella Maris',
            'alamat_lingkungan' => 'Jalan Kampung Timur',
        ]);

        Lingkungan::create([
            'nama_lingkungan' => 'St. Antonius dari Padua',
            'alamat_lingkungan' => 'Jalan Ternate',
        ]);

        $umats = [
            [
                'nama_lengkap' => 'Alice',
                'lingkungan_id' => '1',
                'alamat' => 'Jalan A',
                'jenis_kelamin' => 'Wanita',
                'tempat_lahir' => 'Merauke',
                'tanggal_lahir' => '2002-02-14',
                'pendidikan' => 'SMA',
                'jenis_pekerjaan' => 'Pegawai',

                // umur nullable dulu. harus otomatis
                'status_hubungan' => 'Belum Menikah',
                // status baptis, komuni, krisma, dan pernikahan kosong dulu
                'nomor_telpon' => '081111111111'
            ],
            [
                'nama_lengkap' => 'Angga',
                'lingkungan_id' => '1',
                'alamat' => 'Jalan B',
                'jenis_kelamin' => 'Pria',
                'tempat_lahir' => 'Merauke',
                'tanggal_lahir' => '2008-12-10',
                'pendidikan' => 'S1',
                'jenis_pekerjaan' => 'Pelajar',

                // umur nullable dulu. harus otomatis
                'status_hubungan' => 'Belum Menikah',
                // status baptis, komuni, krisma, dan pernikahan kosong dulu
                'nomor_telpon' => '082222222222'
            ],
            [
                'nama_lengkap' => 'Doni',
                'lingkungan_id' => '1',
                'alamat' => 'Jalan C',
                'jenis_kelamin' => 'Pria',
                'tempat_lahir' => 'Merauke',
                'tanggal_lahir' => '1988-10-06',
                'pendidikan' => 'S1',
                'jenis_pekerjaan' => 'Pegawai',

                // umur nullable dulu. harus otomatis
                'status_hubungan' => 'Menikah',
                // status baptis, komuni, krisma, dan pernikahan kosong dulu
                'nomor_telpon' => '083333333333'
            ],
            [
                'nama_lengkap' => 'Indah',
                'lingkungan_id' => '1',
                'alamat' => 'Jalan C',
                'jenis_kelamin' => 'Wanita',
                'tempat_lahir' => 'Merauke',
                'tanggal_lahir' => '1990-01-31',
                'pendidikan' => 'S2',
                'jenis_pekerjaan' => 'Dosen',

                // umur nullable dulu. harus otomatis
                'status_hubungan' => 'Menikah',
                // status baptis, komuni, krisma, dan pernikahan kosong dulu
                'nomor_telpon' => '084444444444'
            ],

            // lingkungan 2
            [
                'nama_lengkap' => 'Ali',
                'lingkungan_id' => '2',
                'alamat' => 'Jalan D',
                'jenis_kelamin' => 'Pria',
                'tempat_lahir' => 'Merauke',
                'tanggal_lahir' => '1999-05-13',
                'pendidikan' => 'S1',
                'jenis_pekerjaan' => 'Wirausaha',

                // umur nullable dulu. harus otomatis
                'status_hubungan' => 'Belum Menikah',
                // status baptis, komuni, krisma, dan pernikahan kosong dulu
                'nomor_telpon' => '085555555555'
            ],
            [
                'nama_lengkap' => 'Butet',
                'lingkungan_id' => '2',
                'alamat' => 'Jalan C',
                'jenis_kelamin' => 'Wanita',
                'tempat_lahir' => 'Medan',
                'tanggal_lahir' => '2000-18-01',
                'pendidikan' => 'S1',
                'jenis_pekerjaan' => 'Pegawai',

                // umur nullable dulu. harus otomatis
                'status_hubungan' => 'Belum Menikah',
                // status baptis, komuni, krisma, dan pernikahan kosong dulu
                'nomor_telpon' => '086666666666'
            ],
            [
                'nama_lengkap' => 'Dinda',
                'lingkungan_id' => '2',
                'alamat' => 'Jalan F',
                'jenis_kelamin' => 'Wanita',
                'tempat_lahir' => 'Manokwari',
                'tanggal_lahir' => '2004-03-026',
                'pendidikan' => 'S1',
                'jenis_pekerjaan' => 'Pelajar',

                // umur nullable dulu. harus otomatis
                'status_hubungan' => 'Belum Menikah',
                // status baptis, komuni, krisma, dan pernikahan kosong dulu
                'nomor_telpon' => '087777777777'
            ],
            [
                'nama_lengkap' => 'Yogi',
                'lingkungan_id' => '2',
                'alamat' => 'Jalan G',
                'jenis_kelamin' => 'Pria',
                'tempat_lahir' => 'Merauke',
                'tanggal_lahir' => '2001-12-23',
                'pendidikan' => 'S2',
                'jenis_pekerjaan' => 'Dosen',

                // umur nullable dulu. harus otomatis
                'status_hubungan' => 'Menikah',
                // status baptis, komuni, krisma, dan pernikahan kosong dulu
                'nomor_telpon' => '084444444444'
            ],
        ];

        foreach ($umats as $umat){
            Umat::create($umat);
        }
    }
}
