-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 04:25 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `code` varchar(100) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `emp_head` int(11) NOT NULL,
  `emp_wrks` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `attachment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`code`, `project_name`, `emp_head`, `emp_wrks`, `start_date`, `end_date`, `attachment`) VALUES
('PRO 1895', 'Test', 4389, 3687, '2023-12-18', '2023-12-20', 'V0663_generated.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `Id` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `task_name` varchar(100) NOT NULL,
  `task_employee` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `requirements` varchar(100) NOT NULL,
  `attachment` varchar(100) NOT NULL,
  `task_status` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `dateCreated` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`Id`, `project_name`, `task_name`, `task_employee`, `start_date`, `requirements`, `attachment`, `task_status`, `active`, `dateCreated`) VALUES
(2, 'PRO 1895', 'Task 01', 4, '2023-12-19', 'Go to Bathroom', 'V0663_generated.jpg', 'Complete', 1, '2023-12-18');

-- --------------------------------------------------------

--
-- Table structure for table `teamhead`
--

CREATE TABLE `teamhead` (
  `Id` int(11) NOT NULL,
  `headCall_id` int(11) NOT NULL,
  `emp` int(11) NOT NULL,
  `project_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teamhead`
--

INSERT INTO `teamhead` (`Id`, `headCall_id`, `emp`, `project_id`) VALUES
(1, 8865, 3, 'PRO 1494'),
(2, 8865, 4, 'PRO 1494'),
(3, 1522, 3, 'PRO 1494'),
(4, 1522, 4, 'PRO 1494'),
(5, 3023, 3, 'PRO 1494'),
(6, 3023, 4, 'PRO 1494'),
(9, 4389, 4, 'PRO 1895'),
(10, 4389, 5, 'PRO 1895'),
(11, 4389, 6, 'PRO 1895');

-- --------------------------------------------------------

--
-- Table structure for table `teamwrks`
--

CREATE TABLE `teamwrks` (
  `Id` int(11) NOT NULL,
  `call_ID` int(11) NOT NULL,
  `empid` int(11) NOT NULL,
  `projectcode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teamwrks`
--

INSERT INTO `teamwrks` (`Id`, `call_ID`, `empid`, `projectcode`) VALUES
(1, 7708, 5, 'PRO 1494'),
(2, 7708, 6, 'PRO 1494'),
(3, 6660, 5, 'PRO 1494'),
(4, 6660, 6, 'PRO 1494'),
(5, 2862, 5, 'PRO 1494'),
(6, 2862, 6, 'PRO 1494'),
(9, 3687, 3, 'PRO 1895'),
(10, 3687, 4, 'PRO 1895'),
(11, 3687, 5, 'PRO 1895'),
(12, 3687, 6, 'PRO 1895');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_role` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `dateCreated` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `first_name`, `last_name`, `user_role`, `email`, `PhoneNumber`, `city`, `username`, `password`, `dateCreated`) VALUES
(1, 'Fathima', 'Hana', 'Admin', 'hana@gmail.com', '775062716', 'Kalmunai', 'ADM1625', 'PWD6476', '2023-12-13'),
(3, 'Mohamed', 'Inshath', 'Employee', 'inshath97.mi@gmail.com', '775062716', 'Sainthamaruthu', 'EMP5441', 'PWD8935', '2023-12-17'),
(4, 'Mohamed', 'Zifan', 'Employee', 'ins@gmail.com', '776533256', 'Kalmunai', 'EMP8493', 'PWD8175', '2023-12-17'),
(5, 'Mohamed', 'Afsir', 'Employee', 'test@gmail.com', '770552243', 'Sainthamaruthu', 'EMP2554', 'PWD5347', '2023-12-17'),
(6, 'Mohamed', 'Sarafath', 'Employee', 'abcd@gmail.com', '778896523', 'Kalmunai', 'EMP9414', 'PWD8029', '2023-12-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `teamhead`
--
ALTER TABLE `teamhead`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `teamwrks`
--
ALTER TABLE `teamwrks`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teamhead`
--
ALTER TABLE `teamhead`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `teamwrks`
--
ALTER TABLE `teamwrks`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
