@extends('layouts.app')

@section('styles')
<style>
    /* Enhanced header image styling */
    .header-image {
        height: 360px;
        background-size: cover;
        background-position: center;
        position: relative;
        border-radius: 8px 8px 0 0;
        overflow: hidden;
        transition: all 0.5s ease;
    }
    
    .header-gallery {
        position: relative;
        width: 100%;
        height: 100%;
    }
    
    .gallery-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        background: rgba(255,255,255,0.8);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 2;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .header-image:hover .gallery-nav {
        opacity: 1;
    }
    
    .gallery-prev {
        left: 15px;
    }
    
    .gallery-next {
        right: 15px;
    }
    
    .gallery-indicators {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 8px;
        z-index: 2;
    }
    
    .gallery-indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(255,255,255,0.5);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .gallery-indicator.active {
        background: white;
        transform: scale(1.2);
    }
    
    .header-gradient {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 180px;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        padding: 30px;
        display: flex;
        align-items: flex-end;
        z-index: 1;
    }
    
    .badge-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .status-badge {
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    
    /* Enhanced card styling */
    .card-custom {
        transition: all 0.3s ease;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    
    .card-custom:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .card-header {
        border-bottom: none;
        padding: 20px;
    }
    
    .card-body {
        padding: 20px;
    }
    
    /* Enhanced timeline styling */
    .timeline {
        position: relative;
        padding-left: 40px;
    }
    
    .timeline:before {
        content: '';
        position: absolute;
        top: 10px;
        bottom: 10px;
        left: 19px;
        width: 2px;
        background-color: #e9ecef;
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 30px;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }
    
    .timeline-dot {
        position: absolute;
        left: -40px;
        top: 4px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }
    
    .timeline-dot i {
        font-size: 10px;
        color: white;
    }
    
    .timeline-content {
        padding: 20px;
        border-radius: 8px;
        background-color: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    
    .timeline-content:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: translateY(-3px);
    }
    
    /* Enhanced facility badges */
    .facility-badge {
        display: inline-block;
        background-color: #e9f4ff;
        color: #0d6efd;
        padding: 5px 12px;
        border-radius: 15px;
        margin: 3px;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }
    
    .facility-badge:hover {
        background-color: #d0e7ff;
        transform: translateY(-2px);
    }
    
    /* Enhanced action buttons */
    .action-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 5px;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    }
    
    .action-btn:hover {
        transform: scale(1.15);
        box-shadow: 0 5px 15px rgba(0,0,0,0.25);
    }
    
    /* Enhanced modals */
    .modal-custom .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        overflow: hidden;
    }
    
    .modal-custom .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #eee;
        padding: 20px 25px;
    }
    
    .modal-custom .modal-body {
        padding: 25px;
    }
    
    .modal-custom .modal-footer {
        border-top: 1px solid #eee;
        padding: 15px 25px;
    }
    
    /* Room image thumbnail gallery */
    .room-thumbnails {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        overflow-x: auto;
        padding-bottom: 10px;
    }
    
    .room-thumbnail {
        width: 80px;
        height: 60px;
        border-radius: 5px;
        object-fit: cover;
        cursor: pointer;
        opacity: 0.7;
        transition: all 0.3s ease;
    }
    
    .room-thumbnail:hover, 
    .room-thumbnail.active {
        opacity: 1;
        transform: scale(1.05);
        box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    }
    
    /* Weather and conditions section */
    .conditions-card {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        overflow: hidden;
    }
    
    .conditions-card .card-body {
        position: relative;
        z-index: 1;
    }
    
    .conditions-card:after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 150px;
        height: 150px;
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 10h-4V6"/><path d="M14 10L21 3"/><path d="M21 14v7h-7"/><path d="M21 21L14 14"/><path d="M3 14v7h7"/><path d="M3 21l7-7"/><path d="M10 7V3H3"/><path d="M3 3l7 7"/></svg>');
        background-repeat: no-repeat;
        background-position: right bottom;
        background-size: contain;
        opacity: 0.3;
        z-index: 0;
    }
    
    /* QR code section */
    .qr-code-container {
        text-align: center;
    }
    
    .qr-code {
        width: 140px;
        height: 140px;
        margin: 0 auto;
        border: 5px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    
    .qr-code:hover {
        transform: scale(1.05);
    }
    
    /* Responsive fixes */
    @media (max-width: 768px) {
        .header-image {
            height: 250px;
        }
        
        .action-btn {
            width: 36px;
            height: 36px;
        }
        
        .timeline {
            padding-left: 30px;
        }
        
        .timeline-dot {
            left: -30px;
            width: 20px;
            height: 20px;
        }
        
        .room-thumbnail {
            width: 70px;
            height: 50px;
        }
    }
    
    /* Print styles */
    @media print {
        .action-btn, .gallery-nav, .btn-warning, .btn-danger {
            display: none !important;
        }
        
        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }
        
        .header-image {
            height: 200px !important;
        }
    }
</style>
@endsection

@section('content')
<div class="container my-5">
    <div class="card shadow">
        <!-- Enhanced Header with Image Gallery -->
        <div class="header-image @if(!$kamar->image && !$kamar->gallery) bg-primary @endif">
            <div class="header-gallery" id="roomGallery">
                @if($kamar->image || $kamar->gallery)
                    <div class="gallery-slide active" style="background-image: url('{{ Storage::url($kamar->image) }}')"></div>
                    
                    @if(isset($kamar->gallery) && is_array($kamar->gallery))
                        @foreach($kamar->gallery as $image)
                            <div class="gallery-slide" style="background-image: url('{{ Storage::url($image) }}')"></div>
                        @endforeach
                    @endif
                @else
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <i class="fas fa-bed text-white" style="font-size: 5rem;"></i>
                    </div>
                @endif
                
                @if($kamar->image || (isset($kamar->gallery) && is_array($kamar->gallery) && count($kamar->gallery) > 0))
                    <div class="gallery-nav gallery-prev" onclick="changeSlide(-1)">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="gallery-nav gallery-next" onclick="changeSlide(1)">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                    
                    <div class="gallery-indicators">
                        <div class="gallery-indicator active" onclick="goToSlide(0)"></div>
                        @if(isset($kamar->gallery) && is_array($kamar->gallery))
                            @foreach($kamar->gallery as $index => $image)
                                <div class="gallery-indicator" onclick="goToSlide({{ $index + 1 }})"></div>
                            @endforeach
                        @endif
                    </div>
                @endif
            </div>
            
            <div class="header-gradient">
                <div>
                    <h1 class="text-white mb-2 d-flex align-items-center">
                        Kamar {{ $kamar->nomor_kamar }}
                    </h1>
                    <div class="badge-container">
                        <span class="status-badge 
                            @if($kamar->status == 'tersedia') bg-success @endif
                            @if($kamar->status == 'terisi') bg-danger @endif
                            @if($kamar->status == 'perbaikan') bg-warning text-dark @endif
                        ">
                            {{ ucfirst($kamar->status) }}
                        </span>
                        @if(isset($kamar->featured) && $kamar->featured)
                            <span class="status-badge bg-info">
                                <i class="fas fa-star me-1"></i> Featured
                            </span>
                        @endif
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="ms-auto">
                    <div class="d-flex">
                        <a href="{{ route('kamar.edit', $kamar) }}" class="action-btn bg-white text-primary" title="Edit room details">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="action-btn bg-white text-warning" 
                                data-bs-toggle="modal" data-bs-target="#updateStatusModal" title="Change room status">
                            <i class="fas fa-exchange-alt"></i>
                        </button>
                        <button type="button" class="action-btn bg-white text-info" 
                                data-bs-toggle="modal" data-bs-target="#uploadImagesModal" title="Manage images">
                            <i class="fas fa-images"></i>
                        </button>
                        <button type="button" class="action-btn bg-white text-danger" 
                                data-bs-toggle="modal" data-bs-target="#deleteModal" title="Delete room">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Room Thumbnails Gallery - New Feature -->
        @if($kamar->image || (isset($kamar->gallery) && is_array($kamar->gallery) && count($kamar->gallery) > 0))
            <div class="px-4 pt-3">
                <div class="room-thumbnails">
                    <img src="{{ Storage::url($kamar->image) }}" class="room-thumbnail active" onclick="goToSlide(0)" alt="Room main image">
                    @if(isset($kamar->gallery) && is_array($kamar->gallery))
                        @foreach($kamar->gallery as $index => $image)
                            <img src="{{ Storage::url($image) }}" class="room-thumbnail" onclick="goToSlide({{ $index + 1 }})" alt="Room image {{ $index + 1 }}">
                        @endforeach
                    @endif
                </div>
            </div>
        @endif

        <!-- Room Information -->
        <div class="card-body p-4">
            <div class="row g-4">
                <!-- Basic Information Card -->
                <div class="col-md-6">
                    <div class="card card-custom h-100">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-info-circle text-primary me-2"></i>
                                Informasi Dasar
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <th style="width: 40%">Nomor Kamar</th>
                                    <td class="fw-bold">{{ $kamar->nomor_kamar }}</td>
                                </tr>
                                <tr>
                                    <th>Tipe Kamar</th>
                                    <td class="fw-bold">{{ $kamar->tipeKamar->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Lantai</th>
                                    <td class="fw-bold">{{ $kamar->lantai }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="fw-bold 
                                            @if($kamar->status == 'tersedia') text-success @endif
                                            @if($kamar->status == 'terisi') text-danger @endif
                                            @if($kamar->status == 'perbaikan') text-warning @endif
                                        ">
                                            {{ ucfirst($kamar->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Terakhir Diperbarui</th>
                                    <td class="fw-bold">{{ $kamar->updated_at->format('d F Y, H:i') }}</td>
                                </tr>
                                <!-- Add availability prediction - New Feature -->
                                @if($kamar->status == 'perbaikan' && isset($kamar->estimated_ready))
                                <tr>
                                    <th>Estimasi Tersedia</th>
                                    <td class="fw-bold text-info">{{ \Carbon\Carbon::parse($kamar->estimated_ready)->format('d F Y') }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Room Type Details Card -->
                <div class="col-md-6">
                    <div class="card card-custom h-100">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-bed text-primary me-2"></i>
                                Detail Tipe Kamar
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <th style="width: 40%">Nama Tipe</th>
                                    <td class="fw-bold">{{ $kamar->tipeKamar->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Harga Per Malam</th>
                                    <td class="fw-bold">Rp {{ number_format($kamar->tipeKamar->harga, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Kapasitas</th>
                                    <td class="fw-bold">{{ $kamar->tipeKamar->kapasitas }} orang</td>
                                </tr>
                                <tr>
                                    <th class="align-top">Fasilitas</th>
                                    <td>
                                        @foreach(explode(',', $kamar->tipeKamar->fasilitas) as $fasilitas)
                                            <span class="facility-badge">
                                                <i class="fas fa-check-circle me-1"></i>
                                                {{ trim($fasilitas) }}
                                            </span>
                                        @endforeach
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Third Row with Additional Features - New Feature -->
            <div class="row g-4 mt-1">
                <!-- Current Conditions - Weather and Room Conditions - New Feature -->
                <div class="col-md-6">
                    <div class="card card-custom conditions-card h-100">
                        <div class="card-header bg-transparent border-0">
                            <h5 class="card-title mb-0 text-white">
                                <i class="fas fa-thermometer-half me-2"></i>
                                Kondisi Kamar Saat Ini
                            </h5>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row align-items-center">
                                <div class="col-7">
                                    <div class="mb-3">
                                        <small class="text-white-50">Temperatur</small>
                                        <h3 class="mb-0 text-white">{{ $kamar->current_temp ?? '23' }}°C</h3>
                                    </div>
                                    <div class="mb-3">
                                        <small class="text-white-50">Kelembaban</small>
                                        <h3 class="mb-0 text-white">{{ $kamar->current_humidity ?? '55' }}%</h3>
                                    </div>
                                    <div>
                                        <small class="text-white-50">AC Status</small>
                                        <h5 class="mb-0 text-white">
                                            @if(isset($kamar->ac_status) && $kamar->ac_status)
                                                <i class="fas fa-check-circle me-1 text-success"></i> Menyala
                                            @else
                                                <i class="fas fa-power-off me-1 text-white-50"></i> Mati
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-5 text-center">
                                    <i class="fas fa-sun" style="font-size: 4rem; opacity: 0.8;"></i>
                                    <div class="mt-2 text-white-50">
                                        Terakhir check: {{ now()->format('H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- QR Code for Check-in - New Feature -->
                <div class="col-md-6">
                    <div class="card card-custom h-100">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-qrcode text-primary me-2"></i>
                                QR Code Kamar
                            </h5>
                        </div>
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <div class="qr-code-container">
                                <div class="qr-code bg-light d-flex align-items-center justify-content-center">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ route('kamar.show', $kamar) }}" alt="Room QR Code">
                                </div>
                                <p class="text-muted mt-3 mb-1">Scan untuk check-in otomatis</p>
                                <button class="btn btn-sm btn-outline-secondary mt-2" onclick="printQRCode()">
                                    <i class="fas fa-print me-1"></i> Cetak QR Code
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Room History Timeline -->
            <div class="card card-custom mt-4">
                <div class="card-header bg-white d-flex align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-history text-primary me-2"></i>
                        Riwayat Perubahan Status
                    </h5>
                    <a href="{{ route('kamar.history', $kamar) }}" class="ms-auto btn btn-sm btn-outline-primary">
                        <i class="fas fa-eye me-1"></i> Lihat Semua
                    </a>
                </div>
                <div class="card-body">
                    @if($kamar->histories->count() > 0)
                        <div class="timeline">
                            @foreach($kamar->histories->take(5) as $history)
                                <div class="timeline-item">
                                    <div class="timeline-dot 
                                        @if($history->status_baru == 'tersedia') bg-success @endif
                                        @if($history->status_baru == 'terisi') bg-danger @endif
                                        @if($history->status_baru == 'perbaikan') bg-warning @endif
                                    ">
                                        <i class="fas fa-circle"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <small class="text-muted">{{ $history->created_at->format('d F Y, H:i') }}</small>
                                        <div class="mt-2">
                                            Status diubah dari 
                                            <span class="fw-bold 
                                                @if($history->status_lama == 'tersedia') text-success @endif
                                                @if($history->status_lama == 'terisi') text-danger @endif
                                                @if($history->status_lama == 'perbaikan') text-warning @endif
                                            ">
                                                {{ ucfirst($history->status_lama) }}
                                            </span> 
                                            menjadi 
                                            <span class="fw-bold 
                                                @if($history->status_baru == 'tersedia') text-success @endif
                                                @if($history->status_baru == 'terisi') text-danger @endif
                                                @if($history->status_baru == 'perbaikan') text-warning @endif
                                            ">
                                                {{ ucfirst($history->status_baru) }}
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-center mt-2">
                                            <i class="fas fa-user-edit text-muted me-1"></i>
                                            <small>
                                                @if($history->user)
                                                    {{ $history->user->name }}
                                                @else
                                                    User tidak ditemukan
                                                @endif
                                            </small>
                                            @if($history->keterangan)
                                                <span class="badge bg-light text-dark ms-2 p-2">
                                                    {{ $history->keterangan }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-light text-center" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            Belum ada riwayat perubahan status
                        </div>
                    @endif
                </div>
            </div>

            <!-- Actions Footer -->
            <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mt-4 pt-4 border-top">
                <div>
                    <a href="{{ route('kamar') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Kamar
                    </a>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    @if($kamar->status == 'tersedia')
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#checkInModal">
                            <i class="fas fa-sign-in-alt me-2"></i> Check-in
                        </button>
                    @endif
                    @if($kamar->status == 'terisi')
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#checkOutModal">
                            <i class="fas fa-sign-out-alt me-2"></i> Check-out
                        </button>
                    @endif
                    <a href="{{ route('kamar.edit', $kamar) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i> Edit Kamar
                    </a>
                    <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                        <i class="fas fa-exchange-alt me-2"></i> Ubah Status
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Status Modal -->
{{-- <div class="modal fade modal-custom" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateStatusModalLabel">Ubah Status Kamar {{ $kamar->nomor_kamar }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> --}}
            {{-- <form action="{{ route('kamar.updateStatus', $kamar) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status Baru</label>
                        <select id="status" name="status" class="form-select">
                            <option value="tersedia" {{ $kamar->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="terisi" {{ $kamar->status == 'terisi' ? 'selected' : '' }}>Terisi</option>
                            <option value="perbaikan" {{ $kamar->status == 'perbaikan' ? 'selected' : '' }}><option value="perbaikan" {{ $kamar->status == 'perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                        </select>
                    </div>
                    
                    <!-- Estimated ready date field - New Feature -->
                    <div class="mb-3 estimated-ready-container" style="{{ $kamar->status != 'perbaikan' ? 'display: none;' : '' }}">
                        <label for="estimated_ready" class="form-label">Estimasi Tanggal Siap</label>
                        <input type="date" class="form-control" id="estimated_ready" name="estimated_ready"
                               value="{{ isset($kamar->estimated_ready) ? date('Y-m-d', strtotime($kamar->estimated_ready)) : '' }}">
                        <small class="form-text text-muted">Perkiraan kapan kamar akan tersedia kembali</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan (opsional)</label>
                        <textarea id="keterangan" name="keterangan" class="form-control" rows="3" placeholder="Berikan keterangan mengenai perubahan status"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

<!-- Upload Images Modal -->
{{-- <div class="modal fade modal-custom" id="uploadImagesModal" tabindex="-1" aria-labelledby="uploadImagesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadImagesModalLabel">Kelola Gambar Kamar {{ $kamar->nomor_kamar }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> --}}
            {{-- <form action="{{ route('kamar.updateImages', $kamar) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-4">
                        <label class="form-label">Gambar Utama</label>
                        @if($kamar->image)
                            <div class="position-relative mb-3">
                                <img src="{{ Storage::url($kamar->image) }}" alt="Main image" class="img-thumbnail w-100" style="max-height: 200px; object-fit: cover;">
                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2" 
                                        onclick="removeMainImage()">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @endif
                        <input type="file" name="main_image" class="form-control" accept="image/*">
                        <input type="hidden" name="remove_main_image" id="remove_main_image" value="0">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Galeri Gambar</label>
                        @if(isset($kamar->gallery) && is_array($kamar->gallery) && count($kamar->gallery) > 0)
                            <div class="row mb-3">
                                @foreach($kamar->gallery as $index => $image)
                                    <div class="col-4 mb-3">
                                        <div class="position-relative">
                                            <img src="{{ Storage::url($image) }}" alt="Gallery image {{ $index }}" class="img-thumbnail w-100" style="height: 100px; object-fit: cover;">
                                            <div class="form-check position-absolute bottom-0 end-0 m-1">
                                                <input class="form-check-input" type="checkbox" name="remove_gallery[]" value="{{ $index }}" id="removeGallery{{ $index }}">
                                                <label class="form-check-label text-danger" for="removeGallery{{ $index }}">
                                                    <i class="fas fa-trash"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">Belum ada gambar galeri.</p>
                        @endif
                        <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple>
                        <small class="form-text text-muted">Anda dapat memilih beberapa gambar sekaligus</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

<!-- Check-in Modal - New Feature -->
{{-- <div class="modal fade modal-custom" id="checkInModal" tabindex="-1" aria-labelledby="checkInModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkInModalLabel">Check-in Kamar {{ $kamar->nomor_kamar }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kamar.checkIn', $kamar) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="guest_name" class="form-label">Nama Tamu</label>
                        <input type="text" class="form-control" id="guest_name" name="guest_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="guest_id" class="form-label">Nomor ID Tamu (KTP/Passport)</label>
                        <input type="text" class="form-control" id="guest_id" name="guest_id" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="check_in_date" class="form-label">Tanggal Check-in</label>
                            <input type="date" class="form-control" id="check_in_date" name="check_in_date" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="check_out_date" class="form-label">Tanggal Check-out</label>
                            <input type="date" class="form-control" id="check_out_date" name="check_out_date" value="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Catatan (opsional)</label>
                        <textarea id="notes" name="notes" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-sign-in-alt me-2"></i> Check-in
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

<!-- Check-out Modal - New Feature -->
{{-- <div class="modal fade modal-custom" id="checkOutModal" tabindex="-1" aria-labelledby="checkOutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkOutModalLabel">Check-out Kamar {{ $kamar->nomor_kamar }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kamar.checkOut', $kamar) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Kamar ini akan diubah statusnya menjadi "Tersedia" setelah check-out.
                    </div>
                    
                    <div class="mb-3">
                        <label for="room_condition" class="form-label">Kondisi Kamar</label>
                        <select id="room_condition" name="room_condition" class="form-select">
                            <option value="good">Baik - Siap Pakai</option>
                            <option value="cleanup">Perlu Pembersihan</option>
                            <option value="maintenance">Perlu Perbaikan</option>
                        </select>
                    </div>
                    
                    <div class="mb-3 maintenance-container" style="display: none;">
                        <label for="maintenance_notes" class="form-label">Catatan Perbaikan</label>
                        <textarea id="maintenance_notes" name="maintenance_notes" class="form-control" rows="3" placeholder="Jelaskan masalah yang perlu diperbaiki"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="checkout_notes" class="form-label">Catatan Check-out (opsional)</label>
                        <textarea id="checkout_notes" name="checkout_notes" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt me-2"></i> Check-out
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

<!-- Delete Modal -->
<div class="modal fade modal-custom" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Kamar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Perhatian!</strong> Anda akan menghapus data kamar {{ $kamar->nomor_kamar }}. Tindakan ini tidak dapat dibatalkan.
                </div>
                <p>Semua data terkait kamar ini akan dihapus dari sistem, termasuk:</p>
                <ul>
                    <li>Riwayat perubahan status</li>
                    <li>Gambar kamar</li>
                    <li>Catatan lainnya</li>
                </ul>
                <p class="mb-0">Apakah Anda yakin ingin melanjutkan?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('kamar.destroy', $kamar) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i> Ya, Hapus Kamar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Gallery slider functionality
    let currentSlide = 0;
    const slides = document.querySelectorAll('.gallery-slide');
    const indicators = document.querySelectorAll('.gallery-indicator');
    const thumbnails = document.querySelectorAll('.room-thumbnail');
    
    function showSlide(index) {
        // Hide all slides
        slides.forEach(slide => slide.classList.remove('active'));
        
        // Show the selected slide
        slides[index].classList.add('active');
        
        // Update indicators
        indicators.forEach(indicator => indicator.classList.remove('active'));
        indicators[index].classList.add('active');
        
        // Update thumbnails
        thumbnails.forEach(thumbnail => thumbnail.classList.remove('active'));
        thumbnails[index].classList.add('active');
        
        currentSlide = index;
    }
    
    function changeSlide(direction) {
        let newIndex = currentSlide + direction;
        if (newIndex < 0) newIndex = slides.length - 1;
        if (newIndex >= slides.length) newIndex = 0;
        showSlide(newIndex);
    }
    
    function goToSlide(index) {
        showSlide(index);
    }
    
    // Initialize first slide if slides exist
    if (slides.length > 0) {
        slides[0].classList.add('active');
    }
    
    // Print QR Code function
    function printQRCode() {
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <html>
            <head>
                <title>QR Code Kamar ${document.querySelector('h1').textContent.trim()}</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        text-align: center;
                        padding: 20px;
                    }
                    .qr-container {
                        margin: 20px auto;
                        width: 200px;
                    }
                    .qr-code {
                        width: 100%;
                        height: auto;
                    }
                    .room-info {
                        margin-top: 10px;
                        font-size: 18px;
                        font-weight: bold;
                    }
                    .instruction {
                        margin-top: 20px;
                        font-size: 14px;
                        color: #666;
                    }
                </style>
            </head>
            <body>
                <h2>QR Code Check-in</h2>
                <div class="qr-container">
                    <img class="qr-code" src="${document.querySelector('.qr-code img').src}" alt="Room QR Code">
                </div>
                <div class="room-info">${document.querySelector('h1').textContent.trim()}</div>
                <div class="instruction">Scan QR code untuk check-in otomatis</div>
            </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.focus();
        setTimeout(() => {
            printWindow.print();
            printWindow.close();
        }, 500);
    }
    
    // Timeline animation
    document.addEventListener('DOMContentLoaded', function() {
        const timelineItems = document.querySelectorAll('.timeline-item');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });
        
        timelineItems.forEach(item => {
            observer.observe(item);
        });
    });
    
    // Handle room condition change in check-out modal
    document.getElementById('room_condition').addEventListener('change', function() {
        const maintenanceContainer = document.querySelector('.maintenance-container');
        if (this.value === 'maintenance') {
            maintenanceContainer.style.display = 'block';
        } else {
            maintenanceContainer.style.display = 'none';
        }
    });
    
    // Handle status change in update status modal
    document.getElementById('status').addEventListener('change', function() {
        const estimatedReadyContainer = document.querySelector('.estimated-ready-container');
        if (this.value === 'perbaikan') {
            estimatedReadyContainer.style.display = 'block';
        } else {
            estimatedReadyContainer.style.display = 'none';
        }
    });
    
    // Remove main image function
    function removeMainImage() {
        document.getElementById('remove_main_image').value = '1';
        document.querySelector('[name="main_image"]').closest('.mb-4').querySelector('img').style.display = 'none';
        document.querySelector('[name="main_image"]').closest('.mb-4').querySelector('button').style.display = 'none';
    }
</script>
@endsection