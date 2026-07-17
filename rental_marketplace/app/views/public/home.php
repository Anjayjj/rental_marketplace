<?php require_once '../app/views/templates/header_public.php'; ?>

<!-- Hero Section -->
<div class="p-5 text-center bg-white rounded-3 shadow-sm border mb-5 position-relative overflow-hidden">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(26,37,47,0.03), rgba(26,37,47,0.08));"></div>
    <div class="position-relative">
        <span class="badge bg-light text-primary border mb-3 px-3 py-2 rounded-pill fw-semibold">Platform Rental P2P #1</span>
        <h1 class="fw-bold text-dark mb-3 display-5">Sewa Peralatan Kapan Saja</h1>
        <p class="text-muted mb-4 fs-5 mx-auto" style="max-width: 600px;">Platform terpercaya untuk menyewa dan menyewakan berbagai macam barang dengan sistem booking otomatis & transparan.</p>
        <div class="d-flex justify-content-center gap-2 flex-wrap">
            <a href="<?= BASEURL; ?>/home/explore" class="btn btn-primary btn-lg px-5 fw-semibold shadow-sm">Mulai Eksplorasi</a>
            <a href="<?= BASEURL; ?>/auth/register" class="btn btn-outline-primary btn-lg px-4 fw-semibold">Daftar Gratis</a>
        </div>
    </div>
</div>

<!-- Keunggulan -->
<div class="row g-4 text-center mb-5">
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm bg-white p-4">
            <i class="fas fa-shield-alt fs-1 text-primary mb-3"></i>
            <h5 class="fw-bold text-dark">Aman & Terpercaya</h5>
            <p class="text-muted small mb-0">Semua transaksi dan pengguna diverifikasi oleh sistem kami.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm bg-white p-4">
            <i class="fas fa-wallet fs-1 text-primary mb-3"></i>
            <h5 class="fw-bold text-dark">Harga Terbaik</h5>
            <p class="text-muted small mb-0">Temukan barang dengan harga sewa harian yang terjangkau.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm bg-white p-4">
            <i class="fas fa-handshake fs-1 text-primary mb-3"></i>
            <h5 class="fw-bold text-dark">Mudah Digunakan</h5>
            <p class="text-muted small mb-0">Sistem booking yang otomatis dan transparan.</p>
        </div>
    </div>
</div>

<!-- Katalog Terbaru -->
<div class="d-flex justify-content-between align-items-end mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">Barang Terbaru</h3>
        <p class="text-muted small mb-0">Peralatan pilihan yang baru saja ditambahkan ke katalog kami.</p>
    </div>
    <a href="<?= BASEURL; ?>/home/explore" class="btn btn-outline-primary fw-semibold">Lihat Semua <i class="fas fa-arrow-right ms-1"></i></a>
</div>

<div class="row g-4">
    <?php if(empty($data['items'])): ?>
        <div class="col-12 text-center py-5">
            <i class="fas fa-box-open fs-1 text-muted mb-3"></i>
            <h5 class="fw-bold text-dark">Belum ada barang</h5>
            <p class="text-muted">Jadilah yang pertama menyewakan barang Anda.</p>
        </div>
    <?php else: ?>
        <?php foreach($data['items'] as $item): ?>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0 bg-white">
                    <img src="<?= BASEURL; ?>/assets/uploads/items/<?= $item['cover_image'] ?? 'default.jpg'; ?>" class="card-img-top object-fit-cover p-2 rounded" style="height: 170px;" alt="<?= htmlspecialchars($item['name']); ?>">
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-light text-secondary mb-2 align-self-start border"><?= htmlspecialchars($item['category_name']); ?></span>
                        <h6 class="card-title fw-bold text-dark text-truncate mb-1"><?= htmlspecialchars($item['name']); ?></h6>
                        <p class="text-primary fw-bold mb-3 mt-auto">Rp <?= number_format($item['price_daily'], 0, ',', '.'); ?> <span class="text-muted fw-normal" style="font-size: 0.8rem;">/hari</span></p>
                        <a href="<?= BASEURL; ?>/item/detail/<?= $item['slug']; ?>" class="btn btn-outline-primary w-100 fw-semibold">Lihat Detail</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once '../app/views/templates/footer_public.php'; ?>
