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
        [
            'nama_lengkap' => 'Doni',
            'nik' => '2233445566',
            'ttl' => '1992-03-10',
            'alamat' => 'Jl. Dahlia No.4',
            'no_hp' => '085566778899',
            'email' => 'doni@mail.com',
            'lingkungan' => 'st.petrus',
            'kk_file' => null,
            'akte_file' => null,
            'status_pendaftaran' => 'Pending',
        ],
        [
            'nama_lengkap' => 'Eka',
            'nik' => '3344556677',
            'ttl' => '1993-08-22',
            'alamat' => 'Jl. Teratai No.5',
            'no_hp' => '084455667788',
            'email' => 'eka@mail.com',
            'lingkungan' => 'st.yohanes',
            'kk_file' => null,
            'akte_file' => null,
            'status_pendaftaran' => 'Pending',
        ],
        [
            'nama_lengkap' => 'Farah',
            'nik' => '4455667788',
            'ttl' => '1991-11-11',
            'alamat' => 'Jl. Kenanga No.6',
            'no_hp' => '083344556677',
            'email' => 'farah@mail.com',
            'lingkungan' => 'st.maria',
            'kk_file' => null,
            'akte_file' => null,
            'status_pendaftaran' => 'Pending',
        ],
        [
            'nama_lengkap' => 'Gilang',
            'nik' => '5566778899',
            'ttl' => '1989-12-30',
            'alamat' => 'Jl. Flamboyan No.7',
            'no_hp' => '082233445566',
            'email' => 'gilang@mail.com',
            'lingkungan' => 'st.petrus',
            'kk_file' => null,
            'akte_file' => null,
            'status_pendaftaran' => 'Pending',
        ],
        [
            'nama_lengkap' => 'Hana',
            'nik' => '6677889900',
            'ttl' => '1994-09-17',
            'alamat' => 'Jl. Soka No.8',
            'no_hp' => '081122334455',
            'email' => 'hana@mail.com',
            'lingkungan' => 'st.yohanes',
            'kk_file' => null,
            'akte_file' => null,
            'status_pendaftaran' => 'Pending',
        ],
        [
            'nama_lengkap' => 'Iwan',
            'nik' => '7788990011',
            'ttl' => '1987-06-06',
            'alamat' => 'Jl. Bougenville No.9',
            'no_hp' => '089911223344',
            'email' => 'iwan@mail.com',
            'lingkungan' => 'st.maria',
            'kk_file' => null,
            'akte_file' => null,
            'status_pendaftaran' => 'Pending',
        ],
        [
            'nama_lengkap' => 'Joko',
            'nik' => '8899001122',
            'ttl' => '1986-04-18',
            'alamat' => 'Jl. Cempaka No.10',
            'no_hp' => '088899001122',
            'email' => 'joko@mail.com',
            'lingkungan' => 'st.petrus',
            'kk_file' => null,
            'akte_file' => null,
            'status_pendaftaran' => 'Pending',
        ],
        [
            'nama_lengkap' => 'Kiki',
            'nik' => '9900112233',
            'ttl' => '1996-10-25',
            'alamat' => 'Jl. Kamboja No.11',
            'no_hp' => '087788990011',
            'email' => 'kiki@mail.com',
            'lingkungan' => 'st.yohanes',
            'kk_file' => null,
            'akte_file' => null,
            'status_pendaftaran' => 'Pending',
        ],
        [
            'nama_lengkap' => 'Lina',
            'nik' => '1011121314',
            'ttl' => '1997-01-02',
            'alamat' => 'Jl. Alamanda No.12',
            'no_hp' => '086677889900',
            'email' => 'lina@mail.com',
            'lingkungan' => 'st.maria',
            'kk_file' => null,
            'akte_file' => null,
            'status_pendaftaran' => 'Pending',
        ],
        [
            'nama_lengkap' => 'Mario',
            'nik' => '1213141516',
            'ttl' => '1988-02-20',
            'alamat' => 'Jl. Anyelir No.13',
            'no_hp' => '085566778899',
            'email' => 'mario@mail.com',
            'lingkungan' => 'st.petrus',
            'kk_file' => null,
            'akte_file' => null,
            'status_pendaftaran' => 'Pending',
        ],
        [
            'nama_lengkap' => 'Nina',
            'nik' => '1314151617',
            'ttl' => '1992-12-01',
            'alamat' => 'Jl. Tapak No.14',
            'no_hp' => '084455667788',
            'email' => 'nina@mail.com',
            'lingkungan' => 'st.yohanes',
            'kk_file' => null,
            'akte_file' => null,
            'status_pendaftaran' => 'Pending',
        ],
        [
            'nama_lengkap' => 'Oscar',
            'nik' => '1415161718',
            'ttl' => '1993-03-03',
            'alamat' => 'Jl. Pinang No.15',
            'no_hp' => '083344556677',
            'email' => 'oscar@mail.com',
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
