-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2019 at 06:05 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int(11) NOT NULL,
  `employee_id` int(3) NOT NULL,
  `password` varchar(75) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `middle_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(25) NOT NULL,
  `contact_num` varchar(15) NOT NULL,
  `department` varchar(15) NOT NULL,
  `shift` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `employee_id`, `password`, `first_name`, `middle_name`, `last_name`, `email`, `contact_num`, `department`, `shift`) VALUES
(1, 999, '202cb962ac59075b964b07152d234b70', 'Juan', 'A', 'Dela Cruz', 'juan_delacruz@gmail.com', '09123456781', 'Admin', 'Morning'),
(2, 998, 'caf1a3dfb505ffed0d024130f58c5cfa', 'Nadya', 'M', 'Santos', 'nadya_santos@gmail.com', '09123456782', 'NOC', 'Mid'),
(3, 997, '5f4dcc3b5aa765d61d8327deb882cf99', 'Bruce', 'W', 'Graham', 'bruce_graham@gmail.com', '09123456783', 'Admin', 'Morning'),
(4, 996, '7c6a180b36896a0a8c02787eeafb0e4c', 'Stella', 'R', 'Holt', 'stella_holt@gmail.com', '09123456784', 'NOC', 'GY'),
(5, 995, '6cb75f652a9b52798eb6cf2201057c73', 'Brian', 'D', 'Flores', 'brian_flores@gmail.com', '09123456785', 'NOC', 'GY'),
(6, 994, '819b0643d6b89dc9b579fdfc9094f28e', 'Shane', 'A', 'Caceres', 'shane_caceres@gmail.com', '09123456786', 'Admin', 'Morning');

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
  MODIFY `check_ID` int(11) NOT NULL AUTO_INCREMENT;
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
