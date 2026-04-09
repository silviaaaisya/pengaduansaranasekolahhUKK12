<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use App\Models\Aspirasi;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    public function dashboardSiswa()
    {
        // 1. Ambil NIS siswa yang login
    $nis = Auth::guard('siswa')->user()->nis;
    
    // 2. Ambil semua kategori untuk dropdown
    $kategori = \App\Models\Kategori::all();

    // TAMBAHKAN BARIS INI UNTUK DEBUGGING:
    //dd($kategori); 

    // ... sisa kode di bawahnya biarkan saja ...

        // 3. Ambil histori aspirasi milik siswa ini
        $aspirasis = InputAspirasi::with('kategori')
                    ->where('nis', $nis)
                    ->orderBy('id_pelaporan', 'desc')
                    ->get();

        // 4. Hitung statistik untuk dashboard
        $total = Aspirasi::whereHas('inputAspirasi', function($q) use ($nis) {
                    $q->where('nis', $nis);
                 })->count();

        $proses = Aspirasi::where('status', 'Proses')
                 ->whereHas('inputAspirasi', function($q) use ($nis) {
                    $q->where('nis', $nis);
                 })->count();

        $selesai = Aspirasi::where('status', 'Selesai')
                 ->whereHas('inputAspirasi', function($q) use ($nis) {
                    $q->where('nis', $nis);
                 })->count();

        // 5. Kirim semua ke view (Pastikan baris return ini ada di paling bawah sebelum kurung tutup fungsi)
        return view('siswa.dashboard', compact('kategori', 'aspirasis', 'total', 'proses', 'selesai'));
    }

    // Tambahkan fungsi ini di dalam AspirasiController.php
public function histori()
{
    // Ambil NIS siswa yang sedang login
    $nis = Auth::guard('siswa')->user()->nis;

    // Ambil data aspirasi khusus milik siswa ini saja
    $aspirasis = \App\Models\InputAspirasi::with('kategori')
                ->where('nis', $nis)
                ->orderBy('id_pelaporan', 'desc')
                ->get();

    return view('siswa.histori', compact('aspirasis'));
}

    public function store(Request $request)
{
    // Validasi data dan foto
    $request->validate([
        'id_kategori' => 'required',
        'lokasi' => 'required',
        'ket' => 'required',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto
    ]);

    // Proses Upload Foto
    $pathFoto = null;
    if ($request->hasFile('foto')) {
        // Menyimpan foto ke folder storage/app/public/foto_bukti
        $pathFoto = $request->file('foto')->store('foto_bukti', 'public');
    }

    // Simpan ke tabel InputAspirasi
    $simpan = \App\Models\InputAspirasi::create([
        'nis' => Auth::guard('siswa')->user()->nis,
        'id_kategori' => $request->id_kategori,
        'lokasi' => $request->lokasi,
        'ket' => $request->ket,
        'foto' => $pathFoto, // Simpan nama file foto ke database
    ]);

    // Simpan ke tabel Aspirasi (Histori/Status)
    \App\Models\Aspirasi::create([
        'id_pelaporan' => $simpan->id_pelaporan,
        'id_kategori' => $request->id_kategori,
        'status' => 'Menunggu',
    ]);

    return back()->with('success', 'Aspirasi dan foto bukti berhasil dikirim!');
}
}