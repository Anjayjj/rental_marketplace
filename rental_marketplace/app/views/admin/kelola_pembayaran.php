<?php require_once '../app/views/templates/header_admin.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold text-dark">Verifikasi Pembayaran</h4>
        <p class="text-muted small mb-0">Tinjau dan validasi bukti transfer penyewa.</p>
    </div>
    <a href="<?= BASEURL; ?>/admin/dashboard" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-white py-3">
        <h6 class="m-0 fw-bold text-primary">Daftar Menunggu Verifikasi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No Invoice</th>
                        <th>Penyewa</th>
                        <th>Barang</th>
                        <th>Metode</th>
                        <th>Total (Rp)</th>
                        <th>Bukti</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($data['payments'])): ?>
                        <tr><td colspan="7" class="text-center py-4 text-muted">Tidak ada pembayaran yang menunggu verifikasi.</td></tr>
                    <?php else: ?>
                        <?php foreach($data['payments'] as $payment): ?>
                        <tr>
                            <td class="fw-semibold text-primary"><?= $payment['invoice_no']; ?></td>
                            <td><?= htmlspecialchars($payment['user_name']); ?></td>
                            <td><?= htmlspecialchars($payment['item_name']); ?></td>
                            <td><?= htmlspecialchars($payment['payment_method']); ?></td>
                            <td class="text-danger fw-bold"><?= number_format($payment['amount'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="<?= BASEURL; ?>/assets/uploads/payments/<?= htmlspecialchars($payment['proof_image']); ?>" target="_blank" class="btn btn-sm btn-outline-info">Lihat Bukti</a>
                            </td>
                            <td class="text-center">
                                <form action="<?= BASEURL; ?>/adminpayment/verifikasi" method="POST" class="d-inline">
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? ''; ?>">
                                    <input type="hidden" name="payment_id" value="<?= $payment['id']; ?>">
                                    <input type="hidden" name="booking_id" value="<?= $payment['booking_id']; ?>">
                                    <button type="submit" name="action" value="verify" class="btn btn-sm btn-success" onclick="return confirm('Yakin menerima pembayaran ini?')">Terima</button>
                                    <button type="submit" name="action" value="reject" class="btn btn-sm btn-danger" onclick="return confirm('Yakin menolak pembayaran ini?')">Tolak</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../app/views/templates/footer_admin.php'; ?>
