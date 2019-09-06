-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2019 at 03:37 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `expense_record`
--

CREATE TABLE `expense_record` (
  `expense_id` int(11) NOT NULL,
  `expense` varchar(200) NOT NULL,
  `expense_desc` varchar(200) DEFAULT NULL,
  `expense_value` double(10,2) NOT NULL,
  `expense_date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_record`
--

INSERT INTO `expense_record` (`expense_id`, `expense`, `expense_desc`, `expense_value`, `expense_date`, `user_id`) VALUES
(1, 'burger', 'chicken burger in kfc', 150.00, '2019-09-01', 1),
(2, 'bus', 'from basabo to badda', 15.00, '2019-09-01', 1),
(3, 'scan', 'CV scan', 20.00, '2019-09-02', 1),
(4, 'burger', 'chicken burger with juice', 150.00, '2019-09-02', 1),
(5, 'money transfer', '', 4600.00, '2019-09-02', 1),
(6, 'train', '', 45.00, '2019-09-02', 5),
(7, 'chocolate', '', 33.00, '2019-09-02', 5),
(8, 'burger', 'grill chicken burger', 55.00, '2019-09-04', 5),
(9, 'bus', 'badda to khilkhet', 25.00, '2019-09-04', 5),
(10, 'train', 'chandpur to lakkhipur', 22.00, '2019-09-04', 5);

-- --------------------------------------------------------

--
-- Table structure for table `income_record`
--

CREATE TABLE `income_record` (
  `income_id` int(11) NOT NULL,
  `income` varchar(200) NOT NULL,
  `income_desc` varchar(200) DEFAULT NULL,
  `income_value` double(10,2) NOT NULL,
  `income_date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `income_record`
--

INSERT INTO `income_record` (`income_id`, `income`, `income_desc`, `income_value`, `income_date`, `user_id`) VALUES
(1, 'Salary', '', 20000.00, '2019-09-02', 1),
(2, 'ticket sell', '', 50.00, '2019-09-02', 5),
(3, 'bonus', 'bonus of puja', 4500.00, '2019-09-04', 5),
(4, 'ticket sell', '', 4000.00, '2019-09-04', 5),
(5, 'debt payment', '', 5000.00, '2019-09-04', 5);

-- --------------------------------------------------------

--
-- Table structure for table `month_record`
--

CREATE TABLE `month_record` (
  `record_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_date` date NOT NULL,
  `last_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `month_record`
--

INSERT INTO `month_record` (`record_id`, `user_id`, `first_date`, `last_date`) VALUES
(1, 5, '2019-09-02', '2019-10-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_email`, `user_password`, `created_at`) VALUES
(1, 'mithul', 'bsusmoy@hotmail.com', '131313', '2019-09-01'),
(2, 'adib', 'adib@gmail.com', 'xyz', '2019-09-01'),
(3, 'ratul', 'ratul@yahoo.com', 'ratul123', '2019-09-01'),
(4, 'user', 'user@gmail.com', 'user123', '2019-09-02'),
(5, 'skscom', 'sks@computer.bd', 'sks823', '2019-09-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expense_record`
--
ALTER TABLE `expense_record`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `income_record`
--
ALTER TABLE `income_record`
  ADD PRIMARY KEY (`income_id`);

--
-- Indexes for table `month_record`
--
ALTER TABLE `month_record`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expense_record`
--
ALTER TABLE `expense_record`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `income_record`
--
ALTER TABLE `income_record`
  MODIFY `income_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `month_record`
--
ALTER TABLE `month_record`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
