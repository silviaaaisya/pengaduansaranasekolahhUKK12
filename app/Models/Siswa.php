<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    protected $table = 'siswas';
    protected $primaryKey = 'nis';
    public $incrementing = false;

    // TAMBAHKAN 'username' DI SINI
    protected $fillable = ['nis', 'username', 'kelas', 'password'];

    protected $hidden = ['password'];
}