-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2016 at 09:35 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `traindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `res_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_price` int(11) NOT NULL,
  `num_pass` int(11) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(35) NOT NULL,
  `mobile` varchar(14) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`res_id`, `trip_id`, `time`, `total_price`, `num_pass`, `fname`, `lname`, `mobile`, `email`) VALUES
(24, 5, '2016-04-22 19:02:20', 150, 1, 'ahmad', 'alnasser', '0555383723', 'ahmad@hotmail.com'),
(25, 5, '2016-04-22 19:03:56', 150, 2, 'laila', 'alghamdi', '055378265', 'laila@hotmail.com'),
(27, 5, '2016-04-22 19:08:00', 150, 4, 'abdulaziz', 'almadi', '055375256', 'abdulaziz@hotmail.com'),
(28, 5, '2016-04-22 19:09:14', 150, 1, 'sumaia', 'alsaleh', '0555382987', 'sumaia@hotmail.com'),
(29, 1, '2016-04-22 19:15:41', 1050, 7, 'abdullah', 'almajed', '055386254', 'abdullah@hotmail.com'),
(30, 1, '2016-04-22 19:33:03', 150, 1, 'nada', 'alasmri', '055647382', 'nada@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `trip_id` int(11) NOT NULL,
  `from` varchar(15) NOT NULL,
  `to` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `price` int(11) NOT NULL,
  `available_seats` int(11) NOT NULL DEFAULT '20'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`trip_id`, `from`, `to`, `date`, `time`, `price`, `available_seats`) VALUES
(1, 'Riyadh', 'Dammam', '2016-04-30', '03:00:00', 150, 14),
(2, 'Dammam', 'Riyadh', '2016-05-01', '04:30:00', 150, 13),
(3, 'Riyadh', 'Jeddah', '2016-04-28', '17:00:00', 150, 0),
(4, 'Jeddah', 'Dammam', '2016-04-29', '09:00:00', 150, 20),
(5, 'Riyadh', 'Dammam', '2016-04-15', '08:00:00', 150, 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`res_id`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`trip_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
