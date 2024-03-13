-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 12, 2024 at 09:17 PM
-- Server version: 8.0.35-cll-lve
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demoblri_ruas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `number` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `profile` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` tinyint(1) DEFAULT '1',
  `reset_token` text COLLATE utf8mb4_general_ci NOT NULL,
  `user_status` int DEFAULT '1',
  `team` int DEFAULT NULL,
  `roll_no` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `branch` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dob` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `student_id` varchar(55) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `number`, `role`, `profile`, `createdOn`, `isActive`, `reset_token`, `user_status`, `team`, `roll_no`, `class`, `branch`, `gender`, `dob`, `student_id`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$dcu9gR1DL2XI0lrrLwYSzukjkXca1dsDQm1KaiJ6iWfU5Pb17Gs4W', '9880772287', 'Administrator', 'default.png', '2023-06-26 14:53:19', 1, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(5, 'Sathis', 'sathis@gmail.com', '$2y$10$f6H6Z6HNRG.ik0SpooCN3.UiwJDLxdGXvj39Qy2uPvixJ8ucVvG7i', '7848454874', 'Member', NULL, '2024-03-09 08:12:26', 1, '', 1, NULL, '21etcs002043', 'A', '7', 'male', '2007-03-02', '6000'),
(6, 'Likhi', 'likhi@gmail.com', '$2y$10$9z20tH/wxxDqV5Hc8cWbMO8IcHnueybvJIN/wJFCsiQhx/INswPY2', '9457386548', 'Member', NULL, '2024-03-10 09:08:01', 1, '', 1, NULL, '21etcs002063', 'A', '7', 'female', '2002-12-16', '6001'),
(7, 'Dachi', 'dachi@gmail.com', '$2y$10$MJx0UwezzTgAD2to3gKgzepaUsWFwUuJrv/q6qeRJfW6elTN3RXMq', '9357821745', 'Member', NULL, '2024-03-10 13:53:14', 1, '', 1, NULL, '21etcs002064', 'A', '7', 'male', '2003-02-04', '6002'),
(8, 'kumar', 'kumar@gmail.com', '$2y$10$K5sf.mzr7mYyp3o64N0ekedcZYgap94Tu1.S9m0Has.SXZXU.8d2q', '99784321', 'Member', NULL, '2024-03-12 15:44:09', 1, '', 1, NULL, '12345', 'B', '7', 'male', '2007-03-12', '6003');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int NOT NULL,
  `title` varchar(55) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `desc` text COLLATE utf8mb4_general_ci,
  `isActive` int DEFAULT '1',
  `status` enum('unread','read') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `title`, `desc`, `isActive`, `status`, `created_at`) VALUES
(7, 'Cse', NULL, 1, 'unread', '2024-02-01 15:31:20'),
(8, 'ISE', NULL, 1, 'unread', '2024-03-09 13:52:03'),
(9, 'AIML', NULL, 1, 'unread', '2024-03-10 13:48:06'),
(10, 'MC', NULL, 1, 'unread', '2024-03-10 13:48:24');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int NOT NULL,
  `title` text COLLATE utf8mb4_general_ci,
  `desc` text COLLATE utf8mb4_general_ci,
  `isActive` int DEFAULT '1',
  `status` enum('unread','read') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int DEFAULT NULL,
  `user_status` int NOT NULL,
  `admin_status` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `title`, `desc`, `isActive`, `status`, `created_at`, `userid`, `user_status`, `admin_status`) VALUES
(1, 'New Event Registered: <span class=\"txt-name\">Sivakumar ', 'test', 1, 'read', '2024-02-21 00:00:00', 2, 0, 1),
(3, 'New Event Registered: <span class=\"txt-name\">Sivakumar </span><br>\n			 data<br>Im going to attend this event\n			                 .', 'Im going to attend this event', 1, 'read', '2024-02-02 00:00:00', 2, 0, 1),
(4, 'New Event Registered: <span class=\"txt-name\">Sivakumar </span><br>\n			 Title: <span class=\"txt-name\">Data 1</span><br>Register: <span class=\"txt-name\">Im ver much intrested to attent this event</span>\n			                 .', 'Im ver much intrested to attent this event', 1, 'read', '2024-02-28 00:00:00', 2, 0, 1),
(5, 'New Event Registered:<br> <strong>Name :</strong> <span class=\"txt-name\">Sivakumar </span><br>\n			 <strong> Title: </strong><span class=\"txt-name\">Data 1</span><br><strong>Register:</strong>  <span class=\"txt-name\">Hi sir Im very much intrested to particpate this event</span>\n			                 .', 'Hi sir Im very much intrested to particpate this event', 1, 'read', '2024-02-21 00:00:00', 2, 0, 1),
(6, 'New Event Registered:<br> <strong style=\"color:black\">Name :</strong> <span class=\"txt-name\">Sivakumar </span><br>\n			 <strong style=\"color:black\"> Title: </strong><span class=\"txt-name\">Test</span><br><strong style=\"color:black\">Register:</strong>  <span class=\"txt-name\">Hi sir Im very much intrested to particpate this event. Thank you</span>\n			                 .', 'Hi sir Im very much intrested to particpate this event. Thank you', 1, 'read', '2024-02-20 00:00:00', 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int NOT NULL,
  `student` varchar(55) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `amount` varchar(55) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` varchar(55) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isActive` int DEFAULT '1',
  `status` varchar(55) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `student`, `amount`, `date`, `isActive`, `status`) VALUES
(2, '5', '5000', '2024-03-09', 1, 'Recived'),
(3, '6', '6000', '2024-03-10', 1, 'Pending'),
(4, '7', '1000', '2024-02-02', 1, 'Recived');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int NOT NULL,
  `student` varchar(55) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `semester` varchar(55) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `percentage` varchar(55) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isActive` int DEFAULT '1',
  `result` varchar(55) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment` varchar(55) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `student`, `semester`, `percentage`, `isActive`, `result`, `payment`) VALUES
(1, '5', 'sem 1', '75', 1, 'First class', 'Paid');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
