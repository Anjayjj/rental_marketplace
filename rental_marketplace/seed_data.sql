-- SEED DATA: 30 users + 75 items (themed images) + sample bookings
-- Import AFTER database.sql. Aman di-import berulang kali.

SET FOREIGN_KEY_CHECKS=0;
DELETE FROM `reviews` WHERE `booking_id` BETWEEN 1 AND 8;
DELETE FROM `bookings` WHERE `id` BETWEEN 1 AND 8;
DELETE FROM `item_images` WHERE `item_id` >= 4;
DELETE FROM `items` WHERE `id` >= 4;
DELETE FROM `users` WHERE `id` >= 4;
DELETE FROM `categories` WHERE `id` >= 4;
SET FOREIGN_KEY_CHECKS=1;

INSERT INTO `categories` (`id`,`name`,`icon`,`slug`) VALUES
(4, 'Alat Musik', 'fas fa-guitar', 'alat-musik'),
(5, 'Perlengkapan Pesta', 'fas fa-glass-cheers', 'perlengkapan-pesta'),
(6, 'Elektronik Rumah', 'fas fa-plug', 'elektronik-rumah');

-- USERS (id 4..33) password: password123
INSERT INTO `users` (`id`,`name`,`email`,`password`,`phone`,`address`,`role`,`avatar`,`created_at`) VALUES
(4, 'Andi Wijaya', 'user04@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08964910500', 'Jl. Contoh No.4, Jakarta', 'user', 'default.png', '2026-07-16 10:00:00'),
(5, 'Budi Nugroho', 'user05@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08476159471', 'Jl. Contoh No.5, Jakarta', 'user', 'default.png', '2026-07-16 10:01:01'),
(6, 'Citra Nugroho', 'user06@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08922093531', 'Jl. Contoh No.6, Jakarta', 'user', 'default.png', '2026-07-16 10:02:02'),
(7, 'Dewi Halim', 'user07@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08437547040', 'Jl. Contoh No.7, Jakarta', 'user', 'default.png', '2026-07-16 10:03:03'),
(8, 'Eka Wijaya', 'user08@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08372885566', 'Jl. Contoh No.8, Jakarta', 'user', 'default.png', '2026-07-16 10:04:04')
;
INSERT INTO `users` (`id`,`name`,`email`,`password`,`phone`,`address`,`role`,`avatar`,`created_at`) VALUES
(9, 'Fajar Nugroho', 'user09@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08446340984', 'Jl. Contoh No.9, Jakarta', 'user', 'default.png', '2026-07-16 10:05:05'),
(10, 'Gita Nugroho', 'user10@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08899919492', 'Jl. Contoh No.10, Jakarta', 'user', 'default.png', '2026-07-16 10:00:06'),
(11, 'Hendra Putra', 'user11@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08593549935', 'Jl. Contoh No.11, Jakarta', 'user', 'default.png', '2026-07-16 10:01:07'),
(12, 'Indah Lestari', 'user12@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08740064726', 'Jl. Contoh No.12, Jakarta', 'user', 'default.png', '2026-07-16 10:02:08'),
(13, 'Joko Santoso', 'user13@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08468965591', 'Jl. Contoh No.13, Jakarta', 'user', 'default.png', '2026-07-16 10:03:09')
;
INSERT INTO `users` (`id`,`name`,`email`,`password`,`phone`,`address`,`role`,`avatar`,`created_at`) VALUES
(14, 'Kiki Halim', 'user14@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08404137315', 'Jl. Contoh No.14, Jakarta', 'user', 'default.png', '2026-07-16 10:04:10'),
(15, 'Lina Nugroho', 'user15@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08198772423', 'Jl. Contoh No.15, Jakarta', 'user', 'default.png', '2026-07-16 10:05:11'),
(16, 'Maya Nugroho', 'user16@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08853685198', 'Jl. Contoh No.16, Jakarta', 'user', 'default.png', '2026-07-16 10:00:12'),
(17, 'Nanda Saputra', 'user17@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08636125314', 'Jl. Contoh No.17, Jakarta', 'user', 'default.png', '2026-07-16 10:01:13'),
(18, 'Oka Permata', 'user18@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08881137784', 'Jl. Contoh No.18, Jakarta', 'user', 'default.png', '2026-07-16 10:02:14')
;
INSERT INTO `users` (`id`,`name`,`email`,`password`,`phone`,`address`,`role`,`avatar`,`created_at`) VALUES
(19, 'Putri Santoso', 'user19@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08154564980', 'Jl. Contoh No.19, Jakarta', 'user', 'default.png', '2026-07-16 10:03:15'),
(20, 'Qori Pratama', 'user20@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08375653832', 'Jl. Contoh No.20, Jakarta', 'user', 'default.png', '2026-07-16 10:04:16'),
(21, 'Rian Permata', 'user21@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08649967889', 'Jl. Contoh No.21, Jakarta', 'user', 'default.png', '2026-07-16 10:05:17'),
(22, 'Sari Santoso', 'user22@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08398806999', 'Jl. Contoh No.22, Jakarta', 'user', 'default.png', '2026-07-16 10:00:18'),
(23, 'Toni Permata', 'user23@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08501918073', 'Jl. Contoh No.23, Jakarta', 'user', 'default.png', '2026-07-16 10:01:19')
;
INSERT INTO `users` (`id`,`name`,`email`,`password`,`phone`,`address`,`role`,`avatar`,`created_at`) VALUES
(24, 'Umi Wijaya', 'user24@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08244126259', 'Jl. Contoh No.24, Jakarta', 'user', 'default.png', '2026-07-16 10:02:20'),
(25, 'Vino Putra', 'user25@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08381631802', 'Jl. Contoh No.25, Jakarta', 'user', 'default.png', '2026-07-16 10:03:21'),
(26, 'Wati Pratama', 'user26@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08891304393', 'Jl. Contoh No.26, Jakarta', 'user', 'default.png', '2026-07-16 10:04:22'),
(27, 'Xena Nugroho', 'user27@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08818695899', 'Jl. Contoh No.27, Jakarta', 'user', 'default.png', '2026-07-16 10:05:23'),
(28, 'Yoga Saputra', 'user28@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08212524492', 'Jl. Contoh No.28, Jakarta', 'user', 'default.png', '2026-07-16 10:00:24')
;
INSERT INTO `users` (`id`,`name`,`email`,`password`,`phone`,`address`,`role`,`avatar`,`created_at`) VALUES
(29, 'Zaki Nugroho', 'user29@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08523023106', 'Jl. Contoh No.29, Jakarta', 'user', 'default.png', '2026-07-16 10:01:25'),
(30, 'Anwar Permata', 'user30@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08756304116', 'Jl. Contoh No.30, Jakarta', 'user', 'default.png', '2026-07-16 10:02:26'),
(31, 'Bella Saputra', 'user31@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08408262972', 'Jl. Contoh No.31, Jakarta', 'user', 'default.png', '2026-07-16 10:03:27'),
(32, 'Caca Wijaya', 'user32@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08065959151', 'Jl. Contoh No.32, Jakarta', 'user', 'default.png', '2026-07-16 10:04:28'),
(33, 'Dimas Lestari', 'user33@rental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08171971218', 'Jl. Contoh No.33, Jakarta', 'user', 'default.png', '2026-07-16 10:05:29')
;
-- ITEMS (id 4..78)  prices realistic per category  -- setiap 10 item = 1 statement
INSERT INTO `items` (`id`,`owner_id`,`category_id`,`name`,`slug`,`description`,`specifications`,`terms_conditions`,`price_daily`,`price_weekly`,`price_monthly`,`status`,`created_at`) VALUES
(4, 22, 1, 'Sony A7III + Lensa 28-70mm', 'sony-a7iii-lensa-28-70mm-4', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 75000, 450000, 1650000, 'active', '2026-07-14 02:00:56'),
(5, 2, 2, 'Tenda Dome 4 Orang Eiger', 'tenda-dome-4-orang-eiger-5', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 25000, 150000, 550000, 'active', '2026-07-16 04:20:02'),
(6, 26, 3, 'Honda Beat 2022', 'honda-beat-2022-6', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 80000, 480000, 1760000, 'active', '2026-07-13 07:48:20'),
(7, 9, 1, 'Canon EOS R6 + RF 24-105mm', 'canon-eos-r6-rf-24-105mm-7', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 90000, 540000, 1980000, 'active', '2026-07-16 05:42:47'),
(8, 11, 2, 'Tenda Dome 6 Orang', 'tenda-dome-6-orang-8', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 35000, 210000, 770000, 'active', '2026-07-16 06:32:23'),
(9, 20, 3, 'Yamaha NMAX 2023', 'yamaha-nmax-2023-9', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 110000, 660000, 2420000, 'active', '2026-07-10 08:01:41'),
(10, 20, 1, 'Fujifilm X-T4 + XF 16-55mm', 'fujifilm-x-t4-xf-16-55mm-10', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 110000, 660000, 2420000, 'active', '2026-07-11 07:51:21'),
(11, 32, 2, 'Sleeping Bag -10C', 'sleeping-bag-10c-11', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 30000, 180000, 660000, 'active', '2026-07-10 05:03:05'),
(12, 23, 3, 'Toyota Avanza 2019', 'toyota-avanza-2019-12', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 350000, 2100000, 7700000, 'active', '2026-07-16 02:14:52'),
(13, 28, 1, 'Nikon Z6 II + Z 24-70mm', 'nikon-z6-ii-z-24-70mm-13', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 130000, 780000, 2860000, 'active', '2026-07-15 01:45:35')
;
INSERT INTO `items` (`id`,`owner_id`,`category_id`,`name`,`slug`,`description`,`specifications`,`terms_conditions`,`price_daily`,`price_weekly`,`price_monthly`,`status`,`created_at`) VALUES
(14, 21, 2, 'Kompor Portable Camping', 'kompor-portable-camping-14', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 40000, 240000, 880000, 'active', '2026-07-16 08:02:30'),
(15, 24, 3, 'Honda Vario 2021', 'honda-vario-2021-15', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 90000, 540000, 1980000, 'active', '2026-07-15 09:48:48'),
(16, 28, 1, 'GoPro Hero 11 Black', 'gopro-hero-11-black-16', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 150000, 900000, 3300000, 'active', '2026-07-12 08:40:20'),
(17, 33, 2, 'Carrier 60L Outdoor', 'carrier-60l-outdoor-17', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 50000, 300000, 1100000, 'active', '2026-07-11 09:51:25'),
(18, 14, 3, 'Suzuki Ertiga 2020', 'suzuki-ertiga-2020-18', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 400000, 2400000, 8800000, 'active', '2026-07-12 02:23:17'),
(19, 8, 1, 'DJI Osmo Pocket 3', 'dji-osmo-pocket-3-19', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 150000, 900000, 3300000, 'active', '2026-07-11 06:57:15'),
(20, 7, 2, 'Hammock Eiger Double', 'hammock-eiger-double-20', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 45000, 270000, 990000, 'active', '2026-07-13 04:08:30'),
(21, 21, 3, 'Yamaha Aerox 2022', 'yamaha-aerox-2022-21', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 120000, 720000, 2640000, 'active', '2026-07-10 04:41:26'),
(22, 29, 1, 'Lensa Prime 50mm f/1.8', 'lensa-prime-50mm-f-1-8-22', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 160000, 960000, 3520000, 'active', '2026-07-14 01:04:53'),
(23, 22, 2, 'Matras Inflatable', 'matras-inflatable-23', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 30000, 180000, 660000, 'active', '2026-07-11 02:45:30')
;
INSERT INTO `items` (`id`,`owner_id`,`category_id`,`name`,`slug`,`description`,`specifications`,`terms_conditions`,`price_daily`,`price_weekly`,`price_monthly`,`status`,`created_at`) VALUES
(24, 25, 3, 'Mitsubishi Xpander 2021', 'mitsubishi-xpander-2021-24', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 450000, 2700000, 9900000, 'active', '2026-07-14 05:19:54'),
(25, 7, 1, 'Lensa Tele 70-200mm f/2.8', 'lensa-tele-70-200mm-f-2-8-25', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 180000, 1080000, 3960000, 'active', '2026-07-12 03:31:44'),
(26, 23, 2, 'Lampu LED Camping', 'lampu-led-camping-26', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 25000, 150000, 550000, 'active', '2026-07-16 09:08:28'),
(27, 2, 3, 'Honda PCX 2023', 'honda-pcx-2023-27', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 100000, 600000, 2200000, 'active', '2026-07-10 09:50:02'),
(28, 5, 1, 'Drone DJI Mini 3 Pro', 'drone-dji-mini-3-pro-28', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 190000, 1140000, 4180000, 'active', '2026-07-13 08:38:13'),
(29, 6, 2, 'Trekking Pole Carbon', 'trekking-pole-carbon-29', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 35000, 210000, 770000, 'active', '2026-07-16 03:05:59'),
(30, 8, 3, 'Daihatsu Sigra 2019', 'daihatsu-sigra-2019-30', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 250000, 1500000, 5500000, 'active', '2026-07-12 01:24:17'),
(31, 8, 1, 'Gimbal DJI RS 3', 'gimbal-dji-rs-3-31', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 200000, 1200000, 4400000, 'active', '2026-07-15 02:25:09'),
(32, 18, 2, 'Tenda Tunnel 3 Orang', 'tenda-tunnel-3-orang-32', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 55000, 330000, 1210000, 'active', '2026-07-15 02:31:11'),
(33, 17, 3, 'Kawasaki Ninja 250', 'kawasaki-ninja-250-33', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 200000, 1200000, 4400000, 'active', '2026-07-11 07:14:44')
;
INSERT INTO `items` (`id`,`owner_id`,`category_id`,`name`,`slug`,`description`,`specifications`,`terms_conditions`,`price_daily`,`price_weekly`,`price_monthly`,`status`,`created_at`) VALUES
(34, 27, 1, 'Sony ZV-E10 Vlogging 1', 'sony-zv-e10-vlogging-1-34', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 200000, 1200000, 4400000, 'active', '2026-07-13 02:48:56'),
(35, 12, 2, 'Kapak Survival Multi 2', 'kapak-survival-multi-2-35', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 30000, 180000, 660000, 'active', '2026-07-14 02:35:22'),
(36, 4, 3, 'Toyota Innova Reborn 2020 3', 'toyota-innova-reborn-2020-3-36', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 550000, 3300000, 12100000, 'active', '2026-07-16 03:54:38'),
(37, 13, 1, 'Canon 90D DSLR 4', 'canon-90d-dslr-4-37', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 210000, 1260000, 4620000, 'active', '2026-07-15 01:54:47'),
(38, 13, 2, 'Cooler Box 25L 5', 'cooler-box-25l-5-38', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 40000, 240000, 880000, 'active', '2026-07-16 07:26:32'),
(39, 19, 3, 'Honda Scoopy 2021 6', 'honda-scoopy-2021-6-39', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 85000, 510000, 1870000, 'active', '2026-07-14 06:21:00'),
(40, 4, 1, 'Lighting Softbox 2pc 7', 'lighting-softbox-2pc-7-40', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 120000, 720000, 2640000, 'active', '2026-07-13 09:32:55'),
(41, 16, 2, 'Tenda Tipi Family 8', 'tenda-tipi-family-8-41', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 60000, 360000, 1320000, 'active', '2026-07-14 02:48:58'),
(42, 5, 3, 'Suzuki Nex II 2022 9', 'suzuki-nex-ii-2022-9-42', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 95000, 570000, 2090000, 'active', '2026-07-10 08:44:12'),
(43, 15, 1, 'Microphone Rode VideoMic 1', 'microphone-rode-videomic-1-43', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 80000, 480000, 1760000, 'active', '2026-07-10 07:47:11')
;
INSERT INTO `items` (`id`,`owner_id`,`category_id`,`name`,`slug`,`description`,`specifications`,`terms_conditions`,`price_daily`,`price_weekly`,`price_monthly`,`status`,`created_at`) VALUES
(44, 30, 2, 'Sleeping Bag Summer 2', 'sleeping-bag-summer-2-44', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 30000, 180000, 660000, 'active', '2026-07-12 03:34:59'),
(45, 2, 3, 'Wuling Cortez 2021 3', 'wuling-cortez-2021-3-45', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 500000, 3000000, 11000000, 'active', '2026-07-13 07:05:12'),
(46, 5, 1, 'Tripod Manfrotto 4', 'tripod-manfrotto-4-46', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 90000, 540000, 1980000, 'active', '2026-07-15 02:43:54'),
(47, 9, 2, 'Poncho Raincoat 5', 'poncho-raincoat-5-47', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 20000, 120000, 440000, 'active', '2026-07-10 09:57:24'),
(48, 10, 3, 'Yamaha Mio 2020 6', 'yamaha-mio-2020-6-48', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 75000, 450000, 1650000, 'active', '2026-07-14 04:32:45'),
(49, 10, 1, 'Mirrorless Panasonic GH6 7', 'mirrorless-panasonic-gh6-7-49', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 220000, 1320000, 4840000, 'active', '2026-07-10 02:35:44'),
(50, 11, 2, 'Jetboil Cooking System 8', 'jetboil-cooking-system-8-50', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 45000, 270000, 990000, 'active', '2026-07-16 02:00:06'),
(51, 13, 3, 'Honda CRF 150L 9', 'honda-crf-150l-9-51', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 150000, 900000, 3300000, 'active', '2026-07-13 03:01:48'),
(52, 6, 1, 'Action Cam Insta360 1', 'action-cam-insta360-1-52', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 170000, 1020000, 3740000, 'active', '2026-07-16 07:53:01'),
(53, 31, 2, 'Tenda Geodisic 2P 2', 'tenda-geodisic-2p-2-53', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 50000, 300000, 1100000, 'active', '2026-07-11 03:10:44')
;
INSERT INTO `items` (`id`,`owner_id`,`category_id`,`name`,`slug`,`description`,`specifications`,`terms_conditions`,`price_daily`,`price_weekly`,`price_monthly`,`status`,`created_at`) VALUES
(54, 10, 3, 'Toyota Calya 2019 3', 'toyota-calya-2019-3-54', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 230000, 1380000, 5060000, 'active', '2026-07-10 04:20:24'),
(55, 14, 1, 'Lensa Wide 16mm f/1.4 4', 'lensa-wide-16mm-f-1-4-4-55', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 140000, 840000, 3080000, 'active', '2026-07-11 05:47:27'),
(56, 33, 2, 'Kompor Gas Mini 5', 'kompor-gas-mini-5-56', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 25000, 150000, 550000, 'active', '2026-07-10 06:13:10'),
(57, 24, 3, 'Suzuki Satria FU 6', 'suzuki-satria-fu-6-57', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 120000, 720000, 2640000, 'active', '2026-07-12 07:46:02'),
(58, 27, 1, 'Studio Flash Godox 7', 'studio-flash-godox-7-58', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 130000, 780000, 2860000, 'active', '2026-07-15 01:25:57'),
(59, 30, 2, 'Tas Pinggang Hiking 8', 'tas-pinggang-hiking-8-59', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 30000, 180000, 660000, 'active', '2026-07-12 08:19:57'),
(60, 29, 3, 'Mitsubishi Pajero 2020 9', 'mitsubishi-pajero-2020-9-60', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 600000, 3600000, 13200000, 'active', '2026-07-14 07:32:46'),
(61, 9, 1, 'Drone DJI Air 2S 1', 'drone-dji-air-2s-1-61', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 250000, 1500000, 5500000, 'active', '2026-07-14 09:29:48'),
(62, 26, 2, 'Tenda Pop-up Beach 2', 'tenda-pop-up-beach-2-62', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 35000, 210000, 770000, 'active', '2026-07-14 04:10:37'),
(63, 12, 3, 'Honda ADV 150 3', 'honda-adv-150-3-63', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 130000, 780000, 2860000, 'active', '2026-07-10 06:56:18')
;
INSERT INTO `items` (`id`,`owner_id`,`category_id`,`name`,`slug`,`description`,`specifications`,`terms_conditions`,`price_daily`,`price_weekly`,`price_monthly`,`status`,`created_at`) VALUES
(64, 6, 1, 'Kamera Film Pentax 35mm 4', 'kamera-film-pentax-35mm-4-64', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 100000, 600000, 2200000, 'active', '2026-07-10 03:51:06'),
(65, 4, 2, 'Headlamp 1000 Lumens 5', 'headlamp-1000-lumens-5-65', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 40000, 240000, 880000, 'active', '2026-07-10 09:32:00'),
(66, 15, 3, 'KTM Duke 200 6', 'ktm-duke-200-6-66', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 180000, 1080000, 3960000, 'active', '2026-07-15 09:17:14'),
(67, 7, 1, 'Lensa Macro 105mm 7', 'lensa-macro-105mm-7-67', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 150000, 900000, 3300000, 'active', '2026-07-16 07:49:13'),
(68, 31, 2, 'Tenda Kemah Anak 8', 'tenda-kemah-anak-8-68', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 45000, 270000, 990000, 'active', '2026-07-16 07:45:39'),
(69, 17, 3, 'Toyota Fortuner 2019 9', 'toyota-fortuner-2019-9-69', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 700000, 4200000, 15400000, 'active', '2026-07-10 05:22:49'),
(70, 11, 1, 'Ring Light 18 inch 1', 'ring-light-18-inch-1-70', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 70000, 420000, 1540000, 'active', '2026-07-14 01:33:49'),
(71, 32, 2, 'Termos 1L Stainless 2', 'termos-1l-stainless-2-71', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 35000, 210000, 770000, 'active', '2026-07-13 09:40:34'),
(72, 16, 3, 'Yamaha Lexi 2022 3', 'yamaha-lexi-2022-3-72', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 90000, 540000, 1980000, 'active', '2026-07-15 09:17:08'),
(73, 19, 1, 'Stabilizer Zhiyun Crane 4', 'stabilizer-zhiyun-crane-4-73', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 160000, 960000, 3520000, 'active', '2026-07-15 02:42:40')
;
INSERT INTO `items` (`id`,`owner_id`,`category_id`,`name`,`slug`,`description`,`specifications`,`terms_conditions`,`price_daily`,`price_weekly`,`price_monthly`,`status`,`created_at`) VALUES
(74, 25, 2, 'Tenda Dome 8 Orang 5', 'tenda-dome-8-orang-5-74', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 70000, 420000, 1540000, 'active', '2026-07-12 08:21:17'),
(75, 15, 3, 'Daihatsu Gran Max 6', 'daihatsu-gran-max-6-75', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 200000, 1200000, 4400000, 'active', '2026-07-15 04:12:05'),
(76, 12, 1, 'Sony FX30 Cinema 7', 'sony-fx30-cinema-7-76', 'Kamera dan lensa profesional siap pakai untuk foto maupun video. Termasuk aksesoris pendukung, baterai ekstra, dan kartu memori. Cocok untuk acara, konten kreator, maupun dokumentasi.', 'Sensor full-frame 24MP; ISO 100-51200; 5-axis stabilizer; baterai NP-FZ100; 2x SD card slot; berat 650g.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 300000, 1800000, 6600000, 'active', '2026-07-14 04:33:51'),
(77, 18, 2, 'Kursi Lipat Camping 8', 'kursi-lipat-camping-8-77', 'Peralatan camping berkualitas untuk petualangan alam terbuka. Ringan, kokoh, dan mudah dibawa. Termasuk tenda, sleeping bag, dan perlengkapan survival.', 'Kapasitas 4 orang; bahan polyester waterproof 3000mm; berat 3.2kg; mudah dipasang <10 menit; dilengkapi jendela ventilasi.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 40000, 240000, 880000, 'active', '2026-07-12 07:42:02'),
(78, 14, 3, 'Honda Brio 2021 9', 'honda-brio-2021-9-78', 'Kendaraan terawat dengan dokumen lengkap dan asuransi dasar. Pas untuk perjalanan wisata maupun kebutuhan harian. Sudah termasuk helm dan perlengkapan keselamatan.', 'Transmisi otomatis; bahan bakar efisien; kapasitas 4 penumpang; AC dual zone; sudah service rutin; odometer terawat.', 'Sewa minimal 1 hari. Wajib menyerahkan KTP. Barang dikembalikan dalam kondisi sama. Kerusakan ditanggung penyewa.', 220000, 1320000, 4840000, 'active', '2026-07-12 07:44:05')
;

-- ITEM_IMAGES (is_primary=1)  themed photos via loremflickr
INSERT INTO `item_images` (`item_id`,`image_path`,`is_primary`) VALUES
(4, 'item_001.jpg', 1),
(5, 'item_002.jpg', 1),
(6, 'item_003.jpg', 1),
(7, 'item_004.jpg', 1),
(8, 'item_005.jpg', 1),
(9, 'item_006.jpg', 1),
(10, 'item_007.jpg', 1),
(11, 'item_008.jpg', 1),
(12, 'item_009.jpg', 1),
(13, 'item_010.jpg', 1)
;
INSERT INTO `item_images` (`item_id`,`image_path`,`is_primary`) VALUES
(14, 'item_011.jpg', 1),
(15, 'item_012.jpg', 1),
(16, 'item_013.jpg', 1),
(17, 'item_014.jpg', 1),
(18, 'item_015.jpg', 1),
(19, 'item_016.jpg', 1),
(20, 'item_017.jpg', 1),
(21, 'item_018.jpg', 1),
(22, 'item_019.jpg', 1),
(23, 'item_020.jpg', 1)
;
INSERT INTO `item_images` (`item_id`,`image_path`,`is_primary`) VALUES
(24, 'item_021.jpg', 1),
(25, 'item_022.jpg', 1),
(26, 'item_023.jpg', 1),
(27, 'item_024.jpg', 1),
(28, 'item_025.jpg', 1),
(29, 'item_026.jpg', 1),
(30, 'item_027.jpg', 1),
(31, 'item_028.jpg', 1),
(32, 'item_029.jpg', 1),
(33, 'item_030.jpg', 1)
;
INSERT INTO `item_images` (`item_id`,`image_path`,`is_primary`) VALUES
(34, 'item_031.jpg', 1),
(35, 'item_032.jpg', 1),
(36, 'item_033.jpg', 1),
(37, 'item_034.jpg', 1),
(38, 'item_035.jpg', 1),
(39, 'item_036.jpg', 1),
(40, 'item_037.jpg', 1),
(41, 'item_038.jpg', 1),
(42, 'item_039.jpg', 1),
(43, 'item_040.jpg', 1)
;
INSERT INTO `item_images` (`item_id`,`image_path`,`is_primary`) VALUES
(44, 'item_041.jpg', 1),
(45, 'item_042.jpg', 1),
(46, 'item_043.jpg', 1),
(47, 'item_044.jpg', 1),
(48, 'item_045.jpg', 1),
(49, 'item_046.jpg', 1),
(50, 'item_047.jpg', 1),
(51, 'item_048.jpg', 1),
(52, 'item_049.jpg', 1),
(53, 'item_050.jpg', 1)
;
INSERT INTO `item_images` (`item_id`,`image_path`,`is_primary`) VALUES
(54, 'item_051.jpg', 1),
(55, 'item_052.jpg', 1),
(56, 'item_053.jpg', 1),
(57, 'item_054.jpg', 1),
(58, 'item_055.jpg', 1),
(59, 'item_056.jpg', 1),
(60, 'item_057.jpg', 1),
(61, 'item_058.jpg', 1),
(62, 'item_059.jpg', 1),
(63, 'item_060.jpg', 1)
;
INSERT INTO `item_images` (`item_id`,`image_path`,`is_primary`) VALUES
(64, 'item_061.jpg', 1),
(65, 'item_062.jpg', 1),
(66, 'item_063.jpg', 1),
(67, 'item_064.jpg', 1),
(68, 'item_065.jpg', 1),
(69, 'item_066.jpg', 1),
(70, 'item_067.jpg', 1),
(71, 'item_068.jpg', 1),
(72, 'item_069.jpg', 1),
(73, 'item_070.jpg', 1)
;
INSERT INTO `item_images` (`item_id`,`image_path`,`is_primary`) VALUES
(74, 'item_071.jpg', 1),
(75, 'item_072.jpg', 1),
(76, 'item_073.jpg', 1),
(77, 'item_074.jpg', 1),
(78, 'item_075.jpg', 1)
;

-- SAMPLE BOOKINGS + REVIEWS
INSERT INTO `bookings` (`invoice_no`,`item_id`,`user_id`,`start_date`,`end_date`,`duration`,`daily_price`,`total_price`,`admin_fee`,`deposit`,`grand_total`,`status`,`created_at`) VALUES
('INV-00001', 4, 7, '2026-07-08', '2026-07-22', 5, 75000, 375000, 5000, 150000, 530000, 'active', '2026-07-04 12:00:00'),
('INV-00002', 5, 6, '2026-07-16', '2026-07-27', 7, 25000, 175000, 5000, 50000, 230000, 'active', '2026-07-05 12:00:00'),
('INV-00003', 6, 12, '2026-07-15', '2026-07-23', 2, 80000, 160000, 5000, 160000, 325000, 'completed', '2026-07-01 12:00:00'),
('INV-00004', 7, 27, '2026-07-05', '2026-07-21', 6, 90000, 540000, 5000, 180000, 725000, 'approved', '2026-07-04 12:00:00'),
('INV-00005', 8, 13, '2026-07-12', '2026-07-24', 4, 35000, 140000, 5000, 70000, 215000, 'active', '2026-07-04 12:00:00'),
('INV-00006', 9, 30, '2026-07-20', '2026-07-27', 7, 110000, 770000, 5000, 220000, 995000, 'completed', '2026-07-04 12:00:00'),
('INV-00007', 10, 17, '2026-07-15', '2026-07-26', 6, 110000, 660000, 5000, 220000, 885000, 'active', '2026-07-01 12:00:00'),
('INV-00008', 11, 31, '2026-07-05', '2026-07-22', 7, 30000, 210000, 5000, 60000, 275000, 'approved', '2026-07-04 12:00:00');

INSERT INTO `reviews` (`booking_id`,`item_id`,`user_id`,`rating`,`comment`,`created_at`) VALUES
(1, 4, 7, 5, 'Barang sesuai deskripsi, bersih, dan owner ramah. Recommended!', '2026-07-28 15:00:00'),
(2, 5, 6, 5, 'Barang sesuai deskripsi, bersih, dan owner ramah. Recommended!', '2026-07-25 15:00:00'),
(3, 6, 12, 4, 'Barang sesuai deskripsi, bersih, dan owner ramah. Recommended!', '2026-07-24 15:00:00'),
(4, 7, 27, 4, 'Barang sesuai deskripsi, bersih, dan owner ramah. Recommended!', '2026-07-26 15:00:00'),
(5, 8, 13, 4, 'Barang sesuai deskripsi, bersih, dan owner ramah. Recommended!', '2026-07-28 15:00:00'),
(6, 9, 30, 5, 'Barang sesuai deskripsi, bersih, dan owner ramah. Recommended!', '2026-07-21 15:00:00');
