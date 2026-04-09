<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\InputAspirasi;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil semua data aspirasi beserta relasi inputnya agar efisien
        $aspirasis = Aspirasi::with('inputAspirasi.kategori')->orderBy('created_at', 'desc')->get();
        return view('admin.dashboard', compact('aspirasis'));
    }

    // Tambahkan fungsi ini di dalam AdminController.php
// Pastikan ditaruh di dalam class AdminController
    public function laporan(Request $request)
    {
        // Mengambil semua data dengan relasi yang sudah kita perbaiki tadi
        $query = \App\Models\Aspirasi::with(['inputAspirasi.kategori']);

        // Fitur Plus UKK: Filter berdasarkan status (Opsional tapi bikin nilai A)
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $aspirasis = $query->orderBy('created_at', 'desc')->get();
        
        return view('admin.laporan', compact('aspirasis'));
    }

// Tambahkan fungsi-fungsi ini di dalam AdminController.php

// Tambahkan fungsi-fungsi ini di dalam AdminController.php

public function siswa()
{
    // Mengambil semua data siswa urut berdasarkan NIS terkecil
    $siswas = \App\Models\Siswa::orderBy('nis', 'asc')->get();
 return view('admin.data_siswa', compact('siswas'));
}

public function storeSiswa(Request $request)
{
    // Validasi agar tidak ada NIS ganda
    $request->validate([
        'nis' => 'required|numeric|unique:siswas,nis',
        'kelas' => 'required',
        'password' => 'required|min:6'
    ]);

    \App\Models\Siswa::create([
        'nis' => $request->nis,
        'kelas' => $request->kelas,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
    ]);

    return redirect('/admin/siswa')->with('success', 'Siswa baru berhasil ditambahkan!');
}

public function destroySiswa($nis)
{
    \App\Models\Siswa::where('nis', $nis)->delete();
    return redirect('/admin/siswa')->with('success', 'Data siswa berhasil dihapus!');
}

// Tambahkan ini di dalam AdminController.php

public function kategori()
{
    $kategoris = \App\Models\Kategori::all();
    return view('admin.kategori', compact('kategoris'));
}

public function storeKategori(Request $request)
{
    $request->validate([
        'ket_kategori' => 'required|unique:kategoris,ket_kategori'
    ]);

    \App\Models\Kategori::create([
        'ket_kategori' => $request->ket_kategori
    ]);

    return back()->with('success', 'Kategori baru berhasil ditambahkan!');
}

public function destroyKategori($id)
{
    // Cek dulu apakah kategori ini sedang dipakai di tabel aspirasi
    $cek = \App\Models\InputAspirasi::where('id_kategori', $id)->count();
    
    if ($cek > 0) {
        return back()->with('error', 'Kategori tidak bisa dihapus karena sedang digunakan dalam laporan siswa!');
    }

    \App\Models\Kategori::where('id_kategori', $id)->delete();
    return back()->with('success', 'Kategori berhasil dihapus!');
}

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'feedback' => 'nullable|string'
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update([
            'status' => $request->status,
            'feedback' => $request->feedback
        ]);

        return back()->with('success', 'Status dan feedback berhasil diperbarui!');
    }
}
