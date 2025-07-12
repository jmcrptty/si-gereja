<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Umat;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $daftarLingkungan = [
            'Eusebius Damianus',
    'Regina Pacis',
    'Ratu Rosari Bunda Allah (RRBA)',
    'Ratu Rosari Semesta Alam (RRSA)',
    'Santa Agnes',
    'Santa Anna',
    'Santa Bernadetha',
    'Santo Agustinus',
    'Santo Anthonius',
    'Santo Yohanes Don Bosco',
    'Santo Hermanus',
    'Santo Kornelis',
    'Santo Marselino',
    'Santo Paulus',
    'Santo Petrus',
    'Santo Yoseph',
    'St. Fransiskus Xaverius',
    'Stella Maris',
        ];

        // Users dengan role dan lingkungan
        User::create([
            'name' => 'Pastor Paroki',
            'email' => 'pastor@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'pastor paroki',
            'lingkungan' => null,
        ]);

        User::create([
            'name' => 'Ketua Lingkungan St.Petrus',
            'email' => 'st.petrus@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'ketua lingkungan',
            'lingkungan' => $daftarLingkungan[14], // Santo Petrus
        ]);

        User::create([
            'name' => 'Ketua Lingkungan St.Yohanes',
            'email' => 'st.yohanes@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'ketua lingkungan',
            'lingkungan' => $daftarLingkungan[9], // Santo Yohanes
        ]);

        User::create([
            'name' => 'Sekretaris',
            'email' => 'sekretaris@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'sekretaris',
            'lingkungan' => null,
        ]);

        // Data umat contoh
        $umats = [
            [
                'nama_lengkap' => 'Alice',
                'nik' => '1234567890',
                'jenis_kelamin' => 'Wanita',
                'nama_ayah' => 'Agus',
                'nama_ibu' => 'Sari',
                'tempat_lahir' => 'Jakarta',
                'ttl' => '1990-01-01',
                'alamat' => 'Jl. Mawar No.1',
                'no_hp' => '081234567890',
                'email' => 'alice@mail.com',
                'lingkungan' => $daftarLingkungan[1], // Eusebius Damianus
                'kk_file' => null,
                'akte_file' => null,
                'status_pendaftaran' => 'Pending',
            ],
            [
                'nama_lengkap' => 'Budi',
                'nik' => '0987654321',
                'jenis_kelamin' => 'Pria',
                'nama_ayah' => 'Bambang',
                'nama_ibu' => 'Rina',
                'tempat_lahir' => 'Bandung',
                'ttl' => '1985-05-15',
                'alamat' => 'Jl. Melati No.2',
                'no_hp' => '089876543210',
                'email' => 'budi@mail.com',
                'lingkungan' => $daftarLingkungan[2], // Regina Pacis
                'kk_file' => null,
                'akte_file' => null,
                'status_pendaftaran' => 'Pending',
            ],
            [
                'nama_lengkap' => 'Citra',
                'nik' => '1122334455',
                'jenis_kelamin' => 'Wanita',
                'nama_ayah' => 'Cahyo',
                'nama_ibu' => 'Lestari',
                'tempat_lahir' => 'Surabaya',
                'ttl' => '1995-07-20',
                'alamat' => 'Jl. Anggrek No.3',
                'no_hp' => '082233445566',
                'email' => 'citra@mail.com',
                'lingkungan' => $daftarLingkungan[5],
                'kk_file' => null,
                'akte_file' => null,
                'status_pendaftaran' => 'Pending',
            ],
            [
                'nama_lengkap' => 'Doni',
                'nik' => '2233445566',
                'jenis_kelamin' => 'Pria',
                'nama_ayah' => 'Darto',
                'nama_ibu' => 'Nani',
                'tempat_lahir' => 'Semarang',
                'ttl' => '1992-03-10',
                'alamat' => 'Jl. Dahlia No.4',
                'no_hp' => '085566778899',
                'email' => 'doni@mail.com',
                'lingkungan' => $daftarLingkungan[1],
                'kk_file' => null,
                'akte_file' => null,
                'status_pendaftaran' => 'Pending',
            ],
            [
                'nama_lengkap' => 'Eka',
                'nik' => '3344556677',
                'jenis_kelamin' => 'Wanita',
                'nama_ayah' => 'Eko',
                'nama_ibu' => 'Yuni',
                'tempat_lahir' => 'Depok',
                'ttl' => '1993-08-22',
                'alamat' => 'Jl. Teratai No.5',
                'no_hp' => '084455667788',
                'email' => 'eka@mail.com',
                'lingkungan' => $daftarLingkungan[8],
                'kk_file' => null,
                'akte_file' => null,
                'status_pendaftaran' => 'Pending',
            ],
            [
                'nama_lengkap' => 'Farah',
                'nik' => '4455667788',
                'jenis_kelamin' => 'Wanita',
                'nama_ayah' => 'Fahri',
                'nama_ibu' => 'Lina',
                'tempat_lahir' => 'Yogyakarta',
                'ttl' => '1991-11-11',
                'alamat' => 'Jl. Kenanga No.6',
                'no_hp' => '083344556677',
                'email' => 'farah@mail.com',
                'lingkungan' => $daftarLingkungan[14],
                'kk_file' => null,
                'akte_file' => null,
                'status_pendaftaran' => 'Pending',
            ],
            [
                'nama_lengkap' => 'Gilang',
                'nik' => '5566778899',
                'jenis_kelamin' => 'Pria',
                'nama_ayah' => 'Gunawan',
                'nama_ibu' => 'Ratna',
                'tempat_lahir' => 'Tangerang',
                'ttl' => '1989-12-30',
                'alamat' => 'Jl. Flamboyan No.7',
                'no_hp' => '082233445566',
                'email' => 'gilang@mail.com',
                'lingkungan' => $daftarLingkungan[11],
                'kk_file' => null,
                'akte_file' => null,
                'status_pendaftaran' => 'Pending',
            ],
            [
                'nama_lengkap' => 'Hana',
                'nik' => '6677889900',
                'jenis_kelamin' => 'Wanita',
                'nama_ayah' => 'Herman',
                'nama_ibu' => 'Maya',
                'tempat_lahir' => 'Bekasi',
                'ttl' => '1994-09-17',
                'alamat' => 'Jl. Soka No.8',
                'no_hp' => '081122334455',
                'email' => 'hana@mail.com',
                'lingkungan' => $daftarLingkungan[16],
                'kk_file' => null,
                'akte_file' => null,
                'status_pendaftaran' => 'Pending',
            ],
        ];

        foreach ($umats as $umat) {
            Umat::create($umat);
        }

        $this->call([
            // Seeder lain yang ingin dijalankan
            InformasiMisaSeeder::class,
            PengumumanSeeder::class,
            SakramenSeeder::class,
            SertifikatSakramenSeeder::class,
            PenerimaanSakramenSeeder::class,
        ]);
    }
}
