-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2017 at 10:10 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webr_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus_details`
--

CREATE TABLE `bus_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `bus_no` int(11) NOT NULL,
  `date_departure` date NOT NULL,
  `time_departure` varchar(50) NOT NULL,
  `route` varchar(100) NOT NULL,
  `class` varchar(20) NOT NULL COMMENT 'Air Condition/Economy',
  `full_load` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus_details`
--

INSERT INTO `bus_details` (`id`, `bus_no`, `date_departure`, `time_departure`, `route`, `class`, `full_load`) VALUES
(1, 55001, '2017-10-23', '10:00 AM - 2:00 PM', 'Sagay-Cebu Via Tabuelan', 'Air Conditioned', 'no'),
(2, 555, '2017-10-23', '6:30 AM - 10:30 AM', 'Sagay-Cebu Via Tolido', 'Air Conditioned', 'no'),
(3, 5776, '2017-10-23', '8:00 AM - 8:00 PM', 'Sagay-Zamboanga', 'Air Conditioned', 'no'),
(4, 5775, '2017-10-22', '8:00 AM - 8:00 PM', 'Sagay-Zamboanga', 'Air Conditioned', 'no'),
(5, 537, '2017-10-22', '8:00 PM - 12:00 AM', 'Sagay-Cebu Via Tabuelan', 'Air Conditioned', 'no'),
(6, 535, '2017-10-22', '12:00 PM - 4:00 PM', 'Sagay-Cebu Via Tolido', 'Air Conditioned', 'no'),
(7, 517, '2017-10-22', '6:30 AM - 10:30 AM', 'Sagay-Cebu Via Tolido', 'Air Conditioned', 'no'),
(8, 532, '2017-10-22', '10:00 AM - 2:00 PM', 'Sagay-Cebu Via Tabuelan', 'Air Conditioned', 'no'),
(9, 5775, '2017-10-24', '8:00 AM - 8:00 PM', 'Sagay-Zamboanga', 'Air Conditioned', 'no'),
(10, 5776, '2017-10-25', '8:00 AM - 8:00 PM', 'Sagay-Zamboanga', 'Air Conditioned', 'no'),
(11, 5775, '2017-10-25', '8:00 AM - 8:00 PM', 'Sagay-Zamboanga', 'Air Conditioned', 'no'),
(12, 535, '2017-10-31', '6:30 AM - 10:30 AM', 'Sagay-Cebu Via Tabuelan', 'Air Conditioned', 'no'),
(15, 5775, '2017-12-06', '8:00 AM - 8:00 PM', 'Sagay-Zamboanga', 'Economy', 'no'),
(16, 5775, '2017-10-01', '8:00 AM - 8:00 PM', 'Sagay-Zamboanga', 'Air Conditioned', 'no'),
(17, 5776, '2017-10-02', '8:00 AM - 8:00 PM', 'Sagay-Zamboanga', 'Air Conditioned', 'no'),
(18, 5775, '2017-10-03', '8:00 AM - 8:00 PM', 'Sagay-Zamboanga', 'Air Conditioned', 'no'),
(19, 5776, '2017-10-04', '8:00 AM - 8:00 PM', 'Sagay-Zamboanga', 'Air Conditioned', 'no'),
(20, 517, '2017-10-01', '6:30 AM - 10:30 AM', 'Sagay-Cebu Via Tabuelan', 'Economy', 'no'),
(21, 532, '2017-10-01', '10:00 AM - 2:00 PM', 'Sagay-Cebu Via Tolido', 'Air Conditioned', 'no'),
(22, 535, '2017-10-01', '12:00 PM - 4:00 PM', 'Sagay-Cebu Via Tabuelan', 'Air Conditioned', 'no'),
(23, 537, '2017-10-01', '8:00 PM - 12:00 AM', 'Sagay-Cebu Via Tolido', 'Air Conditioned', 'no'),
(24, 555, '2017-10-02', '6:30 AM - 10:30 AM', 'Sagay-Cebu Via Tabuelan', 'Air Conditioned', 'no'),
(25, 532, '2017-10-02', '10:00 AM - 2:00 PM', 'Sagay-Cebu Via Tolido', 'Air Conditioned', 'no'),
(26, 517, '2017-10-02', '12:00 PM - 4:00 PM', 'Sagay-Cebu Via Tabuelan', 'Air Conditioned', 'no'),
(28, 5775, '2018-06-12', '8:00 AM - 8:00 PM', 'Sagay-Zamboanga', 'Economy', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `bd_id` int(11) NOT NULL,
  `date_departure` date NOT NULL,
  `time_departure` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `seat_no` int(11) NOT NULL,
  `bus_no` int(11) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `ref_no` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL COMMENT 'confimed/pending'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `username`, `bd_id`, `date_departure`, `time_departure`, `route`, `seat_no`, `bus_no`, `payment`, `ref_no`, `status`) VALUES
(142, 'admin', 20, '2017-10-01', '6:30 AM - 10:30 AM', 'Sagay-Cebu Via Tabuelan', 41, 517, 'Paypal', 'WEBR15108055727241', 'pending'),
(134, 'guest', 20, '2017-10-01', '6:30 AM - 10:30 AM', 'Sagay-Cebu Via Tabuelan', 26, 517, 'Ceres Terminal', 'WEBR15107366155790', 'pending'),
(135, 'guest', 20, '2017-10-01', '6:30 AM - 10:30 AM', 'Sagay-Cebu Via Tabuelan', 27, 517, 'Ceres Terminal', 'WEBR15107366158476', 'pending'),
(131, 'user', 20, '2017-10-01', '6:30 AM - 10:30 AM', 'Sagay-Cebu Via Tabuelan', 13, 517, 'Ceres Terminal', 'WEBR15107116398811', 'confirmed'),
(129, 'user', 20, '2017-10-01', '6:30 AM - 10:30 AM', 'Sagay-Cebu Via Tabuelan', 11, 517, 'Ceres Terminal', 'WEBR15107116394495', 'confirmed'),
(130, 'user', 20, '2017-10-01', '6:30 AM - 10:30 AM', 'Sagay-Cebu Via Tabuelan', 12, 517, 'Ceres Terminal', 'WEBR15107116394370', 'confirmed'),
(104, 'guest', 20, '2017-10-01', '6:30 AM - 10:30 AM', 'Sagay-Cebu Via Tabuelan', 15, 517, 'Paypal', 'WEBR15106294613264', 'confirmed'),
(85, 'guest', 18, '2017-10-03', '8:00 AM - 8:00 PM', 'Sagay-Zamboanga', 1, 5775, 'Ceres Terminal', 'WEBR15080506486599', 'confirmed'),
(143, 'admin', 20, '2017-10-01', '6:30 AM - 10:30 AM', 'Sagay-Cebu Via Tabuelan', 42, 517, 'Paypal', 'WEBR15108055726719', 'pending'),
(136, 'guest', 20, '2017-10-01', '6:30 AM - 10:30 AM', 'Sagay-Cebu Via Tabuelan', 28, 517, 'Ceres Terminal', 'WEBR15107366152476', 'pending'),
(132, 'guest', 20, '2017-10-01', '6:30 AM - 10:30 AM', 'Sagay-Cebu Via Tabuelan', 4, 517, 'Ceres Terminal', 'WEBR15107117468228', 'confirmed'),
(107, 'user', 20, '2017-10-01', '6:30 AM - 10:30 AM', 'Sagay-Cebu Via Tabuelan', 3, 517, 'Ceres Terminal', 'WEBR15107090417018', 'confirmed'),
(106, 'user', 20, '2017-10-01', '6:30 AM - 10:30 AM', 'Sagay-Cebu Via Tabuelan', 2, 517, 'Ceres Terminal', 'WEBR15107090418473', 'confirmed'),
(105, 'user', 20, '2017-10-01', '6:30 AM - 10:30 AM', 'Sagay-Cebu Via Tabuelan', 6, 517, 'Ceres Terminal', 'WEBR1510709041636', 'confirmed'),
(100, 'user', 16, '2017-10-01', '8:00 AM - 8:00 PM', 'Sagay-Zamboanga', 25, 5775, 'Ceres Terminal', 'WEBR15100382535334', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL COMMENT 'guest/admin/superuser',
  `status` varchar(20) NOT NULL COMMENT 'verified/not-verified',
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `prk` varchar(100) NOT NULL,
  `brgy` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `status`, `fname`, `lname`, `prk`, `brgy`, `city`, `province`) VALUES
(1, 'superuser', '$2y$10$h18A5luW6bS8qQwWKX7v9uDpSNYq39F1vEOldRaFnnS6upnocB0x6', 'superuser@gmail.com', 'superuser', 'verified', 'David', 'Connoly', 'Santan 1', 'Old Sagay', 'Sagay City', 'Negros Occidental'),
(2, 'admin', '$2y$10$Eev6OoJP/j0BzMwKQobrVuF5BTpAjeDxPh.YtcQjxefvKocIL8mue', 'noyruto88@gmail.com', 'admin', 'verified', '', '', '', '', '', ''),
(3, 'guest', '$2y$10$KCJH6G9hPvK6xlaZF5Hhwu1iCQvGkTH8DW/CvzO6wWuWphlIGBAQG', 'guest@gmail.com', 'guest', 'verified', 'Pedro', 'Pendoko', 'Santan 1', 'Old Sagay', 'Sagay City', 'Negros Occidental'),
(4, 'user2', '$2y$10$NZLTfYs3fldq/0.F091oM.Ek0yR3SToABqJZFLEa9LP3W2Ynb8sKO', 'noyruto45@gmail.com', 'guest', 'verified', 'Michael', 'Edano', 'Santan1', 'Old Sagay', 'Sagay', 'Negros Occidental'),
(5, 'user', '$2y$10$ooqFogfygjs1SOhtfQ7dQ.sjmh0Mw99BJBRYkmCV3kNobmCG5WBiC', 'asdf@gmail.com', 'guest', 'verified', 'Naruto', 'Uzumaki', 'Roxas', 'Poblacion 2', 'Sagay City', 'Negros Occidental');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus_details`
--
ALTER TABLE `bus_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus_details`
--
ALTER TABLE `bus_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
