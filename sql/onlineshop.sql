-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 12:43 AM
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
-- Database: `onlineshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(150) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `image`, `quantity`) VALUES
(9, 2, 'Casque', 150, '../image/product-5.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `prod`
--

CREATE TABLE `prod` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `price` float NOT NULL,
  `image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prod`
--

INSERT INTO `prod` (`id`, `name`, `price`, `image`) VALUES
(16, 'Iphone 15', 2000, 0x2e2e2f696d6167652f3336305f465f3737383236333631395f6e6b737455677073476f45753436324c5a6d5a647546737a6e4e736e4948644e2e6a7067),
(17, 'Samsung', 442, 0x2e2e2f696d6167652f32316c7a6c796b38454f625779434d665a7447686b376d45757055325079757058356b727852736f5a51765f536f696b753074614970374e5f504a6d775f476243573579703955433734617351446d68705a6e387245646756494979333063446a6e743247763676593837326439386569514d2e6a7067),
(20, 'dell', 800, 0x2e2e2f696d6167652f6c6170746f702d706e672d66726f6d2d706e676672652d352e706e67),
(24, 'Smart Tv', 450, 0x2e2e2f696d6167652f3336305f465f36393934363232305f4472777a79705051536356395633696e41666c4d59596e6f75384e6d54777a582e6a7067),
(26, 'Ipad Pro', 1500, 0x2e2e2f696d6167652f726573697a652e6a7067),
(27, 'HP ProOne ', 450, 0x2e2e2f696d6167652f313037373930393037365f5f33343533362e313731353732333236362e6a7067),
(28, 'Smart Watch', 200, 0x2e2e2f696d6167652f70726f647563742d322e6a7067),
(29, 'Camra', 650, 0x2e2e2f696d6167652f70726f647563742d332e6a7067),
(30, 'Speaker', 50, 0x2e2e2f696d6167652f70726f647563742d342e6a7067),
(31, 'Tv', 250, 0x2e2e2f696d6167652f70726f647563742d362e6a7067),
(32, 'Casque', 150, 0x2e2e2f696d6167652f70726f647563742d352e6a7067),
(33, 'OPPO', 200, 0x2e2e2f696d6167652f70726f647563742d312e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--
;
--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prod`
--
ALTER TABLE `prod`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `prod`
--
ALTER TABLE `prod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
