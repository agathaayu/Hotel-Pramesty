<?php

namespace App\Http\Controllers;

use App\Models\TipeKamar;
use App\Models\Kamar; // Pastikan model Kamar di-import
use Illuminate\Http\Request;

class TipeKamarController extends Controller
{
    public function index()
    {
        $tipekamars = TipeKamar::latest()->paginate(10);
        return view('tipe-kamar.index', compact('tipekamars'));
    }

    public function create()
    {
        $tipekamars = TipeKamar::all();
        return view('tipe-kamar.create', compact('tipekamars'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_tipe' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'fasilitas' => 'required|string'
        ]);

        TipeKamar::create($validated);
        return redirect()->route('tipe-kamar.index')
            ->with('success', 'Tipe kamar berhasil ditambahkan');
    }

    public function edit($id)
    {
        $tipekamar = TipeKamar::findOrFail($id); // Get the room type by ID
        return view('tipe-kamar.edit', compact('tipekamar')); // Pass it to the view
    }

    public function update(Request $request, TipeKamar $tipeKamar)
    {
        $validated = $request->validate([
            'nama_tipe' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'fasilitas' => 'required|string'
        ]);

        $tipeKamar->update($validated);
        return redirect()->route('tipe-kamar.index')
            ->with('success', 'Tipe kamar berhasil diupdate');
    }

    public function destroy($id)
    {
        try {
            // Cek struktur tabel terlebih dahulu untuk debug
            $kamar = Kamar::where('tipe_kamar', $id)->first();
            if ($kamar) {
                // Jika tipe_kamar tidak boleh null, cari tipe kamar lain sebagai default
                $defaultTipeKamar = TipeKamar::where('id', '!=', $id)->first();
                if ($defaultTipeKamar) {
                    // Update ke tipe kamar default
                    Kamar::where('tipe_kamar', $id)->update(['tipe_kamar' => $defaultTipeKamar->id]);
                } else {
                    // Hapus semua kamar dengan tipe ini jika tidak ada tipe default
                    Kamar::where('tipe_kamar', $id)->delete();
                }
            }
            
            // Hapus tipe kamar
            TipeKamar::findOrFail($id)->delete();
            
            return redirect()->route('tipe-kamar.index')
                ->with('success', 'Tipe kamar berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('tipe-kamar.index')
                ->with('error', 'Error saat menghapus: ' . $e->getMessage());
        }
    }
}
