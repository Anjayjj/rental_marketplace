<div class="container-fluid mt-4">
    <h2 class="mb-4">Validasi Pembayaran</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Menunggu Verifikasi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No Invoice</th>
                            <th>Bank/Metode</th>
                            <th>Total Tagihan (Rp)</th>
                            <th>Bukti Transfer</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Asumsikan data ini didapatkan dari Controller Admin yang melooping array $data['payments'] -->
                        <?php foreach($data['payments'] as $payment) : ?>
                        <tr>
                            <td><strong><?= $payment['invoice_no']; ?></strong></td>
                            <td><?= $payment['payment_method']; ?></td>
                            <td class="text-danger fw-bold">
                                <?= number_format($payment['amount'], 0, ',', '.'); ?>
                            </td>
                            <td>
                                <!-- Tombol untuk membuka gambar Bukti Transfer di Tab Baru -->
                                <a href="<?= BASEURL; ?>/assets/uploads/payments/<?= $payment['proof_image']; ?>" 
                                   target="_blank" class="btn btn-sm btn-outline-info">
                                   Lihat Bukti
                                </a>
                            </td>
                            <td>
                                <form action="<?= BASEURL; ?>/adminpayment/verifikasi" method="POST" class="d-inline">
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                                    <input type="hidden" name="payment_id" value="<?= $payment['id']; ?>">
                                    <input type="hidden" name="booking_id" value="<?= $payment['booking_id']; ?>">
                                    
                                    <button type="submit" name="action" value="verify" class="btn btn-sm btn-success" 
                                            onclick="return confirm('Yakin ingin menerima pembayaran ini?');">
                                        Terima
                                    </button>
                                    <button type="submit" name="action" value="reject" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Yakin ingin menolak pembayaran ini?');">
                                        Tolak
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>