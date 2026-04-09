<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/admin/dashboard"><i class="bi bi-shield-lock-fill me-2"></i>Admin Panel - Pengaduan Sarana Sekolah</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link text-white" href="/admin/dashboard">Dashboard</a>
                    <a class="nav-link active fw-bold" href="/admin/siswa">Data Siswa</a>
                    <a class="nav-link text-white" href="/admin/laporan">Laporan</a>
                    <form action="{{ route('logout') }}" method="POST" class="ms-lg-3">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-primary"><i class="bi bi-people-fill me-2"></i>Manajemen Data Siswa</h4>
            <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahSiswa">
                <i class="bi bi-person-plus-fill me-1"></i> Tambah Siswa Baru
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
    <thead class="table-light">
        <tr>
            <th class="ps-4">NIS</th>
            <th>Nama Siswa</th> <th>Kelas</th>
            <th>Tanggal Terdaftar</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($siswas as $s)
        <tr>
            <td class="ps-4 fw-bold text-dark">{{ $s->nis }}</td>
            <td>{{ $s->nama }}</td> <td>{{ $s->kelas }}</td>
            <td>{{ $s->created_at->format('d M Y') }}</td>
            <td class="text-center">
                <form action="/admin/siswa/delete/{{ $s->nis }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa dengan NIS {{ $s->nis }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash-fill me-1"></i> Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center p-5 text-muted">Belum ada data siswa terdaftar.</td>
        </tr>
        @endforelse
    </tbody>
</table>
                </div>
            </div>
        </div>
    </div>

   <div class="modal fade" id="modalTambahSiswa" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            
            <form action="/admin/siswa" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Siswa Manual</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
    <div class="mb-3">
        <label class="form-label fw-bold">NIS (Nomor Induk Siswa)</label>
        <input type="number" name="nis" class="form-control" placeholder="Contoh: 67890" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label fw-bold">Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" placeholder="Contoh: Ahmad Budi" required>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Kelas</label>
        <input type="text" name="kelas" class="form-control" placeholder="Contoh: XII RPL 1" required>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Password Akun</label>
        <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
        <div class="form-text">Password ini digunakan siswa untuk login.</div>
    </div>
</div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Data Siswa</button>
                </div>
            </form>
            </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
