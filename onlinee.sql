-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2025 at 03:58 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online`
--

-- --------------------------------------------------------

--
-- Table structure for table `privleges`
--

CREATE TABLE `privleges` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(15) NOT NULL,
  `p_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `privleges`
--

INSERT INTO `privleges` (`p_id`, `p_name`, `p_desc`) VALUES
(2, 'admin', ''),
(3, 'user', '');

-- --------------------------------------------------------

--
-- Table structure for table `prod`
--

CREATE TABLE `prod` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prod`
--

INSERT INTO `prod` (`id`, `name`, `price`, `image`) VALUES
(24, ' موديل هايلوكس', '20000$', 'images/%D8%B5~1.JPG'),
(25, 'موديل', '200$', 'images/%D8%B5~1.JPG'),
(27, 'هايلوكس 2', '$40000', 'images/mobile_listing_main_2018_Toyota_Hilux__1_.jpg'),
(29, 'سنتافي', '$15000', 'images/%D8%B5~1.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(50) NOT NULL,
  `u_email` varchar(30) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_phone` varchar(20) NOT NULL,
  `u_nationality` varchar(20) NOT NULL,
  `u_gender` varchar(6) NOT NULL,
  `u_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `u_status` tinyint(4) NOT NULL DEFAULT 1,
  `u_priv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_name`, `u_email`, `u_password`, `u_phone`, `u_nationality`, `u_gender`, `u_date`, `u_status`, `u_priv`) VALUES
(5, 'mohammed almahdi', 'qasmhashmy566@gmail.commmmmm', '$2y$10$peIu3IAvKJt4gTnyLVQ7I.PfeflhWZVn3YulreBpg7QAzJWUTMg8K', '770232538', 'yemeni', 'male', '2024-10-08 19:48:55', 1, 2),
(6, 'ali', 'm1@email.com', '$2y$10$dwmlwXuw6FLq9GnSNGd4L.mdE/9zvHKbBKwXj5.IvM9IetTBtwsS.', '777135232', 'yemeni', 'male', '2024-10-09 06:45:23', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `privleges`
--
ALTER TABLE `privleges`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `prod`
--
ALTER TABLE `prod`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `u_priv` (`u_priv`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `privleges`
--
ALTER TABLE `privleges`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prod`
--
ALTER TABLE `prod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`u_priv`) REFERENCES `privleges` (`p_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
