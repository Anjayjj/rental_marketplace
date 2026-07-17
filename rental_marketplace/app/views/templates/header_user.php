<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?? 'Rental Marketplace'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        body { font-family: 'Inter', sans-serif !important; background-color: #f3f4f6 !important; overflow-x: hidden; }

        /* --- STYLING SIDEBAR FIXED --- */
        #sidebar { width: 260px; height: 100vh; position: fixed; top: 0; left: 0; background-color: #1e293b; z-index: 1000; display: flex; flex-direction: column; box-shadow: 4px 0 10px rgba(0,0,0,0.05); }
        .sidebar-brand { padding: 20px; font-size: 1.25rem; font-weight: 700; color: #fff; text-decoration: none; border-bottom: 1px solid #334155; }
        .nav-sidebar .nav-link { color: #94a3b8; padding: 12px 20px; margin: 4px 15px; border-radius: 8px; transition: all 0.2s; font-weight: 500; }

        /* UBAH WARNA SIDEBAR AKTIF JADI GELAP (Menghilangkan biru terang) */
        .nav-sidebar .nav-link:hover, .nav-sidebar .nav-link.active { color: #fff; background-color: #334155; }

        /* --- STYLING KONTEN UTAMA --- */
        #main-content { margin-left: 260px; width: calc(100% - 260px); min-height: 100vh; display: flex; flex-direction: column; }
        .top-navbar { background-color: #fff; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }

        /* --- SINKRONISASI WARNA DENGAN HALAMAN PUBLIK --- */
        .bg-primary { background-color: #1a252f !important; }
        .text-primary { color: #1a252f !important; }
        .border-primary { border-color: #1a252f !important; }
        
        .btn-primary { background-color: #1a252f !important; border-color: #1a252f !important; color: white !important;}
        .btn-primary:hover { background-color: #2c3e50 !important; border-color: #2c3e50 !important; color: white !important;}
        
        .btn-outline-primary { color: #1a252f !important; border-color: #1a252f !important; }
        .btn-outline-primary:hover { background-color: #1a252f !important; border-color: #1a252f !important; color: white !important; }

        /* Elemen Estetika Umum */
        .card { border-radius: 12px !important; border: none !important; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05) !important; }
        .btn { border-radius: 6px !important; font-weight: 500; }
        .form-control, .form-select { border-radius: 6px !important; }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- 1. SIDEBAR KIRI (Statis / Fixed) -->
    <nav id="sidebar">
        <a href="<?= BASEURL; ?>" class="sidebar-brand d-flex align-items-center">
            <i class="fas fa-box-open text-primary me-2 fs-4"></i> RentalMarket
        </a>
        
        <div class="px-4 py-3">
            <small class="text-uppercase text-secondary fw-bold" style="font-size: 0.75rem;">Menu Utama</small>
        </div>

        <ul class="nav nav-sidebar flex-column mb-auto">
            <li class="nav-item"><a href="<?= BASEURL; ?>/user/dashboard" class="nav-link menu-link"><i class="fas fa-border-all fa-fw me-2"></i> Dashboard</a></li>
            <li class="nav-item"><a href="<?= BASEURL; ?>/useritem/index" class="nav-link menu-link"><i class="fas fa-boxes fa-fw me-2"></i> Barang Saya</a></li>
            <li class="nav-item"><a href="<?= BASEURL; ?>/useritem/create" class="nav-link menu-link text-info"><i class="fas fa-plus-circle fa-fw me-2"></i> Mulai Sewakan</a></li>
            <li class="nav-item"><a href="<?= BASEURL; ?>/booking/saya" class="nav-link menu-link"><i class="fas fa-receipt fa-fw me-2"></i> Riwayat Sewa</a></li>
        </ul>

        <div class="px-4 py-3 border-top" style="border-color: #334155 !important;">
            <ul class="nav nav-sidebar flex-column">
                <li class="nav-item"><a href="<?= BASEURL; ?>/user/settings" class="nav-link menu-link"><i class="fas fa-cog fa-fw me-2"></i> Pengaturan</a></li>
                <li class="nav-item"><a href="<?= BASEURL; ?>/auth/logout" class="nav-link text-danger mt-2"><i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- 2. KONTEN KANAN -->
    <div id="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 fw-bold text-dark">Portal Member</h5>
            </div>
            
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <div class="text-end me-3 d-none d-md-block">
                        <span class="d-block fw-bold text-dark" style="font-size: 0.9rem;"><?= $_SESSION['user_name']; ?></span>
                        <span class="d-block text-muted" style="font-size: 0.75rem;"><?= $_SESSION['user_role'] == 'admin' ? 'Administrator' : 'Member'; ?></span>
                    </div>
                    <img src="<?= BASEURL; ?>/assets/uploads/avatars/<?= $_SESSION['user_avatar'] ?? 'default.png'; ?>" class="rounded-circle object-fit-cover shadow-sm" style="width: 42px; height: 42px; border: 2px solid #fff;">
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-3 p-2" style="border-radius: 10px;">
                    <li><a class="dropdown-item rounded" href="<?= BASEURL; ?>"><i class="fas fa-store fa-fw me-2 text-primary"></i> Kembali ke Katalog</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item rounded text-danger" href="<?= BASEURL; ?>/auth/logout"><i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- Ruang Konten Utama (Ditutup di footer) -->
        <div class="p-4 p-md-5 flex-grow-1">