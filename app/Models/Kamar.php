<?php

// app/Models/Kamar.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kamar extends Model
{ 
    use HasFactory;

    // Nama tabel jika tidak mengikuti konvensi
   
    protected $table = 'kamars';

    protected $fillable = [
        'nomor_kamar',
        'tipe_kamar',
        'lantai',
        'status',
        'image'
    ];

    protected $casts = [
        'lantai' => 'integer',
        'status' => 'string'
    ];

    // Relasi ke tipe kamar
    public function tipeKamar()
    {
        return $this->belongsTo(TipeKamar::class, 'tipe_kamar', 'id');
    }
    public function histories()
    {
        return $this->hasMany(KamarHistory::class, 'kamar_id','id');
    }

    // Relasi ke tabel tipe_kamar
    // public function tipeKamar()
    // {
    //     return $this->belongsTo(TipeKamar::class, 'tipe_kamar');
    // }

    // // Scope untuk mencari kamar tersedia
    // public function scopeTersedia($query)
    // {
    //     return $query->where('status', 'tersedia');
    // }

    // // Scope untuk mencari kamar berdasarkan lantai
    // public function scopeLantai($query, $lantai)
    // {
    //     return $query->where('lantai', $lantai);
    // }

    // // Scope untuk mencari kamar berdasarkan tipe
    // public function scopeTipe($query, $tipeKamarId)
    // {
    //     return $query->where('tipe_kamar_id', $tipeKamarId);
    // }

    // // Method untuk mengubah status kamar
    // public function setStatus($status)
    // {
    //     if (in_array($status, ['tersedia', 'terisi', 'perbaikan'])) {
    //         $this->status = $status;
    //         return $this->save();
    //     }
    //     return false;
    // }

    // // Method untuk cek apakah kamar tersedia
    // public function isTersedia()
    // {
    //     return $this->status === 'tersedia';
    // }

    // // Mendapatkan harga kamar
    // public function getHarga()
    // {
    //     return $this->tipeKamar->harga;
    // }

    // // Mendapatkan fasilitas kamar
    // public function getFasilitas()
    // {
    //     return $this->tipeKamar->fasilitas;
    // }

    // // Mendapatkan detail lengkap kamar
    // public function getDetailKamar()
    // {
    //     return [
    //         'nomor_kamar' => $this->nomor_kamar,
    //         'tipe' => $this->tipeKamar->nama_tipe,
    //         'lantai' => $this->lantai,
    //         'status' => $this->status,
    //         'harga' => $this->getHarga(),
    //         'fasilitas' => $this->getFasilitas()
    //     ];
    // }
}
