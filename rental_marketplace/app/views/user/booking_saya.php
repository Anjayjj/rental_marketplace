<?php require_once '../app/views/templates/header_user.php'; ?>

<?php if(isset($_SESSION['flash_success'])): ?>
    <div class="alert alert-success alert-dismissible fade show"><?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded shadow-sm border-start border-primary border-4">
    <h4 class="m-0 fw-bold text-dark">Riwayat Sewa Anda</h4>
</div>

<div class="card shadow-sm border-0 bg-white">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr><th>Invoice</th><th>Barang</th><th>Tgl Sewa</th><th>Total Bayar</th><th>Status</th></tr>
                </thead>
                <tbody>
                    <?php if(empty($data['bookings'])): ?>
                        <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada riwayat penyewaan.</td></tr>
                    <?php else: ?>
                        <?php foreach($data['bookings'] as $trx): ?>
                        <tr>
                            <td class="fw-semibold text-primary"><?= $trx['invoice_no']; ?></td>
                            <td><?= $trx['item_name']; ?></td>
                            <td><small class="text-muted"><?= $trx['start_date']; ?> <br>s/d<br> <?= $trx['end_date']; ?></small></td>
                            <td class="fw-semibold">Rp <?= number_format($trx['grand_total'], 0, ',', '.'); ?></td>
                            <td><span class="badge bg-secondary"><?= strtoupper($trx['status']); ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../app/views/templates/footer.php'; ?>