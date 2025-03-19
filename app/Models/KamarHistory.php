<?php

// 1. Buat model KamarHistory
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KamarHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'kamar_id',
        'status_lama',
        'status_baru',
        'keterangan',
        'diubah_oleh'
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'diubah_oleh');
    }
}
