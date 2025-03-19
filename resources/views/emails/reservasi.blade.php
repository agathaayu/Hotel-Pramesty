<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Konfirmasi Reservasi</title>
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
            background-color: #38c172;
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
        .reservation-details {
            background-color: #f8f9fa;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Konfirmasi Reservasi</h1>
        </div>
        <div class="content">
            <p>Halo <strong>{{ $reservasi->nama_tamu }}</strong>,</p>
            <p>Reservasi Anda telah berhasil dikonfirmasi. Berikut adalah detail reservasi Anda:</p>
            
            <div class="reservation-details">
                <p><strong>Kode Reservasi:</strong> {{ $reservasi->kode_reservasi }}</p>
                <p><strong>Tanggal Check-in:</strong> {{ $reservasi->tanggal_checkin }}</p>
                <p><strong>Tanggal Check-out:</strong> {{ $reservasi->tanggal_checkout }}</p>
                <p><strong>Jumlah Kamar:</strong> {{ $reservasi->jumlah_kamar }}</p>
                
                <h3>Detail Kamar:</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Nomor Kamar</th>
                            <th>Tipe Kamar</th>
                            <th>Harga per Malam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservasi->kamar_detail as $kamar)
                        <tr>
                            <td>{{ $kamar->nomor_kamar }}</td>
                            <td>{{ $kamar->tipe_kamar }}</td>
                            <td>Rp {{ number_format($kamar->harga_per_malam, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <p><strong>Total Biaya:</strong> Rp {{ number_format($reservasi->total_biaya, 0, ',', '.') }}</p>
            </div>
            
            <p>Mohon tunjukkan email ini atau kode reservasi Anda saat check-in.</p>
            <p>Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.</p>
            <p>Terima kasih telah memilih hotel kami.</p>
            <p>Salam hangat,<br>Tim Hotel</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Hotel Kami. Semua hak dilindungi.</p>
            <p>Alamat Hotel, Kota, Negara</p>
        </div>
    </div>
</body>
</html>