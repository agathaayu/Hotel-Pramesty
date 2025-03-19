<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Website Sistem Manajemen Kamar Hotel Kami</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #1a365d;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .logo {
            max-width: 150px;
            height: auto;
        }
        .content {
            padding: 20px;
            background-color: #ffffff;
        }
        .footer {
            background-color: #f5f5f5;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #666666;
        }
        .button {
            display: inline-block;
            background-color: #1a365d;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
        }
        .room-info {
            background-color: #f9f9f9;
            border-left: 4px solid #1a365d;
            padding: 15px;
            margin: 20px 0;
        }
        .social-links {
            margin-top: 15px;
        }
        .social-links a {
            margin: 0 10px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="/api/placeholder/150/50" alt="Logo Hotel" class="logo" />
            <h1>Selamat Datang!</h1>
        </div>
        
        <div class="content">
            <p>Halo <strong>{{nama}}</strong>,</p>
            
            <p>Terima kasih telah mendaftar di sistem manajemen kamar hotel kami. Kami sangat senang Anda bergabung dengan kami!</p>
            
            <p>Dengan menggunakan akun Anda, Anda dapat:</p>
            <ul>
                <li>Melihat informasi kamar yang tersedia</li>
                <li>Mengakses detail fasilitas dan layanan hotel</li>
                <li>Mengelola reservasi kamar</li>
                <li>Melihat histori kunjungan Anda</li>
            </ul>
            
            <div class="room-info">
                <p>Saat ini kami memiliki:</p>
                <ul>
                    <li><strong>{{tersedia}}</strong> kamar tersedia</li>
                    <li><strong>{{terisi}}</strong> kamar terisi</li>
                    <li>Berbagai tipe kamar dengan harga mulai dari <strong>Rp {{harga_terendah}}</strong> per malam</li>
                </ul>
            </div>
            
            <p>Untuk memulai, silakan klik tombol di bawah ini untuk login ke akun Anda:</p>
            <center>
                <a href="{{login_url}}" class="button">Login ke Akun Anda</a>
            </center>
            
            <p>Jika Anda memiliki pertanyaan atau membutuhkan bantuan, jangan ragu untuk menghubungi tim layanan pelanggan kami melalui email <a href="mailto:info@hotel.com">info@hotel.com</a> atau telepon di <strong>+62 123 4567 890</strong>.</p>
            
            <p>Salam hangat,<br>
            Tim Hotel</p>
        </div>
        
        <div class="footer">
            <p>© 2025 Hotel Management System. Seluruh hak cipta dilindungi.</p>
            <p>Alamat Hotel, Jalan Contoh No. 123, Kota, Indonesia</p>
            
            <div class="social-links">
                <a href="#">Facebook</a> |
                <a href="#">Instagram</a> |
                <a href="#">Twitter</a>
            </div>
            
            <p>Anda menerima email ini karena Anda telah mendaftar di website kami.<br>
            Jika Anda tidak ingin menerima email dari kami di masa mendatang, <a href="{{unsubscribe_url}}">klik di sini untuk berhenti berlangganan</a>.</p>
        </div>
    </div>
</body>
</html>