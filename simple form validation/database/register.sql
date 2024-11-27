-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2024 at 10:13 PM
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
-- Database: `register`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `full name` text NOT NULL,
  `date birth` varchar(20) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `password` varchar(30) NOT NULL,
  `confirm password` varchar(30) NOT NULL,
  `mobile no` int(10) NOT NULL,
  `id number` varchar(15) NOT NULL,
  `Age` int(3) NOT NULL,
  `sex` text NOT NULL,
  `country` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `full name`, `date birth`, `Email`, `password`, `confirm password`, `mobile no`, `id number`, `Age`, `sex`, `country`) VALUES
(10, 'writeyournamehereplease', '2024-07-02', 'dagiman2116@gmail.com', '$2y$10$t66Ua6pJd1Iri9L.4kFL9uj', '$2y$10$t66Ua6pJd1Iri9L.4kFL9uj', 989786756, 'ugr/10343/56', 45, 'Male', 'Ethiopia'),
(11, 'desalegnbelachewalene', '2024-11-01', 'ketemmdaba@gmail.com', '$2y$10$TvrIvgvWKeHOQjjZdmC7OeO', '$2y$10$TvrIvgvWKeHOQjjZdmC7OeO', 989786756, 'ugr/10343/56', 56, 'Male', 'Ethiopia'),
(12, 'desalegnbelachewalene', '2024-11-01', 'ketemmdaba@gmail.com', '$2y$10$keJQPBfAk2EMxKZsHnudFOf', '$2y$10$keJQPBfAk2EMxKZsHnudFOf', 989786756, 'ugr/10343/56', 56, 'Male', 'Ethiopia'),
(13, 'derese aba', '2024-10-31', 'wehal32@gmail.com', '$2y$10$9nePAqaVM/WobpsOc7bpDuI', '$2y$10$9nePAqaVM/WobpsOc7bpDuI', 989786756, 'ugr/10343/56', 23, 'Female', 'Ethiopia'),
(14, 'derese aba', '2024-10-31', 'wehal32@gmail.com', '$2y$10$0SGbopWzPUUD8FNX0gJt9.q', '$2y$10$0SGbopWzPUUD8FNX0gJt9.q', 989786756, 'ugr/10343/56', 23, 'Female', 'Ethiopia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
