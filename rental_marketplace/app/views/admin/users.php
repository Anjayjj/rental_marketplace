<?php require_once '../app/views/templates/header_admin.php'; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="m-0">Manajemen Pengguna</h4>
        <a href="<?= BASEURL; ?>/admin/dashboard" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <!-- Area Notifikasi -->
    <?php if(isset($_SESSION['flash_success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if(isset($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0 mb-5">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Profil</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>No. Handphone</th>
                            <th>Tanggal Daftar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['users'])): ?>
                            <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada pengguna terdaftar.</td></tr>
                        <?php else: ?>
                            <?php foreach($data['users'] as $user): ?>
                            <tr>
                                <td>
                                    <img src="<?= BASEURL; ?>/assets/uploads/avatars/<?= $user['avatar'] ?? 'default.png'; ?>" class="rounded-circle border" style="width: 40px; height: 40px; object-fit: cover;">
                                </td>
                                <td class="fw-bold"><?= $user['name']; ?></td>
                                <td><?= $user['email']; ?></td>
                                <td><?= $user['phone']; ?></td>
                                <td><?= date('d M Y, H:i', strtotime($user['created_at'])); ?></td>
                                <td class="text-center">
                                    <a href="<?= BASEURL; ?>/admin/delete_user/<?= $user['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('PERINGATAN: Menghapus pengguna ini akan menghapus seluruh data barang dan riwayat transaksinya! Lanjutkan?')">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/templates/footer_admin.php'; ?>
