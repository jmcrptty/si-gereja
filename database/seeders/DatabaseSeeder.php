<?php

namespace Database\Seeders;

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
    }
}
