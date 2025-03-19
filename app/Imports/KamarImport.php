<?php

namespace App\Imports;

use App\Models\Kamar;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KamarImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (!is_numeric($row['tipe_kamar']) || !is_numeric($row['lantai'])) {
            throw new \Exception("Tipe kamar dan lantai harus berupa angka.");
        }
        return new Kamar([
            'nomor_kamar' => $row['nomor_kamar'], // Sesuai header Excel
            'tipe_kamar' => (int) $row['tipe_kamar'],
            'lantai' => (int) $row['lantai'],
            'status' => $row['status']
        ]);
    }
}
