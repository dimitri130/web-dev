-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 13, 2023 at 01:09 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `firstdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `db1_users`
--

CREATE TABLE `db1_users` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gpa` float NOT NULL,
  `gradelevel` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `db1_users`
--

INSERT INTO `db1_users` (`name`, `email`, `password`, `gpa`, `gradelevel`) VALUES
('fred', 'fredham@hammer.com', 'loan333', 3.4, 11),
('Andrew A', 'fullofbs@gmail.com', 'abc123', 3.1, 10),
('Joe joe', 'joehaver@gmail.com', 'joe234', 3.3, 11),
('sandy cheeks', 'sand@gmail.com', 'sandypee', 2.2, 12),
('sanjay', 'sand@hgail.com', 'llllll', 3.8, 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db1_users`
--
ALTER TABLE `db1_users`
  ADD UNIQUE KEY `email` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
