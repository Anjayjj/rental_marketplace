<?php require_once '../app/views/templates/header_user.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded shadow-sm border-start border-primary border-4">
    <h4 class="m-0 fw-bold text-dark">Kelola Barang Saya</h4>
    <a href="<?= BASEURL; ?>/useritem/create" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Barang</a>
</div>

<div class="card shadow-sm border-0 bg-white">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga/Hari</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($data['items'])): ?>
                        <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada barang yang disewakan.</td></tr>
                    <?php else: ?>
                        <?php foreach($data['items'] as $item): ?>
                        <tr>
                            <td class="fw-semibold"><?= $item['name']; ?></td>
                            <td><span class="badge bg-secondary"><?= $item['category_name']; ?></span></td>
                            <td>Rp <?= number_format($item['price_daily'], 0, ',', '.'); ?></td>
                            <td><span class="badge <?= $item['status'] == 'active' ? 'bg-success' : 'bg-warning text-dark'; ?>"><?= ucfirst($item['status']); ?></span></td>
                            <td>
                                <a href="<?= BASEURL; ?>/useritem/delete/<?= $item['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus barang ini?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../app/views/templates/footer.php'; ?>