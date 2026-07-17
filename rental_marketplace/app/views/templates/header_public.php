<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?? 'Rental Marketplace'; ?></title>
    
    <!-- INI YANG SEMPAT HILANG: Framework Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Estetika Serius & Elegan -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif !important; background-color: #f8f9fa !important; }
        
        .bg-primary { background-color: #1a252f !important; }
        .text-primary { color: #1a252f !important; }
        .border-primary { border-color: #1a252f !important; }
        
        /* Tombol Utama (Daftar & Cari) */
        .btn-primary { background-color: #1a252f !important; border-color: #1a252f !important; color: white !important;}
        .btn-primary:hover { background-color: #2c3e50 !important; border-color: #2c3e50 !important; color: white !important;}
        
        /* Tombol Outline (Login & Lihat Detail) */
        .btn-outline-primary { color: #1a252f !important; border-color: #1a252f !important; }
        .btn-outline-primary:hover { background-color: #1a252f !important; border-color: #1a252f !important; color: white !important; }
        
        .btn, .card, .alert, .form-control, .form-select { border-radius: 6px !important; }
        .shadow-sm { box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05) !important; }
        .navbar { box-shadow: 0 1px 3px rgba(0,0,0,0.05) !important; }
    </style>
</head>
<body>

<!-- Navbar Publik -->
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top mb-4 py-3">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="<?= BASEURL; ?>">
            <i class="fas fa-box-open me-2"></i>RentalMarket
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-medium">
                <li class="nav-item"><a class="nav-link" href="<?= BASEURL; ?>">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASEURL; ?>/home/explore">Katalog Barang</a></li>
            </ul>
            <div class="d-flex align-items-center">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="<?= BASEURL; ?>/<?= $_SESSION['user_role'] == 'admin' ? 'admin' : 'user'; ?>/dashboard" class="btn btn-outline-primary me-3 fw-semibold px-4">Dashboard Saya</a>
                    <a href="<?= BASEURL; ?>/auth/logout" class="text-danger text-decoration-none fw-semibold"><i class="fas fa-sign-out-alt me-1"></i>Logout</a>
                <?php else: ?>
                    <a href="<?= BASEURL; ?>/auth/login" class="btn btn-outline-primary me-2 px-4 fw-semibold">Login</a>
                    <a href="<?= BASEURL; ?>/auth/register" class="btn btn-primary px-4 fw-semibold">Daftar</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!-- Container Konten Publik -->
<div class="container pb-5">