-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 02, 2020 at 04:14 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

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

-- --------------------------------------------------------

--
-- Table structure for table `parties`
--

CREATE TABLE `parties` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `electoral_areas`
--
ALTER TABLE `electoral_areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parties`
--
ALTER TABLE `parties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `polling_stations`
--
ALTER TABLE `polling_stations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
