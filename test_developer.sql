-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2025 at 09:17 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtn_developer`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'superAdmin', '$2y$10$BOWfm/olYp3kStw3cczJGuJY97IoH8q.UeZbC3p0jJ4Z6qdcTGM7y');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `variant` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT NULL,
  `image_urls` text DEFAULT NULL,
  `metadata` text DEFAULT NULL,
  `variants` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category`, `tags`, `stock_quantity`, `image_urls`, `metadata`, `variants`, `created_at`) VALUES
(3, 'Leather belt', '  Quality Designer Belt', 25.50, 'Leather works', '[\"Belt\",\"Leather Belt\"]', 100, '[\"https:\\/\\/example.com\\/cake.jpg\"]', '{\"createdBy\":\"admin\"}', '[{\"size\":\"Medium\",\"price\":25.5,\"stock\":50}]', '2025-12-11 05:38:49'),
(4, 'Aki Ola', 'Aki Ola Maths', 50.00, 'Statatory', '[\"Book\",\"Dictionary\"]', 0, '[]', '{\"createdBy\":\"admin\"}', '[{\"size\":\"Big\",\"price\":25.5,\"stock\":50}]', '2025-12-11 05:39:05'),
(5, 'Produc New', 'new prod', 25.50, 'new examp', '[\"tag name here\",\"new name\"]', 0, '[]', '{\"createdBy\":\"admin\"}', '[{\"size\":\"Medium\",\"price\":25.5,\"stock\":50}]', '2025-12-11 17:33:21'),
(6, 'Example name', 'example desc', 25.50, 'example', '[\"leather\",\"bagsa\"]', 100, '[\"https:\\/\\/example.com\\/example.jpg\"]', '{\"createdBy\":\"admin\"}', '[{\"size\":\"Medium\",\"price\":25.5,\"stock\":50}]', '2025-12-11 17:35:01'),
(7, 'Example New', 'example desc New', 25.50, 'example New', '[\"leather\",\"bagsa\"]', 100, '[\"https:\\/\\/example.com\\/example.jpg\"]', '{\"createdBy\":\"admin\"}', '[{\"size\":\"Large\",\"price\":25.5,\"stock\":50}]', '2025-12-11 17:57:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
