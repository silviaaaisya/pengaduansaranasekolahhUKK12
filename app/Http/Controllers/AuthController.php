<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    // --- REGISTER SISWA ---
    public function register() { return view('auth.register'); }

    public function storeRegister(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswas,nis|numeric',
            'username' => 'required|unique:siswas,username|alpha_dash', // Validasi Username
            'kelas' => 'required|max:10',
            'password' => 'required|min:6|confirmed',
        ]);

        Siswa::create([
    'nis' => $request->nis,
    'username' => $request->username, // Pastikan tulisannya 'username'
    'kelas' => $request->kelas,
    'password' => Hash::make($request->password),
]);

        return redirect('/')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // --- REGISTER ADMIN ---
    public function registerAdmin() { return view('auth.register_admin'); }

    public function storeRegisterAdmin(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:admins,username|max:50',
            'password' => 'required|min:6|confirmed',
        ]);

        Admin::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/')->with('success', 'Registrasi Admin berhasil!');
    }

    // --- LOGIN & LOGOUT ---
    public function login(Request $request)
    {
        $request->validate([
            'username_or_nis' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        if ($request->role == 'admin') {
            // Login Admin (Tetap menggunakan Username)
            $kredensial = [
                'username' => $request->username_or_nis,
                'password' => $request->password
            ];
            
            if (Auth::guard('admin')->attempt($kredensial)) {
                return redirect()->intended('/admin/dashboard');
            }

        } else if ($request->role == 'siswa') {
            // LOGIN SISWA (Bisa NIS atau Username)
            // Cek: Jika inputnya angka semua, maka anggap sebagai 'nis'. Jika bukan, anggap 'username'.
            $field = filter_var($request->username_or_nis, FILTER_VALIDATE_INT) ? 'nis' : 'username';
            
            $kredensial = [
                $field => $request->username_or_nis,
                'password' => $request->password
            ];

            if (Auth::guard('siswa')->attempt($kredensial)) {
                return redirect()->intended('/siswa/dashboard');
            }
        }

        return back()->with('error', 'Username/NIS atau Password salah!');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) { Auth::guard('admin')->logout(); }
        elseif (Auth::guard('siswa')->check()) { Auth::guard('siswa')->logout(); }
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}