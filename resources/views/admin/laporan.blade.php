<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Aspirasi - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
            .card { border: none !important; box-shadow: none !important; }
        }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary mb-4 no-print">
        <div class="container">
            <a class="navbar-brand" href="/admin/dashboard">Kembali ke Dashboard</a>
        </div>
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Laporan Pengaduan Sarana Sekolah</h3>
            <p>Rekapitulasi Aspirasi Siswa</p>
        </div>

        <div class="card shadow-sm mb-4 no-print">
            <div class="card-body">
                <form action="/admin/laporan" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Kategori</label>
                        <select name="id_kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $k)
                                <option value="{{ $k->id_kategori }}" {{ request('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                                    {{ $k->ket_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Awal</label>
                        <input type="date" name="tgl_awal" class="form-control" value="{{ request('tgl_awal') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Akhir</label>
                        <input type="date" name="tgl_akhir" class="form-control" value="{{ request('tgl_akhir') }}">
                    </div>
                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                        <button type="button" onclick="window.print()" class="btn btn-success w-100">Cetak</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>NIS</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan as $key => $l)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $l->created_at->format('d/m/Y') }}</td>
                            <td>{{ $l->inputAspirasi->nis }}</td>
                            <td>{{ $l->inputAspirasi->kategori->ket_kategori }}</td>
                            <td>{{ $l->inputAspirasi->lokasi }}</td>
                            <td>{{ $l->inputAspirasi->ket }}</td>
                            <td>{{ $l->status }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Data tidak ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>