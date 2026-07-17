<?php require_once '../app/views/templates/header_public.php'; ?>

<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h3 class="fw-bold text-dark mb-1">Eksplorasi Barang</h3>
        <p class="text-muted small">Temukan peralatan yang Anda butuhkan untuk disewa hari ini.</p>
    </div>
    <div class="col-md-6">
        <form action="<?= BASEURL; ?>/home/explore" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2 bg-white" placeholder="Cari tenda, kamera, proyektor..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-search"></i></button>
        </form>
    </div>
</div>

<div class="row g-4">
    <!-- Filter Kategori Kiri -->
    <div class="col-lg-3">
        <div class="card shadow-sm border-0 bg-white">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3 text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Kategori</h6>
                <div class="list-group list-group-flush">
                    <a href="<?= BASEURL; ?>/home/explore" class="list-group-item list-group-item-action border-0 px-0 <?= !isset($_GET['category']) ? 'text-primary fw-bold' : 'text-muted'; ?>">Semua Kategori</a>
                    <?php if(isset($data['categories'])): ?>
                        <?php foreach($data['categories'] as $cat): ?>
                            <a href="<?= BASEURL; ?>/home/explore?category=<?= $cat['id']; ?>" class="list-group-item list-group-item-action border-0 px-0 <?= (isset($_GET['category']) && $_GET['category'] == $cat['id']) ? 'text-primary fw-bold' : 'text-muted'; ?>">
                                <?= $cat['name']; ?>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Grid Produk Kanan -->
    <div class="col-lg-9">
        <?php if(empty($data['items'])): ?>
            <div class="text-center py-5">
                <i class="fas fa-box-open fs-1 text-muted mb-3"></i>
                <h5 class="fw-bold text-dark">Barang tidak ditemukan</h5>
                <p class="text-muted">Coba ubah kata kunci pencarian atau pilih kategori lain.</p>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach($data['items'] as $item): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0 bg-white">
                             <img src="<?= BASEURL; ?>/assets/uploads/items/<?= $item['cover_image'] ?? 'default.jpg'; ?>" class="card-img-top object-fit-cover p-2 rounded" style="height: 180px;" alt="<?= htmlspecialchars($item['name']); ?>">
                            <div class="card-body d-flex flex-column">
                                <span class="badge bg-light text-secondary mb-2 align-self-start border"><?= $item['category_name']; ?></span>
                                <h6 class="card-title fw-bold text-dark text-truncate mb-1"><?= $item['name']; ?></h6>
                                <p class="text-primary fw-bold mb-3 mt-auto">Rp <?= number_format($item['price_daily'], 0, ',', '.'); ?> <span class="text-muted fw-normal" style="font-size: 0.8rem;">/hari</span></p>
                                <a href="<?= BASEURL; ?>/item/detail/<?= $item['slug']; ?>" class="btn btn-outline-primary w-100 fw-semibold">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../app/views/templates/footer_public.php'; ?>