<?php
// Menyalakan session di tingkat paling atas sebelum ada output HTML
if (!session_id()) {
    session_start();
}

// Memanggil semua komponen inti
require_once '../app/init.php';

// Menjalankan Router Aplikasi
$app = new App();
?>