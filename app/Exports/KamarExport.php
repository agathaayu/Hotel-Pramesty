<?php

namespace App\Exports;

use App\Models\Kamar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KamarExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kamar::with('tipeKamar')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nomor Kamar',
            'Tipe Kamar',
            'Lantai',
            'Status',
            'Tanggal Dibuat',
            'Terakhir Diupdate'
        ];
    }

    /**
     * @param Kamar $kamar
     * @return array
     */
    public function map($kamar): array
    {
        return [
            $kamar->id,
            $kamar->nomor_kamar,
            $kamar->tipeKamar->nama_tipe,
            $kamar->lantai,
            $kamar->status,
            $kamar->created_at ? $kamar->created_at->format('d/m/Y H:i:s') : '-',
            $kamar->updated_at ? $kamar->updated_at->format('d/m/Y H:i:s') : '-'
        ];
    }
    
    
}