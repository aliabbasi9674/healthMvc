-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2023 at 09:36 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `health_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `price` int(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `code`, `phone`, `price`, `created_at`) VALUES
(11, 76665, '09011287885', 20000, '2023-12-08 16:54:40'),
(12, 76665, '09011287885', 20000, '2023-12-08 16:54:56'),
(13, 76665, '09011287885', 20000, '2023-12-08 16:55:33'),
(14, 98898, '09011287885', 45000, '2023-12-08 18:11:24'),
(15, 93479, '09011287885', 2000, '2023-12-08 21:28:57'),
(16, 96605, '09011287885', 5400, '2023-12-09 11:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `discount` tinyint(4) NOT NULL DEFAULT 0,
  `amount` int(11) NOT NULL DEFAULT 0,
  `code` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `discount`, `amount`, `code`, `created_at`) VALUES
(10, 'محصول 2', '13980707092348-eb87cfd9-49ab-46c2-bed6-346dd80d524d.jpg', 230000, 1, 15, '80980', '2023-12-07 20:04:46'),
(11, 'محصول 3', '13980607112751-e065af4f-9fc6-40b3-81f8-1ec1fa155c4a.jpg', 20000, 0, 2, '72725', '2023-12-07 20:08:35'),
(12, 'محصول  4', '13980513104107-18c337bf-31c8-4bda-90ee-cc4fc9c86cb1.jpg', 6000, 1, 12, '96605', '2023-12-07 20:08:52'),
(13, 'محصول 5', '13980707092348-5cca2f4b-672e-4335-96de-5b6707ca59f0.jpg', 2000, 0, 9, '65726', '2023-12-07 20:09:10'),
(14, 'محصول 6', '13980517120635-061b2c58-74c7-4beb-b823-830bd6f851de.jpg', 45000, 0, 9, '98898', '2023-12-07 20:13:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `created_at`) VALUES
(1, 'علی عباسی', '09157744091', 'admin@gmail.com', '$2y$10$d3djQRdkt7ZiniFCWXD3GOoEwX1FIhG24bNw36xh9E0hYePmmvrCm', '2023-12-06 15:20:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
