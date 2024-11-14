-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2024 at 10:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bong_cpu`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `product_id`, `product_name`, `quantity`, `user_id`, `price`, `total_price`) VALUES
(44, 20, 'test', 1, 32, 12, 12),
(52, 2, 'AUG4090-004 INTEL I5-13400F 2.5GHz 10C/16T / B760M / RTX 4090 24GB / 32GB DDR5 5600MHz / M.2 1TB / 1000W (80+GOLD) / HS', 1, 33, 102990, 102990);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `total_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `user_id`, `order_date`, `total_order`) VALUES
(1, 33, '2024-09-05 17:39:33', 37582),
(2, 33, '2024-09-05 15:56:35', 24),
(3, 33, '2024-09-05 17:44:43', 102990),
(4, 33, '2024-09-05 18:13:08', 102990),
(5, 33, '2024-09-05 18:17:24', 12),
(6, 31, '2024-09-05 18:47:31', 136980),
(7, 31, '2024-09-05 20:16:09', 18791),
(8, 33, '2024-09-05 20:27:25', 63980),
(9, 33, '2024-09-06 08:05:41', 24790),
(10, 33, '2024-09-06 08:08:04', 18791),
(11, 33, '2024-09-06 09:04:08', 49580),
(12, 33, '2024-09-06 09:18:19', 31990);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `type_id` tinyint(4) NOT NULL,
  `product_name` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `images` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cpu` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gpu` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ram` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `storage` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mainboard` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `power_supply` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pc_case` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `type_id`, `product_name`, `images`, `cpu`, `gpu`, `ram`, `storage`, `mainboard`, `power_supply`, `pc_case`, `price`) VALUES
(1, 2, 'AUGGIGABYTE-004 AMD RYZEN 5 7500F 3.7GHz 6C/12T / B650M / RTX 3050 6GB / 16GB DDR5 5200MHz / M.2 500GB / 550W (80+SILVER) / HS', 'https://ihcupload.s3.ap-southeast-1.amazonaws.com/img/product/products56029_800.jpg', 'AMD Ryzen™ 5 7500F 3.7GHz 6C/12T', 'GIGABYTE GEFORCE RTX 3050 WINDFORCE OC 6G - 6GB GDDR6', 'KINGSTON FURY BEAST x iHAVECPU 16GB (8x2) DDR5 5200MHz BLACK', 'M.2 KINGSTON NV2 500GB Read (3,500 MB/s)', 'GIGABYTE B650M S2H (rev.1.0)', 'GIGABYTE GP-P550SS 550W (80+ SILVER)', 'iHAVECPU IHC 03A (WHITE)(mATX) | (เลือกเคสติดต่อ ADMIN)', 24790),
(2, 2, 'AUG4090-004 INTEL I5-13400F 2.5GHz 10C/16T / B760M / RTX 4090 24GB / 32GB DDR5 5600MHz / M.2 1TB / 1000W (80+GOLD) / HS', 'https://ihcupload.s3.ap-southeast-1.amazonaws.com/img/product/products55289_800.jpg', 'Intel® CORE i5-13400F 2.5GHz 10C/16T', 'PNY GEFORCE RTX 4090 24GB GDDR6X', 'GeIL ORION V RGB 32GB DDR5 5600MHz', 'M.2 WD BLACK SN770 1TB', 'MSI B760M GAMING PLUS WIFI', 'MSI MPG A1000GL PCIE5 - 1000W', 'iHAVECPU GLACIER', 102990),
(3, 2, 'AUG4080S-004 INTEL I5-13400F 2.5GHz 10C/16T / B760M / RTX 4080 SUPER 16GB / 32GB DDR5 6000Mhz / M.2 500GB / 850W (80+GOLD) / CS240', 'https://ihcupload.s3.ap-southeast-1.amazonaws.com/img/product/products54674_800.jpg', 'Intel® CORE i5-13400F 2.5GHz 10C/16T', 'ASUS TUF GAMING GEFORCE RTX 4080 SUPER 16GB GDDR6X', 'PREDATOR VESTA II 32GB DDR5 6000Mhz', 'M.2 LEXAR NM710 500GB', 'MSI B760M GAMING PLUS WIFI', 'ASUS PRIME 850W', 'iHAVECPU GLACIER', 68490),
(17, 2, 'AUGGIGABYTE-009 AMD RYZEN 5 4500 3.6GHz 6C/12T / A520M / RX 6600 8GB / 16GB DDR4 3200MHz / M.2 500GB / 650W (80+SILVER)', 'https://ihcupload.s3.ap-southeast-1.amazonaws.com/img/product/products56044_800.jpg', 'AMD Ryzen™ 5 4500 3.6GHz 6C/12T', 'GIGABYTE RADEON RX 6600 EAGLE 8G - 8GB GDDR6(REV 1.0)', 'KINGSTON FURY BEAST 16GB (8x2) DDR4 3200MHz BLACK', 'M.2 KINGSTON NV2 500GB Read (3,500 MB/s)', 'GIGABYTE A520M K V2 (REV.1.1)', 'GIGABYTE GP-P650SS 650W (80+ SILVER)', 'iHAVECPU G390 (BLACK)(mATX) | (เลือกเคสติดต่อ ADMIN)', 18791),
(18, 1, 'AUGUSTD5-006 INTEL I5-12400 2.5GHz 6C/12T / B760M / ONBOARD / 16GB DDR5 5200MHz / M.2 500GB / 650W (80+BRONZE)', 'https://ihcupload.s3.ap-southeast-1.amazonaws.com/img/product/products52727_800.jpg', 'Intel® CORE I5-12400 2.5GHz 6C/12T', 'ONBOARD Intel® UHD Graphics 730', 'KINGSTON FURY BEAST x iHAVECPU 16GB (8x2) DDR5 5200MHz BLACK', 'M.2 LEXAR NM710 500GB Read (5000 MB/s)', 'MSI PRO B760M-P DDR5', 'ASUS TUF GAMING 650B - 650W (80+ BRONZE)', 'DARKFLASH DK300 (BLACK)(ATX)', 15790),
(21, 2, 'NOTEBOOK (โน้ตบุ๊ค) HP VICTUS 16-R0133TX (MICA SILVER)', 'https://ihcupload.s3.ap-southeast-1.amazonaws.com/img/product/product34209_800.jpg', 'Intel® Core™ i5-13500H Processors (13th Gen)', 'NVIDIA® GeForce RTX™ 4050 Laptop GPU 6GB GDDR', '16GB DDR5 4800MHz', '512GB PCIe® 4.0 NVMe™ M.2 SSD', '-', '-', '16\"', 31990);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `type_id` int(11) NOT NULL,
  `product_type` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`type_id`, `product_type`) VALUES
(1, 'ไม่มีการ์ดจอแยก/non GPU'),
(2, 'มีการ์ดจอแยก/Have GPU');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` char(10) NOT NULL,
  `cus_name` varchar(32) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `cus_name`, `address`, `password`) VALUES
(31, 'jakb', '', 'psu ', '81dc9bdb52d04dc20036dbd8313ed055'),
(32, 'bjakk', '', 'psu ', '81dc9bdb52d04dc20036dbd8313ed055'),
(33, 'admin', '', 'psu ', 'f15478148ee64990628825ac893cb067'),
(34, '6440011010', '', 'psu ', '8e419539c2daf9685d46184ec92e7001'),
(35, 'jakkarawut', '', 'psu ', 'ab34d8d7f2771066c8724c8c4d440f60');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `product_id` (`product_id`,`user_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`type_id`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
