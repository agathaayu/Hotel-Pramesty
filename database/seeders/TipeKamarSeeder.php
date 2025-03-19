<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipeKamarSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_tipe' => 'Standard Room',
                'harga' => 500000.00,
                'fasilitas' => 'AC, TV, Wi-Fi, Shower',
            ],
            [
                'nama_tipe' => 'Superior Room',
                'harga' => 750000.00,
                'fasilitas' => 'AC, TV, Wi-Fi, Bathtub, Mini Bar',
            ],
            [
                'nama_tipe' => 'Deluxe Room',
                'harga' => 1000000.00,
                'fasilitas' => 'AC, TV, Wi-Fi, Bathtub, Balkon, Sofa',
            ],
            [
                'nama_tipe' => 'Suite Room',
                'harga' => 1500000.00,
                'fasilitas' => 'AC, TV, Wi-Fi, Jacuzzi, Ruang Tamu, Mini Bar',
            ],
        ];

        DB::table('tipe_kamars')->insert($data);
    }
}
