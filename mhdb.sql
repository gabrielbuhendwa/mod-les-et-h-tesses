-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2024 at 11:43 AM
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
-- Database: `mhdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `hostesses`
--

CREATE TABLE `hostesses` (
  `id` int(11) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birth_date` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `code_number` varchar(30) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `whatsapp` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `instagram` varchar(300) NOT NULL,
  `height` varchar(255) NOT NULL,
  `languages` varchar(255) NOT NULL,
  `hair` varchar(255) NOT NULL,
  `eye` varchar(255) NOT NULL,
  `shoes_size` varchar(255) NOT NULL,
  `face_portrait` varchar(255) NOT NULL,
  `profile_portrait` varchar(255) NOT NULL,
  `full_body_front_side` varchar(255) NOT NULL,
  `action_shot` varchar(255) NOT NULL,
  `swimwear_photo` varchar(255) NOT NULL,
  `approval_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hostesses_requests`
--

CREATE TABLE `hostesses_requests` (
  `id` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birth_date` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `code_number` varchar(30) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `whatsapp` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `instagram` varchar(300) NOT NULL,
  `height` varchar(255) NOT NULL,
  `languages` varchar(255) NOT NULL,
  `hair` varchar(255) NOT NULL,
  `eye` varchar(255) NOT NULL,
  `shoes_size` varchar(255) NOT NULL,
  `id_card` varchar(255) NOT NULL,
  `face_portrait` varchar(255) NOT NULL,
  `profile_portrait` varchar(255) NOT NULL,
  `full_body_front_side` varchar(255) NOT NULL,
  `action_shot` varchar(255) NOT NULL,
  `swimwear_photo` varchar(255) NOT NULL,
  `request_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `id` int(11) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birth_date` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `code_number` varchar(30) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `whatsapp` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `instagram` varchar(300) NOT NULL,
  `height` varchar(255) NOT NULL,
  `languages` varchar(255) NOT NULL,
  `hair` varchar(255) NOT NULL,
  `eye` varchar(255) NOT NULL,
  `shoes_size` varchar(255) NOT NULL,
  `face_portrait` varchar(255) NOT NULL,
  `profile_portrait` varchar(255) NOT NULL,
  `full_body_front_side` varchar(255) NOT NULL,
  `action_shot` varchar(255) NOT NULL,
  `swimwear_photo` varchar(255) NOT NULL,
  `approval_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `models_request`
--

CREATE TABLE `models_request` (
  `id` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birth_date` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `code_number` varchar(30) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `whatsapp` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `instagram` varchar(300) NOT NULL,
  `height` varchar(255) NOT NULL,
  `languages` varchar(255) NOT NULL,
  `hair` varchar(255) NOT NULL,
  `eye` varchar(255) NOT NULL,
  `shoes_size` varchar(255) NOT NULL,
  `id_card` varchar(255) NOT NULL,
  `face_portrait` varchar(255) NOT NULL,
  `profile_portrait` varchar(255) NOT NULL,
  `full_body_front_side` varchar(255) NOT NULL,
  `action_shot` varchar(255) NOT NULL,
  `swimwear_photo` varchar(255) NOT NULL,
  `request_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `name`, `description`, `photo`) VALUES
(7, 'Cathy Nganje', ' Prêt-à-porter sur-mesure et créations personnalisées.', '676aace7a36f2.png'),
(8, 'Media Vision Academy', ' Maîtrisez tous les aspects de la production cinématographique', '676aac73b44ab.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT 'images.png',
  `telephone` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_activation_hash` varchar(64) DEFAULT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `profile_picture`, `telephone`, `address`, `password`, `account_activation_hash`, `reset_token_hash`, `reset_token_expires_at`, `role`) VALUES
(11, 'Buhendwa', 'Gabriel', 'gabrielbuhendwa400@gmail.com', 'images.png', '+250791348977', 'Kigali (Rwanda)', '$2y$10$cEWoA7RDMiWDsCj3RZbMqODdat5xM8DhRf3GyO2BajlbjbG/vNH6i', NULL, NULL, NULL, 'admin'),
(12, 'Ndayisaba', 'Gloire', 'carlosjeune741@gmail.com', 'images.png', '+250791348977', 'Goma', '$2y$10$t9WZljqcu9ISfvnWbo7kReaJLz079fEGyzdYK5XyE5X6f6K8XqkBC', NULL, NULL, NULL, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hostesses`
--
ALTER TABLE `hostesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostesses_requests`
--
ALTER TABLE `hostesses_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `models_request`
--
ALTER TABLE `models_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_activation_hash` (`account_activation_hash`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hostesses`
--
ALTER TABLE `hostesses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostesses_requests`
--
ALTER TABLE `hostesses_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `models_request`
--
ALTER TABLE `models_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
