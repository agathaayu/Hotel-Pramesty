<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KamarSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(); // Membuat instance Faker
        
        $data = [];
        
        // Lantai 1 hingga 10, setiap lantai ada 50 kamar
        $lantaiCount = 10; // Jumlah lantai
        $kamarPerLantai = 50; // Jumlah kamar per lantai

        $nomorKamar = 1; // Nomor kamar dimulai dari 1
        
        for ($lantai = 1; $lantai <= $lantaiCount; $lantai++) {
            for ($i = 0; $i < $kamarPerLantai; $i++) {
                $data[] = [
                    'nomor_kamar' => $nomorKamar++, // Nomor kamar berurutan
                    'tipe_kamar' => $faker->numberBetween(1, 4), // ID tipe kamar acak antara 1 dan 4
                    'lantai' => $lantai, // Lantai sesuai perulangan
                    'status' => $faker->randomElement(['tersedia', 'terisi', 'perbaikan']), // Status acak
                    'image' => 'images/kamar' . $nomorKamar . '.jpg', // Nama gambar acak dengan nomor kamar
                ];
            }
        }

        DB::table('kamars')->insert($data); // Insert data ke database
    }
}
