-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2024 at 02:38 PM
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
(76, 'Ma.Ma', 'matthewdelacruz647@gmail.com', '$2y$10$Hv4atNOkiX6fi8m5e00CYexy7Whys0lg6THE6T/7YFf2BqnxC56lm', '2024-10-04 15:04:38', 'admin', NULL, NULL, 0, 0),
(78, 'user.one', 'user01@user.com', '$2y$10$iV5aSj8ornZdubnOr5bat.6.3MYmHI8OfAEnVZcQ2XHwkPv0rlNUq', '2024-10-09 07:29:03', 'user', 'd7da6647697d516e377ebeb78c57379563eb33a4f94d755de229902b94cf8a60', NULL, 0, 0),
(79, 'user.two', 'user02@user.com', '$2y$10$sudRmz74NgRbOHCQD/awS.qDn2RjiMqCkZKfvKpdjIsVxN0Xkan3i', '2024-10-09 07:29:31', 'user', '53af502d6213947f0a288daeaf5c24a880711ef08698a1ba6757da5978964d84', NULL, 0, 0),
(80, 'user.three', 'user03@user.com', '$2y$10$v5q7csXNNJq5LV9IZ1p3H.h13jMeCw4pcrK0b22AuBoG9PyrSHVeu', '2024-10-09 07:29:56', 'user', 'f9c5b9fe39e2b109e9f858dd1a7824b575583485b627b49827650d4ed1f707dc', NULL, 0, 0),
(81, 'user.four', 'user04@user.comm', '$2y$10$wScXfnW01mzwiMF7FZ/kWewDwQbd66xGOql//C6JxVzlSGCRr46si', '2024-10-09 09:24:22', 'user', '4a0d65c5868eaefd9dc010bbbf6e4415da5649842a50dee5761fbad0b4d21125', NULL, 0, 0),
(82, 'user.five', 'user05@user.com', '$2y$10$SIuHXN/e3zUWqVsfTzJjEuOPvX5kIicFmFlzGQVmhten9FwxErYJO', '2024-10-09 07:30:46', 'user', 'ac88b93a758d09820e71b95cdf41904824f7bbe519f92025d7aa16bb8423f650', NULL, 0, 0),
(83, 'user.six', 'user06@user.com', '$2y$10$gYW7FfhFA72wSdoixnh75.DO9.D5i5DUyE9fwZtQO.3HKHqQAPUrm', '2024-10-09 07:31:15', 'user', 'a962168925b4425c4084eb8fb7e15e3e521aa002d01d776ee75d6d7e35788d09', NULL, 0, 0),
(84, 'user.seven', 'user07@user.com', '$2y$10$OidybLEz6ysPMqldxQiydOjMQDeNIS1byR91dFIO6THkhabfgK7fy', '2024-10-09 07:31:29', 'user', '8c7ca2715304a4aeef2b59123ab005bdb761900c490742880bb9e7999f6d1ff8', NULL, 0, 0),
(85, 'user.eight', 'user08@user.com', '$2y$10$358x.G1H4t45ozsZYfHG6eiETpp1s2JBN6mN72/5tAc73XEm3ZAPi', '2024-10-09 07:31:46', 'user', '8c46a3745b2e8db187d4e054f9a54d441f931ad515cd43123400a470973891b6', NULL, 0, 0),
(86, 'user.nine', 'user09@user.com', '$2y$10$cvmjZ8vFppUahOEQUvSNke3u7b0LnrGe1lubGz1Ff1VpmNY2P5dIO', '2024-10-09 07:31:59', 'user', 'dcc278542aa907c5ec245bdbe37ce5238f21a4547e7b0ab2ca1df8881c84f1e1', NULL, 0, 0),
(88, 'user.eleven', 'user11@user.com', '$2y$10$GwKPOHh8O53gWfiVvWFedeFRdF7yAFjPxUxVLH1owlOokp39IXHyK', '2024-10-09 07:32:27', 'user', 'a54b8792995efec91f62825f76e6e182d63d529154afa27fb6bade93a21dbd3f', NULL, 0, 0),
(89, 'user13', 'user13@example.com', 'password123', '2024-10-09 07:35:11', NULL, NULL, NULL, NULL, 0),
(90, 'user14', 'user14@example.com', 'password123', '2024-10-09 07:35:11', NULL, NULL, NULL, NULL, 0),
(91, 'user15', 'user15@example.com', 'password123', '2024-10-09 07:35:11', NULL, NULL, NULL, NULL, 0),
(92, 'user16', 'user16@example.com', 'password123', '2024-10-09 07:35:11', NULL, NULL, NULL, NULL, 0),
(93, 'user17', 'user17@example.com', 'password123', '2024-10-09 07:35:11', NULL, NULL, NULL, NULL, 0),
(94, 'user18', 'user18@example.com', 'password123', '2024-10-09 07:35:11', NULL, NULL, NULL, NULL, 0),
(95, 'user19', 'user19@example.com', 'password123', '2024-10-09 07:35:11', NULL, NULL, NULL, NULL, 0),
(96, 'user20', 'user20@example.com', 'password123', '2024-10-09 07:35:11', NULL, NULL, NULL, NULL, 0),
(99, 'user23', 'user23@example.com', 'password123', '2024-10-09 07:35:11', NULL, NULL, NULL, NULL, 0),
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
