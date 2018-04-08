-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2018 at 04:07 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialcalendar`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `member` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `accepted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`member`, `event`, `accepted`) VALUES
(2, 46, 1),
(9, 47, 1),
(11, 48, 1),
(6, 49, 1),
(3, 51, 0),
(1, 51, 1),
(2, 51, 1),
(1, 54, 1),
(2, 54, 1),
(11, 54, 0),
(6, 54, 2),
(2, 55, 1),
(2, 56, 1),
(11, 56, 0),
(6, 56, 2),
(1, 56, 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventId` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `startDate` datetime DEFAULT NULL,
  `endDate` datetime DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventId`, `owner`, `name`, `startDate`, `endDate`, `location`) VALUES
(46, 1, 'event 1', '2018-04-01 12:00:00', '2018-04-01 13:00:00', 'wherever'),
(47, 1, 'the TEST', '2018-04-02 13:00:00', '2018-04-02 15:00:00', 'the testing center'),
(48, 1, 'the RAC', '2018-04-03 17:00:00', '2018-04-03 19:30:00', 'FIRST center (FRC)'),
(49, 1, 'wriggly wiggling time', '2018-04-04 16:00:00', '2018-04-05 04:00:00', 'the zoo'),
(50, 4, 'Test', '2018-07-07 00:00:00', '2018-07-07 15:39:00', 'Phoenix'),
(51, 4, 'Test', '2018-04-10 13:30:00', '2018-04-10 14:30:00', 'Here'),
(52, 6, 'Some event', '2018-04-09 09:00:00', '2018-04-09 10:30:00', 'Here'),
(53, 14, '???', '2018-04-20 00:12:00', '2048-04-20 14:35:00', '12358'),
(54, 4, 'Tempe Beach Party', '2018-04-10 15:30:00', '2018-04-10 17:00:00', 'Tempe Town Lake'),
(55, 1, 'DaNcE pArTy', '2018-04-09 16:00:00', '2018-04-09 21:00:00', 'your face'),
(56, 4, 'A Quiet Night Out on the Town', '2018-04-11 18:30:00', '2018-04-11 20:00:00', 'Mill');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `friend1` int(11) NOT NULL,
  `friend2` int(11) NOT NULL,
  `accepted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`friend1`, `friend2`, `accepted`) VALUES
(1, 6, 1),
(2, 6, 1),
(1, 2, 1),
(4, 2, 1),
(11, 4, 1),
(11, 6, 1),
(11, 2, 1),
(3, 12, 0),
(8, 5, 0),
(1, 10, 0),
(4, 6, 1),
(4, 1, 1),
(1, 11, 0),
(1, 9, 0),
(1, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `memberId` int(11) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`memberId`, `firstName`, `lastName`, `email`, `password`) VALUES
(1, 'admin', 'ADMIN', 'admin@admin.com', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(2, 'Benjamin', 'Ladick', 'blladi313@gmail.com', '2dc96a7541757d3aa6303d62514e4c5e2af70d05'),
(3, 'Eye', 'Paddy', 'ipad@apple.com', 'd13218f1b0f9b38b21518392d208dbfb3bc2893d'),
(4, 'Alex', 'Harken', 'aharken@yahoo.com', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e'),
(5, 'Harley', 'Greytak', 'harleywinxp@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(6, 'Wriggle', 'Wiggle', 'ww@www.com', 'c50267b906a652f2142cfab006e215c9f6fdc8a0'),
(8, 'jack', 'jack', 'jack@jack.com', '596727c8a0ea4db3ba2ceceedccbacd3d7b371b8'),
(9, 'test', 'tester', 'test@test.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(10, '123', '123', '123@123.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(11, 'First', 'Last', 'firstlast@last.com', 'e0996a37c13d44c3b06074939d43fa3759bd32c1'),
(12, 'Bob', 'Smith', 'Jakef98@yahoo.com', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e'),
(13, '456', '456', '456@4456.com', 'f8b5f622dcf940ae97164f7cea68e98da6bf8ac3'),
(14, '456', '456', '456@456.com', '51eac6b471a284d3341d8c0c63d0f1a286262a18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD KEY `member` (`member`),
  ADD KEY `event` (`event`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventId`),
  ADD KEY `owner` (`owner`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD KEY `friend1` (`friend1`),
  ADD KEY `friend2` (`friend2`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`memberId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `memberId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `actions`
--
ALTER TABLE `actions`
  ADD CONSTRAINT `actions_ibfk_1` FOREIGN KEY (`member`) REFERENCES `members` (`memberId`),
  ADD CONSTRAINT `actions_ibfk_2` FOREIGN KEY (`event`) REFERENCES `events` (`eventId`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `members` (`memberId`);

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`friend1`) REFERENCES `members` (`memberId`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`friend2`) REFERENCES `members` (`memberId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
