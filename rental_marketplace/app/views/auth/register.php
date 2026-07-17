<?php require_once '../app/views/templates/header_public.php'; ?>

<div class="row justify-content-center align-items-center py-4">
    <div class="col-md-6 col-lg-5">
        
        <?php if(isset($_SESSION['flash_error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show"><?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm bg-white">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <h4 class="fw-bold text-dark">Buat Akun Baru</h4>
                    <p class="text-muted small">Bergabunglah dengan RentalMarket hari ini.</p>
                </div>

                <form action="<?= BASEURL; ?>/auth/register" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? ''; ?>">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Nama Lengkap</label>
                        <input type="text" class="form-control bg-light" name="name" required placeholder="John Doe">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Email Address</label>
                        <input type="email" class="form-control bg-light" name="email" required placeholder="nama@email.com">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold small">Password</label>
                        <input type="password" class="form-control bg-light" name="password" required placeholder="Minimal 6 karakter">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fw-bold py-2 mb-3">Daftar Akun</button>
                </form>
                
                <div class="text-center small text-muted">
                    Sudah punya akun? <a href="<?= BASEURL; ?>/auth/login" class="text-primary fw-semibold text-decoration-none">Login di sini</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/templates/footer_public.php'; ?>