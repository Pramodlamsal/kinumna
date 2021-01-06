-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 06, 2021 at 02:44 PM
-- Server version: 8.0.22-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kinumna`
--

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `published` int NOT NULL DEFAULT '1',
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `display_order` varchar(211) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `photo`, `published`, `link`, `display_order`, `created_at`, `updated_at`) VALUES
(37, 'uploads/sliders/BN2c0KlPFT4nkGzuaz3sQRz49PVfHG0R2R3yO9ve.jpeg', 1, 'www.kinumna.com', '5', '2020-10-02 10:35:40', '2021-01-03 23:18:19'),
(73, 'uploads/sliders/osmscHXnUX7pp9FdcadfO2eJLT48ng2gqegBtc1u.gif', 1, 'https://www.kinumna.com/product/Boys-Topi-set-And-Scarf-Sets-aJGht', '4', '2020-12-03 10:06:30', '2021-01-03 23:18:18'),
(74, 'uploads/sliders/69MnewMov4IAz3lcvZzq2ubdOk1cNh6EWYO6NdQi.jpeg', 1, 'https://www.kinumna.com/search?category=Mens-Fashion-WURal', '3', '2020-12-03 10:11:55', '2020-12-03 10:11:55'),
(75, 'uploads/sliders/NIdefzNMCebEoB96Ns2ChnXP2TY1Hw6PyffUgjxU.jpeg', 1, 'https://www.kinumna.com/search?category=Womens-Fashion-jhWs1', '2', '2020-12-03 10:12:57', '2020-12-03 10:12:57'),
(78, 'uploads/sliders/lMuJIYkwKiiyEKLXTTLqAv4nPqKCXZ5u62Jw63Kz.jpeg', 1, 'test', '1', '2021-01-05 01:17:52', '2021-01-05 01:17:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
