-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2019 at 08:00 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finalproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(5) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `description` text,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `description`, `created_on`) VALUES
(1, 'Marketing', 'm', '2019-03-28 06:47:16'),
(2, 'Accounting', 'a', '2019-03-28 06:47:16'),
(3, 'Bangla', 'bangla d', '2019-04-01 19:52:09'),
(4, 'English', 'e', '2019-04-01 19:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rate_id` int(30) NOT NULL,
  `uni_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `rate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `student_address` varchar(255) DEFAULT NULL,
  `student_contact` varchar(255) NOT NULL,
  `status` int(5) NOT NULL DEFAULT '1',
  `uni_id` int(5) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `department_name` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_type` varchar(10) NOT NULL,
  `hsc_grade` varchar(10) NOT NULL,
  `student_type` varchar(255) NOT NULL,
  `hsc_group` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `username`, `password`, `student_name`, `email`, `degree`, `course`, `student_address`, `student_contact`, `status`, `uni_id`, `created_at`, `department_name`, `created_on`, `user_type`, `hsc_grade`, `student_type`, `hsc_group`) VALUES
(1, 'tanvir', '$2y$10$HQfgOR2H8j2Ar1mH6ESDYuWmBD/Ja4nv71tHykAvv7.raAdEl6rpe', 'Tanvir Hasan', 'thr1191@gmail.com', 'Undergraduate', NULL, 'Dhaka Bangladesh', '', 1, 6, '2019-04-10 22:14:33', 'Bangla', '2019-04-10 17:42:44', 'ST', '4.5', 'Admission Seeker', 'Commerce'),
(2, 'hafiz', '$2y$10$IQ4H/ycmxbJckMKWRyXRvesF6L0jKk9CN2ShXERHRDmohLUYkLloW', 'Hafiz ul karim', 'hafthr1191@gmail.com', NULL, NULL, NULL, '', 1, 0, '2019-04-10 22:25:37', '', '2019-04-10 16:25:37', 'ST', '', 'Graduate', '');

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE `university` (
  `uni_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `uni_name` varchar(255) NOT NULL,
  `uni_address` text NOT NULL,
  `uni_phone` varchar(255) NOT NULL,
  `user_type` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`uni_id`, `username`, `password`, `created_at`, `uni_name`, `uni_address`, `uni_phone`, `user_type`) VALUES
(6, 'dhaka', '$2y$10$3JI1jkZ4aKnjz1x7DPQjVu8N8/7qTauFaODidL.94AerZSUfgmDem', '2019-04-02 01:55:46', 'Dhaka University', 'dhaka', '01745', 'UV');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`, `created_at`, `name`) VALUES
(1, 'thr1191@gmail.com', '$2y$10$6oZCSQCzeJUzmVSVZkOHzuj4YK0OGFFwf/dE53XvTvy...', 'AD', '2019-03-26 13:11:43', ''),
(2, 'thr0091@gmail.com', '$2y$10$5RKU9wmI18LfOQ/yOtavK.NW1DNnPxoKInS1RMnMZDdRG09gRFMXa', 'AD', '2019-03-26 13:14:59', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`uni_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rate_id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `uni_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
