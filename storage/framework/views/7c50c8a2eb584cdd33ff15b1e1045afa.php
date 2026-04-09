<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Aspirasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="bi bi-shield-lock-fill me-2"></i>Admin Panel - Pengaduan Sarana Sekolah</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active fw-bold" href="/admin/dashboard">Dashboard</a>
                    <a class="nav-link text-white" href="/admin/siswa">Data Siswa</a>
                    <a class="nav-link text-white" href="/admin/kategori">Kategori</a>
                    <a class="nav-link text-white" href="/admin/laporan">Laporan</a>
                    <form action="<?php echo e(route('logout')); ?>" method="POST" class="ms-lg-3">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <?php if(session('success')): ?>
            <div class="alert alert-success border-0 shadow-sm mb-4"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-primary">Daftar Aspirasi Masuk</h5>
                <a href="/admin/laporan" class="btn btn-success btn-sm shadow-sm">
                    <i class="bi bi-printer-fill me-1"></i> Buka Laporan & Cetak
                </a>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">ID</th>
                                <th>Siswa (NIS)</th>
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $aspirasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="ps-3">#<?php echo e($asp->id_pelaporan); ?></td>
                                <td class="fw-bold"><?php echo e($asp->inputAspirasi->nis); ?></td>
                                <td><?php echo e($asp->inputAspirasi->kategori->ket_kategori); ?></td>
                                <td><?php echo e($asp->inputAspirasi->lokasi); ?></td>
                                <td><?php echo e(Str::limit($asp->inputAspirasi->ket, 30)); ?></td>
                                <td>
                                    <span class="badge <?php if($asp->status == 'Menunggu'): ?> bg-warning text-dark <?php elseif($asp->status == 'Proses'): ?> bg-info <?php else: ?> bg-success <?php endif; ?>">
                                        <?php echo e($asp->status); ?>

                                    </span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalUpdate<?php echo e($asp->id_aspirasi); ?>">
                                        Beri Umpan Balik
                                    </button>

                                    <div class="modal fade" id="modalUpdate<?php echo e($asp->id_aspirasi); ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="/admin/aspirasi/update/<?php echo e($asp->id_aspirasi); ?>" method="POST" class="modal-content">
                                                <?php echo csrf_field(); ?>
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Aspirasi #<?php echo e($asp->id_pelaporan); ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Ubah Status</label>
                                                        <select name="status" class="form-select">
                                                            <option value="Menunggu" <?php echo e($asp->status == 'Menunggu' ? 'selected' : ''); ?>>Menunggu</option>
                                                            <option value="Proses" <?php echo e($asp->status == 'Proses' ? 'selected' : ''); ?>>Proses</option>
                                                            <option value="Selesai" <?php echo e($asp->status == 'Selesai' ? 'selected' : ''); ?>>Selesai</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Umpan Balik (Feedback)</label>
                                                        <textarea name="feedback" class="form-control" rows="3" placeholder="Tulis tanggapan untuk siswa..."><?php echo e($asp->feedback); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\xampp\htdocs\pengaduansaranasekolahhUKK12\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>