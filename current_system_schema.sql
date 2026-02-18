SET FOREIGN_KEY_CHECKS = 0;

-- =========================
-- TABLE: users
-- =========================
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'mahasiswa',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- TABLE: password_reset_tokens
-- =========================
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- TABLE: sessions
-- =========================
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- TABLE: cache
-- =========================
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- TABLE: cache_locks
-- =========================
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- TABLE: jobs
-- =========================
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- TABLE: job_batches
-- =========================
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- TABLE: failed_jobs
-- =========================
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- TABLE: gelombangs
-- =========================
DROP TABLE IF EXISTS `gelombangs`;
CREATE TABLE `gelombangs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tahun` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- TABLE: jadwal_seleksis
-- =========================
DROP TABLE IF EXISTS `jadwal_seleksis`;
CREATE TABLE `jadwal_seleksis` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `waktu` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- TABLE: syarat_dokumens
-- =========================
DROP TABLE IF EXISTS `syarat_dokumens`;
CREATE TABLE `syarat_dokumens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `wajib` tinyint(1) NOT NULL DEFAULT 1,
  `format` varchar(255) NOT NULL DEFAULT 'PDF, JPG, PNG',
  `max_size` varchar(255) NOT NULL DEFAULT '2MB',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- TABLE: pengumumen
-- =========================
DROP TABLE IF EXISTS `pengumumen`;
CREATE TABLE `pengumumen` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- TABLE: system_settings
-- =========================
DROP TABLE IF EXISTS `system_settings`;
CREATE TABLE `system_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `system_settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- TABLE: pendaftar
-- =========================
DROP TABLE IF EXISTS `pendaftar`;
CREATE TABLE `pendaftar` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nomor_pendaftaran` varchar(255) DEFAULT NULL,
  `gelombang` enum('1','2','3') NOT NULL,
  `pilihan_prodi` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nisn` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `golongan_darah` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kabupaten` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `jurusan_sekolah` varchar(255) NOT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `nilai_rata_rata` decimal(5,2) NOT NULL,
  `alamat_sekolah` varchar(255) NOT NULL,
  `nama_ayah` varchar(255) NOT NULL,
  `pekerjaan_ayah` varchar(255) NOT NULL,
  `hp_ayah` varchar(255) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `pekerjaan_ibu` varchar(255) DEFAULT NULL,
  `hp_ibu` varchar(255) NOT NULL,
  `univ_asal` varchar(255) DEFAULT NULL,
  `prodi_asal` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'draft',
  `status_pembayaran` enum('belum_bayar','lunas') NOT NULL DEFAULT 'belum_bayar',
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  
  -- Additional fields from migrations
  `penerima_kps` tinyint(1) NOT NULL DEFAULT 0,
  `no_kps` varchar(30) DEFAULT NULL,
  `peserta_kip` tinyint(1) NOT NULL DEFAULT 0,
  `no_kip` varchar(30) DEFAULT NULL,
  `transportasi` varchar(50) DEFAULT NULL,
  `tinggal_bersama` varchar(50) DEFAULT NULL,
  `rt` varchar(5) DEFAULT NULL,
  `rw` varchar(5) DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `negara` varchar(50) DEFAULT NULL,
  `alamat_sekolah_rt` varchar(5) DEFAULT NULL,
  `alamat_sekolah_rw` varchar(5) DEFAULT NULL,
  `alamat_sekolah_kelurahan` varchar(60) DEFAULT NULL,
  `alamat_sekolah_kecamatan` varchar(60) DEFAULT NULL,
  `alamat_sekolah_kota` varchar(60) DEFAULT NULL,
  `alamat_sekolah_provinsi` varchar(60) DEFAULT NULL,
  `alamat_sekolah_negara` varchar(50) DEFAULT NULL,
  `no_ijazah` varchar(50) DEFAULT NULL,
  `status_ayah` varchar(20) DEFAULT NULL,
  `nik_ayah` varchar(20) DEFAULT NULL,
  `agama_ayah` varchar(20) DEFAULT NULL,
  `tempat_lahir_ayah` varchar(60) DEFAULT NULL,
  `tanggal_lahir_ayah` date DEFAULT NULL,
  `pendidikan_ayah` varchar(50) DEFAULT NULL,
  `penghasilan_ayah` varchar(50) DEFAULT NULL,
  `no_hp_ayah` varchar(20) DEFAULT NULL,
  `alamat_ayah` varchar(150) DEFAULT NULL,
  `rt_ayah` varchar(5) DEFAULT NULL,
  `rw_ayah` varchar(5) DEFAULT NULL,
  `kelurahan_ayah` varchar(60) DEFAULT NULL,
  `kecamatan_ayah` varchar(60) DEFAULT NULL,
  `kota_ayah` varchar(60) DEFAULT NULL,
  `provinsi_ayah` varchar(60) DEFAULT NULL,
  `negara_ayah` varchar(50) DEFAULT NULL,
  `status_ibu` varchar(20) DEFAULT NULL,
  `nik_ibu` varchar(20) DEFAULT NULL,
  `no_hp_ibu` varchar(20) DEFAULT NULL,
  `penghasilan_ibu` varchar(50) DEFAULT NULL,
  `alamat_ibu` varchar(150) DEFAULT NULL,
  `rt_ibu` varchar(5) DEFAULT NULL,
  `rw_ibu` varchar(5) DEFAULT NULL,
  `kelurahan_ibu` varchar(60) DEFAULT NULL,
  `kecamatan_ibu` varchar(60) DEFAULT NULL,
  `kota_ibu` varchar(60) DEFAULT NULL,
  `provinsi_ibu` varchar(60) DEFAULT NULL,
  `negara_ibu` varchar(50) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `hubungan_wali` varchar(30) DEFAULT NULL,
  `penghasilan_wali` varchar(50) DEFAULT NULL,
  `no_hp_wali` varchar(20) DEFAULT NULL,
  `pekerjaan_wali` varchar(50) DEFAULT NULL,
  `sumber_biaya` varchar(20) DEFAULT NULL,
  `status_akreditasi_asal` varchar(10) DEFAULT NULL,
  `ipk` decimal(3,2) DEFAULT NULL,
  
  -- Fields from latest migration (2026_01_23)
  -- Note: System defaults for string is 255 if not specified in migration
  `agama` varchar(255) DEFAULT NULL,
  `tinggi_badan` int(11) DEFAULT NULL,
  `berat_badan` int(11) DEFAULT NULL,
  `kewarganegaraan` varchar(255) DEFAULT NULL,
  `status_pernikahan` varchar(255) DEFAULT NULL,
  `npwp` varchar(255) DEFAULT NULL,
  `agama_ibu` varchar(255) DEFAULT NULL,
  `tempat_lahir_ibu` varchar(255) DEFAULT NULL,
  `tanggal_lahir_ibu` date DEFAULT NULL,
  `pendidikan_ibu` varchar(255) DEFAULT NULL,

  PRIMARY KEY (`id`),
  UNIQUE KEY `pendaftar_nomor_pendaftaran_unique` (`nomor_pendaftaran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- TABLE: dokumen_pendaftar
-- =========================
DROP TABLE IF EXISTS `dokumen_pendaftar`;
CREATE TABLE `dokumen_pendaftar` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pendaftar_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_dokumen` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `status` enum('pending','valid','invalid') NOT NULL DEFAULT 'pending',
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dokumen_pendaftar_pendaftar_id_foreign` (`pendaftar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- TABLE: migrations
-- =========================
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- INSERT DATA
-- =========================

INSERT INTO `jadwal_seleksis` (`id`, `nama`, `tanggal`, `waktu`, `lokasi`, `created_at`, `updated_at`) VALUES
(3, 'Gelombang 1', '2026-01-04', '08.00', 'Gedung B : Aula', '2026-02-04 01:43:35', '2026-02-04 01:43:35');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_08_114452_create_pendaftar_table', 1),
(5, '2026_01_08_114456_create_dokumen_pendaftar_table', 1),
(6, '2026_01_14_033201_add_details_to_pendaftar_table', 1),
(7, '2026_01_14_050124_add_missing_columns_to_pendaftar_table', 1),
(8, '2026_01_15_012648_make_pekerjaan_ibu_nullable', 1),
(9, '2026_01_22_082405_create_gelombangs_table', 2),
(10, '2026_01_22_113627_create_jadwal_seleksis_table', 3),
(11, '2026_01_22_113914_create_syarat_dokumens_table', 4),
(12, '2026_01_22_120240_add_status_pembayaran_to_pendaftars_table', 5),
(13, '2026_01_22_152556_change_status_cloumn_in_pendaftar_table', 6),
(14, '2026_01_22_165255_add_profile_photo_path_to_users_table', 7),
(15, '2026_01_23_061911_create_pengumumen_table', 8),
(16, '2026_02_03_044113_create_system_settings_table', 9),
(17, '2026_02_03_044705_add_role_to_users_table', 10),
(18, '2026_01_23_021522_add_details_to_pendaftar_table', 11),
(19, '2026_01_28_033917_add_catatan_to_pendaftar_table', 12),
(20, '2026_01_28_040339_add_status_and_catatan_to_dokumen_pendaftar_table', 12);

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$12$GUI/CwXtRMcg9iv/LNQ//u4Na0egerAE4mRxo0iJmXgZpmb03B0TO', '2026-01-22 16:13:57');

INSERT INTO `pengumumen` (`id`, `judul`, `isi`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Pengumuman ujian', 'Batal dilaksanakan', 1, '2026-01-26 21:03:47', '2026-02-04 01:48:04');

INSERT INTO `system_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'target_kuota', '3500', '2026-02-02 21:43:21', '2026-02-02 21:43:21'),
(2, 'periode_start', '2026-01-01', '2026-02-02 21:43:21', '2026-02-02 21:43:21'),
(3, 'periode_end', '2026-05-31', '2026-02-02 21:43:21', '2026-02-02 21:43:21');

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `profile_photo_path`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mahasiswa Maba', 'maba@gmail.com', 'mahasiswa', NULL, '$2y$12$2700uIF1eX5u7/fmXko9SOGHW9R4CIr8rrMLxgiOM/IQyxPdbWUMG', NULL, NULL, '2026-01-21 19:04:16', '2026-01-21 19:04:16'),
(3, 'Pimpinan Pimpinan', 'pimpinan@kampus.id', 'pimpinan', NULL, '$2y$12$7Y69ngJRAVOh9yOpcMVqbO2eb3e0vQP2JvKJm93vCuXWGbdpaYkom', NULL, NULL, '2026-01-22 05:28:55', '2026-01-26 22:58:26'),
(4, 'Mahasiswa Ryu', 'ryu@gmail.com', 'mahasiswa', NULL, '$2y$12$svB8LT5szPP1TO25RCsj3eNuG0CL2RkgY37Pg3jNvL4.ZHLqnIXVm', NULL, NULL, '2026-01-22 05:30:32', '2026-01-22 05:30:32'),
(5, 'Admin Admin', 'admin@gmail.com', 'admin', NULL, '$2y$12$T7c6u3L.dDqE7/DOAEpCfeMKGKIQh0iM3h307XPziTiQKDZMfKc.a', NULL, NULL, '2026-01-22 08:23:19', '2026-01-22 08:23:19'),
(6, 'Himmel', 'Himmel@gmail.com', 'mahasiswa', NULL, '$2y$12$/qU4yB.jVdfWBPYx/kVB7.iI0bn2ERnT3qvQG10WUVk2du37Ekp2y', NULL, NULL, '2026-01-22 18:33:34', '2026-01-22 18:33:34'),
(7, 'pim', 'pimpinan@gmail.com', 'pimpinan', NULL, '$2y$12$rILcYR79kCN/qd/e0SvGg.MLoIDmzXP6mDicC.zCZQsNihbCSgbzu', NULL, NULL, '2026-01-22 18:50:49', '2026-01-22 18:50:49'),
(20, 'ryu', 'ryuamatasik@gmail.com', 'mahasiswa', NULL, '$2y$12$QbN3QJgVKZE2uAgOkhM4beeAKu0ZyclFEcUEY3cUPrf4rg1kVkNIW', 'profile-photos/Y6LyllMa4I2I2snkKB3tjywnKGkl2NI6hltKMUkP.jpg', NULL, '2026-01-27 22:29:04', '2026-02-08 21:01:19'),
(21, 'Administrator', 'admin@binaadinata.ac.id', 'admin', '2026-02-08 10:08:33', '$2y$12$ZUfT25yfBuaIHTd48lHmuOdeVtUC26dPSM7ppHgA.h1QFrysY/9km', NULL, NULL, '2026-02-08 10:08:33', '2026-02-08 10:46:08'),
(22, 'Pimpinan', 'pimpinan@binaadinata.ac.id', 'pimpinan', '2026-02-08 10:08:34', '$2y$12$tndWDRcvhVD8k/FlECHYgec2UkbOpWh2boWvRZSYZmLxzpIjSEkFe', NULL, NULL, '2026-02-08 10:08:34', '2026-02-08 10:46:08'),
(26, 'Naga', 'cocytuss12@gmail.com', 'mahasiswa', NULL, '$2y$12$8gO.XY9pUraNHZAX54pmH.RBa/mRn2Xz/ObzJb.Wh5cGA4IzsH5fW', NULL, NULL, '2026-02-09 20:48:23', '2026-02-09 20:48:23');

-- placeholder for pendaftar data --
-- INSERT INTO pendaftar (...) VALUES (...);

INSERT INTO `dokumen_pendaftar` (`id`, `pendaftar_id`, `jenis_dokumen`, `file_path`, `original_name`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
(46, 37, 'ktp', 'uploads/7uZllmR6oaezbiWSX7fJru2Uf3X47w2fiPM8OYe3.png', 'ktp.png', 'valid', NULL, '2026-01-27 22:31:14', '2026-01-27 23:28:39'),
(47, 37, 'ktp_ortu', 'uploads/NgzFhIcVocHskSfOqRxB5MbyGkyGrP8BQBZ7g9Dj.webp', 'ktp ortu.jpg', 'valid', NULL, '2026-01-27 22:31:14', '2026-01-27 23:23:46'),
(48, 37, 'akte', 'uploads/5MBBy3l7ZIry5ne8Hiix6z55gGHIC5204sMvsED4.png', 'akte.png', 'pending', NULL, '2026-01-27 22:31:14', '2026-01-27 22:31:14'),
(49, 37, 'ijazah', 'uploads/jGZLMtjsz4ABcW1ms3p5yA8e3XK06H1Vt1GkyWlI.jpg', 'ijazah.jpg', 'pending', NULL, '2026-01-27 22:31:14', '2026-01-27 22:31:14'),
(50, 37, 'kk', 'uploads/l78wHuOG0zywpDuBluP3b5QuRVCfbj0p5ezEQjBY.webp', 'kk.jpg', 'pending', NULL, '2026-01-27 22:31:14', '2026-01-27 22:31:14'),
(51, 37, 'foto', 'uploads/UDfxAvccMcoMma66u3amGGi3oBkKnMRBaREVrt7F.jpg', 'foto.jpg', 'pending', NULL, '2026-01-27 22:31:14', '2026-01-27 22:31:14'),
(52, 37, 'transkrip', 'uploads/Pno3URgqN1czykRV2ACiht8c9fp5eHFTgUVA8dY9.webp', 'transkirp.jpg', 'pending', NULL, '2026-01-27 22:31:14', '2026-01-27 22:31:14'),
(53, 37, 'bukti_pembayaran', 'uploads/gw55JYQitfNqWg4jgGmnSnoWaf8FrMfhwAIpNgfd.png', 'bukti pembayaran.png', 'pending', NULL, '2026-01-27 22:31:14', '2026-01-27 22:31:14');

SET FOREIGN_KEY_CHECKS = 1;
COMMIT;
