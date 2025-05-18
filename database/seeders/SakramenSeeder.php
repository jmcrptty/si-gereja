<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sakramen;

class SakramenSeeder extends Seeder
{
    public function run()
    {
        $sakramens = [
            ['nama_sakramen' => 'Baptis'],
            ['nama_sakramen' => 'Komuni'],
            ['nama_sakramen' => 'Krisma'],
            ['nama_sakramen' => 'Pernikahan'],
        ];

        foreach ($sakramens as $sakramen) {
            Sakramen::create($sakramen);
        }
    }
}
