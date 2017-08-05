-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1build0.15.04.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2017 at 03:36 PM
-- Server version: 5.6.28-0ubuntu0.15.04.1
-- PHP Version: 5.6.4-4ubuntu6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `plateau_farmers`
--

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE IF NOT EXISTS `farmers` (
`id` int(10) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `othernames` varchar(200) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `number_of_hectares` varchar(200) DEFAULT NULL,
  `land_texture` varchar(200) NOT NULL,
  `number_of_acres` varchar(200) NOT NULL,
  `product_yield` varchar(200) NOT NULL,
  `geolocation` varchar(200) DEFAULT NULL,
  `earning` varchar(200) NOT NULL,
  `challenges` varchar(200) NOT NULL,
  `farming_method` varchar(200) NOT NULL,
  `LGA_id` int(10) NOT NULL,
  `ward_id` int(10) NOT NULL,
  `farmcat_id` int(10) NOT NULL,
  `farmtype_id` int(10) NOT NULL,
  `fertilizer_quant_requested` varchar(200) NOT NULL,
  `fertilizer_collected` varchar(200) DEFAULT NULL,
  `amount_paid` varchar(200) DEFAULT NULL,
  `barcode_info` varchar(200) NOT NULL,
  `extension_agent_id` int(10) unsigned NOT NULL,
  `time_registered` datetime NOT NULL,
  `fertilizer_collected_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`id`, `surname`, `othernames`, `picture`, `address`, `phone_number`, `email`, `number_of_hectares`, `land_texture`, `number_of_acres`, `product_yield`, `geolocation`, `earning`, `challenges`, `farming_method`, `LGA_id`, `ward_id`, `farmcat_id`, `farmtype_id`, `fertilizer_quant_requested`, `fertilizer_collected`, `amount_paid`, `barcode_info`, `extension_agent_id`, `time_registered`, `fertilizer_collected_time`) VALUES
(1, 'mad', 'kill', 'ab.jpg', 'jos', '099876543', '', '20', 'Sandy', '4', '100 bags', 'bassa', '2mil', 'inadaquate man', 'mechanized', 2, 4, 1, 5, '', NULL, NULL, '017202857837', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'sly', 'dung', 'dc.jpg', 'mangu', '0989876666667', '', '45', 'sandy', '10', '70', 'mangu', '7809876', 'insufficient funds', 'local', 3, 1, 2, 1, '', NULL, NULL, '226439456045', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Shekina', 'Deldy', '1461008745_shekinah smile.jpg', 'Lamingo', '0875435', '', '132435647', 'loamy', '34557', '600', 'lamingo', '800000', 'insufficient fertilizer', 'mechanized', 4, 8, 1, 5, '', NULL, NULL, '123456789012', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
