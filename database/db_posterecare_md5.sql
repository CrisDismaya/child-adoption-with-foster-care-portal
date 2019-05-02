-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2019 at 09:18 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_posterecare_md5`
--

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `childrenId` int(11) NOT NULL,
  `chFosterhomeId` int(11) NOT NULL,
  `chPhoto` varchar(150) NOT NULL,
  `chFname` varchar(150) NOT NULL,
  `chMname` varchar(150) NOT NULL,
  `chLname` varchar(150) NOT NULL,
  `chAge` int(11) NOT NULL,
  `chBirthday` date NOT NULL,
  `chPlace` varchar(200) NOT NULL,
  `chGender` int(11) NOT NULL,
  `chNationality` varchar(100) NOT NULL,
  `chStatus` int(11) NOT NULL,
  `chAddress` text NOT NULL,
  `chDescription` text NOT NULL,
  `chHieght` text NOT NULL,
  `chWeight` text NOT NULL,
  `chHobbies` text NOT NULL,
  `chChildAdopt` int(11) NOT NULL,
  `chCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `children_adopt_by_parent`
--

CREATE TABLE `children_adopt_by_parent` (
  `adopt_id` int(11) NOT NULL,
  `adopt_parent_id` int(11) NOT NULL,
  `adopt_children_id` int(11) NOT NULL,
  `adopt_children_name` text NOT NULL,
  `adopt_children_bday` text NOT NULL,
  `adopt_children_status` int(11) NOT NULL,
  `adopt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `childstatus`
--

CREATE TABLE `childstatus` (
  `childstatusId` int(11) NOT NULL,
  `csName` varchar(100) NOT NULL,
  `csCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `childstatus`
--

INSERT INTO `childstatus` (`childstatusId`, `csName`, `csCreated`) VALUES
(1, 'Possible Adoptees', '2019-03-13 10:47:12'),
(2, 'Temporary', '2019-03-13 10:47:12'),
(3, 'Adopted', '2019-03-13 10:47:12'),
(4, 'Children under foster care', '2019-03-13 10:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `credenId` int(11) NOT NULL,
  `credenAnyid` int(11) NOT NULL,
  `credenUser` varchar(200) NOT NULL,
  `credenPass` text NOT NULL,
  `credenLevel` int(11) NOT NULL,
  `crendeStatus` int(11) NOT NULL,
  `credenCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`credenId`, `credenAnyid`, `credenUser`, `credenPass`, `credenLevel`, `crendeStatus`, `credenCreated`) VALUES
(1, 1, 'dswd', '91d621e7eb5bb2cd30510f4d059ff304', 1, 0, '2019-04-25 10:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `disId` int(11) NOT NULL,
  `disName` varchar(50) NOT NULL,
  `muniDistrict` int(11) NOT NULL,
  `disCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`disId`, `disName`, `muniDistrict`, `disCreated`) VALUES
(1, 'DISTRICT 1', 1, '2019-03-11 17:19:13'),
(2, 'DISTRICT 2', 2, '2019-03-11 17:19:13'),
(3, 'DISTRICT 3', 3, '2019-03-11 17:19:13'),
(4, 'DISTRICT 4', 4, '2019-03-11 17:19:13');

-- --------------------------------------------------------

--
-- Table structure for table `download_file`
--

CREATE TABLE `download_file` (
  `download_id` int(11) NOT NULL,
  `dl_path` text NOT NULL,
  `dl_filename` text NOT NULL,
  `dl_file_status` int(11) NOT NULL,
  `dl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `facilityId` int(11) NOT NULL,
  `faCredenId` int(11) NOT NULL,
  `faPhoto` varchar(255) NOT NULL,
  `faName` varchar(150) NOT NULL,
  `faStatus` int(11) NOT NULL,
  `faCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fosterhome`
--

CREATE TABLE `fosterhome` (
  `fosterhomeId` int(11) NOT NULL,
  `fhName` varchar(150) NOT NULL,
  `fhAddress` varchar(255) NOT NULL,
  `fhDistrict` varchar(100) NOT NULL,
  `fhMunicipal` int(11) NOT NULL,
  `fmEmail` varchar(255) NOT NULL,
  `fhContact` varchar(15) NOT NULL,
  `fhUsername` varchar(150) NOT NULL,
  `fhPassword` text NOT NULL,
  `fhStatus` int(11) NOT NULL,
  `fhaccStatus` int(11) NOT NULL,
  `fhCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fosterparent`
--

CREATE TABLE `fosterparent` (
  `fosterparentId` int(11) NOT NULL,
  `fpCreadenId` int(11) NOT NULL,
  `fpFosterparentId` int(11) NOT NULL,
  `fpPtoho` varchar(255) NOT NULL,
  `fpFname` varchar(150) NOT NULL,
  `fpMname` varchar(150) NOT NULL,
  `fpLname` varchar(150) NOT NULL,
  `fpAge` int(5) NOT NULL,
  `fpBirthday` date NOT NULL,
  `fpGender` int(11) NOT NULL,
  `fpCivilStatus` int(11) NOT NULL,
  `fpContact` varchar(15) NOT NULL,
  `fpEmail` varchar(150) NOT NULL,
  `fpAddress` text NOT NULL,
  `fpChild` varchar(250) NOT NULL,
  `fpStatusAdopt` int(11) NOT NULL,
  `fpUsername` varchar(200) NOT NULL,
  `fpPassword` text NOT NULL,
  `fpStatus` int(11) NOT NULL,
  `fpAccountStatus` int(11) NOT NULL,
  `msgStatus` int(11) NOT NULL,
  `fpCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `messageId` int(11) NOT NULL,
  `msgCredenId` int(11) NOT NULL,
  `msgFparentId` int(11) NOT NULL,
  `msgSendid` int(11) NOT NULL,
  `msgContent` text NOT NULL,
  `msgStatused` int(11) NOT NULL,
  `msgArchive` int(11) NOT NULL,
  `msgCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `municipal`
--

CREATE TABLE `municipal` (
  `muniId` int(11) NOT NULL,
  `muniName` varchar(50) NOT NULL,
  `muniPostal` int(11) NOT NULL,
  `disId` int(11) NOT NULL,
  `muniCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `municipal`
--

INSERT INTO `municipal` (`muniId`, `muniName`, `muniPostal`, `disId`, `muniCreated`) VALUES
(1, 'CITY OF BINAN', 4024, 1, '2019-03-11 17:27:57'),
(2, 'CITY OF SAN PEDRO', 4023, 1, '2019-03-11 17:08:52'),
(3, 'CITY OF SANTA ROSA', 4026, 1, '2019-03-11 17:08:52'),
(4, 'BAY', 4033, 2, '2019-03-11 17:09:57'),
(5, 'CABUYAO CITY', 4025, 2, '2019-03-11 17:09:57'),
(6, 'CITY OF CALAMBA', 4027, 2, '2019-03-11 17:09:57'),
(7, 'LOS BANOS', 4031, 2, '2019-03-11 17:28:06'),
(8, 'ALAMINOS', 4001, 3, '2019-03-11 17:11:35'),
(9, 'CALAUAN', 4012, 3, '2019-03-11 17:11:35'),
(10, 'LILIW', 4004, 3, '2019-03-11 17:11:35'),
(11, 'NAGCARLAN', 4002, 3, '2019-03-11 17:11:35'),
(12, 'RIZAL', 4003, 3, '2019-03-11 17:11:35'),
(13, 'SAN PABLO CITY', 4000, 3, '2019-03-11 17:11:35'),
(14, 'VICTORIA', 4011, 3, '2019-03-11 17:11:35'),
(15, 'CAVINTI', 4013, 4, '2019-03-11 17:15:43'),
(16, 'FAMY', 4021, 4, '2019-03-11 17:15:43'),
(17, 'KALAYAAN', 4015, 4, '2019-03-11 17:15:43'),
(18, 'LUISIANA', 4032, 4, '2019-03-11 17:15:43'),
(19, 'LUMBAN', 4014, 4, '2019-03-11 17:15:43'),
(20, 'MABITAC', 4020, 4, '2019-03-11 17:15:43'),
(21, 'MAGDALENA', 4007, 4, '2019-03-11 17:15:43'),
(22, 'MAJAYJAY', 4005, 4, '2019-03-11 17:15:43'),
(23, 'PAETE', 4016, 4, '2019-03-11 17:15:43'),
(24, 'PAGSANJAN', 4008, 4, '2019-03-11 17:15:43'),
(25, 'PAKIL', 4017, 4, '2019-03-11 17:15:43'),
(26, 'PANGIL', 4018, 4, '2019-03-11 17:15:43'),
(27, 'PILA', 4010, 4, '2019-03-11 17:15:43'),
(28, 'SANTA CRUZ', 4009, 4, '2019-03-11 17:15:43'),
(29, 'SANTA MARIA', 4022, 4, '2019-03-11 17:15:43'),
(30, 'SINILOAN', 4019, 4, '2019-03-11 17:15:43');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newsId` int(11) NOT NULL,
  `nwCredenId` int(11) NOT NULL,
  `nwPath` varchar(200) NOT NULL,
  `nwPhoto` varchar(150) NOT NULL,
  `nwDate` date NOT NULL,
  `nwTitle` text NOT NULL,
  `nwContent` text NOT NULL,
  `nwStatus` int(11) NOT NULL,
  `nwCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parent_report`
--

CREATE TABLE `parent_report` (
  `parent_report_id` int(11) NOT NULL,
  `prFosterparentId` int(11) NOT NULL,
  `prChildrenId` int(11) NOT NULL,
  `prPath` text NOT NULL,
  `prPhotoname` varchar(200) NOT NULL,
  `prDescription` text NOT NULL,
  `prCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reportcare`
--

CREATE TABLE `reportcare` (
  `reportCareId` int(11) NOT NULL,
  `rcfosterHomeid` int(11) NOT NULL,
  `rcfilePath` varchar(255) NOT NULL,
  `rcfileName` varchar(150) NOT NULL,
  `rsTitile` varchar(200) NOT NULL,
  `rcCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `video_id` int(11) NOT NULL,
  `video_path` text NOT NULL,
  `video_name` text NOT NULL,
  `video_title` text NOT NULL,
  `video_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `y_video`
--

CREATE TABLE `y_video` (
  `y_video_id` int(11) NOT NULL,
  `y_video_link` text NOT NULL,
  `y_video_title` varchar(255) NOT NULL,
  `y_archive` int(11) NOT NULL,
  `y_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`childrenId`);

--
-- Indexes for table `children_adopt_by_parent`
--
ALTER TABLE `children_adopt_by_parent`
  ADD PRIMARY KEY (`adopt_id`);

--
-- Indexes for table `childstatus`
--
ALTER TABLE `childstatus`
  ADD PRIMARY KEY (`childstatusId`);

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`credenId`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`disId`);

--
-- Indexes for table `download_file`
--
ALTER TABLE `download_file`
  ADD PRIMARY KEY (`download_id`);

--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`facilityId`);

--
-- Indexes for table `fosterhome`
--
ALTER TABLE `fosterhome`
  ADD PRIMARY KEY (`fosterhomeId`);

--
-- Indexes for table `fosterparent`
--
ALTER TABLE `fosterparent`
  ADD PRIMARY KEY (`fosterparentId`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`messageId`);

--
-- Indexes for table `municipal`
--
ALTER TABLE `municipal`
  ADD PRIMARY KEY (`muniId`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsId`);

--
-- Indexes for table `parent_report`
--
ALTER TABLE `parent_report`
  ADD PRIMARY KEY (`parent_report_id`);

--
-- Indexes for table `reportcare`
--
ALTER TABLE `reportcare`
  ADD PRIMARY KEY (`reportCareId`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`video_id`);

--
-- Indexes for table `y_video`
--
ALTER TABLE `y_video`
  ADD PRIMARY KEY (`y_video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `childrenId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `children_adopt_by_parent`
--
ALTER TABLE `children_adopt_by_parent`
  MODIFY `adopt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `childstatus`
--
ALTER TABLE `childstatus`
  MODIFY `childstatusId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
  MODIFY `credenId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `disId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `download_file`
--
ALTER TABLE `download_file`
  MODIFY `download_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `facilityId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fosterhome`
--
ALTER TABLE `fosterhome`
  MODIFY `fosterhomeId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fosterparent`
--
ALTER TABLE `fosterparent`
  MODIFY `fosterparentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `municipal`
--
ALTER TABLE `municipal`
  MODIFY `muniId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parent_report`
--
ALTER TABLE `parent_report`
  MODIFY `parent_report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reportcare`
--
ALTER TABLE `reportcare`
  MODIFY `reportCareId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `y_video`
--
ALTER TABLE `y_video`
  MODIFY `y_video_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
