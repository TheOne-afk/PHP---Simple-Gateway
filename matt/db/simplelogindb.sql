-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2024 at 03:43 PM
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
-- Database: `simplelogindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_codes`
--

CREATE TABLE `admin_codes` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `expiration` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_codes`
--

INSERT INTO `admin_codes` (`id`, `code`, `expiration`) VALUES
(1, '123', '2024-10-24 12:00:00'),
(2, '321', '2025-10-25 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `username`, `action`, `timestamp`) VALUES
(1, 'Ma.Ma', 'user_login', '2024-10-18 20:42:43'),
(8, 'user20', 'user_deleted', '2024-10-18 21:17:53'),
(10, 'user23', 'user_deleted', '2024-10-18 21:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempt`
--

CREATE TABLE `login_attempt` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `time_count` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_attempt`
--

INSERT INTO `login_attempt` (`id`, `username`, `time_count`) VALUES
(22, 'Matthew.DelaCruz', '2024-09-27 06:17:06'),
(23, 'Matthew.DelaCruz', '2024-09-27 06:17:08'),
(24, 'Matthew.DelaCruz', '2024-09-27 06:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(10) DEFAULT NULL,
  `activation_token` varchar(64) DEFAULT NULL,
  `begin` datetime DEFAULT NULL,
  `attempt` int(11) DEFAULT NULL,
  `locked` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `create_at`, `role`, `activation_token`, `begin`, `attempt`, `locked`) VALUES
(86, 'user.nine', 'user09@user.com', '$2y$10$cvmjZ8vFppUahOEQUvSNke3u7b0LnrGe1lubGz1Ff1VpmNY2P5dIO', '2024-10-09 07:31:59', 'user', 'dcc278542aa907c5ec245bdbe37ce5238f21a4547e7b0ab2ca1df8881c84f1e1', NULL, 0, 0),
(88, 'user.eleven', 'user11@user.com', '$2y$10$GwKPOHh8O53gWfiVvWFedeFRdF7yAFjPxUxVLH1owlOokp39IXHyK', '2024-10-09 07:32:27', 'user', 'a54b8792995efec91f62825f76e6e182d63d529154afa27fb6bade93a21dbd3f', NULL, 0, 0),
(95, 'user19', 'user19@example.com', 'password123', '2024-10-09 07:35:11', NULL, NULL, NULL, NULL, 0),
(100, 'user24', 'user24@example.com', 'password123', '2024-10-09 07:35:11', NULL, NULL, NULL, NULL, 0),
(101, 'user25', 'user25@example.com', 'password123', '2024-10-09 07:35:11', NULL, NULL, NULL, NULL, 0),
(102, 'user26', 'user26@example.com', 'password123', '2024-10-09 07:35:11', NULL, NULL, NULL, NULL, 0),
(103, 'user27', 'user27@example.com', 'password123', '2024-10-09 07:35:11', NULL, NULL, NULL, NULL, 0),
(104, 'user28', 'user28@example.comm', 'password123', '2024-10-09 09:49:07', '', NULL, NULL, 0, 0),
(105, 'user29', 'user29@example.com', 'password123', '2024-10-09 11:05:48', '', NULL, NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_codes`
--
ALTER TABLE `admin_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempt`
--
ALTER TABLE `login_attempt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `activation_token` (`activation_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_codes`
--
ALTER TABLE `admin_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `login_attempt`
--
ALTER TABLE `login_attempt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
