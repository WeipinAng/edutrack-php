-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2023 at 03:55 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `module_id` int(10) NOT NULL,
  `module_programme` varchar(255) NOT NULL,
  `module_code` varchar(10) NOT NULL,
  `module_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_id`, `module_programme`, `module_code`, `module_name`) VALUES
(1, 'Foundation in Computing', 'ITS30605', 'Web Programming'),
(2, 'Foundation in Computing', 'ITS30705', 'Introduction To Algorithm'),
(3, 'Foundation in Business', 'STA30305', 'Quantitative Technique'),
(4, 'Foundation in Engineering', 'MTH30805', 'Engineering Mathematics'),
(5, 'Foundation in Business', 'MKT30205', 'Introduction To Marketing');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `notice_id` int(10) NOT NULL,
  `notice_date` date NOT NULL,
  `notice_title` varchar(255) NOT NULL,
  `notice_content` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`notice_id`, `notice_date`, `notice_title`, `notice_content`) VALUES
(1, '2023-07-06', 'Launching of EduTrack', 'EduTrack is now launched successfully!'),
(2, '2023-07-06', 'Result Release', 'Result of all pre-U programmes will be released on 16th August 2023.');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `result_id` int(10) NOT NULL,
  `result_score` int(3) DEFAULT NULL,
  `result_status` varchar(20) NOT NULL DEFAULT 'In Progress',
  `user_id` int(10) NOT NULL,
  `module_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`result_id`, `result_score`, `result_status`, `user_id`, `module_id`) VALUES
(1, 90, 'Completed', 1, 2),
(2, 90, 'Completed', 4, 2),
(3, 100, 'Completed', 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `user_full_name` varchar(255) NOT NULL,
  `user_nric` varchar(12) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_birthday` date NOT NULL,
  `user_age` int(3) NOT NULL,
  `user_gender` varchar(10) NOT NULL,
  `user_mobile_no` varchar(20) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_role` varchar(10) NOT NULL,
  `user_programme` varchar(255) DEFAULT NULL,
  `user_intake` varchar(255) DEFAULT NULL,
  `user_emergency_contact` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_full_name`, `user_nric`, `user_password`, `user_birthday`, `user_age`, `user_gender`, `user_mobile_no`, `user_email`, `user_address`, `user_role`, `user_programme`, `user_intake`, `user_emergency_contact`) VALUES
(1, 'Ang Wei Pin', '040508070000', 'weipin', '2004-05-08', 19, 'male', '0123230197', 'weipin@gmail.com', 'Penang', 'student', 'Foundation in Computing', '2022-08', '0123230197'),
(2, 'Teo Di Shi', '010516010000', 'dishi', '2001-05-16', 22, 'male', '0128390516', 'dishi@gmail.com', 'Johor', 'student', 'Foundation in Business', '2022-08', '0128390516'),
(3, 'Ng Jacey', '040906140000', 'jacey', '2004-09-06', 19, 'female', '0103645789', 'jacey@gmail.com', 'Kuala Lumpur', 'student', 'Foundation in Engineering', '2022-08', '0103645789'),
(4, 'Bryan Tan Yun Jing', '040517010000', 'bryan', '2004-05-17', 19, 'male', '0126689611', 'bryantan@gmail.com', 'Pontian', 'student', 'Foundation in Computing', '2022-08', '0126689611'),
(5, 'Tan Lay Chun', '900525070000', 'laychun', '1990-05-25', 33, 'female', '0123948576', 'laychun08@gmail.com', 'Penang', 'teacher', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `module_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `notice_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
