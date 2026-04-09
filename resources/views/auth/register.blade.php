<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Siswa - Pengaduan Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card-register { width: 100%; max-width: 450px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    <div class="card card-register p-4">
        <div class="text-center mb-4">
            <h4>Daftar Akun Siswa</h4>
            <p class="text-muted">Lengkapi data untuk membuat akun</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/register" method="POST">
            @csrf
           <div class="mb-3">
    <label class="form-label">NIS</label>
    <input type="number" name="nis" class="form-control" required>
</div>

<div class="mb-3">
    <label class="form-label">Username</label>
    <input type="text" name="username" class="form-control" placeholder="Contoh: budi_rpl" required>
</div>

<div class="mb-3">
    <label class="form-label">Kelas</label>
    <input type="text" name="kelas" class="form-control" required>
</div>
           <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="password" class="form-control" required>
</div>

<div class="mb-3">
    <label class="form-label">Konfirmasi Password</label>
    <input type="password" name="password_confirmation" class="form-control" required>
</div>
            <button type="submit" class="btn btn-success w-100 mb-3">Daftar Sekarang</button>
            <div class="text-center">
                <a href="/" class="text-decoration-none small text-muted">Sudah punya akun? Login di sini</a>
            </div>
        </form>
    </div>

</body>
</html>