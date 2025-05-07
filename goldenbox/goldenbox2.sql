-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 07, 2025 lúc 04:58 PM
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

--
-- Đang đổ dữ liệu cho bảng `bai_viets`
--

INSERT INTO `bai_viets` (`id`, `title_vi`, `title_en`, `mo_ta_ngan_vi`, `mo_ta_ngan_en`, `tac_gia`, `noi_dung_vi`, `noi_dung_en`, `luot_xem`, `anh_dai_dien`, `slug`, `created_at`, `updated_at`, `id_user`) VALUES
(1, 'Bài viết 1', 'Post 1', 'Mô tả 1', 'Desc 1', 'Nguyen Van A', 'Nội dung 1', 'Content 1', 10, 'img1.jpg', 'bai-viet-1', '2025-05-01 10:48:06', '2025-05-01 10:48:06', 1),
(2, 'Bài viết 2', 'Post 2', 'Mô tả 2', 'Desc 2', 'Tran Thi B', 'Nội dung 2', 'Content 2', 5, 'img2.jpg', 'bai-viet-2', '2025-05-01 10:48:06', '2025-05-01 10:48:06', 2);

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

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_anhs`
--

INSERT INTO `chi_tiet_anhs` (`id`, `id_san_pham`, `hinh_anh`, `created_at`, `updated_at`) VALUES
(1, 1, 'iphone14_side.jpg', '2025-05-01 10:47:06', '2025-05-01 10:47:06'),
(2, 1, 'iphone14_back.jpg', '2025-05-01 10:47:06', '2025-05-01 10:47:06'),
(3, 2, 'macbook_side.jpg', '2025-05-01 10:47:06', '2025-05-01 10:47:06');

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

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_don_hangs`
--

INSERT INTO `chi_tiet_don_hangs` (`id_don_hang`, `id_san_pham`, `so_luong`, `don_gia`) VALUES
(1, 1, 2, 100000.00),
(1, 2, 1, 150000.00),
(2, 1, 3, 100000.00),
(2, 2, 2, 150000.00),
(3, 1, 1, 100000.00),
(3, 2, 1, 150000.00),
(45, 1, 2, 100000.00),
(45, 2, 1, 150000.00),
(46, 1, 3, 100000.00),
(46, 2, 2, 150000.00),
(47, 1, 1, 100000.00),
(47, 2, 1, 150000.00),
(48, 1, 2, 100000.00),
(48, 2, 2, 150000.00),
(49, 1, 1, 100000.00),
(49, 2, 3, 150000.00),
(50, 1, 2, 100000.00),
(50, 2, 1, 150000.00),
(51, 1, 1, 100000.00),
(51, 2, 1, 150000.00),
(52, 1, 3, 100000.00),
(52, 2, 2, 150000.00),
(53, 1, 2, 100000.00),
(53, 2, 2, 150000.00);

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

--
-- Đang đổ dữ liệu cho bảng `danh_mucs`
--

INSERT INTO `danh_mucs` (`id`, `ten_danh_muc_vi`, `ten_danh_muc_en`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Điện thoại', 'Phones', 'dien-thoai', '2025-05-01 10:42:49', '2025-05-01 10:42:49'),
(2, 'Laptop', 'Laptops', 'laptop', '2025-05-01 10:42:49', '2025-05-01 10:42:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hangs`
--

CREATE TABLE `don_hangs` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `trang_thai_giao_hang` enum('chưa giao','đã giao') NOT NULL DEFAULT 'chưa giao',
  `trang_thai_thanh_toan` enum('chưa thanh toán','đã thanh toán') NOT NULL DEFAULT 'chưa thanh toán',
  `trang_thai_call` enum('đã gọi','chưa gọi') NOT NULL DEFAULT 'chưa gọi',
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `tong_tien` decimal(15,2) NOT NULL,
  `ghi_chu` text DEFAULT NULL,
  `phuong_thuc_thanh_toan` varchar(100) NOT NULL,
  `id_ma_khuyen_mai` int(11) DEFAULT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `so_dien_thoai` varchar(20) NOT NULL,
  `dia_chi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `don_hangs`
--

INSERT INTO `don_hangs` (`id`, `created_at`, `updated_at`, `trang_thai_giao_hang`, `trang_thai_thanh_toan`, `trang_thai_call`, `id_user`, `tong_tien`, `ghi_chu`, `phuong_thuc_thanh_toan`, `id_ma_khuyen_mai`, `ho_ten`, `email`, `so_dien_thoai`, `dia_chi`) VALUES
(1, '2025-05-01 01:28:58', '2025-05-01 10:50:32', 'chưa giao', 'chưa thanh toán', 'chưa gọi', 1, 18000000.00, 'Giao nhanh', 'cod', 1, 'Nguyen Van A', 'a@gmail.com', '0123456789', 'Hà Nội'),
(2, '2025-05-02 01:29:16', '2025-05-01 10:50:32', 'đã giao', 'đã thanh toán', 'đã gọi', 2, 29750000.00, 'Giao trước 3h', 'banking', 2, 'Tran Thi B', 'b@gmail.com', '0987654321', 'TP.HCM'),
(3, '2025-05-03 01:29:42', NULL, 'chưa giao', 'đã thanh toán', 'chưa gọi', 4, 10000000.00, 'Giao trước 12h ', 'Thanh toán khi nhận hàng', 1, 'Nguyễn Bá Thước', 'ndns2@Gmail.com', '0961460727', '11/1525 Đông vệ Tp.Thanh Hóa'),
(44, '2025-05-04 01:30:05', NULL, 'chưa giao', 'đã thanh toán', 'đã gọi', 2, 500000.00, 'Giao giờ hành chính', 'Thanh toán khi nhận hàng', 2, 'Trần Văn Bình', 'binhtran@example.com', '0901234567', '123 Lê Lợi, Hà Nội'),
(45, '2025-05-05 02:10:45', NULL, 'đã giao', 'đã thanh toán', 'đã gọi', 3, 1500000.00, '', 'Chuyển khoản', NULL, 'Phạm Thị Hoa', 'hoa.pham@gmail.com', '0912345678', '456 Trần Phú, TP.HCM'),
(46, '2025-05-06 02:11:03', NULL, 'đã giao', 'đã thanh toán', 'đã gọi', 3, 750000.00, 'Giao buổi chiều', 'Thanh toán khi nhận hàng', NULL, 'Lê Minh Tú', 'minhtu@yahoo.com', '0987654321', '789 Nguyễn Huệ, Đà Nẵng'),
(47, '2025-05-07 02:11:26', NULL, 'đã giao', 'đã thanh toán', 'đã gọi', 3, 200000.00, 'Khách không nhận hàng', 'Thanh toán khi nhận hàng', NULL, 'Hoàng Văn Long', 'longhv@outlook.com', '0933344556', '321 Quang Trung, Hải Phòng'),
(48, '2025-05-07 02:14:35', NULL, 'đã giao', 'đã thanh toán', 'đã gọi', 2, 3500000.00, 'Giao sớm trước 9h', 'Momo', NULL, 'Nguyễn Văn An', 'an.nguyen@gmail.com', '0966112233', '22/10 Phạm Văn Đồng, Cần Thơ'),
(49, '2025-05-01 02:14:18', NULL, 'chưa giao', 'chưa thanh toán', 'chưa gọi', 2, 1200000.00, '', 'ZaloPay', NULL, 'Đỗ Thị Lan', 'lan.do@gmail.com', '0977888999', '88/3A Hoàng Hoa Thám, Huế'),
(50, '2025-05-01 02:12:13', NULL, 'đã giao', 'đã thanh toán', 'đã gọi', 3, 2100000.00, 'Giao tại cơ quan', 'Chuyển khoản', NULL, 'Ngô Quang Hưng', 'h.nqoang@gmail.com', '0923456789', 'Tầng 5, Tòa nhà ABC, TP.HCM'),
(51, '2025-05-03 02:13:32', NULL, 'đã giao', 'đã thanh toán', 'đã gọi', 3, 890000.00, '', 'Thanh toán khi nhận hàng', NULL, 'Trịnh Thị Ngọc', 'ngoc.trinh@example.com', '0944556677', 'Ngõ 68, Nguyễn Trãi, Hà Nội'),
(52, '2025-05-04 02:13:48', NULL, 'đã giao', 'đã thanh toán', 'đã gọi', 2, 620000.00, 'Giao tận nơi sau 18h', 'Momo', NULL, 'Vũ Đức Anh', 'anhvuduc@example.com', '0911223344', '12 Trần Đại Nghĩa, Hà Nội'),
(53, '2025-05-05 02:14:02', NULL, 'chưa giao', 'chưa thanh toán', 'chưa gọi', 2, 300000.00, '', 'ZaloPay', NULL, 'Lý Thị Mai', 'maily@gmail.com', '0977332211', 'Phường 9, Quận 3, TP.HCM');

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

--
-- Đang đổ dữ liệu cho bảng `ma_khuyen_mais`
--

INSERT INTO `ma_khuyen_mais` (`id`, `ma_code`, `mo_ta`, `gia_tri`, `loai`, `ngay_bat_dau`, `ngay_ket_thuc`, `so_luong_ma`, `trang_thai`, `created_at`, `updated_at`) VALUES
(1, 'SALE10', 'Giảm 10%', 10, 'phan_tram', '2025-05-01', '2025-06-01', 100, 'con_hieu_luc', '2025-05-01 10:44:06', '2025-05-01 10:44:06'),
(2, 'SALE15', 'Giảm 15%', 15, 'phan_tram', '2025-05-01', '2025-07-01', 50, 'con_hieu_luc', '2025-05-01 10:44:06', '2025-05-01 10:44:06');

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

--
-- Đang đổ dữ liệu cho bảng `san_phams`
--

INSERT INTO `san_phams` (`id`, `ten_san_pham_vi`, `ten_san_pham_en`, `mo_ta_ngan_vi`, `mo_ta_ngan_en`, `id_danh_muc`, `mo_ta_vi`, `mo_ta_en`, `anh_chinh`, `so_luong`, `so_luot_mua`, `gia_goc_vi`, `gia_goc_en`, `khuyen_mai`, `trang_thai`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'iPhone 14', 'iPhone 14', 'Mô tả IP14', 'Desc IP14', 1, NULL, NULL, 'iphone14.jpg', 100, 10, 20000000.00, 20000000.00, 10, 'con_ban', 'iphone-14', '2025-05-01 10:46:29', '2025-05-01 10:46:29'),
(2, 'MacBook Pro', 'MacBook Pro', 'Mô tả MBP', 'Desc MBP', 2, NULL, NULL, 'macbook.jpg', 50, 5, 35000000.00, 35000000.00, 15, 'con_ban', 'macbook-pro', '2025-05-01 10:46:29', '2025-05-01 10:46:29');

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
('pAxOvSG5Hm9OERJsvEg30MT1rlMDP9vKgyS4QVFs', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTTdUWWxpQVcyemd6MlhGNWdUZVhLcE5VZ213aEpYaExvbFptQVpMRSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjUxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vZGFzaGJvYXJkL2NoYXJ0dHVybm92ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1746586394);

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
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$Mjoc0xPM1SB3IUa8gX.NiezqnsHVVUsz1kyNxuJJnfGT5yYVsqjn6', NULL, 'admin', '2025-04-27 01:13:28', '2025-04-27 01:13:28'),
(2, 'Nguyen Van A', 'a@gmail.com', NULL, '123456', NULL, 'admin', '2025-05-01 10:47:56', '2025-05-01 10:47:56'),
(3, 'Tran Thi B', 'b@gmail.com', NULL, '123456', NULL, 'nhanvien', '2025-05-01 10:47:56', '2025-05-01 10:47:56'),
(4, 'Le Van C', 'c@gmail.com', NULL, '123456', NULL, 'nhanvien', '2025-05-01 10:47:56', '2025-05-01 10:47:56');

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
  ADD KEY `id_danh_muc` (`id_danh_muc`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_anhs`
--
ALTER TABLE `chi_tiet_anhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `danh_mucs`
--
ALTER TABLE `danh_mucs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `don_hangs`
--
ALTER TABLE `don_hangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

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
-- AUTO_INCREMENT cho bảng `ma_khuyen_mais`
--
ALTER TABLE `ma_khuyen_mais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `san_phams`
--
ALTER TABLE `san_phams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  ADD CONSTRAINT `san_phams_ibfk_1` FOREIGN KEY (`id_danh_muc`) REFERENCES `danh_mucs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
