-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2019 at 11:47 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `timecheck`
--

CREATE TABLE `timecheck` (
  `check_ID` int(11) NOT NULL,
  `login_date` date DEFAULT NULL,
  `login_time` time DEFAULT NULL,
  `logout_date` date DEFAULT NULL,
  `logout_time` time DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  `sched_status` varchar(10) NOT NULL,
  `user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timecheck`
--

INSERT INTO `timecheck` (`check_ID`, `login_date`, `login_time`, `logout_date`, `logout_time`, `status`, `sched_status`, `user_ID`) VALUES
(1, '2019-11-05', '10:44:18', '2019-11-05', '10:44:42', 'Logged out', 'Late', 1),
(2, '2019-11-05', '10:45:56', '2019-11-05', '10:46:29', 'Logged out', 'On-time', 1),
(3, '2019-11-05', '10:46:57', '2019-11-05', '11:14:23', 'Logged out', 'Late', 1),
(4, '2019-11-05', '11:13:55', '2019-11-05', '11:34:38', 'Logged out', 'On-time', 2),
(5, '2019-11-05', '11:34:47', '2019-11-05', '21:00:00', 'Logged out', 'Overtime', 1),
(6, '2019-11-05', '11:58:36', '2019-11-05', '12:00:23', 'Logged out', 'On-time', 3),
(7, '2019-11-05', '21:05:47', '2019-11-05', '14:56:23', 'Logged out', 'Undertime', 5),
(8, '2019-11-05', '12:00:40', '2019-11-05', '12:01:47', 'Logged out', 'On-time', 3),
(9, '2019-11-04', '21:00:00', '2019-11-05', '16:05:23', 'Logged out', 'Undertime', 4),
(10, '2019-11-05', '12:01:54', '2019-11-05', '16:05:53', 'Logged out', 'Undertime', 3),
(11, '2019-11-05', '06:37:24', '2019-11-05', '13:02:56', 'Logged out', 'Late', 6),
(12, '2019-11-05', '13:03:17', '2019-11-05', '13:03:26', 'Logged out', 'Late', 6),
(13, '2019-11-05', '13:04:01', '2019-11-05', '13:13:54', 'Logged out', 'Undertime', 6),
(14, '2019-11-05', '02:14:28', '2019-11-05', '13:17:58', 'Logged out', 'Overtime', 6),
(17, '2019-11-05', '15:25:08', '2019-11-05', '16:02:08', 'Logged out', 'Undertime', 5),
(18, '2019-11-05', '16:25:24', '2019-11-05', '16:25:38', 'Logged out', 'Undertime', 5),
(19, '2019-11-04', '21:00:00', '2019-11-05', '05:00:00', 'Logged out', 'Overtime', 5),
(20, '2019-11-07', '11:07:46', '2019-11-07', '11:07:51', 'Logged out', 'Undertime', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int(11) NOT NULL,
  `employee_id` int(3) NOT NULL,
  `password` varchar(12) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `middle_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `department` varchar(15) NOT NULL,
  `shift` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `employee_id`, `password`, `first_name`, `middle_name`, `last_name`, `department`, `shift`) VALUES
(1, 999, '123', 'Juan', 'A. ', 'Dela Cruz', 'Admin', 'Morning'),
(2, 998, '321', 'Nadya', 'M.', 'Santos', 'NOC', 'Mid'),
(3, 997, 'password', 'Bruce', 'W.', 'Graham', 'Admin', 'Morning'),
(4, 996, 'password1', 'Stella', 'R.', 'Holt', 'NOC', 'GY'),
(5, 995, 'password2', 'Brian', 'D.', 'Peña', 'NOC', 'GY'),
(6, 994, 'password3', 'Shane', 'A.', 'Caceres', 'Admin', 'Morning');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `timecheck`
--
ALTER TABLE `timecheck`
  ADD PRIMARY KEY (`check_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `timecheck`
--
ALTER TABLE `timecheck`
  MODIFY `check_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `timecheck`
--
ALTER TABLE `timecheck`
  ADD CONSTRAINT `timecheck_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
