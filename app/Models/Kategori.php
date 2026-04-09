<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $primaryKey = 'id_kategori'; // Ini sangat penting!
    
    // Pastikan ini ada agar bisa ditambah datanya
    protected $fillable = ['ket_kategori']; 
    
    public $timestamps = false; // Jika di tabelmu tidak ada created_at/updated_at, biarkan ini ada. Jika ada, hapus baris ini.
}