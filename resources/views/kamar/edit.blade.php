@extends('layouts.app')
@section('content')
<div class="container-fluid p-4">
    <div class="card border-0 shadow-lg rounded-lg overflow-hidden">
        <div class="card-header bg-white py-3 px-4 border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 font-weight-bold text-gray-800">Edit Kamar</h5>
                <a href="{{ route('kamar') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali
                </a>
            </div>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('kamar.update', $kamar) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="nomor_kamar" class="form-label fw-semibold text-gray-700">
                            Nomor Kamar
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border">
                                <i class="fas fa-door-closed text-gray-400"></i>
                            </span>
                            <input type="text" 
                                   class="form-control @error('nomor_kamar') is-invalid @enderror"
                                   id="nomor_kamar" 
                                   name="nomor_kamar" 
                                   value="{{ old('nomor_kamar', $kamar->nomor_kamar) }}"
                                   placeholder="Masukkan nomor kamar">
                        </div>
                        @error('nomor_kamar')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="tipe_kamar" class="form-label fw-semibold text-gray-700">
                            Tipe Kamar
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border">
                                <i class="fas fa-tag text-gray-400"></i>
                            </span>
                            <select class="form-select @error('tipe_kamar') is-invalid @enderror"
                                    id="tipe_kamar" 
                                    name="tipe_kamar">
                                @foreach($tipeKamars as $tipe)
                                <option value="{{ $tipe->id }}"
                                        {{ old('tipe_kamar', $kamar->tipe_kamar) == $tipe->id ? 'selected' : '' }}>
                                    {{ $tipe->nama_tipe }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @error('tipe_kamar')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="lantai" class="form-label fw-semibold text-gray-700">
                            Lantai
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border">
                                <i class="fas fa-building text-gray-400"></i>
                            </span>
                            <input type="number" 
                                   class="form-control @error('lantai') is-invalid @enderror"
                                   id="lantai" 
                                   name="lantai" 
                                   value="{{ old('lantai', $kamar->lantai) }}"
                                   placeholder="Masukkan nomor lantai">
                        </div>
                        @error('lantai')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="status" class="form-label fw-semibold text-gray-700">
                            Status
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border">
                                <i class="fas fa-circle text-gray-400"></i>
                            </span>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status">
                                <option value="tersedia" {{ old('status', $kamar->status) == 'tersedia' ? 'selected' : '' }}>
                                    Tersedia
                                </option>
                                <option value="terisi" {{ old('status', $kamar->status) == 'terisi' ? 'selected' : '' }}>
                                    Terisi
                                </option>
                                <option value="perbaikan" {{ old('status', $kamar->status) == 'perbaikan' ? 'selected' : '' }}>
                                    Perbaikan
                                </option>
                            </select>
                        </div>
                        @error('status')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-4">
                        <label for="image" class="form-label fw-semibold text-gray-700">
                            Foto Kamar
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border">
                                <i class="fas fa-image text-gray-400"></i>
                            </span>
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror"
                                   id="image" 
                                   name="image"
                                   accept="image/*">
                        </div>
                        @error('image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @if($kamar->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $kamar->image) }}" 
                                 alt="Current room image" 
                                 class="img-thumbnail" 
                                 style="height: 100px; object-fit: cover;">
                        </div>
                        @endif
                    </div>
                </div>

                <div class="d-flex gap-2 justify-content-end mt-4">
                    <a href="{{ route('kamar') }}" class="btn btn-outline-secondary px-4">
                        <i class="fas fa-times me-2"></i>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.card {
    transition: all 0.3s ease;
}

.form-label {
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
}

.input-group-text {
    padding: 0.6rem 0.75rem;
}

.input-group-text i {
    width: 16px;
    text-align: center;
}

.form-control,
.form-select {
    padding: 0.6rem 0.75rem;
    font-size: 0.875rem;
    border-color: #e5e7eb;
}

.form-control:focus,
.form-select:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
}

.invalid-feedback {
    font-size: 0.75rem;
    margin-top: 0.25rem;
}

.btn {
    padding: 0.6rem 1rem;
    font-size: 0.875rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

/* Utility classes */
.text-gray-400 { color: #94a3b8; }
.text-gray-700 { color: #334155; }
.text-gray-800 { color: #1e293b; }
</style>
@endsection