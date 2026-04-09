<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirasis', function (Blueprint $table) {
            $table->integer('id_aspirasi')->autoIncrement();
            $table->integer('id_pelaporan');
            $table->enum('status', ['Menunggu', 'Proses', 'Selesai'])->default('Menunggu');
            $table->integer('id_kategori');
            $table->text('feedback')->nullable(); // Diubah jadi text agar bisa diketik kalimat
            $table->timestamps();

            // Relasi ke input_aspirasi
            $table->foreign('id_pelaporan')->references('id_pelaporan')->on('input_aspirasis')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};