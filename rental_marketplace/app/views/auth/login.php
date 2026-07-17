<?php require_once '../app/views/templates/header_public.php'; ?>
<div class="row justify-content-center align-items-center" style="min-height:70vh;">
    <div class="col-lg-10">
        <div class="card border-0 shadow overflow-hidden" style="border-radius:18px;">
            <div class="row g-0">
                <div class="col-md-6 d-none d-md-flex auth-art align-items-center justify-content-center p-5">
                    <div class="text-center">
                        <i class="fas fa-box-open mb-3" style="font-size:4rem;"></i>
                        <h3 class="fw-bold">Selamat datang kembali!</h3>
                        <p class="opacity-75">Masuk untuk mengelola sewa & barang kamu di RentalMarket.</p>
                    </div>
                </div>
                <div class="col-md-6 bg-white p-4 p-md-5">
                    <?php if(isset($_SESSION['flash_success'])): ?><div class="alert alert-success alert-dismissible fade show"><?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div><?php endif; ?>
                    <?php if(isset($_SESSION['flash_error'])): ?><div class="alert alert-danger alert-dismissible fade show"><?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div><?php endif; ?>
                    <h4 class="fw-bold text-dark mb-1">Masuk</h4>
                    <p class="text-muted small mb-4">Belum punya akun? <a href="<?= BASEURL; ?>/auth/register" class="text-brand fw-semibold">Daftar</a></p>
                    <form action="<?= BASEURL; ?>/auth/login" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? ''; ?>">
                        <div class="mb-3"><label class="form-label fw-semibold small">Email</label><input type="email" name="email" class="form-control bg-light" required placeholder="nama@email.com"></div>
                        <div class="mb-4"><label class="form-label fw-semibold small">Password</label><input type="password" name="password" class="form-control bg-light" required placeholder="••••••••"></div>
                        <button class="btn btn-brand w-100 fw-bold py-2 mb-3">Masuk</button>
                    </form>
                    <div class="text-center small"><a href="<?= BASEURL; ?>" class="text-muted">← Kembali ke beranda</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once '../app/views/templates/footer_public.php'; ?>
