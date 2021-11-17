-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 17, 2021 lúc 02:17 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL COMMENT 'Mã Loại',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên loại SP',
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'SLug Loại SP',
  `parentid` int(11) NOT NULL DEFAULT 0 COMMENT 'Mã cấp cha',
  `orders` int(11) NOT NULL COMMENT 'Thứ tự',
  `metakey` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Từ khóa SEO',
  `metadesc` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mô tả SEO',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo',
  `created_by` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Người tạo',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày sửa',
  `updated_by` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Người sửa',
  `status` tinyint(4) NOT NULL DEFAULT 2 COMMENT 'Trạng thái',
  `is_delete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `parentid`, `orders`, `metakey`, `metadesc`, `created_at`, `created_by`, `updated_at`, `updated_by`, `status`, `is_delete`) VALUES
(1, 'Chairs', '', 0, 0, '', '', '2021-11-09 06:19:02', 0, '2021-11-15 06:04:05', 0, 1, 0),
(2, 'Tables', '', 0, 0, '', '', '2021-11-09 07:05:26', 0, '2021-11-15 05:05:12', 0, 1, 0),
(3, 'Light', '', 0, 0, '', '', '2021-11-09 07:06:53', 0, '2021-11-15 01:59:45', 0, 1, 0),
(4, 'pots', '', 0, 0, '', '', '2021-11-09 07:35:01', 0, '2021-11-10 09:32:48', 0, 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Mã sản phẩm',
  `catid` int(10) UNSIGNED NOT NULL COMMENT 'Mã loại sản phẩm',
  `name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên sản phẩm',
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Hình ảnh',
  `detail` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'Chi tiết',
  `number` smallint(5) UNSIGNED NOT NULL COMMENT 'Số lượng',
  `price` int(20) NOT NULL COMMENT 'Giá',
  `pricesale` int(20) NOT NULL COMMENT 'Giá khuyến mãi',
  `metakey` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Từ khóa SEO',
  `metadesc` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mô tả SEO',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo',
  `created_by` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Người tạo',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày sửa',
  `updated_by` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Người sửa',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 2 COMMENT 'Trạng thái',
  `is_delete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `catid`, `name`, `img`, `detail`, `number`, `price`, `pricesale`, `metakey`, `metadesc`, `created_at`, `created_by`, `updated_at`, `updated_by`, `status`, `is_delete`) VALUES
(1, 1, 'Modern Chair 1', 'product_1637111672.jpg', 'asdasd', 1, 15, 12, 'dsasdasd', 'asdasda', '2021-11-17 01:14:32', 1, '2021-11-17 01:14:32', 1, 1, 0),
(2, 1, 'Modern Chair 2', 'product_1637111703.jpg', 'sdddsadasd', 1, 20, 17, 'adadasd', 'asdasd', '2021-11-17 01:15:03', 1, '2021-11-17 01:15:03', 1, 1, 0),
(3, 2, 'Small Table', 'product_1637111733.jpg', 'fasdsadas', 1, 22, 20, 'sdasdasd', 'asdasda', '2021-11-17 01:15:33', 1, '2021-11-17 01:15:33', 1, 1, 0),
(4, 3, 'Light ', 'product_1637111762.jpg', 'dasdfasdfa', 1, 18, 15, 'asdasdasd', 'adsdasd', '2021-11-17 01:16:02', 1, '2021-11-17 01:16:02', 1, 1, 0),
(5, 4, ' Plots 1', 'product_1637111833.jpg', 'Plot 1', 1, 12, 10, 'asdasdas', 'asdasd', '2021-11-17 01:16:39', 1, '2021-11-17 01:17:13', 1, 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Mã tài khoản',
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Họ và tên',
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên đăng nhâp',
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mật khẩu',
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email',
  `gender` tinyint(3) UNSIGNED NOT NULL COMMENT 'Giới tính',
  `phone` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Điện thoại',
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Địa chỉ',
  `img` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Hình',
  `access` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Quyền truy cập',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo',
  `created_by` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Người tạo',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày sửa',
  `updated_by` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Người sửa',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 2 COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `fullname`, `username`, `password`, `email`, `gender`, `phone`, `address`, `img`, `access`, `created_at`, `created_by`, `updated_at`, `updated_by`, `status`) VALUES
(1, 'ad', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@email.com', 1, '', NULL, 'avatar5.png', 1, '2021-11-08 06:32:14', 1, '2021-11-08 06:32:14', 1, 1),
(2, 'Thắng', 'user', 'e10adc3949ba59abbe56e057f20f883e', '', 0, '', NULL, '', 0, '2021-11-08 06:32:14', 1, '2021-11-08 06:32:14', 1, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã Loại', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã sản phẩm', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã tài khoản', AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
