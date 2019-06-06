-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2019 at 10:08 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `visual-otp`
--

-- --------------------------------------------------------

--
-- Table structure for table `hosts`
--

CREATE TABLE `hosts` (
  `id_host` int(11) NOT NULL,
  `OS` varchar(100) NOT NULL,
  `IP` varchar(100) NOT NULL,
  `MAC` varchar(100) NOT NULL,
  `id_scanner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ports`
--

CREATE TABLE `ports` (
  `id_port` int(11) NOT NULL,
  `port_number` smallint(5) UNSIGNED NOT NULL,
  `protocol` enum('TCP','UDP') NOT NULL,
  `state` enum('open','close','filtered','unfiltered','open/filtered','close/filtered') NOT NULL,
  `reason` varchar(20) NOT NULL,
  `service` varchar(50) NOT NULL,
  `product` varchar(100) NOT NULL,
  `version` varchar(20) NOT NULL,
  `extra` varchar(100) NOT NULL,
  `id_host` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scanners`
--

CREATE TABLE `scanners` (
  `id_scanner` int(11) NOT NULL,
  `state` enum('READY','PROCESSING','FINISHED') NOT NULL,
  `name` varchar(150) NOT NULL,
  `target` varchar(20) NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `sS` tinyint(1) NOT NULL DEFAULT '0',
  `sT` tinyint(1) NOT NULL DEFAULT '0',
  `sU` tinyint(1) NOT NULL DEFAULT '0',
  `sY` tinyint(1) NOT NULL DEFAULT '0',
  `sN` tinyint(1) NOT NULL DEFAULT '0',
  `sF` tinyint(1) NOT NULL DEFAULT '0',
  `sX` tinyint(1) NOT NULL DEFAULT '0',
  `sA` tinyint(1) NOT NULL DEFAULT '0',
  `sW` tinyint(1) NOT NULL DEFAULT '0',
  `sM` tinyint(1) NOT NULL DEFAULT '0',
  `sO` tinyint(1) NOT NULL DEFAULT '0',
  `urg` tinyint(1) NOT NULL DEFAULT '0',
  `ack` tinyint(1) NOT NULL DEFAULT '0',
  `psh` tinyint(1) NOT NULL DEFAULT '0',
  `rst` tinyint(1) NOT NULL DEFAULT '0',
  `syn` tinyint(1) NOT NULL DEFAULT '0',
  `fin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scanners`
--

INSERT INTO `scanners` (`id_scanner`, `state`, `name`, `target`, `start`, `end`, `sS`, `sT`, `sU`, `sY`, `sN`, `sF`, `sX`, `sA`, `sW`, `sM`, `sO`, `urg`, `ack`, `psh`, `rst`, `syn`, `fin`) VALUES
(22, 'READY', 'Scanner of CApC', '172.16.10.1/24', NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vulnerabilities`
--

CREATE TABLE `vulnerabilities` (
  `id_cve` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `score` decimal(3,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vulnerabilities`
--

INSERT INTO `vulnerabilities` (`id_cve`, `description`, `score`) VALUES
('CVE-1', '', '7.5'),
('CVE-2', '', '6.0'),
('CVE-21', '', '8.6'),
('CVE-22', '', '10.0'),
('CVE-23', '', '10.0'),
('CVE-3', '', '4.5'),
('CVE-4', '', '2.0'),
('CVE-5', '', '6.0'),
('CVE-6', '', '9.2');

-- --------------------------------------------------------

--
-- Table structure for table `vulnerabilities_list`
--

CREATE TABLE `vulnerabilities_list` (
  `id` int(11) NOT NULL,
  `id_cve` varchar(20) NOT NULL,
  `id_port` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hosts`
--
ALTER TABLE `hosts`
  ADD PRIMARY KEY (`id_host`),
  ADD KEY `hosts_ibfk_1` (`id_scanner`);

--
-- Indexes for table `ports`
--
ALTER TABLE `ports`
  ADD PRIMARY KEY (`id_port`),
  ADD KEY `FK_PORTS_HOSTS` (`id_host`);

--
-- Indexes for table `scanners`
--
ALTER TABLE `scanners`
  ADD PRIMARY KEY (`id_scanner`);

--
-- Indexes for table `vulnerabilities`
--
ALTER TABLE `vulnerabilities`
  ADD PRIMARY KEY (`id_cve`);

--
-- Indexes for table `vulnerabilities_list`
--
ALTER TABLE `vulnerabilities_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vulnerabilities_list_ibfk_1` (`id_cve`),
  ADD KEY `vulnerabilities_list_ibfk_2` (`id_port`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hosts`
--
ALTER TABLE `hosts`
  MODIFY `id_host` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ports`
--
ALTER TABLE `ports`
  MODIFY `id_port` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `scanners`
--
ALTER TABLE `scanners`
  MODIFY `id_scanner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `vulnerabilities_list`
--
ALTER TABLE `vulnerabilities_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hosts`
--
ALTER TABLE `hosts`
  ADD CONSTRAINT `hosts_ibfk_1` FOREIGN KEY (`id_scanner`) REFERENCES `scanners` (`id_scanner`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ports`
--
ALTER TABLE `ports`
  ADD CONSTRAINT `FK_PORTS_HOSTS` FOREIGN KEY (`id_host`) REFERENCES `hosts` (`id_host`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vulnerabilities_list`
--
ALTER TABLE `vulnerabilities_list`
  ADD CONSTRAINT `vulnerabilities_list_ibfk_1` FOREIGN KEY (`id_cve`) REFERENCES `vulnerabilities` (`id_cve`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vulnerabilities_list_ibfk_2` FOREIGN KEY (`id_port`) REFERENCES `ports` (`id_port`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
