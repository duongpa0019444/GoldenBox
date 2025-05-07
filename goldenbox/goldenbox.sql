-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 27, 2025 lúc 05:06 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `goldenbox2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bai_viets`
--

CREATE TABLE `bai_viets` (
  `id` int(11) NOT NULL,
  `title_vi` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `mo_ta_ngan_vi` text DEFAULT NULL,
  `mo_ta_ngan_en` text DEFAULT NULL,
  `tac_gia` varchar(255) DEFAULT NULL,
  `noi_dung_vi` text DEFAULT NULL,
  `noi_dung_en` text DEFAULT NULL,
  `luot_xem` int(11) DEFAULT 0,
  `anh_dai_dien` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_anhs`
--

CREATE TABLE `chi_tiet_anhs` (
  `id` int(11) NOT NULL,
  `id_san_pham` int(11) NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_don_hangs`
--

CREATE TABLE `chi_tiet_don_hangs` (
  `id_don_hang` int(11) NOT NULL,
  `id_san_pham` int(11) NOT NULL,
  `so_luong` int(11) DEFAULT 1,
  `don_gia` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_mucs`
--

CREATE TABLE `danh_mucs` (
  `id` int(11) NOT NULL,
  `ten_danh_muc_vi` varchar(255) NOT NULL,
  `ten_danh_muc_en` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hangs`
--

CREATE TABLE `don_hangs` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `trang_thai_giao_hang` enum('chua_giao','da_giao') DEFAULT 'chua_giao',
  `trang_thai_thanh_toan` enum('chua_thanh_toan','da_thanh_toan') DEFAULT 'chua_thanh_toan',
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `tong_tien` decimal(15,2) NOT NULL,
  `ghi_chu` text DEFAULT NULL,
  `phuong_thuc_thanh_toan` varchar(100) DEFAULT NULL,
  `id_ma_khuyen_mai` int(11) DEFAULT NULL,
  `ho_ten` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `dia_chi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

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
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khach_hangs`
--

CREATE TABLE `khach_hangs` (
  `id` int(11) NOT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `dia_chi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ma_khuyen_mais`
--

CREATE TABLE `ma_khuyen_mais` (
  `id` int(11) NOT NULL,
  `ma_code` varchar(50) NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `gia_tri` int(11) NOT NULL,
  `loai` enum('phan_tram') DEFAULT 'phan_tram',
  `ngay_bat_dau` date DEFAULT NULL,
  `ngay_ket_thuc` date DEFAULT NULL,
  `so_luong_ma` int(11) DEFAULT 0,
  `trang_thai` enum('con_hieu_luc','het_hieu_luc') DEFAULT 'con_hieu_luc',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_phams`
--

CREATE TABLE `san_phams` (
  `id` int(11) NOT NULL,
  `ten_san_pham_vi` varchar(255) NOT NULL,
  `ten_san_pham_en` varchar(255) DEFAULT NULL,
  `mo_ta_ngan_vi` text DEFAULT NULL,
  `mo_ta_ngan_en` text DEFAULT NULL,
  `id_danh_muc` int(11) NOT NULL,
  `mo_ta_vi` text DEFAULT NULL,
  `mo_ta_en` text DEFAULT NULL,
  `anh_chinh` varchar(255) NOT NULL,
  `so_luong` int(11) DEFAULT 0,
  `so_luot_mua` int(11) DEFAULT 0,
  `gia_goc_vi` decimal(15,2) NOT NULL,
  `gia_goc_en` decimal(15,2) NOT NULL,
  `khuyen_mai` int(11) DEFAULT NULL,
  `trang_thai` enum('con_ban','ngung_ban') DEFAULT 'con_ban',
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('kBX1bJfXD4MkTLdpFTUQH4Ba4r99Bc0aNntArMkI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRjJ1cE5wS2drMWJGT1NUUGxNWXRkZDl1WVY5aW4yRHJDQlFUWElEQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1745723167);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` enum('admin','nhanvien') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bai_viets`
--
ALTER TABLE `bai_viets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `chi_tiet_anhs`
--
ALTER TABLE `chi_tiet_anhs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_san_pham` (`id_san_pham`);

--
-- Chỉ mục cho bảng `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  ADD PRIMARY KEY (`id_don_hang`,`id_san_pham`),
  ADD KEY `id_san_pham` (`id_san_pham`);

--
-- Chỉ mục cho bảng `danh_mucs`
--
ALTER TABLE `danh_mucs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_ma_khuyen_mai` (`id_ma_khuyen_mai`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `khach_hangs`
--
ALTER TABLE `khach_hangs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ma_khuyen_mais`
--
ALTER TABLE `ma_khuyen_mais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ma_code` (`ma_code`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `san_phams`
--
ALTER TABLE `san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_danh_muc` (`id_danh_muc`),
  ADD KEY `khuyen_mai` (`khuyen_mai`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bai_viets`
--
ALTER TABLE `bai_viets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_anhs`
--
ALTER TABLE `chi_tiet_anhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `danh_mucs`
--
ALTER TABLE `danh_mucs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `don_hangs`
--
ALTER TABLE `don_hangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khach_hangs`
--
ALTER TABLE `khach_hangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ma_khuyen_mais`
--
ALTER TABLE `ma_khuyen_mais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `san_phams`
--
ALTER TABLE `san_phams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bai_viets`
--
ALTER TABLE `bai_viets`
  ADD CONSTRAINT `fk_user_id_bv` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `chi_tiet_anhs`
--
ALTER TABLE `chi_tiet_anhs`
  ADD CONSTRAINT `chi_tiet_anhs_ibfk_1` FOREIGN KEY (`id_san_pham`) REFERENCES `san_phams` (`id`);

--
-- Các ràng buộc cho bảng `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  ADD CONSTRAINT `chi_tiet_don_hangs_ibfk_1` FOREIGN KEY (`id_don_hang`) REFERENCES `don_hangs` (`id`),
  ADD CONSTRAINT `chi_tiet_don_hangs_ibfk_2` FOREIGN KEY (`id_san_pham`) REFERENCES `san_phams` (`id`);

--
-- Các ràng buộc cho bảng `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD CONSTRAINT `fk_ma_khuyen_mai` FOREIGN KEY (`id_ma_khuyen_mai`) REFERENCES `ma_khuyen_mais` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `san_phams`
--
ALTER TABLE `san_phams`
  ADD CONSTRAINT `san_phams_ibfk_1` FOREIGN KEY (`id_danh_muc`) REFERENCES `danh_mucs` (`id`),
  ADD CONSTRAINT `san_phams_ibfk_2` FOREIGN KEY (`khuyen_mai`) REFERENCES `ma_khuyen_mais` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
