-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2021 at 04:09 PM
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
  `frame_etc` int(11) NOT NULL DEFAULT 0,
  `mudguard_etc` int(11) NOT NULL DEFAULT 0,
  `rim_etc` int(11) NOT NULL DEFAULT 0,
  `sit_etc` int(11) NOT NULL DEFAULT 0,
  `chaincover_etc` int(11) NOT NULL DEFAULT 0,
  `ball_racer_etc` int(11) NOT NULL DEFAULT 0,
  `ch_wheel_etc` int(11) NOT NULL DEFAULT 0,
  `pedal_etc` int(11) NOT NULL DEFAULT 0,
  `chain_etc` int(11) NOT NULL DEFAULT 0,
  `bb_axle_etc` int(11) NOT NULL DEFAULT 0,
  `colter_join_etc` int(11) NOT NULL DEFAULT 0,
  `break_set_etc` int(11) NOT NULL DEFAULT 0,
  `busket_etc` int(11) NOT NULL DEFAULT 0,
  `stand_etc` int(11) NOT NULL DEFAULT 0,
  `mud_screw_etc` int(11) NOT NULL DEFAULT 0,
  `dress_guard_etc` int(11) NOT NULL DEFAULT 0,
  `spock_etc` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_by` int(11) NOT NULL DEFAULT 0,
  `added_dtime` datetime DEFAULT NULL,
  `edited_by` int(11) NOT NULL DEFAULT 0,
  `edited_dtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_checklists_2`
--

INSERT INTO `tbl_checklists_2` (`checklist_id`, `checklist_name`, `checklist_desc`, `company_id`, `segment_id`, `cycle_id`, `quantity`, `frame_etc`, `mudguard_etc`, `rim_etc`, `sit_etc`, `chaincover_etc`, `ball_racer_etc`, `ch_wheel_etc`, `pedal_etc`, `chain_etc`, `bb_axle_etc`, `colter_join_etc`, `break_set_etc`, `busket_etc`, `stand_etc`, `mud_screw_etc`, `dress_guard_etc`, `spock_etc`, `status`, `added_by`, `added_dtime`, `edited_by`, `edited_dtime`) VALUES
(17, 'et', NULL, 3, 7, 13, 2, 3, 3, 3, 3, 2, 3, 2, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, '2021-09-18 22:52:07', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_checklists_2`
--
ALTER TABLE `tbl_checklists_2`
  ADD PRIMARY KEY (`checklist_id`),
  ADD KEY `segment_name` (`checklist_name`),
  ADD KEY `checklist_name` (`checklist_name`,`company_id`,`segment_id`,`cycle_id`,`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_checklists_2`
--
ALTER TABLE `tbl_checklists_2`
  MODIFY `checklist_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
