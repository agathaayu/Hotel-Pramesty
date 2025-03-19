<?php
namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\TipeKamar;
use App\Exports\KamarExport;
class HomeController extends Controller
{
    public function index()
    {
        $tipekamars = TipeKamar::with('kamars')->get();
        $kamars = Kamar::with('tipekamar')->get();

        return view('home', compact('tipekamars', 'kamars'));
    }
}