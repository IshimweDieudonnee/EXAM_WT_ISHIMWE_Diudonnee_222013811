-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2024 at 11:11 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `communicationskills_workshops_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `communicationskillsresources`
--

CREATE TABLE `communicationskillsresources` (
  `resource_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `communicationskillsresources`
--

INSERT INTO `communicationskillsresources` (`resource_id`, `title`, `url`, `description`, `category_id`) VALUES
(1, 'tititi', 'www.hello.v]com', 'ssddff', 1),
(2, 'tititi', 'www.hello.v]com', 'ssddff', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `communicationskillsresources`
--
ALTER TABLE `communicationskillsresources`
  ADD PRIMARY KEY (`resource_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `communicationskillsresources`
--
ALTER TABLE `communicationskillsresources`
  MODIFY `resource_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `communicationskillsresources`
--
ALTER TABLE `communicationskillsresources`
  ADD CONSTRAINT `communicationskillsresources_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `communicationskillscategories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
