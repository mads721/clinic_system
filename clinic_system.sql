-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2025 at 08:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('pending','approved','cancelled','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(150) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `license_number` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `user_id`, `specialization`, `license_number`) VALUES
(1, 13, 'bunot', '123123'),
(2, 14, 'bunot', '123123'),
(3, 15, 'bunot', '4125'),
(4, 16, 'dj', '216131332321'),
(5, 17, 'kosneaw', '216131332321'),
(6, 18, 'h', '1234125422'),
(7, 19, 'boxing', '87654321'),
(8, 20, 'bunot', '123');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedules`
--

CREATE TABLE `doctor_schedules` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_records`
--

CREATE TABLE `medical_records` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `diagnosis` text DEFAULT NULL,
  `prescription` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('patient','doctor','admin') NOT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `gender`, `birthdate`, `contact_number`, `address`, `created_at`, `reset_token`, `reset_token_expires`) VALUES
(1, 'Mads', 'Vipinosa', 'maderickph7777@gmail.com', '$2y$10$zNXys22QIpM/Y8bGC5wpVOhhhJ31vCmxtr5c/KJFLrDkqsH/Nkefu', 'patient', 'female', '0123-02-02', '3123-12-02', 'cavite', '2025-04-08 08:53:33', NULL, NULL),
(3, 'Brent', 'Bendal', 'brent@asdasd.com', '$2y$10$lbLDSpGb5Gwp76c0Ja8Dy.ewdvFquRe9wFDWl5sp9NyaY1wy3Qmrq', 'patient', 'male', '0412-12-23', '123123123', 'dasdasd', '2025-04-08 08:56:27', NULL, NULL),
(4, 'Antoine', 'Mijares', 'markvip.2022@gmail.com', '$2y$10$7n3k02ResB6f3jTAP7bn5.G5tB4pOVektyN8OTp5YFmMs43XcCOTC', 'patient', 'male', '3123-02-21', 'sdasdasdas', 'sdasd', '2025-04-08 09:00:33', NULL, NULL),
(5, 'Joel															Joel', 'Bermudez														Bermudez', 'joel@joel.bermudez', '$2y$10$xek3ijOgvq1CpT5dmPunbulo7MLlAt/qWnZTQpqvqn.v/2SEEK4bi', 'patient', 'male', NULL, '3123-02-02', '																																																																											1231asdasda																																																																																									', '2025-04-08 09:11:54', NULL, NULL),
(6, 'Alver', 'Dahingo', 'alvernahingo@kld.edu.ph', '$2y$10$JgDB3se4Prnae16ad0ebK.S/u4R6gGsd7z.B6UVR5gLoW9jFh0yhC', 'patient', 'male', '2124-02-03', '0909090909', 'paliparan 23', '2025-04-08 09:15:37', NULL, NULL),
(7, 'john', 'doe', 'jdoe@kld.edu.ph', '$2y$10$RNgjbXjgyshEFTVECGYz9.V5/O4O.SuqxT66kQhdoBOo6n4mN4PNy', 'patient', NULL, NULL, NULL, NULL, '2025-04-08 09:16:28', NULL, NULL),
(8, 'jhonny', 'sinner', 'jsinner@kld.edu.ph', '$2y$10$JgUEV2hTn7tA..I28HR99.SgFUVNy7nNR6U5dNrNDpbFW3kNqEWk.', 'patient', NULL, NULL, NULL, NULL, '2025-04-08 09:17:18', NULL, NULL),
(9, 'Arline', 'Vipinosa', 'arline@edu.ph', '$2y$10$5bM1ITmUXQCRpYhEMcP43esJlCPGu1tpusK8wT3wq35k0qRqMo.ru', 'patient', NULL, NULL, NULL, NULL, '2025-04-08 14:13:05', NULL, NULL),
(10, 'Rijel', 'Vipinosa', 'rvipinosa@kld.edu.ph', '$2y$10$Lmr/nGLdUJuGnAY1di89SOkcT5sbNMqhcgAPas3j/Borp.oH/l.gO', 'patient', NULL, NULL, NULL, NULL, '2025-04-08 14:37:54', NULL, NULL),
(11, 'mads', 'mads', 'mads@mads.com', 'test', 'patient', 'male', '1243-03-12', '1241231`2', 'sdasdasd', '2025-04-08 17:08:24', NULL, NULL),
(12, 'Precious Desiree', 'Ogena', 'preciousdesireeogena@gmail.com', '$2y$10$YlyykQceYvpXNmxWCFUVt.eO8VkYGTpKwvGoqPxYfDP7SfUA6xesq', 'patient', NULL, NULL, NULL, NULL, '2025-04-09 06:18:13', NULL, NULL),
(13, 'ako', 'si', 'akosi@kld.edu', '$2y$10$NtVy.Jt3Ik8iGqypVb8uYutUQ23plZhMnLCC1MtfsKgxFxhIZOB2S', 'doctor', NULL, NULL, '0909090909', NULL, '2025-04-09 16:39:27', NULL, NULL),
(14, 'Brent', 'asdasdasd', 'asdasdasd2@asdasd.fg', '$2y$10$8QeLoBt3nWf01UHd5aeDB.hQMe5hmDcUNgHjzgdpGaPWwL4PJvs.S', 'doctor', NULL, NULL, '123123123123', NULL, '2025-04-09 16:39:47', NULL, NULL),
(15, 'Antoine', '1243', '123@asd.d', '123', 'doctor', 'male', '0003-02-02', '12753312', 'sdfwdsf22fd', '2025-04-09 16:46:20', NULL, NULL),
(16, 'akoako', 'asojdngs', 'sdasd@sd.d', '$2y$10$wP3803nFzjdKP1oTXPQY4OXUNyshW49hWhbMUkFDDD71CJk37uoCO', 'doctor', 'female', '2031-02-02', '1516111', 'asd12223 ako', '2025-04-09 16:49:48', NULL, NULL),
(17, 'Doctor', 'd', 'docd21@gogo.go', '$2y$10$5qVK/yqsSbeYSmn75mRlfuvFVuyuf6iN934wo74Gnw7hRlkCKmTC6', 'doctor', 'other', '0005-05-26', '12412425', '51jj', '2025-04-09 17:18:28', NULL, NULL),
(18, 'Shaquille', 'Curry', 'shaqc23@jk.cv', '$2y$10$oH.xCuOvvwta/HE1EN0fVu5jzoTyH9mzj0xY8/l8.iTsCZuDPLZOC', 'doctor', 'male', '0021-04-02', '55555', '1 d 2 d 2 d', '2025-04-09 17:38:10', NULL, NULL),
(19, 'Manny', 'Pacman', 'mpacman123@wbo.com', '$2y$10$tsxxcFu2GzTudvORKWyp/.F1tXcVksMp1qVTLti8QgwvATKlXwcYW', 'doctor', 'male', '2124-06-05', '89898989', '1 g w 2 s', '2025-04-09 17:41:06', NULL, NULL),
(20, 'Kazuhiko', 'Paraungao', 'kp@w.s', '$2y$10$RmOVQN5SRROP1luv.Hsj5u.CgmqkJx/2m9VxwzgqjkqPUuQ.9S7SG', 'doctor', 'female', '0005-08-12', '1136', 'japan', '2025-04-09 17:43:32', NULL, NULL),
(21, 'test', 'test', 'test@test.test', '$2y$10$6NYj3uv2S/YH2a7UqxjYROpHWXcrnAeSRfJeFSeQi0S/U9nRkiFqu', 'patient', NULL, NULL, NULL, NULL, '2025-04-29 08:17:58', NULL, NULL),
(22, 'Precious', 'Ogena', 'precious@gmail.com', '$2y$10$xk0Mu5QaRQvzX/kumXfbHullh2OrBsTHDicbBN.cWSk6sIASUr/m.', 'patient', NULL, NULL, NULL, NULL, '2025-04-29 10:00:22', NULL, NULL),
(23, 'Sophia Marie ', 'Honra', 'smhonra@kld.edu.ph', '$2y$10$z7uqq0uf2NNJOs4nPUBDpuA3kNIzTp0Wr3V2LhCfR60NvNc97pE0i', 'patient', NULL, NULL, NULL, NULL, '2025-04-29 10:34:54', NULL, NULL),
(24, 'Alver', 'Dahingo', 'ajldahingo@kld.edu.ph', '$2y$10$RvnT.7wLqGVemSL2MKY8jOmZG0SwiZuRnAL2ytHQuHEpZpXlqjOOm', 'patient', NULL, NULL, NULL, NULL, '2025-05-01 07:55:54', '2141585e92ce10ce5649eb0380cfe7e988b26379e331a5fd0f5931c2b44bf6d8', '2025-05-01 16:56:09'),
(25, 'Maderick', 'Vipinosa', 'mtvipinosa@kld.edu.ph', '$2y$10$rEBHyP3CDj7rx/l4mbNVyuXlNQC2VIv3ZK6X03qn0LkMZJbsFK7h.', 'patient', NULL, NULL, NULL, NULL, '2025-05-01 17:21:32', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `appointment_id` (`appointment_id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medical_records`
--
ALTER TABLE `medical_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  ADD CONSTRAINT `doctor_schedules_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD CONSTRAINT `medical_records_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medical_records_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medical_records_ibfk_3` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
