-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2019 at 10:45 AM
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
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `leave_type` varchar(15) NOT NULL,
  `request_Date` date NOT NULL,
  `start_Date` date NOT NULL,
  `end_Date` date NOT NULL,
  `reason` varchar(200) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_ID`, `user_ID`, `leave_type`, `request_Date`, `start_Date`, `end_Date`, `reason`, `status`) VALUES
(1, 1, 'SL', '2019-11-12', '2019-11-15', '2019-11-15', 'medical check-up', 'approved'),
(2, 2, 'SL', '2019-11-12', '2019-11-15', '2019-11-15', 'medical check-up. Please disregard the other text. Test 123sdaf jasdjsdfjh jAHSDJH USDF  JASHDJHASJD ajshdjashdjasd jashdjhajshdj j jashjdhasjd', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_ID` int(11) NOT NULL,
  `start_Date` date NOT NULL,
  `end_Date` date NOT NULL,
  `user_ID` int(11) NOT NULL,
  `shift_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_ID`, `start_Date`, `end_Date`, `user_ID`, `shift_ID`) VALUES
(1, '2019-11-01', '2019-11-30', 1, 1),
(2, '2019-11-01', '2019-11-30', 2, 2),
(3, '2019-11-01', '2019-11-30', 3, 3),
(4, '2019-11-01', '2019-11-30', 4, 1),
(5, '2019-11-01', '2019-11-30', 5, 1),
(6, '2019-11-01', '2019-11-30', 6, 2),
(7, '2019-11-01', '2019-11-30', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `shift_ID` int(11) NOT NULL,
  `shift` varchar(15) NOT NULL,
  `login_time` time NOT NULL,
  `logout_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`shift_ID`, `shift`, `login_time`, `logout_time`) VALUES
(1, 'Morning Shift', '06:00:00', '15:00:00'),
(2, 'Mid-day Shift', '12:00:00', '21:00:00'),
(3, 'GY Shift', '21:00:00', '06:00:00');

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
  `email` varchar(50) NOT NULL,
  `contact_num` varchar(15) NOT NULL,
  `department` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `employee_id`, `password`, `first_name`, `middle_name`, `last_name`, `email`, `contact_num`, `department`) VALUES
(1, 999, '202cb962ac59075b964b07152d234b70', 'Juan', 'A', 'Dela Cruz', 'juan_delacruz@gmail.com', '09123456781', 'Admin'),
(2, 998, 'caf1a3dfb505ffed0d024130f58c5cfa', 'Nadya', 'M', 'Santos', 'nadya_santos@gmail.com', '09123456782', 'Admin'),
(3, 997, '5f4dcc3b5aa765d61d8327deb882cf99', 'Bruce', 'W', 'Graham', 'bruce_graham@gmail.com', '09123456783', 'Admin'),
(4, 996, '7c6a180b36896a0a8c02787eeafb0e4c', 'Stella', 'R', 'Holt', 'stella_holt@gmail.com', '09123456784', 'NOC'),
(5, 995, '6cb75f652a9b52798eb6cf2201057c73', 'Brian', 'D', 'Flores', 'brian_flores@gmail.com', '09123456785', 'NOC'),
(6, 994, '819b0643d6b89dc9b579fdfc9094f28e', 'Shane', 'A', 'Caceres', 'shane_caceres@gmail.com', '09123456786', 'NOC'),
(9, 114, 'c4ca4238a0b923820dcc509a6f75849b', 'Jherico Alexis', 'D', 'Bengco', 'mail@email.com', '09167995982', 'CS'),
(10, 113, 'c81e728d9d4c2f636f067f89cc14862c', 'Justin', 'V', 'Cadavillo', 'mail@email.com', '09127654321', 'NOC'),
(11, 115, 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 'Lianne', 'K', 'Lu', 'mail@email.com', '09124567654', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_ID`),
  ADD KEY `user_ID` (`user_ID`,`shift_ID`),
  ADD KEY `shift_ID` (`shift_ID`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`shift_ID`);

--
-- Indexes for table `timecheck`
--
ALTER TABLE `timecheck`
  ADD PRIMARY KEY (`check_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `user_ID_2` (`user_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `shift_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `timecheck`
--
ALTER TABLE `timecheck`
  MODIFY `check_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
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
-- Constraints for table `timecheck`
--
ALTER TABLE `timecheck`
  ADD CONSTRAINT `timecheck_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `schedule` (`user_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
