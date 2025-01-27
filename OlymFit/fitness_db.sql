-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 03:19 PM
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
-- Database: `fitness_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$4wx3icbm.h2WxVsLVT/KneNETqIHCxlWg/6aT8d.jHJRrW2RmfB1K');

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE `challenges` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`id`, `name`, `description`, `start_date`, `end_date`) VALUES
(2, '10 km Marathon', 'Challenge your Limits', '2025-01-01', '2025-01-29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Maria', 'maria@email.com', '$2y$10$1TNJ5tT4OVi4mr1K5wNyYuZu8npzWJVuy5tAqhJ/WaoypurNu3GrG', '2025-01-24 07:07:53'),
(3, 'mamamia', 'mamami@email.com', '$2y$10$YQCexLo3axJRqgZ3W/1P5eoNotTYz2tV/TTbB9XbmD6//N4.AYFPi', '2025-01-24 07:08:39'),
(4, 'mamamia', 'mamamia@email.com', '$2y$10$PEOm96l783RqoPfgadf9PejhLnmDuphlL/Vh.DG9m/K7SDQR3Qnqa', '2025-01-24 13:35:42'),
(6, 'hamanahamana', 'hamanahamana@email.com', '$2y$10$LIxEmBg/JmuTuwq.kpL3ROtH/zCAxxx3cl3LtD3V0qyKzPwlBaAt2', '2025-01-24 13:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `workouts`
--

CREATE TABLE `workouts` (
  `id` int(11) NOT NULL,
  `activity` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `duration` int(11) NOT NULL,
  `distance` decimal(5,2) NOT NULL,
  `calories` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `intensity` enum('Low','Medium','High') DEFAULT 'Medium',
  `heartRate` int(11) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workouts`
--

INSERT INTO `workouts` (`id`, `activity`, `date`, `duration`, `distance`, `calories`, `userId`, `intensity`, `heartRate`, `location`, `createdAt`, `updatedAt`, `notes`) VALUES
(1, 'Running', '2025-01-24', 60, 10.00, 700, 3, 'Medium', 150, 'Soledad, Darasa, Tanauan City ', '2025-01-25 00:08:38', '2025-01-25 00:08:38', 'It was hell'),
(2, 'Running', '2025-01-24', 60, 10.00, 700, 3, 'Medium', 150, 'Soledad, Darasa, Tanauan City ', '2025-01-25 00:11:15', '2025-01-25 00:11:15', 'It was hell'),
(3, 'Running', '2025-01-24', 60, 10.00, 700, 3, 'Medium', 150, 'Soledad, Darasa, Tanauan City ', '2025-01-25 01:07:51', '2025-01-25 01:07:51', 'It was hell'),
(4, 'Running', '2024-12-12', 60, 20.00, 600, 3, 'Medium', 120, 'BGC', '2025-01-25 01:26:38', '2025-01-25 01:26:38', 'hell yeah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workouts`
--
ALTER TABLE `workouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `challenges`
--
ALTER TABLE `challenges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `workouts`
--
ALTER TABLE `workouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `workouts`
--
ALTER TABLE `workouts`
  ADD CONSTRAINT `workouts_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
