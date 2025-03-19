<?php

namespace App\Http\Controllers;
use App\Models\Kamar;
use App\Models\TipeKamar;
use App\Models\KamarHistory;
use App\Exports\KamarExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Exports\KamarPDFExport;
use Barryvdh\DomPDF\Facade\Pdf;

class KamarController extends Controller
{
   
    public function index()
    {
        if (session()->has('updatedKamars')) {
            $kamars = session('updatedKamars');
            $tersedia = session('tersedia');
            $terisi = session('terisi');
            $perbaikan = session('perbaikan');
        } else {
            // Otherwise query as normal
            $tersedia = Kamar::where('status', 'tersedia')->count();
            $terisi = Kamar::where('status', 'terisi')->count();
            $perbaikan = Kamar::where('status', 'perbaikan')->count();
            $kamars = Kamar::with('tipeKamar')->latest()->paginate(5);
        }
        $tersedia = Kamar::where('status', 'tersedia')->count();
        $terisi = Kamar::where('status', 'terisi')->count();
        $perbaikan = Kamar::where('status', 'perbaikan')->count();

        $kamars = Kamar::with('tipeKamar')->latest()->paginate(10);
        return view('kamar.index', compact('kamars', 'tersedia', 'terisi', 'perbaikan'));
    }

    public function create()
    {
        $tipekamars = TipeKamar::all();
        return view('kamar.create', compact('tipekamars'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_kamar' => 'required|string|max:255|unique:kamars',
            'tipe_kamar' => 'required|exists:tipe_kamars,id',
            'lantai' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,terisi,perbaikan',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'nomor_kamar' => $validated['nomor_kamar'],
            'tipe_kamar' => $validated['tipe_kamar'],
            'lantai' => $validated['lantai'],
            'status' => $validated['status']
        ];

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('kamars', $imageName, 'public');
            $data['image'] = $path;
        }

        Kamar::create($data);

        return redirect()->route('kamar')->with('success', 'Kamar berhasil ditambahkan');
    }

    public function show(Kamar $kamar)
    {
        $kamar->load(['tipeKamar', 'histories' => function ($query) {
            $query->with('user')->latest()->take(5);
        }]);

        return view('kamar.show', compact('kamar'));
    }

    public function edit(Kamar $kamar)
    {
        $tipeKamars = TipeKamar::all();
        return view('kamar.edit', compact('kamar', 'tipeKamars'));
    }

    public function update(Request $request, Kamar $kamar)
    {
        $validated = $request->validate([
            'nomor_kamar' => 'required|string|max:255|unique:kamars,nomor_kamar,' . $kamar->id,
            'tipe_kamar' => 'required|exists:tipe_kamars,id',
            'lantai' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,terisi,perbaikan',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'nomor_kamar' => $validated['nomor_kamar'],
            'tipe_kamar' => $validated['tipe_kamar'],
            'lantai' => $validated['lantai'],
            'status' => $validated['status']
        ];

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($kamar->image) {
                Storage::disk('public')->delete($kamar->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('kamars', $imageName, 'public');
            $data['image'] = $path;
        }

        $kamar->update($data);

        return redirect()->route('kamar')->with('success', 'Kamar berhasil diupdate');
    }

    public function destroy(Kamar $kamar)
    {
        if ($kamar->image) {
            Storage::disk('public')->delete($kamar->image);
        }

        $kamar->delete();
        return redirect()->route('kamar')->with('success', 'Kamar berhasil dihapus');
    }

    public function getAvailableRooms()
    {
        $availableRooms = Kamar::where('status', 'tersedia')
            ->with('tipekamar')
            ->get();
        return view('kamar.available', compact('availableRooms'));
    }

    public function history(Kamar $kamar)
    {
        $histories = $kamar->histories()->with('user')->latest()->paginate(15);
        return view('kamar.history', compact('kamar', 'histories'));
    }

    public function updateStatus(Request $request, Kamar $kamar)
    {
        $validated = $request->validate([
            'status' => 'required|in:tersedia,terisi,perbaikan',
            'keterangan' => 'nullable|string|max:500',
        ]);

        $statusLama = $kamar->status;
        $statusBaru = $validated['status'];

        if ($statusLama !== $statusBaru) {
            KamarHistory::create([
                'kamar_id' => $kamar->id,
                'status_lama' => $statusLama,
                'status_baru' => $statusBaru,
                'keterangan' => $validated['keterangan'] ?? 'Perubahan status kamar',
                'diubah_oleh' => Auth::id(),
            ]);

            $kamar->update(['status' => $statusBaru]);

            return redirect()->route('kamar')
                ->with('success', "Status kamar {$kamar->nomor_kamar} berhasil diubah dari {$statusLama} menjadi {$statusBaru}");
        }

        return redirect()->route('kamar')
            ->with('info', "Tidak ada perubahan status pada kamar {$kamar->nomor_kamar}");
    }

        // 🚀 Export Excel
    public function export()
    {
        return Excel::download(new KamarExport, 'kamar.xlsx');
    }


    /**
 * Get rooms by floor for AJAX request
 *
 * @param Request $request
 * @return \Illuminate\Http\JsonResponse
 */
public function getByFloor(Request $request)
{
    $lantai = $request->input('lantai');
    
    $kamars = Kamar::with('tipeKamar')
                    ->where('lantai', $lantai)
                    ->get();
    
    $data = [];
    
    foreach ($kamars as $kamar) {
        $data[] = [
            'id' => $kamar->id,
            'nomor_kamar' => $kamar->nomor_kamar,
            'tipe_kamar' => $kamar->tipeKamar->nama_tipe,
            'lantai' => $kamar->lantai,
            'status' => $kamar->status,
            'image_url' => Storage::url($kamar->image),
            'harga_formatted' => number_format($kamar->tipeKamar->harga_per_malam, 0, ',', '.'),
        ];
    }
    
    return response()->json([
        'success' => true,
        'data' => $data
    ]);
}
public function exportPDF()
{
    // Ambil data kamar beserta relasinya
    $kamars = Kamar::with('tipeKamar')->get();
    
    // Buat PDF dengan memanfaatkan view 'kamar.export-pdf'
    $pdf = Pdf::loadView('kamar.export-pdf', compact('kamars'));
    
    // Kembalikan file PDF untuk diunduh
    return $pdf->download('data-kamar.pdf');
}
   }
