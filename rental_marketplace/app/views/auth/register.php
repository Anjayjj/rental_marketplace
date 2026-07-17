<?php require_once '../app/views/templates/header_public.php'; ?>
<div class="row justify-content-center align-items-center py-4" style="min-height:70vh;">
    <div class="col-lg-10">
        <div class="card border-0 shadow overflow-hidden" style="border-radius:18px;">
            <div class="row g-0">
                <div class="col-md-6 d-none d-md-flex auth-art align-items-center justify-content-center p-5">
                    <div class="text-center">
                        <i class="fas fa-handshake mb-3" style="font-size:4rem;"></i>
                        <h3 class="fw-bold">Bergabung sekarang</h3>
                        <p class="opacity-75">Sewa kebutuhanmu atau dapatkan penghasilan dari barang menganggur.</p>
                    </div>
                </div>
                <div class="col-md-6 bg-white p-4 p-md-5">
                    <?php if(isset($_SESSION['flash_error'])): ?><div class="alert alert-danger alert-dismissible fade show"><?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div><?php endif; ?>
                    <h4 class="fw-bold text-dark mb-1">Daftar Akun</h4>
                    <p class="text-muted small mb-4">Sudah punya akun? <a href="<?= BASEURL; ?>/auth/login" class="text-brand fw-semibold">Masuk</a></p>
                    <form action="<?= BASEURL; ?>/auth/register" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? ''; ?>">
                        <div class="mb-3"><label class="form-label fw-semibold small">Nama Lengkap</label><input type="text" name="name" class="form-control bg-light" required placeholder="John Doe"></div>
                        <div class="mb-3"><label class="form-label fw-semibold small">Email</label><input type="email" name="email" class="form-control bg-light" required placeholder="nama@email.com"></div>
                        <div class="mb-3"><label class="form-label fw-semibold small">No. HP</label><input type="text" name="phone" class="form-control bg-light" required placeholder="08xxxxxxxx"></div>
                        <div class="mb-4"><label class="form-label fw-semibold small">Password</label><input type="password" name="password" class="form-control bg-light" required placeholder="Minimal 6 karakter"></div>
                        <div class="mb-4"><label class="form-label fw-semibold small">Konfirmasi Password</label><input type="password" name="password_confirm" class="form-control bg-light" required placeholder="Ulangi password"></div>
                        <button class="btn btn-brand w-100 fw-bold py-2 mb-3">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once '../app/views/templates/footer_public.php'; ?>
