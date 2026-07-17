<?php require_once '../app/views/templates/header_user.php'; ?>

<!-- Konten Dashboard Tanpa Pembungkus Grid -->
<div class="d-flex align-items-center mb-4 bg-white p-4 rounded shadow-sm border-start border-primary border-4">
    <img src="<?= BASEURL; ?>/assets/uploads/avatars/<?= $_SESSION['user_avatar'] ?? 'default.png'; ?>" class="rounded-circle shadow-sm me-4 border object-fit-cover" style="width: 80px; height: 80px;">
    <div>
        <h3 class="mb-1 fw-bold text-dark">Selamat datang, <?= explode(' ', $_SESSION['user_name'])[0]; ?>!</h3>
        <span class="text-muted"><i class="fas fa-calendar-alt me-2 text-primary"></i> Hari ini: <strong><?= date('d F Y'); ?></strong> | Pantau dan kelola aktivitas sewa Anda.</span>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card bg-white p-2">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-success fw-bold text-uppercase mb-0"><i class="fas fa-store me-2"></i>Sebagai Pemilik</h6>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">Vendor Mode</span>
                </div>
                <p class="text-muted mb-4 small">Kelola barang yang Anda sewakan, pantau ketersediaan, dan tinjau pesanan masuk dari pelanggan.</p>
                <div class="d-flex gap-2">
                    <a href="<?= BASEURL; ?>/useritem/create" class="btn btn-success flex-grow-1"><i class="fas fa-plus me-1"></i> Tambah</a>
                    <a href="<?= BASEURL; ?>/useritem/index" class="btn btn-outline-success flex-grow-1">Kelola Barang</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card bg-white p-2">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-primary fw-bold text-uppercase mb-0"><i class="fas fa-shopping-cart me-2"></i>Sebagai Penyewa</h6>
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">Customer Mode</span>
                </div>
                <p class="text-muted mb-4 small">Lacak status penyewaan Anda, cek tagihan pembayaran, dan eksplorasi katalog barang terbaru.</p>
                <div class="d-flex gap-2">
                    <a href="<?= BASEURL; ?>/home/explore" class="btn btn-primary flex-grow-1"><i class="fas fa-search me-1"></i> Eksplorasi</a>
                    <a href="<?= BASEURL; ?>/booking/saya" class="btn btn-outline-primary flex-grow-1">Riwayat Sewa</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/templates/footer.php'; ?>