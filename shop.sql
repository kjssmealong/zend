-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 08, 2021 lúc 01:17 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 7.3.27

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
  `status` tinyint(4) NOT NULL DEFAULT 2 COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `parentid`, `orders`, `metakey`, `metadesc`, `created_at`, `created_by`, `updated_at`, `updated_by`, `status`) VALUES
(2, '2', 'ádasd', 0, 1, 'ádas', 'ádasd', '2021-11-06 18:22:44', 0, '2021-11-06 18:22:44', 0, 1),
(3, 'a', '', 0, 0, '', '', '2021-11-06 21:09:59', 0, '2021-11-06 21:09:59', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL COMMENT 'Mã liên hệ',
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Họ và tên',
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email',
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Điện thoại',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tiêu đề',
  `detail` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'Chi tiết',
  `replaydetail` text COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Nội dung liên hệ',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày liên hệ',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày trả lời',
  `updated_by` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Người trả lời',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Tráng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL COMMENT 'Mã Menu',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên Menu',
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Liên kết',
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Kiểu Menu',
  `tableid` int(11) NOT NULL DEFAULT 0 COMMENT 'Mã trong bảng',
  `orders` int(11) NOT NULL DEFAULT 0 COMMENT 'Thứ tự',
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Vị trí',
  `parentid` int(11) NOT NULL COMMENT 'Mã cấp cha',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày Tạo',
  `created_by` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Người tạo',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày sửa',
  `updated_by` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Người sửa',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Mã đơn hàng',
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Code đơn hàng',
  `userid` int(11) NOT NULL COMMENT 'Mã khách hàng',
  `createdate` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo',
  `exportdate` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày xuất',
  `deliveryaddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Địa chỉ người nhận',
  `deliveryname` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên người nhận',
  `deliveryphone` varchar(120) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Điện thoại người nhận',
  `deliveryemail` varchar(120) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email ngươig nhận',
  `updated_at` timestamp NULL DEFAULT current_timestamp() COMMENT 'Ngày cập nhật',
  `updated_by` tinyint(3) UNSIGNED DEFAULT NULL COMMENT 'Người cập nhật',
  `status` tinyint(3) UNSIGNED NOT NULL COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetail`
--

CREATE TABLE `orderdetail` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Mã CT Đơn hàng',
  `orderid` int(10) UNSIGNED NOT NULL COMMENT 'Mã đơn hàng',
  `productid` int(10) UNSIGNED NOT NULL COMMENT 'Mã sản phẩm',
  `price` float(12,2) NOT NULL COMMENT 'Giá sản phẩm',
  `quantity` int(10) UNSIGNED NOT NULL COMMENT 'Số lượng',
  `amount` float(12,2) NOT NULL COMMENT 'Thành tiền'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `page`
--

CREATE TABLE `page` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Mã bài viết',
  `topid` int(10) UNSIGNED DEFAULT NULL COMMENT 'Mã chủ đề',
  `title` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tiêu đề bài viết',
  `slug` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Slug tiêu đề',
  `detail` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'Chi tiết bài viết',
  `img` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Hình ảnh',
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'post' COMMENT 'Kiểu bài viết',
  `metakey` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Từ khóa SEO',
  `metadesc` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mô tả SEO',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo',
  `created_by` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Người tạo',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày sửa',
  `updated_by` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Người sửa',
  `status` tinyint(4) NOT NULL DEFAULT 2 COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Mã bài viết',
  `topid` int(10) UNSIGNED DEFAULT NULL COMMENT 'Mã chủ đề',
  `title` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tiêu đề bài viết',
  `slug` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Slug tiêu đề',
  `detail` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'Chi tiết bài viết',
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Hình ảnh',
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'post' COMMENT 'Kiểu bài viết',
  `metakey` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Từ khóa SEO',
  `metadesc` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mô tả SEO',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo',
  `created_by` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Người tạo',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày sửa',
  `updated_by` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Người sửa',
  `status` tinyint(4) NOT NULL DEFAULT 2 COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Mã sản phẩm',
  `catid` int(10) UNSIGNED NOT NULL COMMENT 'Mã loại sản phẩm',
  `name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên sản phẩm',
  `slug` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Slug tên sản phẩm',
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
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 2 COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `catid`, `name`, `slug`, `img`, `detail`, `number`, `price`, `pricesale`, `metakey`, `metadesc`, `created_at`, `created_by`, `updated_at`, `updated_by`, `status`) VALUES
(10, 2, ' aaaa', '', 'product_1636252370.jpg', 'ádasd', 1, 20000, 20000, 'đâsdasd', 'ádasdas', '2021-11-07 02:32:50', 1, '2021-11-07 02:32:50', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slider`
--

CREATE TABLE `slider` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Mã Slider',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên Slider',
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Liên kết',
  `position` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Vị trí',
  `img` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Hình ảnh',
  `orders` int(10) UNSIGNED NOT NULL COMMENT 'Thứ tự',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo',
  `created_by` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Người tạo',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày sửa',
  `updated_by` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Người sửa',
  `status` tinyint(3) UNSIGNED DEFAULT 2 COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `topic`
--

CREATE TABLE `topic` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Mã chủ đề',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên chủ đề',
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Slug tên chủ đề',
  `parentid` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Mã cấp cha',
  `orders` int(10) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Sắp xếp',
  `metakey` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Từ khóa SEO',
  `metadesc` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mô tả SEO',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo',
  `created_by` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Người tạo',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày sửa',
  `updated_by` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Người sửa',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 2 COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `topic`
--
ALTER TABLE `topic`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã Loại', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã liên hệ';

--
-- AUTO_INCREMENT cho bảng `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã Menu';

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã đơn hàng';

--
-- AUTO_INCREMENT cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã CT Đơn hàng';

--
-- AUTO_INCREMENT cho bảng `page`
--
ALTER TABLE `page`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã bài viết';

--
-- AUTO_INCREMENT cho bảng `post`
--
ALTER TABLE `post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã bài viết';

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã sản phẩm', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã Slider';

--
-- AUTO_INCREMENT cho bảng `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã chủ đề';

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã tài khoản';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
