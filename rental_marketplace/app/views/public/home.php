<?php require_once '../app/views/templates/header_public.php'; ?>

<?php if(isset($_SESSION['flash_success'])): ?>
    <div class="alert alert-success alert-dismissible fade show"><?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<!-- HERO -->
<section class="hero p-5 p-lg-5 mb-5">
    <div class="row align-items-center">
        <div class="col-lg-7">
            <span class="badge bg-white text-brand mb-3 px-3 py-2 rounded-pill fw-semibold">✨ Platform Sewa P2P #1 di Indonesia</span>
            <h1 class="display-5 fw-bold mb-3">Sewa apa pun,<br>Kapan pun, Di mana pun.</h1>
            <p class="lead mb-4 opacity-75">Dari kamera profesional, peralatan camping, hingga kendaraan — tersedia untuk disewa dengan harga terjangkau dan proses yang mudah.</p>
            <form action="<?= BASEURL; ?>/home/explore" method="GET" class="search-hero mb-3">
                <i class="fas fa-search text-muted ms-2"></i>
                <input type="text" name="search" class="form-control" placeholder="Mau sewa apa hari ini?">
                <button class="btn btn-brand px-4 fw-semibold" type="submit">Cari</button>
            </form>
            <div class="small opacity-75"><i class="fas fa-shield-alt me-1"></i> Transaksi aman &nbsp;·&nbsp; <i class="fas fa-badge-check me-1"></i> Penyedia terverifikasi &nbsp;·&nbsp; <i class="fas fa-headset me-1"></i> Bantuan 24/7</div>
        </div>
        <div class="col-lg-5 d-none d-lg-block text-center">
            <i class="fas fa-box-open" style="font-size:9rem; opacity:.25;"></i>
        </div>
    </div>
</section>

<!-- CATEGORIES -->
<section class="mb-5">
    <div class="section-head">
        <h3>Belanja berdasarkan kategori</h3>
        <a href="<?= BASEURL; ?>/home/explore" class="text-brand fw-semibold small">Lihat semua <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="row g-3">
        <?php if(isset($data['categories'])): foreach($data['categories'] as $c): ?>
            <div class="col-6 col-md-3">
                <a href="<?= BASEURL; ?>/home/explore?category=<?= $c['id']; ?>" class="cat-tile">
                    <div class="ic"><i class="<?= htmlspecialchars($c['icon'] ?? 'fas fa-tag'); ?>"></i></div>
                    <div class="fw-bold"><?= htmlspecialchars($c['name']); ?></div>
                </a>
            </div>
        <?php endforeach; endif; ?>
    </div>
</section>

<!-- POPULAR ITEMS -->
<section class="mb-5">
    <div class="section-head">
        <h3>Barang Populer</h3>
        <a href="<?= BASEURL; ?>/home/explore" class="text-brand fw-semibold small">Eksplorasi katalog <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="row g-4">
        <?php if(empty($data['items'])): ?>
            <div class="col-12 empty-state"><i class="fas fa-box-open"></i><p>Belum ada barang tersedia.</p></div>
        <?php else: foreach($data['items'] as $item): ?>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-card h-100">
                    <div class="thumb">
                        <a href="<?= BASEURL; ?>/item/detail/<?= $item['slug']; ?>">
                            <img src="<?= BASEURL; ?>/assets/uploads/items/<?= $item['cover_image'] ?? 'default.jpg'; ?>" alt="<?= htmlspecialchars($item['name']); ?>">
                        </a>
                    </div>
                    <div class="body d-flex flex-column">
                        <span class="badge bg-light text-secondary mb-2 align-self-start border" style="font-weight:600;"><?= htmlspecialchars($item['category_name']); ?></span>
                        <a href="<?= BASEURL; ?>/item/detail/<?= $item['slug']; ?>" class="name text-dark mb-2"><?= htmlspecialchars($item['name']); ?></a>
                        <div class="mt-auto d-flex justify-content-between align-items-end">
                            <div class="price">Rp <?= number_format($item['price_daily'], 0, ',', '.'); ?> <small>/hari</small></div>
                            <a href="<?= BASEURL; ?>/item/detail/<?= $item['slug']; ?>" class="btn btn-brand btn-sm"><i class="fas fa-cart-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; endif; ?>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="mb-5">
    <div class="section-head"><h3>Cara menyewa di RentalMarket</h3></div>
    <div class="row g-4">
        <div class="col-md-4"><div class="step-box"><div class="num">1</div><h6 class="fw-bold">Cari & Pilih</h6><p class="text-muted small mb-0">Temukan barang yang kamu butuhkan dan pilih tanggal sewa.</p></div></div>
        <div class="col-md-4"><div class="step-box"><div class="num">2</div><h6 class="fw-bold">Pesan & Bayar</h6><p class="text-muted small mb-0">Ajukan sewa, upload bukti pembayaran, tunggu verifikasi.</p></div></div>
        <div class="col-md-4"><div class="step-box"><div class="num">3</div><h6 class="fw-bold">Gunakan & Kembalikan</h6><p class="text-muted small mb-0">Ambil barang, gunakan, lalu kembalikan dengan mudah.</p></div></div>
    </div>
</section>

<!-- CTA menjadi penyedia -->
<section class="hero p-5 text-center mb-2">
    <h2 class="fw-bold mb-2">Punya barang menganggur?</h2>
    <p class="lead mb-4 opacity-75">Jadikan barangmu sumber penghasilan. Pasang iklan sewa dalam 2 menit, gratis!</p>
    <a href="<?= BASEURL; ?>/useritem/create" class="btn btn-light btn-lg fw-bold px-4"><i class="fas fa-plus me-1"></i> Mulai Sewakan Sekarang</a>
</section>

<?php require_once '../app/views/templates/footer_public.php'; ?>
