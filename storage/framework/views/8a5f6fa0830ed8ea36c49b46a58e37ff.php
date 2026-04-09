<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pengaduan Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md border border-slate-100">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-slate-800">Layanan Pengaduan</h1>
            <p class="text-slate-500 text-sm mt-1">Silakan masuk ke akun Anda</p>
        </div>

        <?php if(session('error')): ?>
            <div class="bg-red-100 text-red-600 p-3 rounded-lg text-sm mb-4 text-center">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>
        <?php if(session('success')): ?>
            <div class="bg-green-100 text-green-600 p-3 rounded-lg text-sm mb-4 text-center">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('login.proses')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="mb-5">
                <label class="block text-sm font-medium text-slate-700 mb-2">Masuk Sebagai</label>
                <select name="role" id="role" onchange="toggleForm()" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 outline-none bg-slate-50">
                    <option value="siswa">Siswa</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div id="form-siswa" class="mb-5">
                <label class="block text-sm font-medium text-slate-700 mb-2">Nomor Induk Siswa (NIS)</label>
                <input type="number" name="nis" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 outline-none">
            </div>

            <div id="form-admin" class="hidden">
                <div class="mb-5">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Username Admin</label>
                    <input type="text" name="username" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 outline-none">
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 outline-none">
                </div>
            </div>

            <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-medium py-2.5 rounded-lg transition">
                Masuk Sekarang
            </button>
        </form>
    </div>

    <script>
        function toggleForm() {
            let role = document.getElementById('role').value;
            let formSiswa = document.getElementById('form-siswa');
            let formAdmin = document.getElementById('form-admin');
            if (role === 'admin') {
                formSiswa.classList.add('hidden');
                formAdmin.classList.remove('hidden');
            } else {
                formAdmin.classList.add('hidden');
                formSiswa.classList.remove('hidden');
            }
        }
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\pengaduansaranasekolahhUKK12\resources\views/login.blade.php ENDPATH**/ ?>