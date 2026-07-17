<?php require_once '../app/views/templates/header_user.php'; ?>

<?php if(isset($_SESSION['flash_success'])): ?>
    <div class="alert alert-success alert-dismissible fade show"><?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>
<?php if(isset($_SESSION['flash_error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show"><?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded shadow-sm border-start border-primary border-4">
    <h4 class="m-0 fw-bold text-dark">Riwayat Sewa Anda</h4>
</div>

<div class="card shadow-sm border-0 bg-white">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr><th>Invoice</th><th>Barang</th><th>Tgl Sewa</th><th>Total Bayar</th><th>Status</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    <?php if(empty($data['bookings'])): ?>
                        <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada riwayat penyewaan.</td></tr>
                    <?php else: ?>
                        <?php foreach($data['bookings'] as $trx): ?>
                            <?php
                                $badge = 'bg-secondary';
                                if($trx['status'] == 'completed' || $trx['status'] == 'active') $badge = 'bg-success';
                                if($trx['status'] == 'approved') $badge = 'bg-info text-dark';
                                if($trx['status'] == 'pending') $badge = 'bg-warning text-dark';
                                if($trx['status'] == 'rejected' || $trx['status'] == 'cancelled') $badge = 'bg-danger';
                            ?>
                            <tr>
                                <td class="fw-semibold text-primary"><?= $trx['invoice_no']; ?></td>
                                <td><?= htmlspecialchars($trx['item_name']); ?></td>
                                <td><small class="text-muted"><?= $trx['start_date']; ?> <br>s/d<br> <?= $trx['end_date']; ?></small></td>
                                <td class="fw-semibold">Rp <?= number_format($trx['grand_total'], 0, ',', '.'); ?></td>
                                <td><span class="badge <?= $badge; ?> rounded-pill"><?= ucfirst($trx['status']); ?></span></td>
                                <td>
                                    <?php if($trx['status'] == 'pending'): ?>
                                        <a href="<?= BASEURL; ?>/payment/invoice/<?= $trx['id']; ?>" class="btn btn-sm btn-primary">Bayar</a>
                                    <?php else: ?>
                                        <span class="text-muted small">-</span>
                                    <?php endif; ?>
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
