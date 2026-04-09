<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Siswa;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Membuat data Kategori
        Kategori::create(['ket_kategori' => 'Kebersihan']);
        Kategori::create(['ket_kategori' => 'Fasilitas Kelas']);
        Kategori::create(['ket_kategori' => 'Alat Olahraga']);
Kategori::create(['ket_kategori' => 'Laboratorium']);

        // 2. Membuat akun Admin Dummy
        Admin::create([
            'username' => 'admin',
            'password' => Hash::make('123456')
        ]);

        // 3. Membuat akun Siswa Dummy
        Siswa::create([
            'nis' => 12345,
            'kelas' => 'XII',
            'password' => Hash::make('123456')
        ]);
    }
}