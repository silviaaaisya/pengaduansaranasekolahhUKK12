<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputAspirasi extends Model
{
    protected $table = 'input_aspirasis';
    protected $primaryKey = 'id_pelaporan';

    protected $fillable = ['nis', 'id_kategori', 'lokasi', 'ket', 'foto'];

    // 1. Relasi ke tabel Siswa (Jika butuh menampilkan nama siswa)
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    // 2. TAMBAHKAN RELASI INI (Ini yang dicari oleh Laravel dan bikin error tadi!)
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}