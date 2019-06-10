-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 10, 2019 at 11:25 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

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
  `OS` varchar(200) NOT NULL,
  `IP` varchar(100) NOT NULL,
  `MAC` varchar(100) NOT NULL,
  `mac_vendor` varchar(100) NOT NULL,
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
  `reason` varchar(100) NOT NULL,
  `service` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `version` varchar(100) NOT NULL,
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
  `target` varchar(50) NOT NULL,
  `start` varchar(50) DEFAULT NULL,
  `end` varchar(50) DEFAULT NULL,
  `sS` tinyint(1) NOT NULL DEFAULT 0,
  `sT` tinyint(1) NOT NULL DEFAULT 0,
  `sU` tinyint(1) NOT NULL DEFAULT 0,
  `sY` tinyint(1) NOT NULL DEFAULT 0,
  `sN` tinyint(1) NOT NULL DEFAULT 0,
  `sF` tinyint(1) NOT NULL DEFAULT 0,
  `sX` tinyint(1) NOT NULL DEFAULT 0,
  `sA` tinyint(1) NOT NULL DEFAULT 0,
  `sW` tinyint(1) NOT NULL DEFAULT 0,
  `sM` tinyint(1) NOT NULL DEFAULT 0,
  `sO` tinyint(1) NOT NULL DEFAULT 0,
  `urg` tinyint(1) NOT NULL DEFAULT 0,
  `ack` tinyint(1) NOT NULL DEFAULT 0,
  `psh` tinyint(1) NOT NULL DEFAULT 0,
  `rst` tinyint(1) NOT NULL DEFAULT 0,
  `syn` tinyint(1) NOT NULL DEFAULT 0,
  `fin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vulnerabilities`
--

CREATE TABLE `vulnerabilities` (
  `id_cve` varchar(20) NOT NULL,
  `description` varchar(600) NOT NULL,
  `score` decimal(3,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vulnerabilities`
--

INSERT INTO `vulnerabilities` (`id_cve`, `description`, `score`) VALUES
('CVE-2011-3368', 'The mod_proxy module in the Apache HTTP Server 1.3.x through 1.3.42, 2.0.x through 2.0.64, and 2.2.x through 2.2.21 does not properly interact with use of (1) RewriteRule and (2) ProxyPassMatch pattern matches for configuration of a reverse proxy, which allows remote attackers to send requests to intranet servers via a malformed URI containing an initial @ (at sign) character.', '5.0'),
('CVE-2011-3607', 'Integer overflow in the ap_pregsub function in server/util.c in the Apache HTTP Server 2.0.x through 2.0.64 and 2.2.x through 2.2.21, when the mod_setenvif module is enabled, allows local users to gain privileges via a .htaccess file with a crafted SetEnvIf directive, in conjunction with a crafted HTTP request header, leading to a heap-based buffer overflow.', '4.4'),
('CVE-2011-4317', 'The mod_proxy module in the Apache HTTP Server 1.3.x through 1.3.42, 2.0.x through 2.0.64, and 2.2.x through 2.2.21, when the Revision 1179239 patch is in place, does not properly interact with use of (1) RewriteRule and (2) ProxyPassMatch pattern matches for configuration of a reverse proxy, which allows remote attackers to send requests to intranet servers via a malformed URI containing an @ (at sign) character and a : (colon) character in invalid positions.  NOTE: this vulnerability exists be', '4.3'),
('CVE-2011-4415', 'The ap_pregsub function in server/util.c in the Apache HTTP Server 2.0.x through 2.0.64 and 2.2.x through 2.2.21, when the mod_setenvif module is enabled, does not restrict the size of values of environment variables, which allows local users to cause a denial of service (memory consumption or NULL pointer dereference) via a .htaccess file with a crafted SetEnvIf directive, in conjunction with a crafted HTTP request header, related to (1) the &quot;len +=&quot; statement and (2) the apr_pcalloc function call, a different vulnerability than CVE-2011-3607.', '1.2'),
('CVE-2012-0021', 'The log_cookie function in mod_log_config.c in the mod_log_config module in the Apache HTTP Server 2.2.17 through 2.2.21, when a threaded MPM is used, does not properly handle a %{}C format string, which allows remote attackers to cause a denial of service (daemon crash) via a cookie that lacks both a name and a value.', '2.6'),
('CVE-2012-0053', '', '4.3'),
('CVE-2012-0883', '', '6.9'),
('CVE-2012-2687', '', '2.6'),
('CVE-2012-3499', '', '4.3'),
('CVE-2012-4557', '', '5.0'),
('CVE-2012-4558', '', '4.3'),
('CVE-2013-1862', '', '5.1'),
('CVE-2013-1896', '', '4.3'),
('CVE-2013-2249', '', '7.5'),
('CVE-2013-4359', '', '5.0'),
('CVE-2013-6438', '', '5.0'),
('CVE-2013-6891', '', '1.2'),
('CVE-2014-0098', '', '5.0'),
('CVE-2014-0117', '', '4.3'),
('CVE-2014-0118', '', '4.3'),
('CVE-2014-0226', '', '6.8'),
('CVE-2014-0231', '', '5.0'),
('CVE-2014-2856', '', '4.3'),
('CVE-2014-3523', '', '5.0'),
('CVE-2014-3537', '', '1.2'),
('CVE-2014-5030', '', '1.9'),
('CVE-2014-5031', '', '5.0'),
('CVE-2014-8109', '', '4.3'),
('CVE-2015-3185', '', '4.3'),
('CVE-2015-3306', '', '10.0'),
('CVE-2016-0736', '', '5.0'),
('CVE-2016-0777', '', '4.0'),
('CVE-2016-0778', '', '4.6'),
('CVE-2016-10708', '', '5.0'),
('CVE-2016-1907', '', '5.0'),
('CVE-2016-2161', '', '5.0'),
('CVE-2016-4975', '', '4.3'),
('CVE-2016-8612', '', '3.3'),
('CVE-2016-8743', '', '5.0'),
('CVE-2016-8858', '', '7.8'),
('CVE-2017-15710', '', '5.0'),
('CVE-2017-15715', '', '6.8'),
('CVE-2017-15906', '', '5.0'),
('CVE-2017-18190', '', '5.0'),
('CVE-2017-18248', '', '3.5'),
('CVE-2017-3167', '', '7.5'),
('CVE-2017-3169', '', '7.5'),
('CVE-2017-7668', '', '7.5'),
('CVE-2017-7679', '', '7.5'),
('CVE-2017-9798', '', '5.0'),
('CVE-2018-1283', '', '3.5'),
('CVE-2018-1312', '', '6.8'),
('CVE-2018-15919', '', '5.0'),
('CVE-2018-16395', '', '7.5'),
('CVE-2018-16396', '', '6.8'),
('CVE-2018-17199', '', '5.0'),
('CVE-2018-4300', '', '4.3');

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
  MODIFY `id_host` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `ports`
--
ALTER TABLE `ports`
  MODIFY `id_port` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3644;

--
-- AUTO_INCREMENT for table `scanners`
--
ALTER TABLE `scanners`
  MODIFY `id_scanner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `vulnerabilities_list`
--
ALTER TABLE `vulnerabilities_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2108;

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
