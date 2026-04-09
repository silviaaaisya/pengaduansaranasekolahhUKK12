<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\Siswa;
use App\Models\Kategori;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Kita biarkan truncate untuk berjaga-jaga
        Kategori::truncate();

        // Gunakan updateOrCreate agar tidak error duplicate
        Admin::updateOrCreate(
            ['username' => 'admin'], // Cari apakah ada username 'admin'
            ['password' => Hash::make('admin123')] // Jika ada update passwordnya, jika tidak buat baru
        );

        Siswa::updateOrCreate(
            ['nis' => 12345], // Cari apakah ada siswa dengan NIS ini
            ['kelas' => 'XII RPL']
        );

        // Kategori bisa kita berikan updateOrCreate juga atau biarkan seperti ini
        Kategori::firstOrCreate(['ket_kategori' => 'Kebersihan']);
        Kategori::firstOrCreate(['ket_kategori' => 'Fasilitas Kelas']);
        Kategori::firstOrCreate(['ket_kategori' => 'Olahraga & Seni']);
        Kategori::firstOrCreate(['ket_kategori' => 'Keamanan']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}