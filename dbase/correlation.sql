-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 04, 2020 at 04:14 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

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

--
-- Dumping data for table `ballots`
--

INSERT INTO `ballots` (`id`, `party_id`, `constituency_id`, `type`, `created_at`) VALUES
(1, 1, 1, 'presidential', '2020-12-03 22:25:26'),
(2, 2, 1, 'presidential', '2020-12-03 22:25:26'),
(3, 3, 1, 'presidential', '2020-12-03 22:25:26'),
(4, 4, 1, 'presidential', '2020-12-03 22:25:26'),
(5, 5, 1, 'presidential', '2020-12-03 22:25:26'),
(6, 1, 1, 'parliamentary', '2020-12-03 22:25:47'),
(7, 2, 1, 'parliamentary', '2020-12-03 22:25:47'),
(8, 3, 1, 'parliamentary', '2020-12-03 22:25:47'),
(9, 4, 1, 'parliamentary', '2020-12-03 22:25:47'),
(10, 5, 1, 'parliamentary', '2020-12-03 22:25:47');

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
  `party_name` varchar(50) NOT NULL,
  `presidential_votes` int(11) NOT NULL DEFAULT 0,
  `parliament_votes` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `polling_stations_id`, `party_name`, `presidential_votes`, `parliament_votes`, `created_at`) VALUES
(1, 1, 'NPP', 6, 2, '2020-12-04 15:00:01'),
(2, 1, 'NDC', 5, 1, '2020-12-04 15:00:01'),
(3, 1, 'GUM', 5, 1, '2020-12-04 15:00:01'),
(4, 1, 'CPP', 5, 1, '2020-12-04 15:00:01'),
(5, 1, 'GFP', 5, 1, '2020-12-04 15:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$oN.gOI/sDARA/CbwY9sIJugMhwx52tY0gDVOyXJUBdhHNRG1c1ZYq', '2020-12-03 18:52:50');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_ballots`
-- (See below for the actual view)
--
CREATE TABLE `view_ballots` (
`id` int(11)
,`name` varchar(100)
,`party_id` int(11)
,`constituency` varchar(255)
,`constituency_id` int(11)
,`type` varchar(20)
,`created_at` timestamp
);

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
,`code` varchar(50)
,`polling_name` varchar(100)
,`voters` int(11)
,`constituency` varchar(255)
,`constituency_id` int(11)
,`electoral_name` varchar(255)
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Structure for view `view_ballots`
--
DROP TABLE IF EXISTS `view_ballots`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_ballots`  AS SELECT `b`.`id` AS `id`, `p`.`name` AS `name`, `b`.`party_id` AS `party_id`, `c`.`constituency` AS `constituency`, `b`.`constituency_id` AS `constituency_id`, `b`.`type` AS `type`, `b`.`created_at` AS `created_at` FROM ((`ballots` `b` join `parties` `p`) join `constituencies` `c`) WHERE `b`.`party_id` = `p`.`id` AND `b`.`constituency_id` = `c`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_electoral_areas`
--
DROP TABLE IF EXISTS `view_electoral_areas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_electoral_areas`  AS SELECT `electoral_areas`.`id` AS `id`, `electoral_areas`.`constituencies_id` AS `constituencies_id`, `electoral_areas`.`name` AS `name`, `constituencies`.`district` AS `district`, `constituencies`.`constituency` AS `constituency` FROM (`electoral_areas` join `constituencies`) WHERE `electoral_areas`.`constituencies_id` = `constituencies`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_polling_stations`
--
DROP TABLE IF EXISTS `view_polling_stations`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_polling_stations`  AS SELECT `p`.`id` AS `id`, `p`.`code` AS `code`, `p`.`name` AS `polling_name`, `p`.`voters` AS `voters`, `c`.`constituency` AS `constituency`, `c`.`id` AS `constituency_id`, `e`.`name` AS `electoral_name`, `p`.`created_at` AS `created_at` FROM ((`polling_stations` `p` join `electoral_areas` `e`) join `constituencies` `c`) WHERE `e`.`id` = `p`.`electroal_areas_id` AND `c`.`id` = `e`.`constituencies_id` ;

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ballots`
--
ALTER TABLE `ballots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
