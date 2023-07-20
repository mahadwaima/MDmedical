-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2023 at 10:41 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `damsmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `ID` int(11) NOT NULL,
  `Prescription_Name` int(11) NOT NULL,
  `Notes` text NOT NULL,
  `PID` int(11) NOT NULL,
  `DID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`ID`, `Prescription_Name`, `Notes`, `PID`, `DID`) VALUES
(20, 3, 'after lanuch', 13, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tblappointment`
--

CREATE TABLE `tblappointment` (
  `ID` int(11) NOT NULL,
  `AppointmentNumber` int(10) DEFAULT NULL,
  `Name` varchar(250) DEFAULT NULL,
  `MobileNumber` bigint(20) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `Address` varchar(500) DEFAULT NULL,
  `AppointmentDate` date DEFAULT NULL,
  `AppointmentTime` time DEFAULT NULL,
  `Specialization` varchar(250) DEFAULT NULL,
  `Doctor` int(10) DEFAULT NULL,
  `Message` longtext DEFAULT NULL,
  `ApplyDate` timestamp NULL DEFAULT current_timestamp(),
  `Remark` varchar(250) DEFAULT NULL,
  `Status` varchar(250) NOT NULL DEFAULT '',
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `PID` int(11) DEFAULT NULL,
  `inhouse` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblappointment`
--

INSERT INTO `tblappointment` (`ID`, `AppointmentNumber`, `Name`, `MobileNumber`, `Email`, `Address`, `AppointmentDate`, `AppointmentTime`, `Specialization`, `Doctor`, `Message`, `ApplyDate`, `Remark`, `Status`, `UpdationDate`, `PID`, `inhouse`) VALUES
(1, 480750893, 'mahmod', 1, 'm@gmail.com', NULL, '2024-01-01', '04:00:00', '8', 8, '', '2023-06-23 18:22:08', 'm', 'Deleted', '2023-06-23 19:18:23', 13, 0),
(2, 346077054, 'Mahmod', 123, 'm@gmail.com', NULL, '2023-12-31', '11:00:00', '8', 8, '', '2023-06-23 18:56:51', NULL, 'Deleted', '2023-06-23 18:57:50', 13, 0),
(3, 424047939, 'mmm', 1, 'm@gmail.com', NULL, '2025-02-01', '09:00:00', '8', 8, 'dsa', '2023-06-24 13:05:50', NULL, 'Deleted', '2023-06-24 13:09:03', 13, 0),
(4, 423039709, 'mmm', 1, 'm@gmail.com', NULL, '2026-01-01', '01:30:00', '8', 8, 'WWWWWWW', '2023-06-24 13:08:51', NULL, 'Deleted', '2023-06-24 13:09:02', 13, 0),
(5, 138572618, 'ahhhhhhh', 1222222222, 'm@gmail.com', NULL, '2027-03-03', '04:00:00', '2', 2, 'dsadaa', '2023-06-24 13:09:37', NULL, 'Deleted', '2023-06-24 13:09:47', 13, 0),
(6, 888469234, 'يس', 1, 'm@gmail.com', NULL, '2028-03-03', '12:00:00', '1', 1, '', '2023-06-24 18:17:52', NULL, '', NULL, 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbldoctor`
--

CREATE TABLE `tbldoctor` (
  `ID` int(5) NOT NULL,
  `FullName` varchar(250) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `Specialization` varchar(250) DEFAULT NULL,
  `Password` varchar(259) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `house` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbldoctor`
--

INSERT INTO `tbldoctor` (`ID`, `FullName`, `MobileNumber`, `Email`, `Specialization`, `Password`, `CreationDate`, `house`) VALUES
(1, 'Dr. Anusakha Singh', 9787979798, 'anu@gmail.com', '1', 'f925916e2754e5e03f75dd58a5733251', '2022-11-09 15:01:11', 0),
(2, 'Dr. Pradeep Chauhan', 6464654646, 'pra@gmail.com', '2', '202cb962ac59075b964b07152d234b70', '2022-11-09 15:01:59', 0),
(3, 'Garima Singh', 14253625, 'gs123@test.com', '7', 'f925916e2754e5e03f75dd58a5733251', '2022-11-11 01:28:44', 0),
(4, 'Shiv Kumar Singh', 1231231230, 'skmr123@test.com', '4', 'f925916e2754e5e03f75dd58a5733251', '2022-11-11 01:54:44', 0),
(5, 'Maha Burham Dwaima', 595536687, 'mahaburham@gmail.com', '2', '8e4e356381f9089c0b0e21cb78639478', '2023-05-07 13:21:12', 0),
(6, 'ahmad', 597777777, 'ahmed@pro.com', '6', '202cb962ac59075b964b07152d234b70', '2023-05-19 21:36:52', 1),
(7, 'MAHMOD', 59595959, 'a@gmail.com', '14', '202cb962ac59075b964b07152d234b70', '2023-05-26 16:34:42', 0),
(8, 'mahmod', 123456, 'ma@gmail.com', '8', '202cb962ac59075b964b07152d234b70', '2023-05-30 18:01:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` longtext DEFAULT NULL,
  `PageDescription` longtext DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` date DEFAULT NULL,
  `Timing` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`, `Timing`) VALUES
(2, 'contactus', 'Contact Us', 'Gaza, palestine', 'MDmedical@gmail.com', 7896541239, NULL, '8:30 am to 5:30 pm');

-- --------------------------------------------------------

--
-- Table structure for table `tblpharmacy`
--

CREATE TABLE `tblpharmacy` (
  `ID` int(11) NOT NULL,
  `M_Name` varchar(255) NOT NULL,
  `M_Price` int(11) NOT NULL,
  `Ph_ID` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpharmacy`
--

INSERT INTO `tblpharmacy` (`ID`, `M_Name`, `M_Price`, `Ph_ID`, `Image`, `Date`) VALUES
(1, 'Test', 100, '5', 'p-1.jpg', '2023-05-26 20:36:43'),
(2, 'PA Ed', 22, '7', 'p-2.jpg', '2023-05-26 20:36:36'),
(3, 'Pa Ex', 80, '7', 'p-3.jpg', '2023-05-26 20:36:25'),
(4, 'Catamol', 22, '7', 'p-4.jpg', '2023-05-26 20:36:11'),
(5, 'Panadol Extra', 10, '7', '515p-3.jpg', '2023-05-26 21:35:30');

-- --------------------------------------------------------

--
-- Table structure for table `tblspecialization`
--

CREATE TABLE `tblspecialization` (
  `ID` int(5) NOT NULL,
  `Specialization` varchar(250) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblspecialization`
--

INSERT INTO `tblspecialization` (`ID`, `Specialization`, `CreationDate`) VALUES
(1, 'Orthopedics', '2022-11-09 14:22:33'),
(2, 'Internal Medicine', '2022-11-09 14:23:42'),
(3, 'Obstetrics and Gynecology', '2022-11-09 14:24:14'),
(4, 'Dermatology', '2022-11-09 14:24:42'),
(5, 'Pediatrics', '2022-11-09 14:25:06'),
(6, 'Radiology', '2022-11-09 14:25:31'),
(7, 'General Surgery', '2022-11-09 14:25:52'),
(8, 'Ophthalmology', '2022-11-09 14:27:18'),
(9, 'Family Medicine', '2022-11-09 14:27:52'),
(10, 'Chest Medicine', '2022-11-09 14:28:32'),
(11, 'Anesthesia', '2022-11-09 14:29:12'),
(12, 'Pathology', '2022-11-09 14:29:51'),
(13, 'ENT', '2022-11-09 14:30:13'),
(14, 'Pharmacy', '2023-05-26 16:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `tplpatients`
--

CREATE TABLE `tplpatients` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(55) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `code` mediumtext NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tplpatients`
--

INSERT INTO `tplpatients` (`ID`, `username`, `fullname`, `email`, `password`, `phone`, `code`, `active`) VALUES
(13, 'm', 'mmm', 'm@gmail.com', '202cb962ac59075b964b07152d234b70', 1, '', 1),
(23, 'mahmod', 'Mahmod Yousif Abo Rizq', 'mahmodyousif2@gmail.com', '202cb962ac59075b964b07152d234b70', 595955595, '4e732ced3463d06de0ca9a15b6153677', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PreID` (`PID`),
  ADD KEY `doctor` (`DID`),
  ADD KEY `med_name` (`Prescription_Name`);

--
-- Indexes for table `tblappointment`
--
ALTER TABLE `tblappointment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `pId` (`PID`);

--
-- Indexes for table `tbldoctor`
--
ALTER TABLE `tbldoctor`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpharmacy`
--
ALTER TABLE `tblpharmacy`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblspecialization`
--
ALTER TABLE `tblspecialization`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tplpatients`
--
ALTER TABLE `tplpatients`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblappointment`
--
ALTER TABLE `tblappointment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbldoctor`
--
ALTER TABLE `tbldoctor`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpharmacy`
--
ALTER TABLE `tblpharmacy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblspecialization`
--
ALTER TABLE `tblspecialization`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tplpatients`
--
ALTER TABLE `tplpatients`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `PreID` FOREIGN KEY (`PID`) REFERENCES `tplpatients` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctor` FOREIGN KEY (`DID`) REFERENCES `tbldoctor` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `med_name` FOREIGN KEY (`Prescription_Name`) REFERENCES `tblpharmacy` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblappointment`
--
ALTER TABLE `tblappointment`
  ADD CONSTRAINT `pId` FOREIGN KEY (`PID`) REFERENCES `tplpatients` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
