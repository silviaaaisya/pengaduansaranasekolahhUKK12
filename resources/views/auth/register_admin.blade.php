<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin - Pengaduan Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card-register { width: 100%; max-width: 400px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    <div class="card card-register p-4 border-primary">
        <div class="text-center mb-4">
            <h4 class="text-primary">Daftar Akun Admin</h4>
            <p class="text-muted">Khusus Petugas / Administrator</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger p-2 small">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif

        <form action="/register-admin" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Username Admin</label>
                <input type="text" name="username" class="form-control" required placeholder="Contoh: admin_sarpras">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">Daftar Admin</button>
            <div class="text-center">
                <a href="/" class="text-decoration-none small text-muted">Kembali ke Login</a>
            </div>
        </form>
    </div>

</body>
</html>