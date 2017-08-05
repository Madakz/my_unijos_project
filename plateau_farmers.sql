-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1build0.15.04.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 22, 2017 at 09:26 AM
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
-- Table structure for table `extension_agent`
--

CREATE TABLE IF NOT EXISTS `extension_agent` (
`id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `LGA_id` int(10) unsigned NOT NULL,
  `ward_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `extension_agent`
--

INSERT INTO `extension_agent` (`id`, `name`, `email`, `username`, `password`, `LGA_id`, `ward_id`) VALUES
(5, 'Madaxv', 'g@opg.com', 'pop', 'kkk', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE IF NOT EXISTS `farmers` (
`id` int(10) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `othernames` varchar(100) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `soil_type` varchar(100) NOT NULL,
  `plot_size` varchar(100) NOT NULL,
  `product_yield` varchar(100) NOT NULL,
  `geolocation` varchar(100) DEFAULT NULL,
  `earning` varchar(100) DEFAULT NULL,
  `challenges` varchar(200) DEFAULT NULL,
  `farming_method` varchar(100) NOT NULL,
  `LGA_id` int(10) NOT NULL,
  `ward_id` int(10) NOT NULL,
  `farmcat_id` int(10) NOT NULL,
  `farmtype_id` int(10) NOT NULL,
  `status` int(2) unsigned NOT NULL,
  `fertilizer_quantity_requested` varchar(100) NOT NULL,
  `fertilizer_quantity_collected` varchar(100) DEFAULT NULL,
  `amount_paid` varchar(100) DEFAULT NULL,
  `balance` varchar(100) DEFAULT NULL,
  `barcode_info` varchar(100) NOT NULL,
  `extension_agent_id` varchar(100) NOT NULL,
  `time_registered` varchar(100) NOT NULL,
  `fertilizer_collected_time` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`id`, `surname`, `othernames`, `picture`, `address`, `phone_number`, `email`, `soil_type`, `plot_size`, `product_yield`, `geolocation`, `earning`, `challenges`, `farming_method`, `LGA_id`, `ward_id`, `farmcat_id`, `farmtype_id`, `status`, `fertilizer_quantity_requested`, `fertilizer_quantity_collected`, `amount_paid`, `balance`, `barcode_info`, `extension_agent_id`, `time_registered`, `fertilizer_collected_time`) VALUES
(4, 'Madaki', 'Queen', '1489179739_102220.jpg', 'abj', '08176654353', 'email@example.com', 'sandy', '2 plots', '50', 'north', '200000', 'power implement', 'manual', 1, 1, 1, 5, 0, '20', '20', '100000', '0', '7ST5PW962V', '5', '0000-00-00 00:00:00', '12 03 2017 10:27:11'),
(6, 'Joshua', 'Esther', '1489216688_IMG0258A.jpg', 'twad', '08134568899', 'email@example.com', 'sandy', '2 plots', '50 bags', 'south', '500', 'fulani', 'manual', 1, 2, 2, 3, 0, '20 bags', '0', '100000', '0', '0G4AR08134568899', '', '11 03 2017 08:18:08', '0000-00-00 00:00:00'),
(9, 'Gochin', 'MaXWELL', '1489758151_205391_309157709180825_2003991257_n.jpg', 'FGFGFGFGGF', '07038243154', 'madakifatsen@yahoo.com', 'CLAY', '5', '5666', 'SOUTH', '100000', 'inadequate man power', 'MANUAL', 1, 1, 1, 6, 0, '50', '50', '100000', '0', '3DW2Z07038243154', '5', '17 03 2017 02:42:31', '17 03 2017 02:45:15'),
(10, 'MADAKI', 'FATSEN', '1489758776_madaki Fatsen.jpg', 'NEW LAYOUT BOKKOS', '07032807741', 'madakifatsen@yahoo.com', 'loamy', '5', '100', 'north', '700000', 'inadequate man power', 'MANUAL', 3, 6, 1, 4, 0, '30', '0', '120000', '0', '0I9OZ07032807741', '5', '17 03 2017 02:52:56', '00 00 0000 0:0:0'),
(11, 'mad', 'kill', '1490029559_spaceapp.jpg', 'rshfjdj', '08177699656', 'd@h.com', 'loamy', '3', '34', 'east', '500', 'inadequate man power', 'manual', 1, 1, 1, 2, 0, '20', '0', '100000', '0', '62DAG08177699656', 'madakifatsen@gmail.com', '20 03 2017 06:05:59', '00 00 0000 0:0:0'),
(12, 'MADAKI', 'FATSEN TIMON', '1490039827_madaki Fatsen.jpg', 'Behind the kings palace, Gwande', '08060573186', 'madakifatsen@gmail.com', 'loamy', '5 plots', '70', 'SOUTH', '600000', 'Insufficient Fertilizer', 'manual', 3, 12, 1, 4, 0, '20', '0', '120000', '20000', 'IJQC708060573186', '', '20 03 2017 08:57:07', '00 00 0000 0:0:0'),
(13, 'reko', 'amina', '1490044636_2347066576120.jpg', 'gte', '08135456466', 'mad@gmail.com', 'sandy', '2', '56', 'east', '500', 'inadequate man power', 'MANUAL', 1, 1, 2, 7, 0, '20', '20', '100000', '0', 'XKCJL08135456466', '5', '20 03 2017 10:17:16', '20 03 2017 10:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `farming_category`
--

CREATE TABLE IF NOT EXISTS `farming_category` (
`id` int(10) NOT NULL,
  `farm_category_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farming_category`
--

INSERT INTO `farming_category` (`id`, `farm_category_name`) VALUES
(1, 'Cash Crops'),
(2, 'Animal');

-- --------------------------------------------------------

--
-- Table structure for table `farm_type`
--

CREATE TABLE IF NOT EXISTS `farm_type` (
`id` int(10) NOT NULL,
  `farm_type_name` varchar(200) NOT NULL,
  `farm_cat_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farm_type`
--

INSERT INTO `farm_type` (`id`, `farm_type_name`, `farm_cat_id`) VALUES
(1, 'cattle', 2),
(2, 'rice', 1),
(3, 'rabbit', 2),
(4, 'maize', 1),
(5, 'potato', 1),
(6, 'tomato', 1),
(7, 'poultry', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fertilizer_charge`
--

CREATE TABLE IF NOT EXISTS `fertilizer_charge` (
`id` int(10) unsigned NOT NULL,
  `amount` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fertilizer_charge`
--

INSERT INTO `fertilizer_charge` (`id`, `amount`) VALUES
(1, '7000');

-- --------------------------------------------------------

--
-- Table structure for table `localgovtArea`
--

CREATE TABLE IF NOT EXISTS `localgovtArea` (
`id` int(10) NOT NULL,
  `lga_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `localgovtArea`
--

INSERT INTO `localgovtArea` (`id`, `lga_name`) VALUES
(1, 'Barkin Ladi'),
(2, 'Bassa'),
(3, 'Bokkos'),
(4, 'Jos East'),
(5, 'Jos North'),
(6, 'Jos South'),
(7, 'Kanam'),
(8, 'Kanke'),
(9, 'Langtang North'),
(10, 'Langtang South'),
(11, 'Mangu'),
(12, 'Mikang'),
(13, 'Pankshin'),
(14, 'Quaan Pan'),
(15, 'Riyom'),
(16, 'Shendam'),
(17, 'Wase');

-- --------------------------------------------------------

--
-- Table structure for table `ward`
--

CREATE TABLE IF NOT EXISTS `ward` (
`id` int(10) NOT NULL,
  `ward_name` varchar(100) NOT NULL,
  `LGA_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward`
--

INSERT INTO `ward` (`id`, `ward_name`, `LGA_id`) VALUES
(1, 'A', 1),
(2, 'B', 1),
(3, 'C', 2),
(4, 'D', 2),
(5, 'E', 2),
(6, 'F', 3),
(7, 'G', 3),
(8, 'H', 4),
(9, 'fdgh', 4),
(10, 'Fgfhj', 5),
(11, 'rtyu', 5),
(12, 'Gwande', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `extension_agent`
--
ALTER TABLE `extension_agent`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farming_category`
--
ALTER TABLE `farming_category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farm_type`
--
ALTER TABLE `farm_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fertilizer_charge`
--
ALTER TABLE `fertilizer_charge`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `localgovtArea`
--
ALTER TABLE `localgovtArea`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ward`
--
ALTER TABLE `ward`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `extension_agent`
--
ALTER TABLE `extension_agent`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `farming_category`
--
ALTER TABLE `farming_category`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `farm_type`
--
ALTER TABLE `farm_type`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `fertilizer_charge`
--
ALTER TABLE `fertilizer_charge`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `localgovtArea`
--
ALTER TABLE `localgovtArea`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `ward`
--
ALTER TABLE `ward`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
