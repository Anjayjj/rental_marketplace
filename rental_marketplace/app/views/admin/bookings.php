<?php require_once '../app/views/templates/header_admin.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="m-0 fw-bold">Manajemen Seluruh Transaksi</h4>
    <a href="<?= BASEURL; ?>/admin/dashboard" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Dashboard</a>
</div>

<div class="card shadow-sm border-0 mb-5">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr><th>Invoice</th><th>Penyewa</th><th>Barang</th><th>Tanggal Sewa</th><th>Total Tagihan</th><th>Status</th><th class="text-end">Aksi</th></tr>
                </thead>
                <tbody>
                    <?php if(empty($data['bookings'])): ?>
                        <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada transaksi.</td></tr>
                    <?php else: foreach($data['bookings'] as $trx): ?>
                        <tr>
                            <td class="fw-bold text-primary"><?= $trx['invoice_no']; ?></td>
                            <td><?= htmlspecialchars($trx['user_name']); ?></td>
                            <td><?= htmlspecialchars($trx['item_name']); ?></td>
                            <td><small class="d-block text-muted">Mulai: <?= date('d/m/Y', strtotime($trx['start_date'])); ?></small><small class="d-block text-muted">Selesai: <?= date('d/m/Y', strtotime($trx['end_date'])); ?></small></td>
                            <td>Rp <?= number_format($trx['grand_total'], 0, ',', '.'); ?></td>
                            <td>
                                <?php
                                    $badge = 'bg-secondary';
                                    if($trx['status'] == 'completed' || $trx['status'] == 'active') $badge = 'bg-success';
                                    if($trx['status'] == 'approved') $badge = 'bg-info text-dark';
                                    if($trx['status'] == 'pending') $badge = 'bg-warning text-dark';
                                    if($trx['status'] == 'rejected' || $trx['status'] == 'cancelled') $badge = 'bg-danger';
                                ?>
                                <span class="badge <?= $badge; ?> rounded-pill" style="font-size: 0.75rem;"><?= strtoupper($trx['status']); ?></span>
                            </td>
                            <td class="text-end">
                                <form method="POST" action="<?= BASEURL; ?>/admin/update_booking_status/<?= $trx['id']; ?>" class="d-inline">
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                                    <select name="status" class="form-select form-select-sm d-inline w-auto" onchange="this.form.submit()">
                                        <?php foreach (['pending','approved','active','completed','cancelled','rejected'] as $st): ?>
                                            <option value="<?= $st; ?>" <?= $trx['status']==$st?'selected':''; ?>><?= ucfirst($st); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </form>
                                <a href="<?= BASEURL; ?>/return/form/<?= $trx['id']; ?>" class="btn btn-sm btn-outline-primary ms-1"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../app/views/templates/footer_admin.php'; ?>
