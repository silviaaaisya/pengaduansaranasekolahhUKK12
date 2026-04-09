<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('input_aspirasis', function (Blueprint $table) {
            $table->integer('id_pelaporan')->autoIncrement();
            $table->integer('nis');
            $table->integer('id_kategori');
            $table->string('lokasi', 50);
            $table->string('ket', 50);
            $table->string('foto')->nullable(); // TAMBAHKAN BARIS INI
            $table->timestamps();

            // Relasi ke tabel siswa dan kategori
            $table->foreign('nis')->references('nis')->on('siswas')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('input_aspirasis');
    }
};