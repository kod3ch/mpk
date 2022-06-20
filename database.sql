-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2022 at 08:26 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mpk`
--
CREATE DATABASE IF NOT EXISTS `mpk` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mpk`;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `ticket_category` text NOT NULL,
  `ticket_discount` text NOT NULL,
  `ticket_period` int(11) NOT NULL,
  `ticket_zone` text NOT NULL,
  `ticket_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `ticket_category`, `ticket_discount`, `ticket_period`, `ticket_zone`, `ticket_price`) VALUES
(1, 'IMIENNY', 'NORMALNY', 30, 'STREFA 1', 59.6),
(2, 'IMIENNY', 'NORMALNY', 30, 'STREFA 2', 53),
(3, 'IMIENNY', 'NORMALNY', 30, 'STREFA 1+2', 81),
(4, 'IMIENNY', 'NORMALNY', 90, 'STREFA 1', 180),
(5, 'IMIENNY', 'NORMALNY', 90, 'STREFA 2', 149.9),
(6, 'IMIENNY', 'NORMALNY', 90, 'STREFA 1+2', 243.15),
(7, 'IMIENNY', 'NORMALNY', 150, 'STREFA 1', 300),
(8, 'IMIENNY', 'NORMALNY', 150, 'STREFA 2', 250),
(9, 'IMIENNY', 'NORMALNY', 150, 'STREFA 1+2', 410.5),
(10, 'IMIENNY', 'ULGOWY', 30, 'STREFA 1', 30),
(11, 'IMIENNY', 'ULGOWY', 30, 'STREFA 2', 25),
(12, 'IMIENNY', 'ULGOWY', 30, 'STREFA 1+2', 39.99),
(13, 'IMIENNY', 'ULGOWY', 90, 'STREFA 1', 90),
(14, 'IMIENNY', 'ULGOWY', 90, 'STREFA 2', 75),
(15, 'IMIENNY', 'ULGOWY', 90, 'STREFA 1+2', 120.45),
(16, 'IMIENNY', 'ULGOWY', 150, 'STREFA 1', 150),
(17, 'IMIENNY', 'ULGOWY', 150, 'STREFA 2', 125),
(18, 'IMIENNY', 'ULGOWY', 150, 'STREFA 1+2', 198.7),
(19, 'OKAZICIEL', 'NORMALNY', 30, 'STREFA 1', 80),
(20, 'OKAZICIEL', 'NORMALNY', 30, 'STREFA 2', 70),
(21, 'OKAZICIEL', 'NORMALNY', 30, 'STREFA 1+2', 100),
(22, 'OKAZICIEL', 'NORMALNY', 90, 'STREFA 1', 240),
(23, 'OKAZICIEL', 'NORMALNY', 90, 'STREFA 2', 210),
(24, 'OKAZICIEL', 'NORMALNY', 90, 'STREFA 1+2', 300),
(25, 'OKAZICIEL', 'NORMALNY', 150, 'STREFA 1', 399.1),
(26, 'OKAZICIEL', 'NORMALNY', 150, 'STREFA 2', 350),
(27, 'OKAZICIEL', 'NORMALNY', 150, 'STREFA 1+2', 500),
(28, 'OKAZICIEL', 'ULGOWY', 30, 'STREFA 1', 44.1),
(29, 'OKAZICIEL', 'ULGOWY', 30, 'STREFA 2', 35),
(30, 'OKAZICIEL', 'ULGOWY', 30, 'STREFA 1+2', 50),
(31, 'OKAZICIEL', 'ULGOWY', 90, 'STREFA 1', 120.6),
(32, 'OKAZICIEL', 'ULGOWY', 90, 'STREFA 2', 105),
(33, 'OKAZICIEL', 'ULGOWY', 90, 'STREFA 1+2', 150),
(34, 'OKAZICIEL', 'ULGOWY', 150, 'STREFA 1', 200),
(35, 'OKAZICIEL', 'ULGOWY', 150, 'STREFA 2', 175),
(36, 'OKAZICIEL', 'ULGOWY', 150, 'STREFA 1+2', 250);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `trans_id` int(11) NOT NULL,
  `trans_date` datetime NOT NULL DEFAULT current_timestamp(),
  `trans_user_id` int(11) NOT NULL,
  `trans_tickets_id` int(11) NOT NULL,
  `trans_quantity` int(11) NOT NULL,
  `trans_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`trans_id`, `trans_date`, `trans_user_id`, `trans_tickets_id`, `trans_quantity`, `trans_price`) VALUES
(1, '2022-06-20 19:08:46', 3, 14, 3, 225),
(2, '2022-06-20 19:08:59', 3, 6, 1, 243.15),
(3, '2022-06-20 19:09:51', 2, 30, 3, 150),
(4, '2022-06-20 19:10:04', 2, 19, 3, 240),
(5, '2022-06-20 19:58:54', 2, 23, 2, 420);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `pesel` text NOT NULL,
  `phone` text NOT NULL,
  `mail` text NOT NULL,
  `password` text NOT NULL,
  `admin` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `pesel`, `phone`, `mail`, `password`, `admin`) VALUES
(1, 'Vladyslav', 'Artemenko', '01320510471', '795743197', 'artemenko.wlad@gmail.com', '$2y$10$WfQkuIp2FEAJkGKPMKzoVuQOMgZkusu8oqsVhdgPOQu/MdzBCpyIm', 1),
(2, 'Aliaksandr', 'Kholad', '01312810554', '791118967', 'kholadaliaksandr@gmail.com', '$2y$10$fu7G65nd1A7kRrrANmXsmuUk.gGojnacpIjsLyEHfMgozuGg8SR6S', 1),
(3, 'Jan', 'Kowalski', '12345678901', '123456789', 'poczta@wp.pl', '$2y$10$zABU9B3z8bS5A6LiMsw82uVF9C4j6fJ.935pMW6ztzpJAJyF.LkYq', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pesel` (`pesel`) USING HASH,
  ADD UNIQUE KEY `phone` (`phone`) USING HASH,
  ADD UNIQUE KEY `mail` (`mail`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
