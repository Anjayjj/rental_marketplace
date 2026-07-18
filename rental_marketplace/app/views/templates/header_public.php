<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?? 'RentalMarket'; ?> | RentalMarket</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>

<!-- Top utility bar -->
<div class="topbar py-1">
    <div class="container d-flex justify-content-between">
        <span><i class="fas fa-phone-alt me-1"></i> Bantuan: 0800-123-456 | <i class="fas fa-truck-fast me-1"></i> Pengiriman & pengambilan fleksibel</span>
        <span>
            <?php if(isset($_SESSION['user_id'])): ?>
                <i class="fas fa-circle text-success me-1" style="font-size:.5rem;"></i> Hai, <?= htmlspecialchars(explode(' ', $_SESSION['user_name'])[0]); ?>
            <?php else: ?>
                <a href="<?= BASEURL; ?>/auth/login"><i class="fas fa-sign-in-alt me-1"></i> Masuk</a> atau <a href="<?= BASEURL; ?>/auth/register">Daftar</a>
            <?php endif; ?>
        </span>
    </div>
</div>

<!-- Main navbar -->
<nav class="site-nav py-2">
    <div class="container">
        <div class="d-flex align-items-center gap-3 flex-wrap">
            <a href="<?= BASEURL; ?>" class="nav-logo text-nowrap"><i class="fas fa-box-open me-1"></i>RentalMarket</a>

            <form action="<?= BASEURL; ?>/home/explore" method="GET" class="search-wrap d-flex flex-grow-1 mx-lg-3">
                <span class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari kamera, tenda, mobil, proyektor..." value="<?= htmlspecialchars($_GET['search'] ?? ''); ?>">
                    <button class="btn btn-brand px-3" type="submit"><i class="fas fa-search"></i></button>
                </span>
            </form>

            <div class="d-flex align-items-center gap-2">
                <a href="<?= BASEURL; ?>/user/wishlist" class="nav-icon" title="Wishlist"><i class="far fa-heart"></i></a>
                <a href="<?= BASEURL; ?>/cart" class="nav-icon" title="Keranjang Sewa">
                    <i class="fas fa-shopping-cart"></i>
                    <?php $cartCount = count($_SESSION['cart'] ?? []); if($cartCount > 0): ?><span class="badge-dot"><?= $cartCount; ?></span><?php endif; ?>
                </a>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="<?= BASEURL; ?>/assets/uploads/avatars/<?= $_SESSION['user_avatar'] ?? 'default.png'; ?>" class="rounded-circle object-fit-cover" style="width:38px;height:38px;border:2px solid #e9edf3;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" style="border-radius:12px;">
                            <li><a class="dropdown-item rounded" href="<?= BASEURL; ?>/<?= $_SESSION['user_role'] == 'admin' ? 'admin' : 'user'; ?>/dashboard"><i class="fas fa-border-all fa-fw me-2 text-brand"></i> Dashboard</a></li>
                            <li><a class="dropdown-item rounded" href="<?= BASEURL; ?>/user/wishlist"><i class="fas fa-heart fa-fw me-2 text-brand"></i> Wishlist</a></li>
                            <li><a class="dropdown-item rounded" href="<?= BASEURL; ?>/cart"><i class="fas fa-shopping-cart fa-fw me-2 text-brand"></i> Keranjang Sewa</a></li>
                            <li><a class="dropdown-item rounded" href="<?= BASEURL; ?>/booking/saya"><i class="fas fa-receipt fa-fw me-2 text-brand"></i> Pesanan Saya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item rounded text-danger" href="<?= BASEURL; ?>/auth/logout"><i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="<?= BASEURL; ?>/auth/login" class="btn btn-outline-brand btn-sm px-3 fw-semibold">Masuk</a>
                <?php endif; ?>
                <a href="<?= BASEURL; ?>/useritem/create" class="btn btn-brand btn-sm px-3 fw-semibold d-none d-md-inline-flex"><i class="fas fa-plus me-1"></i> Jual Sewa</a>
            </div>
        </div>

        <!-- Category bar -->
        <div class="d-flex align-items-center gap-2 mt-2 overflow-auto pb-1">
            <a href="<?= BASEURL; ?>/home/explore" class="cat-pill <?= empty($_GET['category']) ? 'active' : ''; ?>">Semua</a>
            <?php if(isset($data['categories'])): foreach($data['categories'] as $c): ?>
                <a href="<?= BASEURL; ?>/home/explore?category=<?= $c['id']; ?>" class="cat-pill <?= (($_GET['category'] ?? '') == $c['id']) ? 'active' : ''; ?>">
                    <i class="<?= htmlspecialchars($c['icon'] ?? 'fas fa-tag'); ?> me-1"></i><?= htmlspecialchars($c['name']); ?>
                </a>
            <?php endforeach; endif; ?>
        </div>
    </div>
</nav>

<div class="container py-4">
