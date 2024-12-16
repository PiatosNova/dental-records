-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 09:26 AM
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
-- Database: `dental`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service` varchar(255) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `service`, `appointment_date`, `appointment_time`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Dental Checkup', '2024-12-12', '12:32:00', 'weq', 'confirmed', '2024-12-10 17:06:26', '2024-12-10 17:11:17'),
(2, 2, 'Teeth Cleaning', '2024-12-24', '09:19:00', '', 'confirmed', '2024-12-10 17:17:52', '2024-12-10 17:30:26'),
(3, 4, 'Teeth Cleaning', '2024-12-26', '10:00:00', 'sdfg', 'confirmed', '2024-12-11 09:46:11', '2024-12-11 09:47:14'),
(4, 4, 'Dental Checkup', '2024-12-26', '10:00:00', 'xdfg', 'confirmed', '2024-12-11 09:46:37', '2024-12-11 09:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`, `created_at`, `updated_at`, `isAdmin`) VALUES
(2, 'Mark Louie Alvarez', 'mark@gmail.com', '$2y$10$fKdYJhoXgOn41/nQhSjqeeu6bTdaQAuNwMCbEpui1PbYxg34WcIqu', 1, '2024-12-10 16:59:02', '2024-12-10 16:59:02', 1),
(3, 'Papabon', 'pabon@gmail.com', '$2y$10$OLXqL1sZPZA.u4etlO4F3OX71P0UhBZkHwda7WuX.PSZ2MPTzW3SS', 0, '2024-12-10 17:29:33', '2024-12-10 17:29:33', 0),
(4, 'Vince', 'vince@gmail.com', '$2y$10$VvaEmdAG4s9eEE25eCruq.PIU3YMJEI3rs344mzhZJK7LckxY06pi', 0, '2024-12-11 09:44:59', '2024-12-11 09:44:59', 0),
(5, 'Madara', 'madara@gmail.com', '$2y$10$HEh040PhHhVZ.0tXBAxVdeeJ7Ku9ThOJpz85akOsjzAHq.bSwE10u', 0, '2024-12-11 13:17:48', '2024-12-11 13:17:48', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
