@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-header bg-gradient bg-primary bg-opacity-75 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="text-white mb-0">Data Kamar</h3>
                        <a href="{{ route('kamar.create') }}" class="btn btn-light px-4 shadow-sm">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Kamar
                        </a>
                    </div>
                    <!-- Tambahkan di bagian atas halaman, biasanya setelah judul halaman -->
                    <div class="row mt-3">
                        <div class="col-md-6">
                           <!-- Card untuk Export PDF -->
        <div class="card">
            <div class="card-header">
                <h5>Export Data Kamar ke PDF</h5>
            </div>
            <div class="card-body">
                <!-- Tombol Export PDF -->
                <a href="{{ route('kamar.export.pdf') }}" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>
                <small class="form-text text-muted">Klik untuk mengunduh data kamar dalam format PDF.</small>
            </div>
        </div>
    </div>
                        
                        <div class="col-md-6">
                            <!-- Tombol Export Excel -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Export Data Kamar</h5>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('kamar.export') }}" class="btn btn-success">
                                        <i class="fas fa-download"></i> Export Excel
                                    </a>
                                    <small class="d-block mt-2 text-muted">Download semua data kamar dalam format Excel</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    
                    <!-- Fitur Pencarian dan Filter -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Cari nomor kamar...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select id="filterTipe" class="form-select">
                                <option value="">Semua Tipe Kamar</option>
                                <option value="standard">Standard</option>
                                <option value="deluxe">Deluxe</option>
                                <option value="suite">Suite</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="filterStatus" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="tersedia">Tersedia</option>
                                <option value="terisi">Terisi</option>
                                <option value="perbaikan">Perbaikan</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select id="filterLantai" class="form-select">
                                <option value="">Semua Lantai</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">Lantai {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    
                    <!-- Info Statistik yang Ditingkatkan -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm bg-success bg-opacity-10">
                                <div class="card-body d-flex align-items-center p-3">
                                    <div class="rounded-circle p-3 bg-success bg-opacity-25 me-3">
                                        <i class="bi bi-check-circle text-success fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">{{ $tersedia}}</h5>
                                        <p class="mb-0 text-muted small">Kamar Tersedia</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm bg-warning bg-opacity-10">
                                <div class="card-body d-flex align-items-center p-3">
                                    <div class="rounded-circle p-3 bg-warning bg-opacity-25 me-3">
                                        <i class="bi bi-person-fill text-warning fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">{{ $terisi }}</h5>
                                        <p class="mb-0 text-muted small">Kamar Terisi</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm bg-danger bg-opacity-10">
                                <div class="card-body d-flex align-items-center p-3">
                                    <div class="rounded-circle p-3 bg-danger bg-opacity-25 me-3">
                                        <i class="bi bi-tools text-danger fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">{{ $perbaikan }}</h5>
                                        <p class="mb-0 text-muted small">Kamar Perbaikan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm bg-info bg-opacity-10">
                                <div class="card-body d-flex align-items-center p-3">
                                    <div class="rounded-circle p-3 bg-info bg-opacity-25 me-3">
                                        <i class="bi bi-buildings text-info fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">{{ $tersedia + $terisi + $perbaikan }}</h5>
                                        <p class="mb-0 text-muted small">Total Kamar</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Grafik Tingkat Hunian (Baru) -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Statistik Kamar</h5>
                                </div>
                                <div class="card-body">
                                    <!-- In your statistics section -->
<div class="d-flex justify-content-between mb-1">
    <span>Tingkat Hunian</span>
    <span class="fw-medium">
        @if(($tersedia + $terisi + $perbaikan) > 0)
            {{ number_format(($terisi / ($tersedia + $terisi + $perbaikan)) * 100, 1) }}%
        @else
            0%
        @endif
    </span>
</div>
<div class="progress" style="height: 8px;">
    <div class="progress-bar bg-primary" role="progressbar" 
         style="width: {{ ($tersedia + $terisi + $perbaikan) > 0 ? (($terisi / ($tersedia + $terisi + $perbaikan)) * 100) : 0 }}%">
    </div>
</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tabel Kamar -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="kamarTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="text-center">Gambar</th>
                                    <th scope="col">
                                        <div class="d-flex align-items-center">
                                            Nomor Kamar
                                            <a href="#" class="ms-1 text-dark sort-btn" data-field="nomor_kamar">
                                                <i class="bi bi-arrow-down-up"></i>
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col">
                                        <div class="d-flex align-items-center">
                                            Tipe Kamar
                                            <a href="#" class="ms-1 text-dark sort-btn" data-field="tipe_kamar">
                                                <i class="bi bi-arrow-down-up"></i>
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col">
                                        <div class="d-flex align-items-center">
                                            Lantai
                                            <a href="#" class="ms-1 text-dark sort-btn" data-field="lantai">
                                                <i class="bi bi-arrow-down-up"></i>
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col">
                                        <div class="d-flex align-items-center">
                                            Status
                                            <a href="#" class="ms-1 text-dark sort-btn" data-field="status">
                                                <i class="bi bi-arrow-down-up"></i>
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col">Harga/Malam</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kamars as $kamar)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ Storage::url($kamar->image) }}" class="rounded" style="width: 80px; height: 60px; object-fit: cover" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $kamar->id }}" style="cursor: pointer">
                                            
                                            <!-- Modal untuk memperbesar gambar -->
                                            <div class="modal fade" id="imageModal-{{ $kamar->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Kamar {{ $kamar->nomor_kamar }} - {{ $kamar->tipe_kamar }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img src="{{ Storage::url($kamar->image) }}" class="img-fluid rounded">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-medium">{{ $kamar->nomor_kamar }}</span>
                                        </td>
                                        <td>
                                            <span class="text-capitalize">{{ $kamar->tipeKamar->nama_tipe}}</span>
                                        </td>
                                        <td>{{ $kamar->lantai }}</td>
                                        <td>
                                            @if($kamar->status == 'tersedia')
                                                <span class="badge bg-success text-white px-3 py-2 rounded-pill">Tersedia</span>
                                            @elseif($kamar->status == 'terisi')
                                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Terisi</span>
                                            @else
                                                <span class="badge bg-danger text-white px-3 py-2 rounded-pill">Perbaikan</span>
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($kamar->tipeKamar->harga, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('kamar.show', $kamar->id) }}" class="btn btn-sm btn-info text-white" data-bs-toggle="tooltip" title="Detail">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                                <a href="{{ route('kamar.edit', $kamar->id) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $kamar->id }}" data-bs-toggle="tooltip" title="Hapus">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                                
                                                <!-- Modal Konfirmasi Hapus -->
                                                <div class="modal fade" id="deleteModal-{{ $kamar->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger text-white">
                                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="text-center mb-4">
                                                                    <i class="bi bi-exclamation-triangle-fill text-warning display-1"></i>
                                                                </div>
                                                                <p class="text-center fs-5">Apakah Anda yakin ingin menghapus data kamar <strong>{{ $kamar->nomor_kamar }}</strong>?</p>
                                                                <p class="text-center text-muted">Tindakan ini tidak dapat dibatalkan!</p>
                                                            </div>
                                                            <div class="modal-footer justify-content-center">
                                                                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                                                                <form action="{{ route('kamar.destroy', $kamar->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger px-4">Ya, Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Tombol Aksi Tambahan -->
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#statusModal-{{ $kamar->id }}">
                                                                <i class="bi bi-arrow-repeat me-2"></i>Ubah Status
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('kamar.history', $kamar->id) }}">
                                                                <i class="bi bi-clock-history me-2"></i>Riwayat Kamar
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#qrModal-{{ $kamar->id }}">
                                                                <i class="bi bi-qr-code me-2"></i>Generate QR Code
                                                            </a>
                                                        </li>
                                                        <li>
                                                            {{-- <a class="dropdown-item" href="{{ route('kamar.printDetail', $kamar->id) }}"> --}}
                                                                <i class="bi bi-printer me-2"></i>Cetak Detail
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                
                                                <!-- Modal Ubah Status -->
                                                <div class="modal fade" id="statusModal-{{ $kamar->id }}" tabindex="-1" aria-hidden="true">
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
                                                
                                                <!-- Modal QR Code -->
                                                <div class="modal fade" id="qrModal-{{ $kamar->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">QR Code Kamar {{ $kamar->nomor_kamar }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <div id="qrcode-{{ $kamar->id }}" class="d-inline-block p-3 bg-white border"></div>
                                                                <p class="mt-3 mb-0">Scan untuk melihat detail kamar</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                {{-- <a href="{{ route('kamar.downloadQR', $kamar->id) }}" class="btn btn-primary"> --}}
                                                                    <i class="bi bi-download me-1"></i> Download QR
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="text-center my-5">
                                                <img src="{{ asset('images/empty.svg') }}" alt="Data Kosong" style="max-width: 200px; opacity: 0.5;" class="mb-3">
                                                <h5 class="text-muted">Data Kamar Belum Tersedia</h5>
                                                <p class="text-muted">Silakan tambahkan data kamar baru</p>
                                                <a href="{{ route('kamar.create') }}" class="btn btn-primary px-4 mt-2">
                                                    <i class="bi bi-plus-circle me-2"></i>Tambah Kamar
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Paginasi dengan Informasi -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted small">
                            Menampilkan {{ $kamars->firstItem() ?? 0 }} hingga {{ $kamars->lastItem() ?? 0 }} dari {{ $kamars->total() }} data
                        </div>
                        {{ $kamars->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Link CSS Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/qrcode.js"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Pencarian dan Filter
        $("#searchInput, #filterTipe, #filterStatus, #filterLantai").on("change keyup", function() {
            var searchValue = $("#searchInput").val().toLowerCase();
            var tipeFiler = $("#filterTipe").val().toLowerCase();
            var statusFilter = $("#filterStatus").val().toLowerCase();
            var lantaiFilter = $("#filterLantai").val().toLowerCase();
            
            $("#kamarTable tbody tr").each(function() {
                var row = $(this);
                var nomorKamar = row.find("td:nth-child(2)").text().toLowerCase();
                var tipeKamar = row.find("td:nth-child(3)").text().toLowerCase();
                var lantai = row.find("td:nth-child(4)").text().toLowerCase();
                var status = row.find("td:nth-child(5)").text().toLowerCase();
                
                var matchSearch = nomorKamar.includes(searchValue);
                var matchTipe = tipeFiler === "" || tipeKamar.includes(tipeFiler);
                var matchStatus = statusFilter === "" || status.includes(statusFilter);
                var matchLantai = lantaiFilter === "" || lantai === lantaiFilter;
                
                if (matchSearch && matchTipe && matchStatus && matchLantai) {
                    row.show();
                } else {
                    row.hide();
                }
            });
            
            // Tampilkan pesan jika tidak ada data yang cocok
            var visibleRows = $("#kamarTable tbody tr:visible").length;
            if (visibleRows === 0) {
                if ($("#noDataMsg").length === 0) {
                    $("#kamarTable tbody").append(
                        '<tr id="noDataMsg"><td colspan="7" class="text-center py-4">' +
                        '<i class="bi bi-search text-muted display-4 mb-3"></i>' +
                        '<p class="text-muted">Tidak ada data yang sesuai dengan pencarian</p>' +
                        '</td></tr>'
                    );
                }
            } else {
                $("#noDataMsg").remove();
            }
        });
        
        // Pengurutan Tabel
        $(".sort-btn").on("click", function(e) {
            e.preventDefault();
            var field = $(this).data("field");
            var direction = $(this).hasClass("asc") ? "desc" : "asc";
            
            // Reset semua ikon sort
            $(".sort-btn").removeClass("asc desc");
            $(".sort-btn i").removeClass("bi-arrow-down bi-arrow-up").addClass("bi-arrow-down-up");
            
            // Ubah ikon dan arah pengurutan
            $(this).addClass(direction);
            
            if (direction === "asc") {
                $(this).find("i").removeClass("bi-arrow-down-up").addClass("bi-arrow-up");
            } else {
                $(this).find("i").removeClass("bi-arrow-down-up").addClass("bi-arrow-down");
            }
            
            // Lakukan pengurutan
            var rows = $("#kamarTable tbody tr").get();
            rows.sort(function(a, b) {
                var A, B;
                
                if (field === "nomor_kamar") {
                    A = $(a).find("td:nth-child(2)").text().trim();
                    B = $(b).find("td:nth-child(2)").text().trim();
                } else if (field === "tipe_kamar") {
                    A = $(a).find("td:nth-child(3)").text().trim();
                    B = $(b).find("td:nth-child(3)").text().trim();
                } else if (field === "lantai") {
                    A = parseInt($(a).find("td:nth-child(4)").text().trim());
                    B = parseInt($(b).find("td:nth} else if (field === "status") {
                    A = $(a).find("td:nth-child(5)").text().trim();
                    B = $(b).find("td:nth-child(5)").text().trim();
                }
                
                if (direction === "asc") {
                    return A > B ? 1 : -1;
                } else {
                    return A < B ? 1 : -1;
                }
            });
            
            // Tambahkan kembali baris yang diurutkan ke dalam tabel
            $.each(rows, function(index, row) {
                $("#kamarTable tbody").append(row);
            });
        });
        
        // Generate Chart
        var ctx = document.getElementById('occupancyChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Kamar', 'Tersedia', 'Terisi', 'Perbaikan'],
                datasets: [{
                    label: 'Jumlah Kamar',
                    data: [
                        {{ $tersedia + $terisi + $perbaikan }}, 
                        {{ $tersedia }}, 
                        {{ $terisi }}, 
                        {{ $perbaikan }}
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(255, 99, 132, 0.5)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.raw + ' Kamar';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        }
                    }
                }
            }
        });
        
        // Generate QR Code untuk setiap kamar
        @foreach($kamars as $kamar)
            new QRCode(document.getElementById("qrcode-{{ $kamar->id }}"), {
                text: "{{ route('kamar.show', $kamar->id) }}",
                width: 128,
                height: 128,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });
        @endforeach
        
        // SweetAlert untuk notifikasi
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        @endif
        
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    });
    
    // Fungsi untuk toggle status kamar dengan AJAX
    function toggleStatus(id, currentStatus) {
        var newStatus = currentStatus === 'tersedia' ? 'terisi' : 'tersedia';
        
        $.ajax({
            url: '/kamar/' + id + '/toggle-status',
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                status: newStatus
            },
            success: function(response) {
                if(response.success) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        location.reload();
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat mengubah status kamar!'
                });
            }
        });
    }
    
    // Fungsi untuk memuat data kamar berdasarkan lantai
    function loadRoomsByFloor(floor) {
        $.ajax({
            url: '{{ route("kamar.byFloor") }}',
            type: 'GET',
            data: {
                lantai: floor
            },
            success: function(response) {
                // Kosongkan tabel
                $("#kamarTable tbody").empty();
                
                if(response.data.length > 0) {
                    // Tambahkan data kamar ke tabel
                    $.each(response.data, function(index, kamar) {
                        var row = createRoomRow(kamar);
                        $("#kamarTable tbody").append(row);
                    });
                } else {
                    // Tampilkan pesan jika tidak ada data
                    $("#kamarTable tbody").append(
                        '<tr><td colspan="7" class="text-center py-4">' +
                        '<p class="text-muted">Tidak ada kamar di lantai ' + floor + '</p>' +
                        '</td></tr>'
                    );
                }
            },
            error: function(xhr) {
                console.error('Error loading rooms by floor:', xhr);
            }
        });
    }
    
    // Fungsi untuk membuat baris tabel kamar
    function createRoomRow(kamar) {
        var statusBadge = '';
        if(kamar.status === 'tersedia') {
            statusBadge = '<span class="badge bg-success text-white px-3 py-2 rounded-pill">Tersedia</span>';
        } else if(kamar.status === 'terisi') {
            statusBadge = '<span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Terisi</span>';
        } else {
            statusBadge = '<span class="badge bg-danger text-white px-3 py-2 rounded-pill">Perbaikan</span>';
        }
        
        var row = '<tr>' +
            '<td class="text-center">' +
            '<img src="' + kamar.image_url + '" class="rounded" style="width: 80px; height: 60px; object-fit: cover" data-bs-toggle="modal" data-bs-target="#imageModal-' + kamar.id + '" style="cursor: pointer">' +
            '</td>' +
            '<td><span class="fw-medium">' + kamar.nomor_kamar + '</span></td>' +
            '<td><span class="text-capitalize">' + kamar.tipe_kamar + '</span></td>' +
            '<td>' + kamar.lantai + '</td>' +
            '<td>' + statusBadge + '</td>' +
            '<td>Rp ' + kamar.harga_formatted + '</td>' +
            '<td><div class="d-flex justify-content-center gap-2">' +
            '<a href="/kamar/' + kamar.id + '" class="btn btn-sm btn-info text-white" data-bs-toggle="tooltip" title="Detail"><i class="bi bi-eye-fill"></i></a>' +
            '<a href="/kamar/' + kamar.id + '/edit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit"><i class="bi bi-pencil-fill"></i></a>' +
            '<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-' + kamar.id + '" data-bs-toggle="tooltip" title="Hapus"><i class="bi bi-trash-fill"></i></button>' +
            '</div></td>' +
            '</tr>';
            
        return row;
    }
</script>
@endsection