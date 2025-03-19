<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            TipeKamarSeeder::class,
            KamarSeeder::class, // Pastikan KamarSeeder dimasukkan setelah TipeKamarSeeder
        ]);
    }
}
