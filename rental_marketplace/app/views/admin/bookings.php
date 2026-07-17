<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Transaksi - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

<!-- Navbar Admin (Sudah Disempurnakan) -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= BASEURL; ?>/admin/dashboard"><i class="fas fa-tools me-2"></i>Admin Panel</a>
        
        <!-- Tombol Hamburger untuk Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="adminNavbar">
            <!-- Menu Kiri -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASEURL; ?>/admin/dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active fw-bold" href="<?= BASEURL; ?>/admin/bookings">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASEURL; ?>/admin/users">Pengguna</a>
                </li>
            </ul>
            <!-- Menu Kanan -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-danger" href="<?= BASEURL; ?>/auth/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="m-0">Manajemen Seluruh Transaksi</h4>
        <a href="<?= BASEURL; ?>/admin/dashboard" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div class="card shadow-sm border-0 mb-5">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Invoice</th>
                            <th>Penyewa</th>
                            <th>Barang</th>
                            <th>Tanggal Sewa</th>
                            <th>Total Tagihan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['bookings'])): ?>
                            <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada transaksi.</td></tr>
                        <?php else: ?>
                            <?php foreach($data['bookings'] as $trx): ?>
                            <tr>
                                <td class="fw-bold text-primary"><?= $trx['invoice_no']; ?></td>
                                <td><?= $trx['user_name']; ?></td>
                                <td><?= $trx['item_name']; ?></td>
                                <td>
                                    <small class="d-block text-muted">Mulai: <?= date('d/m/Y', strtotime($trx['start_date'])); ?></small>
                                    <small class="d-block text-muted">Selesai: <?= date('d/m/Y', strtotime($trx['end_date'])); ?></small>
                                </td>
                                <td>Rp <?= number_format($trx['grand_total'], 0, ',', '.'); ?></td>
                                <td>
                                    <?php
                                        $badge = 'bg-secondary';
                                        if($trx['status'] == 'completed' || $trx['status'] == 'active') $badge = 'bg-success';
                                        if($trx['status'] == 'approved') $badge = 'bg-info text-dark';
                                        if($trx['status'] == 'pending') $badge = 'bg-warning text-dark';
                                        if($trx['status'] == 'rejected' || $trx['status'] == 'cancelled') $badge = 'bg-danger';
                                    ?>
                                    <span class="badge <?= $badge; ?> rounded-pill" style="font-size: 0.75rem;"><?= strtoupper($trx['status']); ?></span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i> Cek</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>