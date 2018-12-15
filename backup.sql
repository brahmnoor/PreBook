-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 15, 2018 at 05:33 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `film`
--

-- --------------------------------------------------------

--
-- Table structure for table `broadcast`
--

CREATE TABLE `broadcast` (
  `BroadCastId` int(100) NOT NULL,
  `Dates` date NOT NULL,
  `Time` varchar(100) NOT NULL,
  `FilmId` int(100) NOT NULL,
  `HouseId` int(100) NOT NULL,
  `day` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `broadcast`
--

INSERT INTO `broadcast` (`BroadCastId`, `Dates`, `Time`, `FilmId`, `HouseId`, `day`) VALUES
(1, '2015-11-16', '12:10', 1, 1, 'Mon'),
(2, '2015-11-16', '13:10', 1, 3, 'Mon'),
(3, '2015-11-16', '12:50', 2, 1, 'Mon'),
(4, '2015-11-16', '13:20', 2, 2, 'Mon'),
(5, '2015-11-16', '15:20', 3, 1, 'Mon'),
(6, '2015-11-16', '16:20', 4, 1, 'Mon');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentId` int(100) NOT NULL,
  `FilmId` int(100) NOT NULL,
  `UserId` varchar(100) NOT NULL,
  `Comment` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentId`, `FilmId`, `UserId`, `Comment`) VALUES
(1, 1, 'brahmnoor', 'Bestie'),
(2, 4, 'brahmnoor', 'I like this movie.'),
(4, 1, 'brahmnoor', 'Good movie.'),
(5, 1, 'anupa97', 'was inspired by the cuckoo returning. had fantasies about it in my dream'),
(6, 3, 'anupa97', 'another title could have been \"hookups\" '),
(7, 4, 'anupa97', 'spectacular movie'),
(8, 2, 'anupa97', 'was a mind OPENER!!!!'),
(9, 4, 'Rishi123', 'What crap');

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `FilmId` int(100) NOT NULL,
  `FilmName` varchar(100) NOT NULL,
  `Duration` varchar(100) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `Language` varchar(100) NOT NULL,
  `Director` varchar(100) NOT NULL,
  `Description` varchar(10000) NOT NULL,
  `Poster` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`FilmId`, `FilmName`, `Duration`, `Category`, `Language`, `Director`, `Description`, `Poster`) VALUES
(1, 'Return Of The Cuckoo', '103 mins', 'IIA', 'Cantonese', 'Patrick Kong', 'During the day of the handover of Macau in 1999, Man-Cho (Chi Lam Cheung), Kiki (Joe Chen) and a group of neighbors were celebrating with Aunty Q (Nancy Sit) for her birthday. Kwan-Ho migrates to US for..', 'movie001.jpg'),
(2, 'Suffragette', '106 mins', 'IIA', 'English', 'Sarah Gavron', 'The foot soldiers of the early feminist movement, women who were forced underground to pursue a dangerous game of cat and mouse with an increasingly brutal State...', 'movie002.jpg'),
(3, 'She Remembers, He Forgets', '110 mins', 'IIA', 'Cantonese', 'Adam Wong', 'Unfulfilled at work and dissatisfied with her marital life, a middle-aged woman attends a high school reunion and finds a floodgate of flashbacks of her salad days open before her mind eyes...', 'P3.png'),
(4, 'Spectre', '148 mins', 'IIB', 'English', 'Sam Mendes', 'A cryptic message from the past sends James Bond on a rogue mission to Mexico City and eventually Rome, where he meets Lucia Sciarra (Monica Bellucci), the beautiful and forbidden widow of an infamous criminal...', 'movie004.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

CREATE TABLE `house` (
  `HouseId` int(100) NOT NULL,
  `HouseRow` varchar(100) NOT NULL,
  `HouseCol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `house`
--

INSERT INTO `house` (`HouseId`, `HouseRow`, `HouseCol`) VALUES
(1, '5', '5'),
(2, '6', '5'),
(3, '4', '7');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `UserId` varchar(100) NOT NULL,
  `PW` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`UserId`, `PW`) VALUES
('', ''),
('brahmnoor', 'singh123'),
('bestie', 'coolsie123'),
('Anupa1097', 'Anupa1097'),
('ANUPA1097', 'ANUPA1097'),
('anupa97', 'anupa1097'),
('Rishi123', 'rishabh123');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `TicketId` int(100) NOT NULL,
  `SeatRow` int(11) NOT NULL,
  `SeatCol` int(11) NOT NULL,
  `BroadCastId` int(100) NOT NULL,
  `Valid` varchar(100) NOT NULL,
  `UserId` varchar(100) NOT NULL,
  `TicketType` varchar(100) NOT NULL,
  `TicketFee` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`TicketId`, `SeatRow`, `SeatCol`, `BroadCastId`, `Valid`, `UserId`, `TicketType`, `TicketFee`) VALUES
(3, 5, 3, 1, 'YES', 'brahmnoor', 'Adult', '75'),
(4, 4, 4, 1, 'YES', 'brahmnoor', 'Student/Senior', '50'),
(5, 1, 5, 2, 'YES', 'brahmnoor', 'Student/Senior', '50'),
(6, 5, 4, 1, 'YES', 'ANUPA1097', 'Student/Senior', '50'),
(7, 4, 2, 1, 'YES', 'ANUPA1097', 'Student/Senior', '50'),
(8, 4, 3, 1, 'YES', 'ANUPA1097', 'Student/Senior', '50'),
(9, 6, 1, 4, 'YES', 'ANUPA1097', 'Adult', '75'),
(10, 6, 5, 4, 'YES', 'ANUPA1097', 'Adult', '75'),
(11, 4, 3, 4, 'YES', 'ANUPA1097', 'Adult', '75'),
(12, 4, 4, 4, 'YES', 'ANUPA1097', 'Adult', '75'),
(13, 3, 1, 4, 'YES', 'ANUPA1097', 'Adult', '75'),
(14, 3, 2, 4, 'YES', 'ANUPA1097', 'Adult', '75'),
(15, 3, 3, 4, 'YES', 'ANUPA1097', 'Adult', '75'),
(16, 2, 3, 4, 'YES', 'ANUPA1097', 'Adult', '75'),
(17, 2, 5, 4, 'YES', 'ANUPA1097', 'Adult', '75'),
(18, 1, 1, 4, 'YES', 'ANUPA1097', 'Adult', '75'),
(19, 1, 2, 4, 'YES', 'ANUPA1097', 'Adult', '75'),
(20, 3, 3, 1, 'YES', 'brahmnoor', 'Adult', '75'),
(21, 2, 4, 1, 'YES', 'brahmnoor', 'Adult', '75'),
(22, 5, 1, 6, 'YES', 'anupa97', 'Adult', '75'),
(23, 4, 2, 6, 'YES', 'anupa97', 'Student/Senior', '50'),
(24, 1, 4, 1, 'YES', 'anupa97', 'Adult', '75'),
(25, 2, 3, 6, 'YES', 'Rishi123', 'Adult', '75');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `broadcast`
--
ALTER TABLE `broadcast`
  ADD PRIMARY KEY (`BroadCastId`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentId`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`FilmId`);

--
-- Indexes for table `house`
--
ALTER TABLE `house`
  ADD PRIMARY KEY (`HouseId`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`TicketId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `broadcast`
--
ALTER TABLE `broadcast`
  MODIFY `BroadCastId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `FilmId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `house`
--
ALTER TABLE `house`
  MODIFY `HouseId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `TicketId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
