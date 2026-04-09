<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/admin/dashboard">Admin Panel - Pengaduan Sarana Sekolah</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link text-white" href="/admin/dashboard">Dashboard</a>
                <a class="nav-link text-white" href="/admin/siswa">Data Siswa</a>
                <a class="nav-link text-white fw-bold" href="/admin/kategori">Kategori</a>
                <a class="nav-link text-white" href="/admin/laporan">Laporan</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Tambah Kategori</h5>
                        <form action="/admin/kategori" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label class="form-label">Nama Kategori</label>
                                <input type="text" name="ket_kategori" class="form-control" placeholder="Misal: Alat Olahraga" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Simpan Kategori</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <?php if(session('success')): ?>
                    <div class="alert alert-success border-0 shadow-sm"><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <?php if(session('error')): ?>
                    <div class="alert alert-danger border-0 shadow-sm"><?php echo e(session('error')); ?></div>
                <?php endif; ?>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-bold">Daftar Kategori</div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">ID</th>
                                    <th>Nama Kategori</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="ps-3"><?php echo e($k->id_kategori); ?></td>
                                    <td><?php echo e($k->ket_kategori); ?></td>
                                    <td class="text-center">
                                        <form action="/admin/kategori/<?php echo e($k->id_kategori); ?>" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\xampp\htdocs\pengaduansaranasekolahhUKK12\resources\views/admin/kategori.blade.php ENDPATH**/ ?>