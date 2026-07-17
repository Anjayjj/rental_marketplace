<?php require_once '../app/views/templates/header_public.php'; ?>

<!-- Hero Section -->
<div class="p-5 text-center bg-white rounded-3 shadow-sm border mb-5">
    <h1 class="fw-bold text-dark mb-3">Sewa Peralatan Kapan Saja</h1>
    <p class="text-muted mb-4 fs-5">Platform terpercaya untuk menyewa dan menyewakan berbagai macam barang.</p>
    <a href="<?= BASEURL; ?>/home/explore" class="btn btn-primary btn-lg px-5 fw-semibold shadow-sm">Mulai Eksplorasi</a>
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

<?php require_once '../app/views/templates/footer_public.php'; ?>