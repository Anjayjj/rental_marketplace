<?php require_once '../app/views/templates/header_admin.php'; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="m-0">Manajemen Seluruh Transaksi</h4>
        <a href="<?= BASEURL; ?>/admin/dashboard" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div class="card shadow-sm border-0 mb-5">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Invoice</th>
                            <th>Penyewa</th>
                            <th>Barang</th>
                            <th>Tanggal Sewa</th>
                            <th>Total Tagihan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['bookings'])): ?>
                            <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada transaksi.</td></tr>
                        <?php else: ?>
                            <?php foreach($data['bookings'] as $trx): ?>
                            <tr>
                                <td class="fw-bold text-primary"><?= $trx['invoice_no']; ?></td>
                                <td><?= $trx['user_name']; ?></td>
                                <td><?= $trx['item_name']; ?></td>
                                <td>
                                    <small class="d-block text-muted">Mulai: <?= date('d/m/Y', strtotime($trx['start_date'])); ?></small>
                                    <small class="d-block text-muted">Selesai: <?= date('d/m/Y', strtotime($trx['end_date'])); ?></small>
                                </td>
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
                                <td>
                                    <a href="<?= BASEURL; ?>/return/form/<?= $trx['id']; ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i> Cek</a>
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
