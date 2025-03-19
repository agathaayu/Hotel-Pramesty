@extends('layouts.app')
@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg border-0 rounded-4" style="max-width: 600px; width: 100%;">
        <div class="card-header bg-primary text-white text-center py-3 rounded-top-4">
            <h4 class="mb-0">Tambah Kamar Baru</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('kamar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Image Preview -->
                <div class="mb-4 text-center">
                    <div class="position-relative d-inline-block">
                        <img id="imagePreview" 
                             src="/api/placeholder/400/300"
                             alt="Preview" 
                             class="img-fluid rounded-3 border"
                             style="max-height: 200px; object-fit: cover;">
                        <div class="position-absolute top-50 start-50 translate-middle text-muted">
                            <i class="fas fa-camera fa-2x"></i>
                            <p class="mb-0 mt-2">Pilih Foto Kamar</p>
                        </div>
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="mb-3">
                    <label for="image" class="form-label fw-semibold">Foto Kamar</label>
                    <input type="file" 
                           class="form-control @error('image') is-invalid @enderror" 
                           id="image" 
                           name="image" 
                           accept="image/*"
                           onchange="previewImage(this)">
                    <div class="form-text">Format: JPG, PNG, GIF (Max. 2MB)</div>
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nomor_kamar" class="form-label fw-semibold">Nomor Kamar</label>
                    <input type="text" 
                           class="form-control @error('nomor_kamar') is-invalid @enderror"
                           id="nomor_kamar" 
                           name="nomor_kamar" 
                           value="{{ old('nomor_kamar') }}">
                    @error('nomor_kamar')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tipe_kamar" class="form-label fw-semibold">Tipe Kamar</label>
                    <select class="form-select @error('tipe_kamar') is-invalid @enderror"
                            id="tipe_kamar" 
                            name="tipe_kamar">
                        <option value="">Pilih Tipe Kamar</option>
                        @foreach($tipekamars as $tipe)
                        <option value="{{ $tipe->id }}" {{ old('tipe_kamar') == $tipe->id ? 'selected' : '' }}>
                            {{ $tipe->nama_tipe }}
                        </option>
                        @endforeach
                    </select>
                    @error('tipe_kamar')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="lantai" class="form-label fw-semibold">Lantai</label>
                    <input type="number" 
                           class="form-control @error('lantai') is-invalid @enderror"
                           id="lantai" 
                           name="lantai" 
                           value="{{ old('lantai') }}">
                    @error('lantai')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="form-label fw-semibold">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" 
                            id="status" 
                            name="status">
                        <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="terisi" {{ old('status') == 'terisi' ? 'selected' : '' }}>Terisi</option>
                        <option value="perbaikan" {{ old('status') == 'perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                    <a href="{{ route('kamar') }}" class="btn btn-danger px-4">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    #imagePreview {
        transition: opacity 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .position-relative:hover #imagePreview {
        opacity: 0.7;
        cursor: pointer;
    }
</style>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const overlay = preview.nextElementSibling;
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            overlay.style.display = 'none';
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '/api/placeholder/400/300';
        overlay.style.display = 'block';
    }
}

// Trigger file input when clicking on preview image
document.getElementById('imagePreview').addEventListener('click', function() {
    document.getElementById('image').click();
});
</script>
@endsection