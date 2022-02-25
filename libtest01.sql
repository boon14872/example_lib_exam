-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2022 at 07:51 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libtest01`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `book_name` varchar(50) NOT NULL,
  `author` varchar(30) NOT NULL,
  `publisher` varchar(30) NOT NULL,
  `price` int(11) NOT NULL,
  `member_day` int(11) NOT NULL,
  `officer_day` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `status`, `book_name`, `author`, `publisher`, `price`, `member_day`, `officer_day`) VALUES
(101, 1, '101', '101', '011', 1000, 7, 120),
(12345, 0, '11', '11', '101010', 1000, 10, 50);

-- --------------------------------------------------------

--
-- Table structure for table `book_barrow`
--

CREATE TABLE `book_barrow` (
  `barrow_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `barrow_date` date NOT NULL,
  `member_id` int(11) NOT NULL,
  `officer_id_barrow` int(11) NOT NULL,
  `return_date` date DEFAULT NULL,
  `office_id_return` int(11) DEFAULT NULL,
  `exp_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_barrow`
--

INSERT INTO `book_barrow` (`barrow_id`, `book_id`, `barrow_date`, `member_id`, `officer_id_barrow`, `return_date`, `office_id_return`, `exp_date`) VALUES
(2, 101, '2022-02-24', 1234, 111, '2022-02-24', 111, '2022-03-03'),
(4, 101, '2022-02-25', 111, 111, NULL, NULL, '2022-06-25');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(11) NOT NULL,
  `password` varchar(99) NOT NULL,
  `name` varchar(50) NOT NULL,
  `member_group` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `tell` varchar(10) NOT NULL,
  `member_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `password`, `name`, `member_group`, `address`, `tell`, `member_type`) VALUES
('111', '$2y$10$ORYsNSuH9Qzqp2v44H4TAO/KfAFKip96iRHc0JQcsST', '111', 0, '111', '11111111', 0),
('1234', '$2y$10$SGAR4k8CLYG3Me1CHLuktuVyi1FyltdrPhctzccu06T', '1234', 12, '1234', '1234', 1),
('12345', '$2y$10$/uGU9CMVVk6DTKfwO.jUZuJd7034K7Dv05Pm2jRuXXxMuwRgeDrj6', '12345', 2, '12345', '0968855416', 1),
('191', '$2y$10$GNdvAxa1vO96b.zK5PO71ef9cwyvhi0ElEW4yFcaybg5RFz3jVtRW', '191', 1, '191', '191', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `book_barrow`
--
ALTER TABLE `book_barrow`
  ADD PRIMARY KEY (`barrow_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_barrow`
--
ALTER TABLE `book_barrow`
  MODIFY `barrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
