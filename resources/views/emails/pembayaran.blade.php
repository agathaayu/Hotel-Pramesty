<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Konfirmasi Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .header {
            background-color: #8A2BE2; /* Diganti dari #f6993f (oranye) ke #8A2BE2 (ungu) */
            color: white;
            padding: 10px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
        }
        .payment-details {
            background-color: #f8f9fa;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
        }
        .success {
            color: #38c172;
            font-weight: bold;
        }
        .button {
            display: inline-block;
            background-color: #8A2BE2; /* Diganti dari #f6993f (oranye) ke #8A2BE2 (ungu) */
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Konfirmasi Pembayaran</h1>
        </div>
        <div class="content">
            <p>Halo <strong>{{ $pembayaran->reservasi->nama_tamu }}</strong>,</p>
            <p>Pembayaran Anda telah berhasil diproses. Berikut adalah detail pembayaran Anda:</p>
            
            <div class="payment-details">
                <p><strong>Kode Pembayaran:</strong> {{ $pembayaran->kode_pembayaran }}</p>
                <p><strong>Kode Reservasi:</strong> {{ $pembayaran->reservasi->kode_reservasi }}</p>
                <p><strong>Tanggal Pembayaran:</strong> {{ $pembayaran->tanggal_pembayaran }}</p>
                <p><strong>Metode Pembayaran:</strong> {{ $pembayaran->metode_pembayaran }}</p>
                <p><strong>Jumlah Pembayaran:</strong> Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</p>
                <p><strong>Status:</strong> <span class="success">LUNAS</span></p>
            </div>
            
            <p>Detail reservasi Anda:</p>
            <div class="payment-details">
                <p><strong>Nama Kamar:</strong> {{ $pembayaran->reservasi->kamar->nama_kamar }}</p>
                <p><strong>Tanggal Check-in:</strong> {{ $pembayaran->reservasi->tanggal_checkin }}</p>
                <p><strong>Tanggal Check-out:</strong> {{ $pembayaran->reservasi->tanggal_checkout }}</p>
                <p><strong>Jumlah Malam:</strong> {{ $pembayaran->reservasi->jumlah_malam }}</p>
            </div>
            
            <p>Tanda terima ini adalah bukti pembayaran resmi. Silakan simpan untuk referensi Anda.</p>
            
            <p>Untuk melihat detail reservasi Anda, silakan klik tombol di bawah ini:</p>
            <a href="{{ route('reservasi.detail', $pembayaran->reservasi->kode_reservasi) }}" class="button">Lihat Detail Reservasi</a>
            
            <p>Jika Anda memiliki pertanyaan lebih lanjut, silakan hubungi kami di:</p>
            <p>Email: info@penginapan.com<br>
            Telepon: +62 123 4567 890</p>
            
            <p>Terima kasih telah memilih layanan kami!</p>
            
            <p>Hormat kami,<br>
            Tim Penginapan</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Penginapan. Semua hak dilindungi.</p>
            <p>Alamat: Jl. Pemandangan Indah No. 123, Kota Indah, Indonesia</p>
        </div>
    </div>
</body>
</html>