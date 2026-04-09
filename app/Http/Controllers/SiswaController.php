<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InputAspirasi;
use App\Models\Aspirasi;
use App\Models\Kategori;

class SiswaController extends Controller
{
    public function index()
    {
        // Proteksi: Jika bukan siswa, tendang ke login
        if (session('role') != 'siswa') {
            return redirect('/')->with('error', 'Silakan login sebagai siswa.');
        }

        $nis = session('nis');
        $kategori = Kategori::all();
        
        // Ambil riwayat aspirasi siswa yang sedang login (Beserta statusnya)
        $aspirasi_saya = InputAspirasi::with('aspirasi', 'kategori')
                        ->where('nis', $nis)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('siswa.dashboard', compact('kategori', 'aspirasi_saya'));
    }

    public function store(Request $request)
    {
        // Validasi input sederhana
        $request->validate([
            'id_kategori' => 'required',
            'lokasi' => 'required|max:50',
            'ket' => 'required|max:50',
        ]);

        // 1. Simpan ke tabel input_aspirasi
        $input = InputAspirasi::create([
            'nis' => session('nis'),
            'id_kategori' => $request->id_kategori,
            'lokasi' => $request->lokasi,
            'ket' => $request->ket,
        ]);

        // 2. Otomatis buat record di tabel aspirasi dengan status "Menunggu"
        Aspirasi::create([
            'id_pelaporan' => $input->id_pelaporan,
            'status' => 'Menunggu',
            'feedback' => null
        ]);

        return back()->with('success', 'Aspirasi berhasil dikirim!');
    }
}