-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2022 at 05:54 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yobikes`
--

-- --------------------------------------------------------

--
-- Table structure for table `mt_cnf_entry`
--

CREATE TABLE `mt_cnf_entry` (
  `entry_id` int(55) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `et_invoice_no` varchar(255) DEFAULT NULL,
  `et_invoice_date` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `vin_no` varchar(255) DEFAULT NULL,
  `motor_no` varchar(255) DEFAULT NULL,
  `converter_no` text DEFAULT NULL,
  `controller_no` varchar(255) DEFAULT NULL,
  `charger_no` text DEFAULT NULL,
  `battery_no` varchar(255) DEFAULT NULL,
  `manual_no` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_by` int(11) NOT NULL DEFAULT 0,
  `added_dtime` datetime DEFAULT NULL,
  `edited_by` int(11) NOT NULL DEFAULT 0,
  `edited_dtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mt_cnf_entry`
--

INSERT INTO `mt_cnf_entry` (`entry_id`, `name`, `et_invoice_no`, `et_invoice_date`, `model`, `color`, `vin_no`, `motor_no`, `converter_no`, `controller_no`, `charger_no`, `battery_no`, `manual_no`, `status`, `added_by`, `added_dtime`, `edited_by`, `edited_dtime`) VALUES
(3, 'Tata', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-09-13 21:33:38', 1, '2021-09-13 21:36:30'),
(4, 'Avon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-09-13 21:36:50', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(55) NOT NULL,
  `user_group` int(11) NOT NULL DEFAULT 0,
  `full_name` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `twofa_enabled` int(11) NOT NULL DEFAULT 0,
  `twofa_secret` varchar(255) DEFAULT NULL,
  `dtime` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `last_login` varchar(255) DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL,
  `last_logout` varchar(255) DEFAULT NULL,
  `last_updated` varchar(255) DEFAULT NULL,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `user_blocked` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_group`, `full_name`, `user_name`, `pass`, `twofa_enabled`, `twofa_secret`, `dtime`, `created_by`, `last_login`, `last_login_ip`, `last_logout`, `last_updated`, `updated_by`, `user_blocked`) VALUES
(1, 1, 'Snigdho Upadhyay', 'admin@gmail.com', 'yHbKO56SIL5myftosVG/qw==', 0, NULL, '2020-04-30 11:44:10', 1, '2022-02-13 21:17:27', '::1', '2022-02-13 21:16:56', '2021-08-27 18:09:39', 1, 0),
(27, 1, 'Dibyendu Mukherjee', 'dbyendu@gmail.com', 'Oe63T69YkWosO102Rauwxw==', 0, NULL, '2022-02-13 21:08:56', 1, NULL, NULL, NULL, '2022-02-13 21:11:56', 1, 0),
(28, 1, 'Sujeet Jana', 'sujeet@gmail.com', 'BsNBqIN+0NJWlQJtyuyi8A==', 0, NULL, '2022-02-13 21:11:39', 1, NULL, NULL, NULL, NULL, 0, 0),
(29, 1, 'Tarun Karmakar', 'tarun@gmail.com', 'v0q8A68SGyGvfZThn7YhXQ==', 0, NULL, '2022-02-13 21:12:35', 1, '2022-02-13 21:17:16', '::1', '2022-02-13 21:17:26', '2022-02-13 21:16:54', 1, 0),
(30, 2, 'CNF', 'cnf1@gmail.com', 'h5pmHrnDLtOGm0KnY/kvSw==', 0, NULL, '2022-02-13 21:15:07', 1, NULL, NULL, NULL, NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mt_cnf_entry`
--
ALTER TABLE `mt_cnf_entry`
  ADD PRIMARY KEY (`entry_id`),
  ADD KEY `company_name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mt_cnf_entry`
--
ALTER TABLE `mt_cnf_entry`
  MODIFY `entry_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
