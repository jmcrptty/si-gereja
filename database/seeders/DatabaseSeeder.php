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
            'lingkungan' => 'st.petrus',
        ]);

        User::create([
            'name' => 'Ketua Lingkungan St.Yohanes',
            'email' => 'st.yohanes@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'ketua lingkungan',
            'lingkungan' => 'st.yohanes',
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
                'ttl' => '1990-01-01',
                'alamat' => 'Jl. Mawar No.1',
                'no_hp' => '081234567890',
                'email' => 'alice@mail.com',
                'lingkungan' => 'st.petrus',
                'kk_file' => null,
                'akte_file' => null,
                'status_pendaftaran' => 'Pending',
            ],
            [
                'nama_lengkap' => 'Budi',
                'nik' => '0987654321',
                'ttl' => '1985-05-15',
                'alamat' => 'Jl. Melati No.2',
                'no_hp' => '089876543210',
                'email' => 'budi@mail.com',
                'lingkungan' => 'st.yohanes',
                'kk_file' => null,
                'akte_file' => null,
                'status_pendaftaran' => 'Pending',
            ],
            [
                'nama_lengkap' => 'Citra',
                'nik' => '1122334455',
                'ttl' => '1995-07-20',
                'alamat' => 'Jl. Anggrek No.3',
                'no_hp' => '082233445566',
                'email' => 'citra@mail.com',
                'lingkungan' => 'st.maria',
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
        ]);
    }
}
