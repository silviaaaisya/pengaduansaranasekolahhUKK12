<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - Pengaduan Sarana Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --earth-dark: #4e342e;
            --earth-medium: #795548;
            --earth-light: #d7ccc8;
        }
        body { background-color: #f8f9fa; }
        .navbar { background-color: var(--earth-dark) !important; }
        .card-stats { border: none; border-radius: 12px; transition: 0.3s; }
        .card-stats:hover { transform: translateY(-5px); }
        .btn-earth { background-color: var(--earth-medium); color: white; border: none; }
        .btn-earth:hover { background-color: var(--earth-dark); color: white; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="bi bi-megaphone-fill me-2"></i>Aspirasi Siswa</a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3 small">NIS: {{ Auth::guard('siswa')->user()->nis }} (Kelas {{ Auth::guard('siswa')->user()->kelas }})</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card card-stats bg-white shadow-sm p-3 mb-2">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-light p-3 me-3"><i class="bi bi-list-task text-primary"></i></div>
                        <div>
                            <h6 class="mb-0 text-muted">Total Aduan</h6>
                            <h4 class="mb-0 fw-bold">{{ $total }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stats bg-white shadow-sm p-3 mb-2">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-light p-3 me-3"><i class="bi bi-gear-fill text-warning"></i></div>
                        <div>
                            <h6 class="mb-0 text-muted">Dalam Progres</h6>
                            <h4 class="mb-0 fw-bold">{{ $proses }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stats bg-white shadow-sm p-3 mb-2">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-light p-3 me-3"><i class="bi bi-check-circle-fill text-success"></i></div>
                        <div>
                            <h6 class="mb-0 text-muted">Selesai</h6>
                            <h4 class="mb-0 fw-bold">{{ $selesai }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <h5 class="card-title fw-bold mb-3">Buat Pengaduan Baru</h5>
        
        @if(session('success'))
            <div class="alert alert-success border-0 small">
                {{ session('success') }}
            </div>
        @endif

        <form action="/siswa/aspirasi" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label small fw-bold">Kategori Sarana</label>
                <select name="id_kategori" class="form-select" required>
                    <option value="" selected disabled>-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id_kategori }}">{{ $k->ket_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">Lokasi Kejadian</label>
                <input type="text" name="lokasi" class="form-control" placeholder="Misal: Lab Komputer 1" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">Keterangan Masalah</label>
                <textarea name="ket" class="form-control" rows="4" placeholder="Jelaskan secara detail..." required></textarea>
            </div>

            <div class="mb-4">
        <label class="form-label small fw-bold">Upload Foto Bukti (Opsional)</label>
        <input type="file" name="foto" class="form-control" accept="image/*">
        <div class="form-text small">Format: JPG, JPEG, PNG. Maksimal 2MB.</div>
    </div>

            <button type="submit" class="btn btn-earth w-100 fw-bold">Kirim Sekarang</button>
        </form>
    </div>
</div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white p-3 border-0">
                        <h5 class="mb-0 fw-bold">Histori Pengaduan & Feedback</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">Detail Aduan</th>
                                        <th>Status</th>
                                        <th>Feedback Admin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($aspirasis as $a)
                                    @php
                                        $statusData = \App\Models\Aspirasi::where('id_pelaporan', $a->id_pelaporan)->first();
                                    @endphp
                                    <tr>
                                        <td class="ps-3">
                                            <div class="fw-bold text-primary">#{{ $a->id_pelaporan }} - {{ $a->kategori->ket_kategori }}</div>
                                            <div class="small text-muted"><i class="bi bi-geo-alt"></i> {{ $a->lokasi }}</div>
                                            <div class="small mt-1">{{ Str::limit($a->ket, 50) }}</div>
                                        </td>
                                        <td>
                                            <span class="badge @if($statusData->status == 'Menunggu') bg-warning text-dark @elseif($statusData->status == 'Proses') bg-info @else bg-success @endif">
                                                {{ $statusData->status }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($statusData->feedback)
                                                <div class="p-2 rounded bg-light small border-start border-primary border-3">
                                                    {{ $statusData->feedback }}
                                                </div>
                                            @else
                                                <span class="text-muted small italic">Menunggu tanggapan...</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center p-5 text-muted">Belum ada histori pengaduan.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <a class="navbar-brand" href="/siswa/dashboard"><i class="bi bi-megaphone-fill me-2"></i>Aspirasi Siswa</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item">
            <span class="nav-link text-white me-3 small d-none d-lg-block">NIS: {{ Auth::guard('siswa')->user()->nis }}</span>
        </li>
        <li class="nav-item">
            <a class="nav-link active fw-bold" href="/siswa/dashboard">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="/siswa/histori">Histori Saya</a> </li>
        <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
            </form>
        </li>
    </ul>
</div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>