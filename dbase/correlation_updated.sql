-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2020 at 11:49 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `correlation`
--

-- --------------------------------------------------------

--
-- Table structure for table `ballots`
--

CREATE TABLE `ballots` (
  `id` int(11) NOT NULL,
  `party_id` int(11) NOT NULL,
  `constituency_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `constituencies`
--

CREATE TABLE `constituencies` (
  `id` int(11) NOT NULL,
  `district` varchar(255) NOT NULL,
  `constituency` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `constituencies`
--

INSERT INTO `constituencies` (`id`, `district`, `constituency`, `created_at`) VALUES
(1, 'BOLE-BAMBOI', 'BOLE-BAMBOI', '2020-12-03 07:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `electoral_areas`
--

CREATE TABLE `electoral_areas` (
  `id` int(11) NOT NULL,
  `constituencies_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `electoral_areas`
--

INSERT INTO `electoral_areas` (`id`, `constituencies_id`, `name`, `created_at`) VALUES
(2, 1, 'JAKALA', '2020-12-03 09:47:15'),
(3, 1, 'SAMPELE', '2020-12-03 09:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `parties`
--

CREATE TABLE `parties` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parties`
--

INSERT INTO `parties` (`id`, `name`, `created_at`) VALUES
(1, 'NPP', '2020-12-03 11:31:25'),
(2, 'NDC', '2020-12-03 11:31:25'),
(3, 'GUM', '2020-12-03 11:31:53'),
(4, 'CPP', '2020-12-03 11:31:53'),
(5, 'GFP', '2020-12-03 11:32:25'),
(6, 'GCPP', '2020-12-03 11:32:25'),
(7, 'APC', '2020-12-03 11:32:41'),
(8, 'LPG', '2020-12-03 11:32:41'),
(9, 'PNC', '2020-12-03 11:33:01'),
(10, 'PPP', '2020-12-03 11:33:01'),
(11, 'NDP', '2020-12-03 11:33:59'),
(12, 'IND', '2020-12-03 11:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `polling_stations`
--

CREATE TABLE `polling_stations` (
  `id` int(11) NOT NULL,
  `electroal_areas_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `voters` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `polling_stations`
--

INSERT INTO `polling_stations` (`id`, `electroal_areas_id`, `code`, `name`, `voters`, `created_at`) VALUES
(1, 2, 'N010001', 'ROMAN PRIMARY SCHOOL', 200, '2020-12-03 11:07:44'),
(2, 2, 'N010002', 'presby primary a', 250, '2020-12-03 11:14:30'),
(3, 2, 'N010003', 'COMMUNITY CENTRE A', 400, '2020-12-03 11:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `polling_stations_id` int(11) NOT NULL,
  `party_name` varchar(100) NOT NULL,
  `presidential_votes` int(11) NOT NULL,
  `parliament_votes` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_electoral_areas`
-- (See below for the actual view)
--
CREATE TABLE `view_electoral_areas` (
`id` int(11)
,`constituencies_id` int(11)
,`name` varchar(255)
,`district` varchar(255)
,`constituency` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_polling_stations`
-- (See below for the actual view)
--
CREATE TABLE `view_polling_stations` (
`id` int(11)
,`electroal_areas_id` int(11)
,`electoral_name` varchar(255)
,`code` varchar(50)
,`polling_name` varchar(100)
,`voters` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `view_electoral_areas`
--
DROP TABLE IF EXISTS `view_electoral_areas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_electoral_areas`  AS  select `electoral_areas`.`id` AS `id`,`electoral_areas`.`constituencies_id` AS `constituencies_id`,`electoral_areas`.`name` AS `name`,`constituencies`.`district` AS `district`,`constituencies`.`constituency` AS `constituency` from (`electoral_areas` join `constituencies`) where `electoral_areas`.`constituencies_id` = `constituencies`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_polling_stations`
--
DROP TABLE IF EXISTS `view_polling_stations`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_polling_stations`  AS  select `polling_stations`.`id` AS `id`,`polling_stations`.`electroal_areas_id` AS `electroal_areas_id`,`electoral_areas`.`name` AS `electoral_name`,`polling_stations`.`code` AS `code`,`polling_stations`.`name` AS `polling_name`,`polling_stations`.`voters` AS `voters` from (`polling_stations` join `electoral_areas`) where `polling_stations`.`electroal_areas_id` = `electoral_areas`.`id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ballots`
--
ALTER TABLE `ballots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `party_id` (`party_id`),
  ADD KEY `constituency_id` (`constituency_id`);

--
-- Indexes for table `constituencies`
--
ALTER TABLE `constituencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `electoral_areas`
--
ALTER TABLE `electoral_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `electoral_areas_ibfk_1` (`constituencies_id`);

--
-- Indexes for table `parties`
--
ALTER TABLE `parties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polling_stations`
--
ALTER TABLE `polling_stations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `polling_stations_ibfk_1` (`electroal_areas_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `polling_stations_id` (`polling_stations_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ballots`
--
ALTER TABLE `ballots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `constituencies`
--
ALTER TABLE `constituencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `electoral_areas`
--
ALTER TABLE `electoral_areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `parties`
--
ALTER TABLE `parties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `polling_stations`
--
ALTER TABLE `polling_stations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ballots`
--
ALTER TABLE `ballots`
  ADD CONSTRAINT `ballots_ibfk_1` FOREIGN KEY (`party_id`) REFERENCES `parties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ballots_ibfk_2` FOREIGN KEY (`constituency_id`) REFERENCES `parties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `electoral_areas`
--
ALTER TABLE `electoral_areas`
  ADD CONSTRAINT `electoral_areas_ibfk_1` FOREIGN KEY (`constituencies_id`) REFERENCES `constituencies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `polling_stations`
--
ALTER TABLE `polling_stations`
  ADD CONSTRAINT `polling_stations_ibfk_1` FOREIGN KEY (`electroal_areas_id`) REFERENCES `electoral_areas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`polling_stations_id`) REFERENCES `polling_stations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
