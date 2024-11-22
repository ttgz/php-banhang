-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 22, 2024 lúc 05:27 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanliduan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int(50) UNSIGNED NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `gioi_tinh` text NOT NULL,
  `phone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `email`, `name`, `password`, `gioi_tinh`, `phone`) VALUES
(0, 'giangmyphung@gmail.com', 'giang mỹ phụng', '123', 'Nữ', '123'),
(1, 'khanhdong@gmail.com', 'Đặng Khánh Đông', '123', 'Nam', '0363864542'),
(2, 'khanhdong1@gmail.com', 'dfsdf', '123', 'Nam', '0363864543');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account_laptop`
--

CREATE TABLE `account_laptop` (
  `masp` int(50) NOT NULL,
  `id` int(50) UNSIGNED NOT NULL,
  `soluong` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '123'),
('seller', '123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `laptop`
--

CREATE TABLE `laptop` (
  `masp` int(50) NOT NULL,
  `tensp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` text NOT NULL,
  `manhinh` text NOT NULL,
  `cpu` text NOT NULL,
  `ram` text NOT NULL,
  `ocung` text NOT NULL,
  `cardmanhinh` text NOT NULL,
  `post` text NOT NULL,
  `hedieuhanh` text NOT NULL,
  `hang` text DEFAULT NULL,
  `anhsp` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `laptop`
--

INSERT INTO `laptop` (`masp`, `tensp`, `gia`, `manhinh`, `cpu`, `ram`, `ocung`, `cardmanhinh`, `post`, `hedieuhanh`, `hang`, `anhsp`) VALUES
(1, 'Asus vivobook 14x oled', '18.495.000', '14.5', '	intel core i5 12500H 2.5GHz', '	8 GBDDR4 3200 MHz', '512 GB SSD NVMe PCIe', 'Card tích hợp Intel UHD', 'USB Type-CHDMIJack tai nghe 3.5 mm1 x USB 2.02 x USB 3.2', 'Windows 11 Home SL', 'Asus', 'laptop_6.png'),
(2, 'Laptop Asus Zenbook UM5401QA', '19.690.000', '13.3 inch, 1920 x 1080 Pixels, IPS, 60 Hz, 450 nits, FHD', 'Intel, Core i5, 1135G7', '8 GB (1 thanh 8 GB), DDR4, 3200 MHz', '512 GB SSD NVMe PCIe', 'Intel Iris Xe Graphics', 'USB Type-CHDMIJack tai nghe 3.5 mm1 x USB 2.02 x USB 3.2', 'Windows', 'Asus', 'laptop_7.png');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `account_laptop`
--
ALTER TABLE `account_laptop`
  ADD PRIMARY KEY (`masp`,`id`),
  ADD KEY `fk_account_laptop_account` (`id`);

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `laptop`
--
ALTER TABLE `laptop`
  ADD PRIMARY KEY (`masp`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `account_laptop`
--
ALTER TABLE `account_laptop`
  ADD CONSTRAINT `fk_account_laptop_account` FOREIGN KEY (`id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `fk_account_laptop_laptop` FOREIGN KEY (`masp`) REFERENCES `laptop` (`masp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
