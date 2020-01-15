-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 15, 2020 at 09:55 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
CREATE TABLE IF NOT EXISTS `request` (
  `request_ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_ID` int(11) NOT NULL,
  `leave_type` varchar(25) NOT NULL,
  `request_Date` date NOT NULL,
  `start_Date` date NOT NULL,
  `end_Date` date NOT NULL,
  `reason` varchar(200) NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`request_ID`),
  KEY `user_ID` (`user_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_ID`, `user_ID`, `leave_type`, `request_Date`, `start_Date`, `end_Date`, `reason`, `status`) VALUES
(1, 9, 'Vacation Leave', '2019-12-04', '2019-12-24', '2020-01-03', 'LOOOOOOOOL fdsgffgfyufnbvng gftft gf nbvffgh yuufghgh', 'DECLINED'),
(2, 9, 'Vacation Leave', '2019-12-02', '2019-12-06', '2019-12-06', 'Test 1', 'PENDING'),
(3, 9, 'Vacation Leave', '2019-12-06', '2019-12-07', '2019-12-07', 'Test 2', 'PENDING'),
(4, 10, 'Vacation Leave', '2020-01-06', '2020-01-01', '2020-01-01', 'Out of town', 'APPROVED'),
(5, 11, 'Vacation Leave', '2020-01-06', '2020-01-01', '2020-01-01', 'lololololololololol', 'PENDING'),
(6, 5, 'Sick Leave', '2020-01-06', '2020-01-08', '2020-01-08', 'test if it will show to specific department and super admin only', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `schedule_ID` int(11) NOT NULL AUTO_INCREMENT,
  `sched_Date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `user_ID` int(11) NOT NULL,
  `shift_ID` int(11) NOT NULL,
  `department` varchar(15) NOT NULL,
  PRIMARY KEY (`schedule_ID`),
  KEY `user_ID` (`user_ID`,`shift_ID`),
  KEY `shift_ID` (`shift_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_ID`, `sched_Date`, `created_at`, `user_ID`, `shift_ID`, `department`) VALUES
(1, '2020-01-01', '2020-01-15 14:32:42', 4, 2, 'NOC'),
(2, '2020-01-02', '2020-01-15 14:32:42', 4, 2, 'NOC'),
(3, '2020-01-03', '2020-01-15 14:32:42', 4, 2, 'NOC'),
(4, '2020-01-04', '2020-01-15 14:32:42', 4, 2, 'NOC'),
(5, '2020-01-05', '2020-01-15 14:32:42', 4, 2, 'NOC'),
(6, '2020-01-01', '2020-01-15 14:33:33', 5, 1, 'NOC'),
(7, '2020-01-02', '2020-01-15 14:33:33', 5, 1, 'NOC'),
(8, '2020-01-03', '2020-01-15 14:33:33', 5, 1, 'NOC'),
(9, '2020-01-04', '2020-01-15 14:33:33', 5, 1, 'NOC'),
(10, '2020-01-05', '2020-01-15 14:33:33', 5, 1, 'NOC'),
(11, '2020-01-01', '2020-01-15 16:05:39', 10, 4, 'NOC'),
(12, '2020-01-02', '2020-01-15 16:05:39', 10, 4, 'NOC'),
(13, '2020-01-03', '2020-01-15 16:05:39', 10, 4, 'NOC'),
(14, '2020-01-04', '2020-01-15 16:05:39', 10, 4, 'NOC'),
(15, '2020-01-05', '2020-01-15 16:05:39', 10, 4, 'NOC'),
(16, '2020-01-01', '2020-01-15 17:01:51', 6, 1, 'FS'),
(17, '2020-01-02', '2020-01-15 17:01:51', 6, 1, 'FS'),
(18, '2020-01-03', '2020-01-15 17:01:51', 6, 1, 'FS'),
(19, '2020-01-04', '2020-01-15 17:01:51', 6, 1, 'FS'),
(20, '2020-01-05', '2020-01-15 17:01:51', 6, 1, 'FS'),
(21, '2020-01-01', '2020-01-15 17:02:12', 11, 2, 'FS'),
(22, '2020-01-02', '2020-01-15 17:02:12', 11, 2, 'FS'),
(23, '2020-01-03', '2020-01-15 17:02:12', 11, 2, 'FS'),
(24, '2020-01-04', '2020-01-15 17:02:12', 11, 2, 'FS'),
(25, '2020-01-05', '2020-01-15 17:02:12', 11, 2, 'FS'),
(26, '2020-01-01', '2020-01-15 17:02:22', 12, 3, 'FS'),
(27, '2020-01-02', '2020-01-15 17:02:22', 12, 3, 'FS'),
(28, '2020-01-03', '2020-01-15 17:02:22', 12, 3, 'FS'),
(29, '2020-01-04', '2020-01-15 17:02:22', 12, 3, 'FS'),
(30, '2020-01-05', '2020-01-15 17:02:22', 12, 3, 'FS');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

DROP TABLE IF EXISTS `shift`;
CREATE TABLE IF NOT EXISTS `shift` (
  `shift_ID` int(11) NOT NULL AUTO_INCREMENT,
  `shift` varchar(15) NOT NULL,
  `shift_time_in` time NOT NULL,
  `shift_time_out` time NOT NULL,
  PRIMARY KEY (`shift_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`shift_ID`, `shift`, `shift_time_in`, `shift_time_out`) VALUES
(1, 'Morning Shift', '06:00:00', '15:00:00'),
(2, 'Mid-day Shift', '12:00:00', '21:00:00'),
(3, 'GY Shift', '21:00:00', '06:00:00'),
(4, 'Regular Shift', '08:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `swaprequest`
--

DROP TABLE IF EXISTS `swaprequest`;
CREATE TABLE IF NOT EXISTS `swaprequest` (
  `swap_request_ID` int(11) NOT NULL AUTO_INCREMENT,
  `requester_sched_ID` int(11) NOT NULL,
  `requested_sched_ID` int(11) NOT NULL,
  `requester_user_ID` int(11) NOT NULL,
  `date_requested` date NOT NULL,
  `approval_date` date DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`swap_request_ID`),
  KEY `requested_sched_ID` (`requested_sched_ID`),
  KEY `requester_sched_ID` (`requester_sched_ID`),
  KEY `requester_user_ID` (`requester_user_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `swaprequest`
--

INSERT INTO `swaprequest` (`swap_request_ID`, `requester_sched_ID`, `requested_sched_ID`, `requester_user_ID`, `date_requested`, `approval_date`, `status`) VALUES
(1, 11, 26, 4, '2020-01-10', '2020-01-10', 'APPROVED'),
(2, 10, 25, 4, '2020-01-10', '2020-01-10', 'DECLINED'),
(3, 10, 25, 4, '2020-01-10', '2020-01-10', 'DECLINED'),
(4, 10, 25, 4, '2020-01-10', NULL, 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `timecheck`
--

DROP TABLE IF EXISTS `timecheck`;
CREATE TABLE IF NOT EXISTS `timecheck` (
  `check_ID` int(11) NOT NULL AUTO_INCREMENT,
  `login_date` date DEFAULT NULL,
  `login_time` time DEFAULT NULL,
  `logout_date` date DEFAULT NULL,
  `logout_time` time DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `sched_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`check_ID`),
  KEY `user_ID` (`user_ID`),
  KEY `user_ID_2` (`user_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timecheck`
--

INSERT INTO `timecheck` (`check_ID`, `login_date`, `login_time`, `logout_date`, `logout_time`, `status`, `user_ID`, `sched_status`) VALUES
(1, '2019-11-01', '08:00:00', '2019-11-01', '17:00:00', 'Looged out', 1, 'On-time'),
(2, '2019-11-02', '08:00:00', '2019-11-02', '17:00:00', 'Looged out', 1, 'On-time'),
(3, '2019-11-03', '08:00:00', '2019-11-03', '17:00:00', 'Looged out', 1, 'On-time'),
(4, '2019-11-04', '08:00:00', '2019-11-04', '17:00:00', 'Looged out', 1, 'On-time'),
(5, '2019-11-05', '08:00:00', '2019-11-05', '17:00:00', 'Looged out', 1, 'On-time'),
(6, '2019-01-01', '08:00:00', '2019-01-01', '17:00:00', 'Looged out', 9, 'On-time'),
(7, '2019-12-01', '08:01:00', '2019-12-01', '17:00:00', 'Looged out', 9, 'Late'),
(8, '2019-12-02', '08:00:00', '2019-12-02', '17:00:00', 'Looged out', 9, 'On-time'),
(9, '2019-12-03', '08:00:00', '2019-12-03', '17:00:00', 'Looged out', 9, 'On-time'),
(10, '2019-12-04', '08:00:00', '2019-12-04', '17:00:00', 'Looged out', 9, 'On-time'),
(11, '2019-12-05', '08:00:00', '2019-12-05', '17:00:00', 'Looged out', 9, 'On-time'),
(12, '2019-12-16', '15:20:47', '2019-12-16', '15:31:56', 'Logged out', 1, NULL),
(13, '2019-12-16', '15:21:06', '2019-12-16', '15:21:31', 'Logged out', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_ID` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(3) NOT NULL,
  `password` varchar(75) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `middle_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_num` varchar(15) NOT NULL,
  `department` varchar(15) NOT NULL,
  PRIMARY KEY (`user_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `employee_id`, `password`, `first_name`, `middle_name`, `last_name`, `email`, `contact_num`, `department`) VALUES
(1, 999, '202cb962ac59075b964b07152d234b70', 'Juan', 'A', 'Dela Cruz', 'juan_delacruz@gmail.com', '09123456781', 'SuperAdmin'),
(2, 998, '202cb962ac59075b964b07152d234b70', 'Nadya', 'M', 'Dela Cruz', 'nadya_delacruz@gmail.com', '09123456782', 'AdminNOC'),
(3, 997, '202cb962ac59075b964b07152d234b70', 'Bruce', 'W', 'Graham', 'bruce_graham@gmail.com', '09123456783', 'AdminCS'),
(4, 996, '202cb962ac59075b964b07152d234b70', 'Stella', 'R', 'Holt', 'stella_holt@gmail.com', '09123456784', 'NOC'),
(5, 995, '202cb962ac59075b964b07152d234b70', 'Brian', 'D', 'Flores', 'brian_flores@gmail.com', '09123456785', 'NOC'),
(6, 994, '202cb962ac59075b964b07152d234b70', 'Shane', 'A', 'Caceres', 'shane_caceres@gmail.com', '09123456786', 'FS'),
(9, 114, '202cb962ac59075b964b07152d234b70', 'Jherico Alexis', 'D', 'Bengco', 'mail@email.com', '09167995982', 'AdminFS'),
(10, 113, '202cb962ac59075b964b07152d234b70', 'Justin', 'V', 'Cadavillo', 'mail@email.com', '09127654321', 'NOC'),
(11, 115, '202cb962ac59075b964b07152d234b70', 'Lianne', 'K', 'Lu', 'mail@email.com', '09124567654', 'FS'),
(12, 116, '202cb962ac59075b964b07152d234b70', 'Em', 'M', 'Santiago', 'check@mail.com', '09123456789', 'FS');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`shift_ID`) REFERENCES `shift` (`shift_ID`);

--
-- Constraints for table `swaprequest`
--
ALTER TABLE `swaprequest`
  ADD CONSTRAINT `swaprequest_ibfk_1` FOREIGN KEY (`requested_sched_ID`) REFERENCES `schedule` (`schedule_ID`),
  ADD CONSTRAINT `swaprequest_ibfk_2` FOREIGN KEY (`requester_sched_ID`) REFERENCES `schedule` (`schedule_ID`),
  ADD CONSTRAINT `swaprequest_ibfk_3` FOREIGN KEY (`requester_user_ID`) REFERENCES `user` (`user_ID`);

--
-- Constraints for table `timecheck`
--
ALTER TABLE `timecheck`
  ADD CONSTRAINT `timecheck_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `schedule` (`user_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
