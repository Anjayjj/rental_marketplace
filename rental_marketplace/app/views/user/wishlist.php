<?php require_once '../app/views/templates/header_user.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded shadow-sm border-start border-danger border-4">
    <h4 class="m-0 fw-bold text-dark"><i class="far fa-heart me-2 text-danger"></i> Wishlist Saya</h4>
</div>

<?php if(empty($data['items'])): ?>
    <div class="empty-state bg-white rounded border"><i class="far fa-heart"></i><h6 class="fw-bold text-dark">Belum ada tersimpan</h6><p>Suka barang? Tap hati untuk menyimpannya di sini.</p><a href="<?= BASEURL; ?>/home/explore" class="btn btn-brand">Jelajahi Katalog</a></div>
<?php else: ?>
<div class="row g-4">
    <?php foreach($data['items'] as $item): ?>
        <div class="col-6 col-md-4 col-lg-3">
            <div class="product-card h-100">
                <div class="thumb"><a href="<?= BASEURL; ?>/item/detail/<?= $item['slug']; ?>"><img src="<?= BASEURL; ?>/assets/uploads/items/<?= $item['cover_image'] ?? 'default.jpg'; ?>" alt="<?= htmlspecialchars($item['name']); ?>"></a></div>
                <div class="body d-flex flex-column">
                    <span class="badge bg-light text-secondary mb-2 align-self-start border" style="font-weight:600;"><?= htmlspecialchars($item['category_name'] ?? ''); ?></span>
                    <a href="<?= BASEURL; ?>/item/detail/<?= $item['slug']; ?>" class="name text-dark mb-2"><?= htmlspecialchars($item['name']); ?></a>
                    <div class="mt-auto price">Rp <?= number_format($item['price_daily'], 0, ',', '.'); ?> <small>/hari</small></div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<?php require_once '../app/views/templates/footer.php'; ?>
