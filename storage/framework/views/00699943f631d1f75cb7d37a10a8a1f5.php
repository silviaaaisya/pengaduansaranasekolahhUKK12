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
                            <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($k->id_kategori); ?>" <?php echo e(request('id_kategori') == $k->id_kategori ? 'selected' : ''); ?>>
                                    <?php echo e($k->ket_kategori); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Awal</label>
                        <input type="date" name="tgl_awal" class="form-control" value="<?php echo e(request('tgl_awal')); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Akhir</label>
                        <input type="date" name="tgl_akhir" class="form-control" value="<?php echo e(request('tgl_akhir')); ?>">
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
                        <?php $__empty_1 = true; $__currentLoopData = $laporan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($key + 1); ?></td>
                            <td><?php echo e($l->created_at->format('d/m/Y')); ?></td>
                            <td><?php echo e($l->inputAspirasi->nis); ?></td>
                            <td><?php echo e($l->inputAspirasi->kategori->ket_kategori); ?></td>
                            <td><?php echo e($l->inputAspirasi->lokasi); ?></td>
                            <td><?php echo e($l->inputAspirasi->ket); ?></td>
                            <td><?php echo e($l->status); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center">Data tidak ditemukan</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html><?php /**PATH C:\xampp\htdocs\pengaduansaranasekolahhUKK12\resources\views/admin/laporan.blade.php ENDPATH**/ ?>