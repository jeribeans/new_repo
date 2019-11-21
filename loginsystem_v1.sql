-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2019 at 05:09 PM
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
  `user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timecheck`
--

INSERT INTO `timecheck` (`check_ID`, `login_date`, `login_time`, `logout_date`, `logout_time`, `status`, `user_ID`) VALUES
(1, '2019-11-04', '15:16:52', '2019-11-04', '15:16:55', 'Logged out', 1),
(2, '2019-11-04', '15:18:02', '2019-11-04', '15:23:59', 'Logged out', 1),
(3, '2019-11-04', '15:18:16', '2019-11-04', '15:18:29', 'Logged out', 2),
(4, '2019-11-04', '15:24:00', '2019-11-04', '15:24:04', 'Logged out', 1),
(5, '2019-11-04', '15:26:10', '2019-11-04', '15:26:12', 'Logged out', 1),
(6, '2019-11-04', '15:31:54', '2019-11-04', '15:32:44', 'Logged out', 1),
(7, '2019-11-04', '15:33:20', '2019-11-04', '15:37:42', 'Logged out', 1),
(8, '2019-11-04', '15:46:37', '2019-11-04', '15:46:40', 'Logged out', 1),
(9, '2019-11-04', '15:46:52', '2019-11-04', '15:47:07', 'Logged out', 1),
(10, '2019-11-04', '15:47:26', '2019-11-04', '15:48:54', 'Logged out', 1),
(11, '2019-11-04', '15:47:32', '2019-11-04', '15:50:12', 'Logged out', 2),
(12, '2019-11-04', '15:50:45', '2019-11-04', '15:50:46', 'Logged out', 2),
(13, '2019-11-04', '15:59:08', '2019-11-04', '16:02:55', 'Logged out', 1),
(14, '2019-11-04', '15:59:15', '2019-11-04', '16:03:13', 'Logged out', 2),
(15, '2019-11-04', '15:59:26', '2019-11-04', '16:03:43', 'Logged out', 3),
(16, '2019-11-04', '15:59:39', '2019-11-04', '16:05:00', 'Logged out', 4),
(17, '2019-11-04', '15:59:50', '2019-11-04', '16:05:13', 'Logged out', 5),
(18, '2019-11-04', '16:00:00', '2019-11-04', '16:05:54', 'Logged out', 6),
(19, '2019-11-04', '16:06:07', '2019-11-04', '16:06:19', 'Logged out', 6),
(20, '2019-11-04', '16:06:58', '2019-11-04', '16:09:29', 'Logged out', 6),
(21, '2019-11-04', '16:09:40', '2019-11-04', '16:09:53', 'Logged out', 1),
(22, '2019-11-04', '16:09:47', '2019-11-04', '16:21:16', 'Logged out', 6),
(23, '2019-11-04', '16:21:00', '2019-11-04', '16:21:22', 'Logged out', 1),
(24, '2019-11-04', '16:21:27', '2019-11-04', '16:21:40', 'Logged out', 1),
(25, '2019-11-04', '16:21:35', '2019-11-04', '16:27:17', 'Logged out', 6),
(26, '2019-11-04', '16:21:56', '2019-11-04', '16:26:18', 'Logged out', 1),
(27, '2019-11-04', '16:22:02', '2019-11-04', '16:33:29', 'Logged out', 2),
(28, '2019-11-04', '16:22:10', '2019-11-04', '16:33:36', 'Logged out', 3),
(29, '2019-11-04', '16:22:20', '2019-11-04', '16:33:44', 'Logged out', 4),
(30, '2019-11-04', '16:22:26', '2019-11-04', '16:34:12', 'Logged out', 5),
(31, '2019-11-04', '16:30:34', '2019-11-04', '16:30:59', 'Logged out', 1),
(32, '2019-11-04', '16:36:19', '2019-11-04', '16:36:56', 'Logged out', 1),
(33, '2019-11-04', '16:36:38', '2019-11-04', '16:36:46', 'Logged out', 2),
(34, '2019-11-04', '16:38:00', '2019-11-04', '16:38:28', 'Logged out', 1),
(35, '2019-11-04', '16:38:17', '2019-11-04', '16:38:45', 'Logged out', 2),
(36, '2019-11-04', '16:55:45', '2019-11-04', '16:55:50', 'Logged out', 1);

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
  `department` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `employee_id`, `password`, `first_name`, `middle_name`, `last_name`, `department`) VALUES
(1, 999, '123', 'Juan', 'A. ', 'Dela Cruz', 'admin'),
(2, 998, '321', 'Nadya', 'M.', 'Santos', 'NOC'),
(3, 997, 'password', 'Bruce', 'W.', 'Graham', 'admin'),
(4, 996, 'password1', 'Stella', 'R.', 'Holt', 'NOC'),
(5, 995, 'password2', 'Brian', 'D.', 'Peña', 'NOC'),
(6, 994, 'password3', 'Shane', 'A.', 'Caceres', 'admin');

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
  MODIFY `check_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
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
