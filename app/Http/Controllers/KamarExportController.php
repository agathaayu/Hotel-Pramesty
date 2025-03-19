<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KamarExport;

class ExportController extends Controller
{
    public function indexexport()
    {
        $kamars = Kamar::all();
        return view('indexexport', compact('kamars'));
    }

    // Method untuk mengekspor data kamar ke Excel
    public function exportKamar()
    {
        return Excel::download(new KamarExport, 'data_kamar.xlsx');
    }
}




