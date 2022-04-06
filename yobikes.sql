-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2022 at 08:35 PM
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
  `et_invoice_date` date DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `vin_no` varchar(255) DEFAULT NULL,
  `motor_no` varchar(255) DEFAULT NULL,
  `converter_no` text DEFAULT NULL,
  `controller_no` varchar(255) DEFAULT NULL,
  `charger_no` text DEFAULT NULL,
  `battery_no` varchar(255) DEFAULT NULL,
  `manual_no` varchar(255) DEFAULT NULL,
  `battery_sl1` varchar(255) NOT NULL,
  `battery_sl2` varchar(255) NOT NULL,
  `battery_sl3` varchar(255) NOT NULL,
  `battery_sl4` varchar(255) NOT NULL,
  `battery_sl5` varchar(255) NOT NULL,
  `battery_sl6` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_by` int(11) NOT NULL DEFAULT 0,
  `added_dtime` datetime DEFAULT NULL,
  `edited_by` int(11) NOT NULL DEFAULT 0,
  `edited_dtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mt_cnf_entry`
--

INSERT INTO `mt_cnf_entry` (`entry_id`, `name`, `et_invoice_no`, `et_invoice_date`, `model`, `color`, `vin_no`, `motor_no`, `converter_no`, `controller_no`, `charger_no`, `battery_no`, `manual_no`, `battery_sl1`, `battery_sl2`, `battery_sl3`, `battery_sl4`, `battery_sl5`, `battery_sl6`, `status`, `added_by`, `added_dtime`, `edited_by`, `edited_dtime`) VALUES
(7, 'Yo drift', '001', '2022-04-05', 'm001', 'Red', 'v001', 'm0117', 'c0001', 'c001', 'cr002', NULL, NULL, 'er', 'wer', 'e', 'wr', 'er4', 'tt', 1, 1, '2022-04-05 23:25:55', 1, '2022-04-06 00:49:41'),
(10, 'Yo Edge', 'I001', '2022-04-06', 'V002', 'Red', 'V01', 'ddd', 'dd', 'dd', 'dd', NULL, NULL, 'dd', 'dd', 'd', 'd', 'v', 'f', 1, 1, '2022-04-06 22:36:22', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cnf_billing`
--

CREATE TABLE `tbl_cnf_billing` (
  `billing_id` bigint(20) NOT NULL,
  `cnf_user_id` bigint(20) NOT NULL DEFAULT 0,
  `dealer_user_id` bigint(20) NOT NULL DEFAULT 0,
  `cnf_entry_id` bigint(20) NOT NULL DEFAULT 0,
  `cnf_notes` text DEFAULT NULL,
  `added_dtime` datetime DEFAULT NULL,
  `edited_dtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cnf_billing`
--

INSERT INTO `tbl_cnf_billing` (`billing_id`, `cnf_user_id`, `dealer_user_id`, `cnf_entry_id`, `cnf_notes`, `added_dtime`, `edited_dtime`) VALUES
(1, 1, 32, 7, 's', '2022-04-06 20:43:10', NULL),
(2, 1, 35, 10, 'test note', '2022-04-06 22:37:30', NULL),
(3, 31, 35, 10, 'yestt', '2022-04-06 22:46:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(55) NOT NULL,
  `user_group` int(11) NOT NULL DEFAULT 0 COMMENT '1=admin, 2= cnf, 3=dealer',
  `parent_id` bigint(20) NOT NULL DEFAULT 0,
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

INSERT INTO `users` (`user_id`, `user_group`, `parent_id`, `full_name`, `user_name`, `pass`, `twofa_enabled`, `twofa_secret`, `dtime`, `created_by`, `last_login`, `last_login_ip`, `last_logout`, `last_updated`, `updated_by`, `user_blocked`) VALUES
(1, 1, 0, 'Snigdho Upadhyay', 'admin@gmail.com', 'yHbKO56SIL5myftosVG/qw==', 0, NULL, '2020-04-30 11:44:10', 1, '2022-04-06 22:26:21', '::1', '2022-04-06 23:15:15', '2021-08-27 18:09:39', 1, 0),
(27, 1, 0, 'Dibyendu Mukherjee', 'dibyendu@gmail.com', 'P3T+St+zpUp2sA9933VqDQ==', 0, NULL, '2022-02-13 21:08:56', 1, '2022-04-05 23:23:12', '::1', NULL, '2022-04-05 23:22:58', 1, 0),
(28, 1, 0, 'Sujeet Jana', 'sujeet@gmail.com', 'BsNBqIN+0NJWlQJtyuyi8A==', 0, NULL, '2022-02-13 21:11:39', 1, NULL, NULL, NULL, NULL, 0, 0),
(29, 1, 0, 'Tarun Karmakar', 'tarun@gmail.com', 'v0q8A68SGyGvfZThn7YhXQ==', 0, NULL, '2022-02-13 21:12:35', 1, '2022-02-13 21:17:16', '::1', '2022-02-13 21:17:26', '2022-02-13 21:16:54', 1, 0),
(30, 2, 0, 'KanchraparaCNF', 'kanchraparacnf@gmail.com', 'h5pmHrnDLtOGm0KnY/kvSw==', 0, NULL, '2022-02-13 21:15:07', 1, NULL, NULL, NULL, '2022-04-05 23:31:41', 1, 0),
(31, 2, 0, 'SiliguriCNF', 'siliguricnf@gmail.com', 'PB5J5auc8TwfaqrtfSzfkw==', 0, NULL, '2022-04-05 22:21:26', 1, '2022-04-06 22:39:02', '::1', '2022-04-06 22:59:36', '2022-04-06 22:38:57', 1, 0),
(32, 3, 30, 'Hanshit', 'hanshit@gmail.com', 'cbfpq90zYzXd4JtpVdif6g==', 0, NULL, '2022-04-05 23:19:35', 1, '2022-04-06 20:50:24', '::1', NULL, '2022-04-06 20:50:19', 1, 0),
(34, 3, 31, 'Test Cust', 'demo@email.com', 'UQyz7ja80MCE1ATGRcmfBg==', 0, NULL, '2022-04-06 21:44:26', 1, NULL, NULL, NULL, NULL, 0, 0),
(35, 3, 31, 'dealer 1', 'dealer1@gmail.com', 'RgAagusgSk5NcWGjw8yMkw==', 0, NULL, '2022-04-06 22:23:30', 1, '2022-04-06 23:00:32', '::1', NULL, '2022-04-06 23:00:27', 1, 0);

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
-- Indexes for table `tbl_cnf_billing`
--
ALTER TABLE `tbl_cnf_billing`
  ADD PRIMARY KEY (`billing_id`);

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
  MODIFY `entry_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_cnf_billing`
--
ALTER TABLE `tbl_cnf_billing`
  MODIFY `billing_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
