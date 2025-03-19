
<!-- resources/views/tipe-kamar/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Tipe Kamar</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('tipe-kamar.update', $tipekamar->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_tipe" class="form-label">Nama Tipe</label>
                            <input type="text" class="form-control @error('nama_tipe') is-invalid @enderror" 
                                id="nama_tipe" name="nama_tipe" value="{{ old('nama_tipe', $tipekamar->nama_tipe) }}">
                            @error('nama_tipe')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror" 
                                id="harga" name="harga" value="{{ old('harga', $tipekamar->harga) }}">
                            @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="fasilitas" class="form-label">Fasilitas</label>
                            <textarea class="form-control @error('fasilitas') is-invalid @enderror" 
                                id="fasilitas" name="fasilitas" rows="3">{{ old('fasilitas', $tipekamar->fasilitas) }}</textarea>
                            @error('fasilitas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('tipe-kamar.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection