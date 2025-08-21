-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2025 at 08:30 AM
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
-- Database: `cms1`
--

-- --------------------------------------------------------

--
-- Table structure for table `adddoc`
--

CREATE TABLE `adddoc` (
  `id` int(11) NOT NULL,
  `caseNumber` varchar(50) NOT NULL,
  `citation` varchar(250) NOT NULL,
  `activityDate` date NOT NULL,
  `roughDoc` varchar(500) NOT NULL,
  `finalDoc` varchar(500) DEFAULT NULL,
  `errorFlag` varchar(50) NOT NULL DEFAULT 'False',
  `errorMessage` int(50) DEFAULT NULL,
  `reviewed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adddoc`
--

INSERT INTO `adddoc` (`id`, `caseNumber`, `citation`, `activityDate`, `roughDoc`, `finalDoc`, `errorFlag`, `errorMessage`, `reviewed`) VALUES
(27, 'E100', 'saw vs sickel', '2024-04-04', 'testDoc.pdf', 'testDoc.pdf', 'False', NULL, 0),
(42, 'E1155/2023', 'john vs david', '2024-11-06', 'testDoc.pdf', NULL, 'False', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `caseparty`
--

CREATE TABLE `caseparty` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `caseNumber` varchar(50) NOT NULL,
  `doc` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `caseparty`
--

INSERT INTO `caseparty` (`id`, `firstName`, `lastName`, `role`, `caseNumber`, `doc`) VALUES
(1, 'Brian', 'Wambugu', 'witness', 'E100', ''),
(2, 'chinqa ', 'chilne', 'witness', 'E010/2024', ''),
(3, 'Elvis', 'ngari', 'witness', 'E100', 'testDoc.pdf'),
(4, 'john', 'ngari', 'litigant', 'E100', 'testDoc.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `class_list`
--

CREATE TABLE `class_list` (
  `id` int(11) NOT NULL,
  `caseNumber` varchar(50) NOT NULL,
  `activity` varchar(500) NOT NULL,
  `activityDate` date NOT NULL,
  `activityTime` time NOT NULL,
  `court` varchar(50) NOT NULL,
  `action_to` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_list`
--

INSERT INTO `class_list` (`id`, `caseNumber`, `activity`, `activityDate`, `activityTime`, `court`, `action_to`) VALUES
(4, 'E100', 'mention', '2024-04-27', '09:00:00', 'court 1', 'hon kamau'),
(5, 'E100', 'mention', '2024-04-30', '21:45:00', 'court 1', 'hon kamau'),
(6, 'E100', 'mention', '2024-05-11', '16:54:00', 'Court 1', 'hon kamau'),
(7, 'E100', 'mention', '2024-04-27', '17:11:00', 'Court 1', 'hon kamau');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `caseNumber` varchar(50) NOT NULL,
  `activity` varchar(500) NOT NULL,
  `activityDate` date NOT NULL,
  `court` varchar(50) NOT NULL,
  `action_to` varchar(50) NOT NULL,
  `outcome` varchar(50) NOT NULL,
  `witnessCount` varchar(50) NOT NULL,
  `comments` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `caseNumber`, `activity`, `activityDate`, `court`, `action_to`, `outcome`, `witnessCount`, `comments`) VALUES
(18, 'E100', 'mention', '2024-04-17', 'court 1', 'hon kamau', 'judgement', '0', 'defendant fined KSH 15000 or 4 months imprisonment.'),
(21, 'E036/2020', 'mention', '2024-05-02', 'Court 2', 'hon james', 'hearing date set in court', '0', 'set for 30th may 2024'),
(22, 'E036/2020', 'mention', '2024-04-17', 'Court 1', 'hon james', 'hearing date set in court', '1', 'date 25th june'),
(23, 'E100', 'mention', '2024-04-19', 'Court 2', 'hon kamau', 'Judgements', '2', 'judgement date set for  30th April 2024\r\nwitnesses: Mr james, Mr Doe');

-- --------------------------------------------------------

--
-- Table structure for table `evidence`
--

CREATE TABLE `evidence` (
  `id` int(11) NOT NULL,
  `caseNumber` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `doc` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evidence`
--

INSERT INTO `evidence` (`id`, `caseNumber`, `date`, `image`, `doc`) VALUES
(4, 'E100', '2024-04-22 00:00:00', 'depositphotos_173945448-stock-photo-crime-scene-investigation-collecting-evidence.jpg', 'testDoc.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `user_from` bigint(20) NOT NULL,
  `user_to` bigint(20) NOT NULL,
  `date_send` datetime NOT NULL DEFAULT current_timestamp(),
  `date_read` datetime DEFAULT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `new_case`
--

CREATE TABLE `new_case` (
  `caseNumber` varchar(50) NOT NULL,
  `caseType` varchar(50) NOT NULL,
  `citation` varchar(70) NOT NULL,
  `courtType` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `progress` varchar(50) NOT NULL DEFAULT 'ongoing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `new_case`
--

INSERT INTO `new_case` (`caseNumber`, `caseType`, `citation`, `courtType`, `created_at`, `progress`) VALUES
('E010/2024', 'MCSOA-Sexual Offence', 'The Republic VS SAMUEL LOKUWAM LORDO', 'Magistrate Court', '2024-04-17 14:28:47', 'closed'),
('E036/2020', 'MCSOA-Sexual Offence', 'The Republic VS JOSEPH KURIA WASHUKU AND BONIFACE MUIRURI NYACHAU', 'Magistrate Court', '2024-04-17 14:31:17', 'ongoing'),
('E044/2024', 'MCCR-Criminal Case', 'The Republic VS KELVIN WAITHAKA WAITHERA', 'Magistrate Court', '2024-04-17 14:28:11', 'ongoing'),
('E100', 'civil', 'Marilin vs Edward', 'ELC', '2024-02-04 11:45:25', 'ongoing'),
('E1155/2023', 'MCCR-Criminal Case', 'The Republic VS JOSEPH MULIKA SIYUYU', 'Magistrate Court', '2024-04-17 14:27:18', 'ongoing'),
('E1336/2023', 'MCCR-Criminal Case', 'The Republic VS EZEKIEL KANZUNGU MWAMBIRE', 'Magistrate Court', '2024-04-17 14:27:47', 'ongoing'),
('E1342/2024', 'MCTR-Traffic Case', 'The Republic VS Mike Wesonga', 'Magistrate Court', '2024-04-22 04:28:43', 'ongoing'),
('E140/2024', 'MCTR-Traffic Case', 'The Republic VS ROBERT KELLY MBURU', 'Magistrate Court', '2024-04-17 14:29:49', 'ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `i` int(11) NOT NULL,
  `file` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`i`, `file`) VALUES
(1, 'COMPUTER SECURITY LAB WORK.pdf'),
(2, 'final attatchment report 2022.pdf'),
(10, 'COMPUTER SECURITY LAB WORK.pdf'),
(11, 'COMPUTER SECURITY LAB WORK.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `level` varchar(50) DEFAULT NULL,
  `image` varchar(500) NOT NULL,
  `login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `password`, `email`, `created_at`, `updated_at`, `level`, `image`, `login`) VALUES
(37, 'john', 'ngari', '$2y$10$YO5ZgwhlBZre1swIBPAf5OklnIrxwa/i5bSsXGjbp.tpFDDf1A/xa', 'john@gmail.com', '2024-04-17 08:41:48', '0000-00-00 00:00:00', 'admin', '', NULL),
(38, 'Brian', 'Wambugu', '$2y$10$icNPXRVdK1bAgnfQMvOSveA6mkmCEthrwWdFcgibOdZEKJq.zitfy', 'brian@gmail.com', '2024-04-17 08:42:55', '0000-00-00 00:00:00', 'admin', '', '2025-08-21 05:27:05'),
(39, 'Elvis', 'ngari', '$2y$10$Je0DKesXtvs1sTELorkF7eO.5mNL7KqgFVsd1TenshPaSyhPqMABW', 'elvis@gmail.com', '2024-04-17 08:43:37', '0000-00-00 00:00:00', 'staff', '', '2024-12-03 23:34:16'),
(40, 'china', 'china', '$2y$10$0ezRcAvCztliufvq91.V1OjBPOT/f9kvlz9unpBAjegToL5XohZIu', 'china@gmail.com', '2024-04-22 04:27:32', '0000-00-00 00:00:00', 'staff', '', NULL),
(42, 'one', 'two', '$2y$10$Gc4PBSLaRjNzy/lOSiblwO50cDBPGgQRIE.P57dMpab0hIpCeTKKW', 'one@cms.com', '2025-08-21 08:28:26', '0000-00-00 00:00:00', 'admin', '', '2025-08-21 05:29:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adddoc`
--
ALTER TABLE `adddoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caseNumber` (`caseNumber`);

--
-- Indexes for table `caseparty`
--
ALTER TABLE `caseparty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caseNumber` (`caseNumber`);

--
-- Indexes for table `class_list`
--
ALTER TABLE `class_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caseNumber` (`caseNumber`);

--
-- Indexes for table `evidence`
--
ALTER TABLE `evidence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`user_from`,`user_to`,`date_send`),
  ADD KEY `date_read` (`date_read`);

--
-- Indexes for table `new_case`
--
ALTER TABLE `new_case`
  ADD PRIMARY KEY (`caseNumber`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`i`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adddoc`
--
ALTER TABLE `adddoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `caseparty`
--
ALTER TABLE `caseparty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `class_list`
--
ALTER TABLE `class_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `evidence`
--
ALTER TABLE `evidence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `i` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adddoc`
--
ALTER TABLE `adddoc`
  ADD CONSTRAINT `adddoc_ibfk_1` FOREIGN KEY (`caseNumber`) REFERENCES `new_case` (`caseNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `caseparty`
--
ALTER TABLE `caseparty`
  ADD CONSTRAINT `caseparty_ibfk_1` FOREIGN KEY (`caseNumber`) REFERENCES `new_case` (`caseNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`caseNumber`) REFERENCES `new_case` (`caseNumber`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
