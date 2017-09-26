-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2017 at 07:15 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19
-- Created By Shobhit

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `currency_master`
--

CREATE TABLE IF NOT EXISTS `currency_master` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency_master`
--

INSERT INTO `currency_master` (`id`, `name`, `status`) VALUES
(1, 'INR', 0),
(2, 'USD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id` int(11) NOT NULL,
  `pcode` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `currencyID` smallint(4) NOT NULL,
  `status` smallint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `pcode`, `quantity`, `price`, `currencyID`, `status`) VALUES
(8, 'A', 4, 7, 1, 1),
(12, 'B', 1, 12, 1, 1),
(14, 'C', 1, 1.25, 1, 1),
(15, 'C', 6, 6, 1, 1),
(16, 'D', 1, 0.15, 1, 1),
(18, 'A', 1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_matser`
--

CREATE TABLE IF NOT EXISTS `product_matser` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_matser`
--

INSERT INTO `product_matser` (`id`, `name`, `quantity`) VALUES
(1, 'Unitprice', '1'),
(2, 'Volumeprice ', '>1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currency_master`
--
ALTER TABLE `currency_master`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_matser`
--
ALTER TABLE `product_matser`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `product_matser`
--
ALTER TABLE `product_matser`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
