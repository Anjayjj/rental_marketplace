<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Rental Marketplace</title>
    <!-- Memuat Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Memuat Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">

<!-- Navbar Admin -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= BASEURL; ?>/admin/dashboard"><i class="fas fa-tools me-2"></i>Admin Panel</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active fw-bold" href="<?= BASEURL; ?>/admin/dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASEURL; ?>/admin/bookings">Transaksi</a>
                </li>
                <li class="nav-item">
    <a class="nav-link" href="<?= BASEURL; ?>/admin/users">Pengguna</a>
</li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-danger" href="<?= BASEURL; ?>/auth/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Konten Utama Dashboard -->
<div class="container-fluid px-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="m-0">Ringkasan Sistem</h4>
        <span class="text-muted small">Tanggal: <?= date('d M Y'); ?></span>
    </div>

    <!-- 1. Statistik Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-primary border-4 shadow-sm h-100 py-2 border-0">
                <div class="card-body">
                    <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total Pengguna</div>
                    <div class="h5 mb-0 fw-bold text-gray-800"><?= number_format($data['stats']['total_users']); ?></div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-success border-4 shadow-sm h-100 py-2 border-0">
                <div class="card-body">
                    <div class="text-xs fw-bold text-success text-uppercase mb-1">Total Barang</div>
                    <div class="h5 mb-0 fw-bold text-gray-800"><?= number_format($data['stats']['total_items']); ?></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-info border-4 shadow-sm h-100 py-2 border-0">
                <div class="card-body">
                    <div class="text-xs fw-bold text-info text-uppercase mb-1">Booking Berhasil</div>
                    <div class="h5 mb-0 fw-bold text-gray-800"><?= number_format($data['stats']['total_bookings']); ?></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-warning border-4 shadow-sm h-100 py-2 border-0">
                <div class="card-body">
                    <div class="text-xs fw-bold text-warning text-uppercase mb-1">Pendapatan Platform</div>
                    <div class="h5 mb-0 fw-bold text-gray-800">Rp <?= number_format($data['stats']['total_revenue'], 0, ',', '.'); ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Chart & Transaksi Terbaru -->
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header py-3 bg-white border-bottom">
                    <h6 class="m-0 fw-bold text-primary">Grafik Pendapatan (Tahun <?= date('Y'); ?>)</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="revenueChart" style="height: 320px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaksi Terbaru -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header py-3 bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-primary">Transaksi Terbaru</h6>
                    <a href="<?= BASEURL; ?>/admin/bookings" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <?php if(empty($data['recent_bookings'])): ?>
                            <li class="list-group-item text-center text-muted py-4">Belum ada transaksi.</li>
                        <?php else: ?>
                            <?php foreach($data['recent_bookings'] as $trx): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <div>
                                    <h6 class="my-0 small fw-bold text-dark"><?= $trx['invoice_no']; ?></h6>
                                    <small class="text-muted"><?= $trx['user_name']; ?> - <?= date('d M Y', strtotime($trx['created_at'])); ?></small>
                                </div>
                                <?php
                                    $badge = 'bg-secondary';
                                    if($trx['status'] == 'completed' || $trx['status'] == 'active') $badge = 'bg-success';
                                    if($trx['status'] == 'approved') $badge = 'bg-info text-dark';
                                    if($trx['status'] == 'pending') $badge = 'bg-warning text-dark';
                                    if($trx['status'] == 'rejected' || $trx['status'] == 'cancelled') $badge = 'bg-danger';
                                ?>
                                <span class="badge <?= $badge; ?> rounded-pill" style="font-size: 0.75rem;"><?= ucfirst($trx['status']); ?></span>
                            </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Memuat Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script Chart.js -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const chartData = <?= $data['chart_data']; ?>;
    const ctx = document.getElementById("revenueChart");
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des"],
            datasets: [{
                label: "Pendapatan (Rp)",
                lineTension: 0.3,
                backgroundColor: "rgba(13, 110, 253, 0.1)", // Warna Bootstrap Primary dengan opacity
                borderColor: "rgba(13, 110, 253, 1)",
                pointRadius: 4,
                pointBackgroundColor: "rgba(255, 255, 255, 1)",
                pointBorderColor: "rgba(13, 110, 253, 1)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(13, 110, 253, 1)",
                pointHoverBorderColor: "rgba(255, 255, 255, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: chartData,
                fill: true
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: { padding: { left: 10, right: 25, top: 25, bottom: 0 } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value, index, values) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyColor: "#858796",
                    titleColor: '#6e707e',
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    padding: 15,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Pendapatan: Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                        }
                    }
                }
            }
        }
    });
});
</script>
</body>
</html>