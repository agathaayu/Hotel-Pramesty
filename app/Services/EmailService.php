<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\ReservasiNotifikasi;
use App\Mail\PembayaranKonfirmasi;
use App\Mail\PesanSelamatDatang;

class EmailService
{
    /**
     * Kirim email selamat datang ke pengguna baru
     *
     * @param object $user
     * @return void
     */
    public function kirimEmailSelamatDatang($user)
    {
        Mail::to($user->email)->send(new PesanSelamatDatang($user));
    }

    /**
     * Kirim konfirmasi reservasi ke pelanggan
     *
     * @param object $reservasi
     * @return void
     */
    public function kirimKonfirmasiReservasi($reservasi)
    {
        Mail::to($reservasi->email)->send(new ReservasiNotifikasi($reservasi));
    }

    /**
     * Kirim konfirmasi pembayaran ke pelanggan
     *
     * @param object $pembayaran
     * @return void
     */
    public function kirimKonfirmasiPembayaran($pembayaran)
    {
        Mail::to($pembayaran->reservasi->email)->send(new PembayaranKonfirmasi($pembayaran));
    }
}