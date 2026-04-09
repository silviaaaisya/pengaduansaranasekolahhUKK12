<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Pengaduan - Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --earth-dark: #4e342e;
            --earth-medium: #795548;
        }
        body { background-color: #f8f9fa; }
        .navbar { background-color: var(--earth-dark) !important; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="/siswa/dashboard"><i class="bi bi-megaphone-fill me-2"></i>Aspirasi Siswa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/siswa/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold border-bottom border-2 border-white" href="/siswa/histori">Histori Saya</a>
                    </li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold"><i class="bi bi-clock-history me-2"></i>Riwayat Pengaduan Saya</h4>
            <a href="/siswa/dashboard" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">No. Tiket</th>
                                <th>Tanggal</th>
                                <th>Detail Laporan</th>
                                <th>Status Progres</th>
                                <th>Tanggapan Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($aspirasis as $a)
                            @php
                                $statusData = \App\Models\Aspirasi::where('id_pelaporan', $a->id_pelaporan)->first();
                            @endphp
                            <tr>
                                <td class="ps-4 fw-bold">#{{ $a->id_pelaporan }}</td>
                                <td>{{ $a->created_at->format('d M Y') }}</td>
                                <td>
    <span class="badge bg-secondary mb-1">{{ $a->kategori->ket_kategori }}</span>
    <div class="small fw-bold">{{ $a->lokasi }}</div>
    <div class="small text-muted mb-2">{{ Str::limit($a->ket, 50) }}</div>
    
    @if($a->foto)
        <a href="{{ asset('storage/' . $a->foto) }}" target="_blank">
            <img src="{{ asset('storage/' . $a->foto) }}" alt="Foto Bukti" class="img-thumbnail mt-1" style="max-height: 80px; object-fit: cover;">
        </a>
    @else
        <span class="badge bg-light text-dark border small"><i class="bi bi-camera-video-off"></i> Tidak ada foto</span>
    @endif
</td>
                                
                                <td style="min-width: 200px;">
                                    <div class="mb-1 fw-bold small
                                        @if($statusData->status == 'Menunggu') text-warning 
                                        @elseif($statusData->status == 'Proses') text-info 
                                        @else text-success @endif">
                                        <i class="bi bi-activity"></i> Status: {{ $statusData->status }}
                                    </div>

                                    <div class="progress" style="height: 10px; border-radius: 10px;">
                                        @if($statusData->status == 'Menunggu')
                                            <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" style="width: 33%"></div>
                                        @elseif($statusData->status == 'Proses')
                                            <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" style="width: 66%"></div>
                                        @elseif($statusData->status == 'Selesai')
                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                        @endif
                                    </div>

                                    <div class="d-flex justify-content-between mt-1" style="font-size: 0.70rem;">
                                        <span class="text-dark fw-bold">Terkirim</span>
                                        <span class="{{ $statusData->status == 'Proses' || $statusData->status == 'Selesai' ? 'text-dark fw-bold' : 'text-muted' }}">Diproses</span>
                                        <span class="{{ $statusData->status == 'Selesai' ? 'text-dark fw-bold' : 'text-muted' }}">Selesai</span>
                                    </div>
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
                                <td colspan="5" class="text-center p-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    Kamu belum memiliki riwayat pengaduan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>