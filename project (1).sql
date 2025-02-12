-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2025 at 04:12 PM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `address`, `mobile`, `order_date`) VALUES
(1, 'MOHAMED SYED ANAS A', 'anas@gmail.com', 'saradha nagar,sivakasi', '9876543210', '2025-02-04 14:44:55'),
(2, 'MOHAMED SYED ANAS A', 'anas@gmail.com', 'saradha nagar,sivakasi', '9876543210', '2025-02-04 14:47:10'),
(3, 'MOHAMED SYED ANAS A', 'anas@gmail.com', 'saradha nagar,sivakasi', '9876543210', '2025-02-04 14:47:55'),
(4, 'MOHAMED SYED ANAS A', 'anas@gmail.com', 'saradha nagar,sivakasi', '9876543210', '2025-02-04 14:50:58'),
(5, 'MOHAMED SYED ANAS A', 'anas@gmail.com', 'saradha nagar,sivakasi', '9876543210', '2025-02-04 14:51:13'),
(6, 'anas', 'anas@gmail.com', 'sivakasi', '9876543210', '2025-02-04 14:52:03'),
(7, 'MOHAMED SYED ANAS A', 'anas@gmail.com', 'saradha nagar,sivakasi', '9876543210', '2025-02-04 14:54:36'),
(8, 'MOHAMED SYED ANAS A', 'anas@gmail.com', 'saradha nagar,sivakasi', '9876543210', '2025-02-04 14:56:19'),
(9, 'MOHAMED SYED ANAS A', 'anas@gmail.com', 'saradha nagar,sivakasi', '9876543210', '2025-02-04 14:57:30'),
(10, 'anas', 'anas@gmail.com', 'sivakasi', '9876543210', '2025-02-04 14:58:20'),
(11, 'shahith', 'shahith@gmail.com', 'saradha nagar,sivakasi', '9876543210', '2025-02-04 15:34:02'),
(12, 'shahith', 'shahith@gmail.com', 'saradha nagar,sivakasi', '9876543210', '2025-02-04 15:36:10'),
(13, 'a.mohamed syed anas', 'anasshahith426@gmail.com', 'saradha nagar,sivakasi', '09344258331', '2025-02-04 15:38:09'),
(14, 'a.mohamed syed anas', 'anasshahith426@gmail.com', 'saradha nagar,sivakasi', '09344258331', '2025-02-04 15:38:32'),
(15, 'a.mohamed syed anas', 'anasshahith426@gmail.com', 'saradha nagar,sivakasi', '09344258331', '2025-02-04 15:46:26'),
(16, 'a.mohamed syed anas', 'anasshahith426@gmail.com', 'saradha nagar,sivakasi', '09344258331', '2025-02-04 15:50:22'),
(17, 'shahith', 'shahith@gmail.com', 'saradha nagar,sivakasi', '09876543210', '2025-02-04 15:54:26'),
(18, 'shahith', 'shahith@gmail.com', 'saradha nagar,sivakasi', '09876543210', '2025-02-05 03:51:09'),
(19, 'shahith', 'shahith@gmail.com', 'saradha nagar,sivakasi', '09876543210', '2025-02-06 04:02:26'),
(20, 'shahith', 'shahith@gmail.com', 'saradha nagar,sivakasi', '09876543210', '2025-02-06 04:04:13'),
(21, 'shahith', 'shahith@gmail.com', 'saradha nagar,sivakasi', '09876543210', '2025-02-06 05:54:01'),
(22, 'shahith', 'shahith@gmail.com', 'saradha nagar,sivakasi', '09876543210', '2025-02-12 13:33:50'),
(23, 'suriya', 'suriya@gmail.com', 'sivakasi', '9876543210', '2025-02-12 14:37:22'),
(24, 'suriya', 'suriya@gmail.com', 'saradha nagar,sivakasi', '9876543210', '2025-02-12 14:44:48'),
(25, 'suriya', 'suriya@gmail.com', 'saradha nagar,sivakasi', '9876543210', '2025-02-12 14:44:54');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `total_price`) VALUES
(1, 1, 12, 2, 0.00, 0.00),
(2, 1, 19, 2, 0.00, 0.00),
(3, 1, 13, 1, 2000.00, 2000.00),
(4, 1, 20, 1, 200.00, 200.00),
(5, 2, 12, 2, 0.00, 0.00),
(6, 2, 19, 2, 0.00, 0.00),
(7, 2, 13, 1, 2000.00, 2000.00),
(8, 2, 20, 1, 200.00, 200.00),
(9, 3, 12, 2, 0.00, 0.00),
(10, 3, 19, 2, 0.00, 0.00),
(11, 3, 13, 1, 2000.00, 2000.00),
(12, 3, 20, 2, 200.00, 400.00),
(14, 4, 19, 2, 0.00, 0.00),
(15, 4, 13, 1, 2000.00, 2000.00),
(16, 4, 20, 2, 200.00, 400.00),
(18, 5, 12, 2, 0.00, 0.00),
(19, 5, 19, 2, 0.00, 0.00),
(20, 5, 13, 1, 2000.00, 2000.00),
(21, 5, 20, 2, 200.00, 400.00),
(25, 7, 19, 2, 0.00, 0.00),
(26, 7, 13, 1, 2000.00, 2000.00),
(27, 7, 20, 2, 200.00, 400.00),
(30, 8, 19, 2, 0.00, 0.00),
(31, 8, 13, 1, 2000.00, 2000.00),
(32, 8, 20, 2, 200.00, 400.00),
(34, 9, 12, 3, 0.00, 0.00),
(35, 9, 19, 2, 0.00, 0.00),
(36, 9, 13, 1, 2000.00, 2000.00),
(37, 9, 20, 2, 200.00, 400.00),
(40, 11, 12, 1, 2500.00, 2500.00),
(41, 12, 15, 1, 300.00, 300.00),
(42, 12, 17, 1, 300.00, 300.00),
(43, 13, 15, 1, 300.00, 300.00),
(44, 13, 17, 1, 300.00, 300.00),
(45, 14, 15, 1, 300.00, 300.00),
(46, 14, 17, 1, 300.00, 300.00),
(47, 14, 19, 1, 300.00, 300.00),
(48, 15, 12, 1, 2500.00, 2500.00),
(49, 16, 12, 1, 2500.00, 2500.00),
(50, 17, 12, 1, 2500.00, 2500.00),
(51, 18, 20, 1, 200.00, 200.00),
(52, 19, 12, 1, 2500.00, 2500.00),
(53, 20, 19, 1, 300.00, 300.00),
(54, 21, 13, 1, 2000.00, 2000.00),
(55, 21, 19, 1, 300.00, 300.00),
(56, 22, 20, 1, 200.00, 200.00),
(57, 23, 20, 1, 200.00, 200.00),
(58, 24, 12, 1, 2500.00, 2500.00),
(59, 24, 19, 1, 300.00, 300.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity`, `image`) VALUES
(12, 'bat', 'super quality', 2500.00, 18, 'sports/679792ec855e5.jpg'),
(13, 'helmat', 'super quality', 2000.00, 15, 'sports/67979603352e4.jpg'),
(14, 'gloves', 'super quality', 200.00, 30, 'sports/6797ad4ed484a.jpg'),
(15, 'shoe', 'super quality', 300.00, 30, 'sports/6797af1a154a7.jpg'),
(16, 'bat', 'nice', 400.00, 220, 'sports/6797c283dd46a.jpg'),
(17, 'volly ball', 'super quality', 300.00, 35, 'sports/6797c7debc8df.jpg'),
(19, 'ball', 'super quality', 300.00, 20, 'sports/67a2199f17b04.jpg'),
(20, 'gloves', 'super quality', 200.00, 20, 'sports/67a21afab93b9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `purchase_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `product_id`, `quantity`, `price`, `purchase_date`) VALUES
(5, 13, 20, 200.00, '2025-12-26'),
(6, 15, 20, 200.00, '2025-01-30'),
(7, 12, 20, 200.00, '2025-02-01'),
(8, 17, 10, 300.00, '2025-01-28'),
(9, 16, 200, 2000.00, '2025-02-04'),
(10, 12, 20, 2000.00, '2025-02-04');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `Id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`Id`, `name`, `email`, `password`, `role`) VALUES
(2, 'shahith', 'shahith@gmail.com', '$2y$10$u.fKk1yQzTv7BqFlrtsXq.wKGLBf9VSe6NDkS1cZqslOqmoHGRUhC', 'user'),
(3, 'suriya', 'suriya@gmail.com', '$2y$10$66vRcNwGgrPc3VHNXhqw3.ZgfzzNBf1SXNI45ODK7C/cvuSHR85mm', 'user'),
(6, 'admin', 'admin@gmail.com', '$2y$10$Wqt1J72tN6aqoIP9oaPgaerkEQGCMx7wask6aI5O9uXDWLqOHQ2TW', 'admin'),
(8, 'asim', 'asim@gmail.com', '$2y$10$PPhGY5KUQJDfFm5/Oe6ow.2AKly1KhxNwlJFMj5c5wUHAYRwinSy6', 'user'),
(11, 'anas', 'anas@gmail.com', '$2y$10$F19P8hcGdbfa5UQKJoGDLuOBNoYv/owsx2dEMHlQzdifcf6fV6Yje', 'user'),
(13, 'manickam', 'manickam@gmail.com', '$2y$10$eZkpkKKQ.4GmwlrJgDZQBuwl8U0JNqvHaw5BcxDeRp5wv7ByWFOhm', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `sale_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `quantity`, `total`, `sale_date`) VALUES
(4, 12, 20, 300.00, '2025-01-26'),
(5, 13, 5, 1000.00, '2025-01-26'),
(6, 15, 10, 300.00, '2025-02-02'),
(7, 17, 5, 1500.00, '2025-02-01'),
(8, 13, 2, 400.00, '2025-02-01'),
(9, 12, 4, 1000.00, '2025-02-04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'Mohammed Syed Anas', '$2y$10$x8/3M/SkSxp4ayHbVorMGuMQljvOh0aROROh.eok5qQ.QETEhsDCu', 'user'),
(2, 'manas', '$2y$10$vsU.JHdr/mKaqo1mGcwgj.flwpmQt1VxtHc4XMN.TlzvAjFPSMG7m', 'user'),
(3, 'mani', '$2y$10$Tl6v0oK54EqgYdz5TwP2YujSVQamOPP91jqROZN2jgM7tfsD/Xopq', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
