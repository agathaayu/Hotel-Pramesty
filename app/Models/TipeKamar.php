<?php

// app/Models/TipeKamar.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipeKamar extends Model
{
    protected $fillable = [
        'nama_tipe',
        'harga',
        'fasilitas'
    ];

    // Add this relationship method
    public function kamars()
    {
        return $this->hasMany(Kamar::class, 'tipe_kamar', 'id');
    }

 
    //  // Mendapatkan jumlah kamar tersedia untuk tipe ini
    //  public function getJumlahKamarTersedia()
    //  {
    //      return $this->kamar()->where('status', 'tersedia')->count();
    //  }
 
    //  // Mendapatkan semua kamar yang tersedia untuk tipe ini
    //  public function getKamarTersedia()
    //  {
    //      return $this->kamar()->where('status', 'tersedia')->get();
    //  }
 
    //  // Mendapatkan total pendapatan potensial dari semua kamar dengan tipe ini
    //  public function getPendapatanPotensial()
    //  {
    //      return $this->harga * $this->kamar()->count();
    //  } 
}