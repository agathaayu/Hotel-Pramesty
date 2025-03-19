<?php

// app/Http/Controllers/ExportController.php
namespace App\Http\Controllers;

use App\Models\Kamar; // pastikan model Kamar sudah di-import
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function indexexport()
    {
        
        // Ambil semua data kamar
        $kamar = Kamar::all();

        // Kirimkan data kamar ke view
        return view('indexexport', compact('kamar'));
    }
}





