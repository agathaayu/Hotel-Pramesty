@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="card bg-gradient-to-r from-blue-600 to-purple-600 text-white mb-4 border-0">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-1 d-flex align-items-center gap-2">
                        <i class="fas fa-hotel"></i>
                        Tipe Kamar Hotel
                    </h2>
                    <p class="mb-0 opacity-75">Kelola berbagai tipe kamar dan fasilitasnya</p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('tipe-kamar.create') }}" 
                       class="btn btn-light d-inline-flex align-items-center gap-2">
                        <i class="fas fa-plus-circle"></i>
                        Tambah Tipe Kamar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Section -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Search and Filter Section -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-3">
            <div class="row g-3">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" 
                               id="searchInput" placeholder="Cari tipe kamar...">
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="priceSort">
                        <option value="">Urutkan Harga</option>
                        <option value="low">Termurah - Termahal</option>
                        <option value="high">Termahal - Termurah</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Room Types Grid -->
    <div class="row g-4">
        @foreach($tipekamars as $tipekamar)
        <div class="col-md-6 col-lg-4 room-type-item">
            <div class="card h-100 border-0 shadow-sm hover-lift">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0 text-primary">
                            <i class="fas fa-bed me-2"></i>
                            {{ $tipekamar->nama_tipe }}
                        </h5>
                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                            Rp {{ number_format($tipekamar->harga, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="facilities-section mb-3">
                        <h6 class="text-muted mb-2">Fasilitas:</h6>
                        <p class="mb-0">{{ $tipekamar->fasilitas }}</p>
                    </div>

                    <div class="mt-3 pt-3 border-top">
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('tipe-kamar.edit', $tipekamar->id) }}" 
                               class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-edit me-1"></i>
                                Edit
                            </a>
                            <form action="{{ route('tipe-kamar.destroy', $tipekamar->id) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-outline-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus tipe kamar ini?')">
                                    <i class="fas fa-trash-alt me-1"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Empty State -->
    @if($tipekamars->isEmpty())
    <div class="text-center py-5">
        <img src="/api/placeholder/200/200" alt="No room types" class="mb-3">
        <h5>Belum ada tipe kamar</h5>
        <p class="text-muted">Mulai dengan menambahkan tipe kamar baru</p>
        <a href="{{ route('tipe-kamar.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Tambah Tipe Kamar
        </a>
    </div>
    @endif

    <!-- Pagination -->
    <div class="mt-4">
        {{ $tipekamars->links() }}
    </div>
</div>

<style>
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .badge {
        font-weight: 500;
    }
    
    .bg-gradient-to-r {
        background: linear-gradient(to right, var(--bs-primary), #6366f1);
    }
    
    .pagination {
        gap: 0.5rem;
    }
    
    .page-link {
        border-radius: 0.5rem;
        border: none;
        padding: 0.5rem 1rem;
    }
    
    .page-item.active .page-link {
        background-color: var(--bs-primary);
    }
    
    @media (max-width: 768px) {
        .card-title {
            font-size: 1.1rem;
        }
        
        .badge {
            font-size: 0.8rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const priceSort = document.getElementById('priceSort');
    const roomTypes = document.querySelectorAll('.room-type-item');

    // Search functionality
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        roomTypes.forEach(room => {
            const title = room.querySelector('.card-title').textContent.toLowerCase();
            const facilities = room.querySelector('.facilities-section').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || facilities.includes(searchTerm)) {
                room.style.display = '';
            } else {
                room.style.display = 'none';
            }
        });
    });

    // Price sorting
    priceSort.addEventListener('change', function() {
        const roomTypesArray = Array.from(roomTypes);
        
        roomTypesArray.sort((a, b) => {
            const priceA = extractPrice(a.querySelector('.badge').textContent);
            const priceB = extractPrice(b.querySelector('.badge').textContent);
            
            return this.value === 'low' ? priceA - priceB : priceB - priceA;
        });

        const container = document.querySelector('.row.g-4');
        roomTypesArray.forEach(room => container.appendChild(room));
    });

    function extractPrice(priceString) {
        return parseInt(priceString.replace(/[^\d]/g, ''));
    }
});
</script>
@endsection