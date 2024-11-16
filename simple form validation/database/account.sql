-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 04:53 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `account`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'dejach worku', 'wehaveonelife718@gma', '$2y$10$jY2uc2nZ'),
(2, 'melkamu bessie', 'dagimdog@gmail.com', '$2y$10$ZjiJAy1x'),
(3, 'habib husen ebrahem', 'habbhusen@gmail.com', '$2y$10$jJ.GkKfo'),
(4, 'zera bruk', 'dagiman2116@gmail.co', '$2y$10$iBHzd4OL'),
(5, 'dejach worku', 'dagiman2116@gmail.co', '$2y$10$1eGZvhQR'),
(6, 'dejach worku', 'dagiman2116@gmail.co', '$2y$10$PBeGJ2mn'),
(7, 'dejach worku', 'dagiman2116@gmail.co', '$2y$10$073UyWxz'),
(8, 'dejach worku', 'dagiman2116@gmail.co', '$2y$10$bOzyyqOH'),
(9, 'dejach worku', 'dagiman2116@gmail.co', '$2y$10$cQSyE.r2'),
(10, 'dejach worku', 'dagiman2116@gmail.co', '$2y$10$BXYshozt'),
(11, 'dejach worku', 'dagiman2116@gmail.co', '$2y$10$6UrPJcjE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
