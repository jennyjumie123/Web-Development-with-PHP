-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2020 at 02:31 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medsoft`
--

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `card_id` int(11) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email` varchar(48) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(120) NOT NULL,
  `password` varchar(200) NOT NULL,
  `date_registered` varchar(24) NOT NULL,
  `department` varchar(30) NOT NULL,
  `symptom` varchar(24) NOT NULL,
  `details` varchar(800) NOT NULL,
  `assigned_doctor` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`card_id`, `first_name`, `last_name`, `email`, `phone`, `address`, `password`, `date_registered`, `department`, `symptom`, `details`, `assigned_doctor`) VALUES
(5, 'Jane', 'Emeka', 'j.emeka@earlycode.net', '080546464726', 'Garki 2, Abuja, FCT', 'password', 'Saturday, 18 Jul 2020', '', '', '', ''),
(6, 'Wale', 'Adenuga', 'w.ade@glo.ng', '0708853626125', 'Mike Adenuga Avenue, VI, Lagos state', 'password', 'Saturday, 18 Jul 2020', '', '', '', ''),
(8, 'Chukwuebuka', 'Simon', 'chukwu@yahoo.com', '080753626263', 'Wuye, Abuja', '12345678', 'Thursday, 23 Jul 2020', '', '', '', ''),
(9, 'James', 'Odumedu', 'james@aol.com', '090562514141', 'Asokoro, Abuja', '87654321', 'Thursday, 23 Jul 2020', '', '', '', ''),
(10, 'Joseph', 'Michael', 'joseph.ogbu@earlycode.net', '090562514141', 'P1-03', 'loveworld', 'Friday, 24 Jul 2020', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`card_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
