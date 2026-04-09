<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pengaduan Sarana Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-login {
            width: 100%;
            max-width: 400px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <div class="card card-login p-4">
        <div class="text-center mb-4">
            <h4>Aplikasi Pengaduan<br>Sarana Sekolah</h4>
            <p class="text-muted">Silakan login untuk melanjutkan</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf <div class="mb-3">
                <label for="username_or_nis" class="form-label">Username / NIS</label>
                <input type="text" class="form-control" id="username_or_nis" name="username_or_nis" required placeholder="Masukkan Username atau NIS">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan Password">
            </div>

            <div class="mb-4">
                <label for="role" class="form-label">Login Sebagai</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="" disabled selected>-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="siswa">Siswa</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="text-center mt-3">
    <a href="/register" class="text-decoration-none small text-muted">Belum punya akun? Daftar sebagai Siswa</a>
</div>
<div class="text-center mt-2">
    <a href="/register-admin" class="text-decoration-none small text-primary">Daftar sebagai Admin (Petugas)</a>
</div>

</body>
</html>