<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Kamar - Pramesti Hotel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0 30px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header .logo {
            max-width: 100px;
            margin-bottom: 10px;
        }
        .header .hotel-name {
            font-size: 24px;
            font-weight: bold;
            margin: 5px 0;
        }
        .header .address {
            font-size: 14px;
            line-height: 1.5;
        }
        .document-title {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }
        table thead tr {
            background-color:rgb(90, 155, 205); /* Warna biru keunguan cerah */
            color: #fff;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
        }
        table th {
            border: 1px solidrgb(90, 171, 205);
        }
        table td {
            border: 1px solid #ddd;
        }
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="header">
        <!-- Pastikan file logo berada di public/images/logo.png -->
        <img src="{{ public_path('images/logo.png') }}" alt="Logo" class="logo">
        <div class="hotel-name">Pramesti Hotel</div>
        <div class="address">
            Jl. Senyum Lebar No. 50, Daerah Bahagia<br>
            Telp: (021) 12345678 | Email: info@pramestihotel.com
        </div>
    </div>
    
    <div class="document-title">Data Kamar</div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Kamar</th>
                <th>Tipe Kamar</th>
                <th>Lantai</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kamars as $index => $kamar)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $kamar->nomor_kamar }}</td>
                <td>{{ $kamar->tipeKamar->nama_tipe ?? '-' }}</td>
                <td>{{ $kamar->lantai }}</td>
                <td>{{ $kamar->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>