<div class="container mt-4">
    <div class="row">
        <!-- Rincian Invoice -->
        <div class="col-md-7">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Invoice: <span class="text-primary"><?= $data['booking']['invoice_no']; ?></span></h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td class="text-muted">Status</td>
                            <td><span class="badge bg-warning text-dark">Menunggu Pembayaran</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Barang</td>
                            <td class="fw-bold"><?= $data['booking']['item_name']; ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Durasi Sewa</td>
                            <td><?= $data['booking']['start_date']; ?> s/d <?= $data['booking']['end_date']; ?> (<?= $data['booking']['duration']; ?> Hari)</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Harga Sewa</td>
                            <td>Rp <?= number_format($data['booking']['total_price'], 0, ',', '.'); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Biaya Admin</td>
                            <td>Rp <?= number_format($data['booking']['admin_fee'], 0, ',', '.'); ?></td>
                        </tr>
                        <tr class="border-top">
                            <td class="text-muted fw-bold">Total Pembayaran</td>
                            <td class="fw-bold fs-5 text-danger">Rp <?= number_format($data['booking']['grand_total'], 0, ',', '.'); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Form Upload Bukti -->
        <div class="col-md-5">
            <div class="card shadow-sm border-primary">
                <div class="card-body">
                    <h5 class="card-title">Upload Bukti Transfer</h5>
                    <p class="text-muted small">Silakan transfer ke <strong>BCA 123456789 a/n Rental Marketplace</strong></p>
                    
                    <form action="<?= BASEURL; ?>/payment/upload" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                        <input type="hidden" name="booking_id" value="<?= $data['booking']['id']; ?>">
                        <input type="hidden" name="amount" value="<?= $data['booking']['grand_total']; ?>">

                        <div class="mb-3">
                            <label class="form-label">Metode Pembayaran</label>
                            <select name="payment_method" class="form-select" required>
                                <option value="BCA">Transfer Bank BCA</option>
                                <option value="Mandiri">Transfer Bank Mandiri</option>
                                <option value="Gopay">GoPay</option>
                                <option value="Ovo">OVO</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Bukti Transfer (JPG/PNG, Max 2MB)</label>
                            <input type="file" name="proof_image" class="form-control" accept="image/jpeg, image/png" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Kirim Bukti Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>