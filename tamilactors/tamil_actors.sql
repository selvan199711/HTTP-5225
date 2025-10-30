-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2025 at 05:37 AM
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
-- Database: `assignment1`
--

-- --------------------------------------------------------

--
-- Table structure for table `tamil_actors`
--

CREATE TABLE `tamil_actors` (
  `id` int(11) NOT NULL,
  `actor_name` varchar(100) DEFAULT NULL,
  `movies_count` int(11) DEFAULT NULL,
  `debut_year` int(11) DEFAULT NULL,
  `famous_movie` varchar(100) DEFAULT NULL,
  `birth_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tamil_actors`
--

INSERT INTO `tamil_actors` (`id`, `actor_name`, `movies_count`, `debut_year`, `famous_movie`, `birth_date`) VALUES
(1, 'Vijay', 65, 1992, 'Thuppakki', '1974-06-22'),
(2, 'Ajith Kumar', 61, 1990, 'Veeram', '1971-05-01'),
(3, 'Suriya', 50, 1997, 'Ghajini', '1975-07-23'),
(4, 'Kamal Haasan', 230, 1960, 'Vikram', '1954-11-07'),
(5, 'Rajinikanth', 170, 1975, 'Enthiran', '1950-12-12'),
(6, 'Dhanush', 50, 2002, 'Asuran', '1983-07-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tamil_actors`
--
ALTER TABLE `tamil_actors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tamil_actors`
--
ALTER TABLE `tamil_actors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
