-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2021 at 03:17 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soor_loading`
--

-- --------------------------------------------------------

--
-- Table structure for table `mt_company`
--

CREATE TABLE `mt_company` (
  `company_id` int(55) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_by` int(11) NOT NULL DEFAULT 0,
  `added_dtime` datetime DEFAULT NULL,
  `edited_by` int(11) NOT NULL DEFAULT 0,
  `edited_dtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mt_company`
--

INSERT INTO `mt_company` (`company_id`, `company_name`, `status`, `added_by`, `added_dtime`, `edited_by`, `edited_dtime`) VALUES
(3, 'Tata', 1, 1, '2021-09-13 21:33:38', 1, '2021-09-13 21:36:30'),
(4, 'Avon', 1, 1, '2021-09-13 21:36:50', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mt_cycle`
--

CREATE TABLE `mt_cycle` (
  `cycle_id` int(55) NOT NULL,
  `cycle_name` varchar(255) DEFAULT NULL,
  `cycle_desc` text DEFAULT NULL,
  `company_id` int(11) NOT NULL DEFAULT 0,
  `segment_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_by` int(11) NOT NULL DEFAULT 0,
  `added_dtime` datetime DEFAULT NULL,
  `edited_by` int(11) NOT NULL DEFAULT 0,
  `edited_dtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mt_cycle`
--

INSERT INTO `mt_cycle` (`cycle_id`, `cycle_name`, `cycle_desc`, `company_id`, `segment_id`, `status`, `added_by`, `added_dtime`, `edited_by`, `edited_dtime`) VALUES
(13, 'test cycle', NULL, 3, 7, 1, 1, '2021-09-16 23:05:29', 1, '2021-09-16 23:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `mt_segment`
--

CREATE TABLE `mt_segment` (
  `segment_id` int(55) NOT NULL,
  `segment_name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_by` int(11) NOT NULL DEFAULT 0,
  `added_dtime` datetime DEFAULT NULL,
  `edited_by` int(11) NOT NULL DEFAULT 0,
  `edited_dtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mt_segment`
--

INSERT INTO `mt_segment` (`segment_id`, `segment_name`, `status`, `added_by`, `added_dtime`, `edited_by`, `edited_dtime`) VALUES
(7, 'STANDERD/JUBLINE', 1, 1, '2021-09-13 21:58:55', 0, NULL),
(8, 'SLR/MTB/KID', 1, 1, '2021-09-13 21:59:07', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checklists`
--

CREATE TABLE `tbl_checklists` (
  `checklist_id` int(55) NOT NULL,
  `checklist_name` varchar(255) DEFAULT NULL,
  `checklist_desc` text DEFAULT NULL,
  `company_id` int(11) NOT NULL DEFAULT 0,
  `segment_id` int(11) NOT NULL DEFAULT 0,
  `cycle_id` int(11) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `carton` int(11) NOT NULL DEFAULT 0,
  `tyre` int(11) NOT NULL DEFAULT 0,
  `rim` int(11) NOT NULL DEFAULT 0,
  `busket` int(11) NOT NULL DEFAULT 0,
  `frame` int(11) NOT NULL DEFAULT 0,
  `mudguard` int(11) NOT NULL DEFAULT 0,
  `sit` int(11) NOT NULL DEFAULT 0,
  `handle` int(11) NOT NULL DEFAULT 0,
  `carrier` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_by` int(11) NOT NULL DEFAULT 0,
  `added_dtime` datetime DEFAULT NULL,
  `edited_by` int(11) NOT NULL DEFAULT 0,
  `edited_dtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_checklists`
--

INSERT INTO `tbl_checklists` (`checklist_id`, `checklist_name`, `checklist_desc`, `company_id`, `segment_id`, `cycle_id`, `quantity`, `carton`, `tyre`, `rim`, `busket`, `frame`, `mudguard`, `sit`, `handle`, `carrier`, `status`, `added_by`, `added_dtime`, `edited_by`, `edited_dtime`) VALUES
(15, 'Test', NULL, 3, 7, 13, 2, 21, 22, 23, 24, 25, 26, 27, 28, 29, 1, 1, '2021-09-18 20:15:51', 1, '2021-09-18 21:18:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checklists_2`
--

CREATE TABLE `tbl_checklists_2` (
  `checklist_id` int(55) NOT NULL,
  `checklist_name` varchar(255) DEFAULT NULL,
  `checklist_desc` text DEFAULT NULL,
  `company_id` int(11) NOT NULL DEFAULT 0,
  `segment_id` int(11) NOT NULL DEFAULT 0,
  `cycle_id` int(11) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `carton` int(11) NOT NULL DEFAULT 0,
  `tyre` int(11) NOT NULL DEFAULT 0,
  `rim` int(11) NOT NULL DEFAULT 0,
  `busket` int(11) NOT NULL DEFAULT 0,
  `frame` int(11) NOT NULL DEFAULT 0,
  `mudguard` int(11) NOT NULL DEFAULT 0,
  `sit` int(11) NOT NULL DEFAULT 0,
  `handle` int(11) NOT NULL DEFAULT 0,
  `carrier` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_by` int(11) NOT NULL DEFAULT 0,
  `added_dtime` datetime DEFAULT NULL,
  `edited_by` int(11) NOT NULL DEFAULT 0,
  `edited_dtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_checklists_2`
--

INSERT INTO `tbl_checklists_2` (`checklist_id`, `checklist_name`, `checklist_desc`, `company_id`, `segment_id`, `cycle_id`, `quantity`, `carton`, `tyre`, `rim`, `busket`, `frame`, `mudguard`, `sit`, `handle`, `carrier`, `status`, `added_by`, `added_dtime`, `edited_by`, `edited_dtime`) VALUES
(17, 'et', NULL, 3, 7, 13, 2, 3, 3, 3, 3, 2, 3, 2, 2, 2, 1, 1, '2021-09-18 22:52:07', 0, NULL);

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
(1, 1, 'Snigdho Upadhyay', 'admin@gmail.com', 'yHbKO56SIL5myftosVG/qw==', 0, NULL, '2020-04-30 11:44:10', 1, '2021-09-18 22:40:56', '::1', '2021-09-18 21:48:36', '2021-08-27 18:09:39', 1, 0),
(24, 1, 'Test User', 'testuser1@gmail.com', '05033N4tHKkuEwWKK0iLbQ==', 0, NULL, '2021-08-27 16:09:34', 1, NULL, NULL, NULL, '2021-09-16 23:23:25', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mt_company`
--
ALTER TABLE `mt_company`
  ADD PRIMARY KEY (`company_id`),
  ADD KEY `company_name` (`company_name`);

--
-- Indexes for table `mt_cycle`
--
ALTER TABLE `mt_cycle`
  ADD PRIMARY KEY (`cycle_id`),
  ADD KEY `segment_name` (`cycle_name`),
  ADD KEY `company_id` (`company_id`,`segment_id`,`status`);

--
-- Indexes for table `mt_segment`
--
ALTER TABLE `mt_segment`
  ADD PRIMARY KEY (`segment_id`),
  ADD KEY `segment_name` (`segment_name`);

--
-- Indexes for table `tbl_checklists`
--
ALTER TABLE `tbl_checklists`
  ADD PRIMARY KEY (`checklist_id`),
  ADD KEY `segment_name` (`checklist_name`),
  ADD KEY `checklist_name` (`checklist_name`,`company_id`,`segment_id`,`cycle_id`,`status`);

--
-- Indexes for table `tbl_checklists_2`
--
ALTER TABLE `tbl_checklists_2`
  ADD PRIMARY KEY (`checklist_id`),
  ADD KEY `segment_name` (`checklist_name`),
  ADD KEY `checklist_name` (`checklist_name`,`company_id`,`segment_id`,`cycle_id`,`status`);

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
-- AUTO_INCREMENT for table `mt_company`
--
ALTER TABLE `mt_company`
  MODIFY `company_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mt_cycle`
--
ALTER TABLE `mt_cycle`
  MODIFY `cycle_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mt_segment`
--
ALTER TABLE `mt_segment`
  MODIFY `segment_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_checklists`
--
ALTER TABLE `tbl_checklists`
  MODIFY `checklist_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_checklists_2`
--
ALTER TABLE `tbl_checklists_2`
  MODIFY `checklist_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
