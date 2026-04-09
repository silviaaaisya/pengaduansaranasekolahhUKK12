<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;

    protected $table = 'aspirasis'; // Nama tabel di database
    protected $primaryKey = 'id_aspirasi'; // Primary key-nya

    // TARUH DI SINI: Memberi izin kolom mana saja yang boleh diisi
    protected $fillable = [
        'id_pelaporan', 
        'id_kategori', 
        'status', 
        'feedback'
    ];

    // Relasi ke tabel InputAspirasi (pelaporan)
    public function inputAspirasi()
    {
        return $this->belongsTo(InputAspirasi::class, 'id_pelaporan', 'id_pelaporan');
    }
}