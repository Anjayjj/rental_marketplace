<?php require_once '../app/views/templates/header_public.php'; ?>

<?php if(isset($_SESSION['flash_error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show"><?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="row g-4">
    <div class="col-lg-3">
        <div class="filter-box mb-3">
            <h6 class="fw-bold mb-3"><i class="fas fa-filter me-1 text-brand"></i> Filter</h6>
            <form method="GET" action="<?= BASEURL; ?>/home/explore" id="filterForm">
                <input type="hidden" name="search" value="<?= htmlspecialchars($data['search_q'] ?? ''); ?>">
                <label class="form-label small fw-semibold">Kategori</label>
                <select name="category" class="form-select form-select-sm mb-3">
                    <option value="">Semua Kategori</option>
                    <?php foreach($data['categories'] as $cat): ?>
                        <option value="<?= $cat['id']; ?>" <?= (($data['search_cat'] ?? '') == $cat['id']) ? 'selected' : ''; ?>><?= htmlspecialchars($cat['name']); ?></option>
                    <?php endforeach; ?>
                </select>
                <label class="form-label small fw-semibold">Rentang Harga / hari</label>
                <input type="range" class="price-range w-100 mb-1" min="20000" max="700000" step="10000" value="<?= $data['max_price'] ?? 700000; ?>" name="max_price" id="priceRange">
                <div class="d-flex justify-content-between small text-muted"><span>Rp 20rb</span><span id="priceLabel">Rp <?= number_format($data['max_price'] ?? 700000, 0, ',', '.'); ?></span></div>
                <hr class="my-3">
                <label class="form-label small fw-semibold">Urutkan</label>
                <select name="sort" class="form-select form-select-sm">
                    <option value="terbaru" <?= (($data['sort'] ?? 'terbaru')=='terbaru')?'selected':''; ?>>Terbaru</option>
                    <option value="murah" <?= (($data['sort'] ?? '')=='murah')?'selected':''; ?>>Harga Termurah</option>
                    <option value="mahal" <?= (($data['sort'] ?? '')=='mahal')?'selected':''; ?>>Harga Termahal</option>
                    <option value="nama" <?= (($data['sort'] ?? '')=='nama')?'selected':''; ?>>Nama A-Z</option>
                </select>
                <button class="btn btn-brand btn-sm w-100 mt-3"><i class="fas fa-check me-1"></i> Terapkan</button>
            </form>
        </div>
        <a href="<?= BASEURL; ?>/home/explore" class="btn btn-outline-secondary btn-sm w-100"><i class="fas fa-sync me-1"></i> Reset Filter</a>
    </div>

    <div class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <div>
                <h4 class="fw-bold mb-0">Katalog Barang</h4>
                <small class="text-muted"><?= count($data['items'] ?? []); ?> barang ditemukan<?= !empty($data['search_q']) ? ' untuk "'.htmlspecialchars($data['search_q']).'"' : ''; ?></small>
            </div>
            <form method="GET" action="<?= BASEURL; ?>/home/explore" class="d-flex align-items-center gap-2">
                <input type="hidden" name="category" value="<?= htmlspecialchars($data['search_cat'] ?? ''); ?>">
                <input type="hidden" name="search" value="<?= htmlspecialchars($data['search_q'] ?? ''); ?>">
                <select name="sort" class="form-select form-select-sm sort-select" onchange="this.form.submit()">
                    <option value="terbaru" <?= (($data['sort'] ?? 'terbaru')=='terbaru')?'selected':''; ?>>Terbaru</option>
                    <option value="murah" <?= (($data['sort'] ?? '')=='murah')?'selected':''; ?>>Harga Termurah</option>
                    <option value="mahal" <?= (($data['sort'] ?? '')=='mahal')?'selected':''; ?>>Harga Termahal</option>
                    <option value="nama" <?= (($data['sort'] ?? '')=='nama')?'selected':''; ?>>Nama A-Z</option>
                </select>
            </form>
        </div>

        <?php if(empty($data['items'])): ?>
            <div class="empty-state bg-white rounded border"><div class="empty-art"><i class="fas fa-search"></i></div><h6 class="fw-bold text-dark">Tidak ada barang</h6><p>Coba kata kunci atau kategori lain.</p>
                <a href="<?= BASEURL; ?>/home/explore" class="btn btn-brand">Lihat Semua</a></div>
        <?php else: ?>
            <div class="row g-4" id="catalogGrid">
                <?php foreach($data['items'] as $item): ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="product-card h-100">
                            <div class="thumb">
                                <a href="<?= BASEURL; ?>/item/detail/<?= $item['slug']; ?>"><img loading="lazy" src="<?= BASEURL; ?>/assets/uploads/items/<?= $item['cover_image'] ?? 'default.jpg'; ?>" alt="<?= htmlspecialchars($item['name']); ?>"></a>
                                <button class="fav" data-item="<?= $item['id']; ?>" title="Wishlist"><i class="far fa-heart"></i></button>
                            </div>
                            <div class="body d-flex flex-column">
                                <span class="badge bg-light text-secondary mb-2 align-self-start border" style="font-weight:600;"><?= htmlspecialchars($item['category_name']); ?></span>
                                <a href="<?= BASEURL; ?>/item/detail/<?= $item['slug']; ?>" class="name text-dark mb-2"><?= htmlspecialchars($item['name']); ?></a>
                                <div class="rating-stars mb-2"><?= str_repeat('★', round((float)($item['avg_rating'] ?? 0))); ?><?= str_repeat('☆', 5 - round((float)($item['avg_rating'] ?? 0))); ?> <span class="small text-muted">(<?= (int)($item['total_reviews'] ?? 0); ?>)</span></div>
                                <div class="mt-auto d-flex justify-content-between align-items-end">
                                    <div class="price">Rp <?= number_format($item['price_daily'], 0, ',', '.'); ?> <small>/hari</small></div>
                                    <a href="<?= BASEURL; ?>/item/detail/<?= $item['slug']; ?>" class="btn btn-brand btn-sm"><i class="fas fa-cart-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.getElementById('priceRange')?.addEventListener('input', function(e){
    var v = parseInt(e.target.value, 10);
    document.getElementById('priceLabel').textContent = 'Rp ' + v.toLocaleString('id-ID');
});
document.getElementById('priceRange')?.addEventListener('change', function(){ document.getElementById('filterForm').submit(); });
</script>

<?php require_once '../app/views/templates/footer_public.php'; ?>
