@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-header bg-gradient bg-primary bg-opacity-75 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="text-white mb-0">Riwayat Kamar: {{ $kamar->nomor_kamar }}</h3>
                        <a href="{{ route('kamar') }}" class="btn btn-light px-4 shadow-sm">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    
                    <!-- Informasi Kamar -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <img src="{{ Storage::url($kamar->image) }}" class="img-fluid rounded mb-3" style="max-height: 150px;" alt="Gambar Kamar">
                                    <h5 class="card-title">Kamar {{ $kamar->nomor_kamar }}</h5>
                                    <p class="card-text text-capitalize">{{ optional($kamar->tipeKamar)->nama ?? 'Tidak tersedia' }}</p>
                                    <p class="card-text">Lantai {{ $kamar->lantai }}</p>
                                    <div>
                                        @if($kamar->status == 'tersedia')
                                            <span class="badge bg-success text-white px-3 py-2 rounded-pill">Tersedia</span>
                                        @elseif($kamar->status == 'terisi')
                                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Terisi</span>
                                        @else
                                            <span class="badge bg-danger text-white px-3 py-2 rounded-pill">Perbaikan</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title border-bottom pb-3 mb-3">Informasi Statistik</h5>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle p-3 bg-primary bg-opacity-10 me-3">
                                                    <i class="bi bi-calendar-check text-primary fs-4"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Total Perubahan</h6>
                                                    <h4 class="mb-0">{{ $histories->total() }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle p-3 bg-success bg-opacity-10 me-3">
                                                    <i class="bi bi-check-circle text-success fs-4"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Terakhir Tersedia</h6>
                                                    @php
                                                        $lastAvailable = $kamar->histories()
                                                            ->where('status_baru', 'tersedia')
                                                            ->latest()
                                                            ->first();
                                                    @endphp
                                                    <p class="mb-0">
                                                        @if($lastAvailable)
                                                            {{ $lastAvailable->created_at->format('d M Y, H:i') }}
                                                        @else
                                                            -
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle p-3 bg-warning bg-opacity-10 me-3">
                                                    <i class="bi bi-clock-history text-warning fs-4"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Terakhir Diubah</h6>
                                                    @php
                                                        $lastChanged = $kamar->histories()
                                                            ->latest()
                                                            ->first();
                                                    @endphp
                                                    <p class="mb-0">
                                                        @if($lastChanged)
                                                            {{ $lastChanged->created_at->format('d M Y, H:i') }}
                                                        @else
                                                            -
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Timeline Riwayat Kamar -->
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body">
                            <h5 class="card-title border-bottom pb-3 mb-4">Riwayat Perubahan Status</h5>
                            
                            @if($histories->count() > 0)
                            <div class="timeline-history position-relative ps-4">
                                @foreach($histories as $history)
                                <div class="timeline-item mb-4 position-relative">
                                    <div class="timeline-marker position-absolute rounded-circle bg-primary"
                                         style="width: 14px; height: 14px; left: -29px; top: 8px; border: 3px solid #fff;"></div>
                                    
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="text-muted small">
                                                    <i class="bi bi-clock me-1"></i>
                                                    {{ $history->created_at->format('d M Y, H:i') }}
                                                </span>
                                                <span class="text-muted small">
                                                    <i class="bi bi-person me-1"></i>
                                                    {{ optional($history->user)->name ?? 'Pengguna tidak diketahui' }}
                                                </span>
                                            </div>
                                            
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="me-3">
                                                    @if($history->status_lama == 'tersedia')
                                                        <span class="badge bg-success text-white px-3 py-2">{{ ucfirst($history->status_lama) }}</span>
                                                    @elseif($history->status_lama == 'terisi')
                                                        <span class="badge bg-warning text-dark px-3 py-2">{{ ucfirst($history->status_lama) }}</span>
                                                    @else
                                                        <span class="badge bg-danger text-white px-3 py-2">{{ ucfirst($history->status_lama) }}</span>
                                                    @endif
                                                </div>
                                                
                                                <div class="timeline-arrow text-muted">
                                                    <i class="bi bi-arrow-right fs-4"></i>
                                                </div>
                                                
                                                <div class="ms-3">
                                                    @if($history->status_baru == 'tersedia')
                                                        <span class="badge bg-success text-white px-3 py-2">{{ ucfirst($history->status_baru) }}</span>
                                                    @elseif($history->status_baru == 'terisi')
                                                        <span class="badge bg-warning text-dark px-3 py-2">{{ ucfirst($history->status_baru) }}</span>
                                                    @else
                                                        <span class="badge bg-danger text-white px-3 py-2">{{ ucfirst($history->status_baru) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            @if($history->keterangan)
                                            <div class="timeline-content border-top pt-3">
                                                <p class="mb-0">
                                                    <i class="bi bi-info-circle me-2 text-primary"></i>
                                                    {{ $history->keterangan }}
                                                </p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                
                                <!-- Vertical timeline line -->
                                <div class="timeline-line position-absolute bg-secondary"
                                     style="width: 2px; top: 0; bottom: 0; left: -23px;"></div>
                            </div>
                            
                            <!-- Pagination -->
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div class="text-muted small">
                                    Menampilkan {{ $histories->firstItem() ?? 0 }} hingga {{ $histories->lastItem() ?? 0 }} dari {{ $histories->total() }} riwayat
                                </div>
                                {{ $histories->links('pagination::bootstrap-5') }}
                            </div>
                            @else
                            <div class="text-center my-5">
                                <img src="{{ asset('images/empty.svg') }}" alt="Data Kosong" style="max-width: 200px; opacity: 0.5;" class="mb-3">
                                <h5 class="text-muted">Belum Ada Riwayat Perubahan</h5>
                                <p class="text-muted">Saat ini belum ada riwayat perubahan status untuk kamar ini</p>
                                <a href="{{ route('kamar') }}" class="btn btn-primary px-4 mt-2">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Kamar
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('kamar') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                        
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#statusModal">
                            <i class="bi bi-pencil-square me-2"></i>Ubah Status
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ubah Status -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Status Kamar {{ $kamar->nomor_kamar }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kamar.updateStatus', $kamar->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="tersedia" {{ $kamar->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="terisi" {{ $kamar->status == 'terisi' ? 'selected' : '' }}>Terisi</option>
                            <option value="perbaikan" {{ $kamar->status == 'perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                        <textarea name="keterangan" id="keterangan" rows="3" class="form-control" placeholder="Masukkan keterangan perubahan status"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Link CSS Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if(session()->has('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            toast: true,
            position: 'top-end'
        });
    @elseif(session()->has('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            toast: true,
            position: 'top-end'
        });
    @endif
</script>

<style>
    /* Custom style untuk timeline */
    .timeline-history {
        position: relative;
        padding-left: 20px;
    }
    
    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
    }
    
    .timeline-marker {
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }
    
    .timeline-arrow {
        flex: 0 0 auto;
        display: flex;
        align-items: center;
    }
</style>
@endsection