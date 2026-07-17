<?php require_once '../app/views/templates/header_public.php'; ?>

<?php if(isset($_SESSION['flash_error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show"><?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="row g-4 mb-5 mt-2">
    <!-- Kolom Kiri: Galeri & Deskripsi -->
    <div class="col-lg-8">
        <h2 class="fw-bold mb-3 text-dark"><?= $data['item']['name']; ?></h2>
        
        <div id="itemCarousel" class="carousel slide mb-4 shadow-sm rounded overflow-hidden border border-light" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php if(empty($data['images'])): ?>
                    <div class="carousel-item active"><img src="<?= BASEURL; ?>/assets/uploads/items/default.jpg" class="d-block w-100 object-fit-cover" style="height: 450px;"></div>
                <?php else: ?>
                    <?php $active = 'active'; foreach($data['images'] as $img): ?>
                        <div class="carousel-item <?= $active; ?>"><img src="<?= BASEURL; ?>/assets/uploads/items/<?= $img['image_path']; ?>" class="d-block w-100 object-fit-cover" style="height: 450px;"></div>
                    <?php $active = ''; endforeach; ?>
                <?php endif; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#itemCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon bg-dark rounded-circle p-3"></span></button>
            <button class="carousel-control-next" type="button" data-bs-target="#itemCarousel" data-bs-slide="next"><span class="carousel-control-next-icon bg-dark rounded-circle p-3"></span></button>
        </div>

        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
            <li class="nav-item"><button class="nav-link active fw-semibold" data-bs-toggle="tab" data-bs-target="#deskripsi" type="button">Deskripsi</button></li>
            <li class="nav-item"><button class="nav-link fw-semibold text-muted" data-bs-toggle="tab" data-bs-target="#review" type="button">Ulasan</button></li>
        </ul>
        
        <div class="tab-content bg-white p-4 rounded shadow-sm border-0 mb-4" id="myTabContent">
            <div class="tab-pane fade show active text-muted" id="deskripsi" style="line-height: 1.7;">
                <?= nl2br($data['item']['description']); ?>
            </div>
            <div class="tab-pane fade" id="review">
                <div class="text-center text-muted py-5"><i class="fas fa-comment-slash fs-2 mb-3"></i><p>Belum ada ulasan untuk barang ini.</p></div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Form Booking & Info Pemilik -->
    <div class="col-lg-4">
        <!-- Box Transaksi -->
        <div class="card shadow-sm border-0 bg-white mb-4">
            <div class="card-body p-4">
                <h3 class="text-primary fw-bold mb-0">Rp <?= number_format($data['item']['price_daily'], 0, ',', '.'); ?> <span class="fs-6 text-muted fw-normal">/ hari</span></h3>
                <hr class="text-muted opacity-25 my-4">
                <?php require_once '../app/views/components/form_booking.php'; ?>
            </div>
        </div>

        <!-- Box Profil Pemilik -->
        <div class="card shadow-sm border-0 bg-white">
            <div class="card-body p-4 d-flex align-items-center">
                <img src="<?= BASEURL; ?>/assets/uploads/avatars/<?= $data['item']['owner_avatar'] ?? 'default.png'; ?>" class="rounded-circle me-3 border object-fit-cover shadow-sm" style="width: 55px; height: 55px;">
                <div>
                    <small class="text-muted d-block fw-semibold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Pemilik Barang</small>
                    <strong class="fs-6 text-dark"><?= $data['item']['owner_name']; ?></strong>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/templates/footer_public.php'; ?>