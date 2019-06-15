-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 15, 2019 at 07:11 PM
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
  `OS` varchar(200) NOT NULL DEFAULT 'unknown',
  `IP` varchar(100) NOT NULL,
  `MAC` varchar(100) NOT NULL DEFAULT 'unknown',
  `mac_vendor` varchar(100) NOT NULL DEFAULT 'unknown',
  `id_scanner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hosts`
--

INSERT INTO `hosts` (`id_host`, `OS`, `IP`, `MAC`, `mac_vendor`, `id_scanner`) VALUES
(285, 'unknown', '172.28.128.1', '0A:00:27:00:00:18', 'unknown', 111),
(286, 'unknown', '172.28.128.2', 'unknown', 'unknown', 111),
(287, 'Linux 3.10 - 4.11', '172.28.128.4', '08:00:27:48:64:BF', 'Oracle VirtualBox virtual NIC', 111),
(288, 'Microsoft Windows 7 SP0 - SP1, Windows Server 2008 SP1, Windows Server 2008 R2, Windows 8, or Windows 8.1 Update 1', '172.28.128.5', '08:00:27:5F:3A:EF', 'Oracle VirtualBox virtual NIC', 111),
(289, 'unknown', '172.28.128.3', 'unknown', 'unknown', 111),
(290, 'Linux 3.10 - 4.11', '172.28.128.4', '08:00:27:48:64:BF', 'Oracle VirtualBox virtual NIC', 113),
(308, 'Android 5.0 - 6.0.1 (Linux 3.4)', '192.168.43.1', '8E:F5:A3:77:2D:5D', '', 120),
(309, 'Microsoft Windows Longhorn', '192.168.43.21', 'AC:E0:10:C2:04:83', 'Liteon Technology', 120),
(310, 'Microsoft Windows Server 2008 SP1 or Windows Server 2008 R2', '192.168.43.118', 'F8:28:19:AA:43:B3', 'Liteon Technology', 120),
(311, 'unknown', '192.168.43.181', 'unknown', 'unknown', 120),
(312, 'unknown', '192.168.43.35', 'unknown', 'unknown', 120),
(378, 'unknown', '127.0.0.1', 'unknown', 'unknown', 121),
(396, 'Microsoft Windows 7 SP0 - SP1, Windows Server 2008 SP1, Windows Server 2008 R2, Windows 8, or Windows 8.1 Update 1', '172.28.128.5', '08:00:27:5F:3A:EF', 'Oracle VirtualBox virtual NIC', 114),
(399, 'unknown', '192.168.0.1', 'unknown', 'unknown', 140),
(400, 'unknown', '192.168.0.10', 'unknown', 'unknown', 140),
(401, 'unknown', '192.168.0.80', 'unknown', 'unknown', 140),
(402, 'unknown', '192.168.0.94', 'unknown', 'unknown', 140),
(403, 'unknown', '192.168.0.122', 'unknown', 'unknown', 140),
(404, 'unknown', '192.168.0.164', 'unknown', 'unknown', 140);

-- --------------------------------------------------------

--
-- Table structure for table `ports`
--

CREATE TABLE `ports` (
  `id_port` int(11) NOT NULL,
  `port_number` smallint(5) UNSIGNED NOT NULL,
  `protocol` enum('TCP','UDP') NOT NULL,
  `state` enum('open','closed','filtered','unfiltered','open/filtered','close/filtered') NOT NULL,
  `reason` varchar(100) NOT NULL,
  `service` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `version` varchar(100) NOT NULL,
  `extra` varchar(100) NOT NULL,
  `id_host` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ports`
--

INSERT INTO `ports` (`id_port`, `port_number`, `protocol`, `state`, `reason`, `service`, `product`, `version`, `extra`, `id_host`) VALUES
(5130, 137, 'UDP', 'open', 'udp-response', 'netbios-ns', 'Microsoft Windows netbios-ssn', ' ', 'workgroup: WORKGROUP', 285),
(5131, 21, 'TCP', 'open', 'syn-ack', 'ftp', 'ProFTPD', '1.3.5', ' ', 287),
(5132, 22, 'TCP', 'open', 'syn-ack', 'ssh', 'OpenSSH', '6.6.1p1 Ubuntu 2ubuntu2.10', 'Ubuntu Linux; protocol 2.0', 287),
(5133, 80, 'TCP', 'open', 'syn-ack', 'http', 'Apache httpd', '2.4.7', ' ', 287),
(5134, 445, 'TCP', 'open', 'syn-ack', 'netbios-ssn', 'Samba smbd', '3.X - 4.X', 'workgroup: WORKGROUP', 287),
(5135, 631, 'TCP', 'open', 'syn-ack', 'ipp', 'CUPS', '1.7', ' ', 287),
(5136, 3306, 'TCP', 'open', 'syn-ack', 'mysql', 'MySQL', ' ', 'unauthorized', 287),
(5137, 21, 'TCP', 'open', 'syn-ack', 'ftp', 'Microsoft ftpd', ' ', ' ', 288),
(5138, 22, 'TCP', 'open', 'syn-ack', 'ssh', 'OpenSSH', '7.1', 'protocol 2.0', 288),
(5139, 80, 'TCP', 'open', 'syn-ack', 'http', 'Microsoft IIS httpd', '7.5', ' ', 288),
(5140, 135, 'TCP', 'open', 'syn-ack', 'msrpc', 'Microsoft Windows RPC', ' ', ' ', 288),
(5141, 139, 'TCP', 'open', 'syn-ack', 'netbios-ssn', 'Microsoft Windows netbios-ssn', ' ', ' ', 288),
(5142, 445, 'TCP', 'open', 'syn-ack', 'microsoft-ds', 'Microsoft Windows Server 2008 R2 - 2012 microsoft-ds', ' ', ' ', 288),
(5143, 3306, 'TCP', 'open', 'syn-ack', 'mysql', 'MySQL', '5.5.20-log', ' ', 288),
(5144, 3389, 'TCP', 'closed', 'reset', 'ms-wbt-server', ' ', ' ', ' ', 288),
(5145, 8080, 'TCP', 'open', 'syn-ack', 'http', 'Sun GlassFish Open Source Edition', ' 4.0', ' ', 288),
(5146, 137, 'UDP', 'open', 'udp-response', 'netbios-ns', 'Microsoft Windows netbios-ns', ' ', 'workgroup: WORKGROUP', 288),
(5147, 21, 'TCP', 'open', 'syn-ack', 'ftp', 'ProFTPD', '1.3.5', ' ', 290),
(5148, 22, 'TCP', 'open', 'syn-ack', 'ssh', 'OpenSSH', '6.6.1p1 Ubuntu 2ubuntu2.10', 'Ubuntu Linux; protocol 2.0', 290),
(5149, 80, 'TCP', 'open', 'syn-ack', 'http', 'Apache httpd', '2.4.7', ' ', 290),
(5150, 445, 'TCP', 'open', 'syn-ack', 'netbios-ssn', 'Samba smbd', '3.X - 4.X', 'workgroup: WORKGROUP', 290),
(5151, 631, 'TCP', 'open', 'syn-ack', 'ipp', 'CUPS', '1.7', ' ', 290),
(5152, 3306, 'TCP', 'open', 'syn-ack', 'mysql', 'MySQL', ' ', 'unauthorized', 290),
(5208, 53, 'TCP', 'open', 'syn-ack', 'domain', ' ', ' ', 'unknown banner: Domain Name Server', 308),
(5209, 53, 'UDP', 'open', 'udp-response', 'domain', ' ', ' ', 'unknown banner: Domain Name Server', 308),
(5210, 135, 'TCP', 'open', 'syn-ack', 'msrpc', 'Microsoft Windows RPC', ' ', ' ', 309),
(5211, 445, 'TCP', 'open', 'syn-ack', 'microsoft-ds', 'Microsoft Windows 7 - 10 microsoft-ds', ' ', 'workgroup: WORKGROUP', 309),
(5212, 137, 'UDP', 'open', 'udp-response', 'netbios-ns', 'Microsoft Windows 10 netbios-ns', ' ', 'workgroup: WORKGROUP', 309),
(5213, 80, 'TCP', 'open', 'syn-ack', 'http', 'Microsoft HTTPAPI httpd', '2.0', 'SSDP/UPnP', 310),
(5214, 135, 'TCP', 'open', 'syn-ack', 'msrpc', 'Microsoft Windows RPC', ' ', ' ', 310),
(5215, 139, 'TCP', 'open', 'syn-ack', 'netbios-ssn', 'Microsoft Windows netbios-ssn', ' ', ' ', 310),
(5216, 443, 'TCP', 'open', 'syn-ack', 'http', 'Apache httpd', '2.4.29', '(Win32) OpenSSL/1.0.2n PHP/5.6.33', 310),
(5217, 445, 'TCP', 'open', 'syn-ack', 'microsoft-ds', ' ', ' ', ' ', 310),
(5218, 3306, 'TCP', 'open', 'syn-ack', 'mysql', 'MariaDB', ' ', 'unauthorized', 310),
(5219, 8080, 'TCP', 'open', 'syn-ack', 'http', 'Apache httpd', '2.4.29', '(Win32) OpenSSL/1.0.2n PHP/5.6.33', 310),
(5220, 137, 'UDP', 'open', 'udp-response', 'netbios-ns', 'Samba nmbd netbios-ns', ' ', 'workgroup: WORKGROUP', 310),
(5279, 21, 'TCP', 'open', 'syn-ack', 'ftp', 'Microsoft ftpd', ' ', ' ', 396),
(5280, 22, 'TCP', 'open', 'syn-ack', 'ssh', 'OpenSSH', '7.1', 'protocol 2.0', 396),
(5281, 80, 'TCP', 'open', 'syn-ack', 'http', 'Microsoft IIS httpd', '7.5', ' ', 396),
(5282, 135, 'TCP', 'open', 'syn-ack', 'msrpc', 'Microsoft Windows RPC', ' ', ' ', 396),
(5283, 139, 'TCP', 'open', 'syn-ack', 'netbios-ssn', 'Microsoft Windows netbios-ssn', ' ', ' ', 396),
(5284, 445, 'TCP', 'open', 'syn-ack', 'microsoft-ds', 'Microsoft Windows Server 2008 R2 - 2012 microsoft-ds', ' ', ' ', 396),
(5285, 3306, 'TCP', 'open', 'syn-ack', 'mysql', 'MySQL', '5.5.20-log', ' ', 396),
(5286, 3389, 'TCP', 'closed', 'reset', 'ms-wbt-server', ' ', ' ', ' ', 396),
(5287, 8080, 'TCP', 'open', 'syn-ack', 'http', 'Sun GlassFish Open Source Edition', ' 4.0', ' ', 396);

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
  `urg` tinyint(1) NOT NULL DEFAULT 0,
  `ack` tinyint(1) NOT NULL DEFAULT 0,
  `psh` tinyint(1) NOT NULL DEFAULT 0,
  `rst` tinyint(1) NOT NULL DEFAULT 0,
  `syn` tinyint(1) NOT NULL DEFAULT 0,
  `fin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scanners`
--

INSERT INTO `scanners` (`id_scanner`, `state`, `name`, `target`, `start`, `end`, `sS`, `sT`, `sU`, `sY`, `sN`, `sF`, `sX`, `sA`, `urg`, `ack`, `psh`, `rst`, `syn`, `fin`) VALUES
(111, 'FINISHED', 'scanner for 172.28.128.1/24 subnet', '172.28.128.1/24', '12:09:50 12-06-2019', '12:12:03 12-06-2019', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(113, 'FINISHED', 'scanner for .4 host', '172.28.128.4', '12:16:15 12-06-2019', '12:16:51 12-06-2019', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(114, 'FINISHED', 'scanner for .5 host', '172.28.128.5', '18:45:40 15-06-2019', '18:46:15 15-06-2019', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(120, 'FINISHED', 'scanner for android Ap', '192.168.43.1/24', '14:26:51 12-06-2019', '14:29:18 12-06-2019', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(121, 'FINISHED', 'test scan loopback address', '127.0.0.1', '14:48:43 15-06-2019', '14:48:54 15-06-2019', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(122, 'FINISHED', 'scanner for Dimi s AP', '192.168.43.1/24', '18:01:04 15-06-2019', '18:01:06 15-06-2019', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(140, 'FINISHED', 'Home scanner', '192.168.0.1/24', '18:48:13 15-06-2019', '19:00:46 15-06-2019', 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vulnerabilities`
--

CREATE TABLE `vulnerabilities` (
  `id_cve` varchar(20) NOT NULL,
  `link` varchar(100) NOT NULL,
  `score` decimal(3,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vulnerabilities`
--

INSERT INTO `vulnerabilities` (`id_cve`, `link`, `score`) VALUES
('CVE-2010-1256', 'https://vulners.com/cve/CVE-2010-1256\n', '8.5'),
('CVE-2010-1899', 'https://vulners.com/cve/CVE-2010-1899\n', '4.3'),
('CVE-2010-2730', 'https://vulners.com/cve/CVE-2010-2730\n', '9.3'),
('CVE-2010-3972', 'https://vulners.com/cve/CVE-2010-3972\n', '10.0'),
('CVE-2012-2531', 'https://vulners.com/cve/CVE-2012-2531', '2.1'),
('CVE-2013-4359', 'https://vulners.com/cve/CVE-2013-4359', '5.0'),
('CVE-2013-6891', 'https://vulners.com/cve/CVE-2013-6891', '1.2'),
('CVE-2014-0117', 'https://vulners.com/cve/CVE-2014-0117\n', '4.3'),
('CVE-2014-0118', 'https://vulners.com/cve/CVE-2014-0118\n', '4.3'),
('CVE-2014-0226', 'https://vulners.com/cve/CVE-2014-0226\n', '6.8'),
('CVE-2014-0231', 'https://vulners.com/cve/CVE-2014-0231\n', '5.0'),
('CVE-2014-2856', 'https://vulners.com/cve/CVE-2014-2856\n', '4.3'),
('CVE-2014-3523', 'https://vulners.com/cve/CVE-2014-3523\n', '5.0'),
('CVE-2014-3537', 'https://vulners.com/cve/CVE-2014-3537\n', '1.2'),
('CVE-2014-5030', 'https://vulners.com/cve/CVE-2014-5030\n', '1.9'),
('CVE-2014-5031', 'https://vulners.com/cve/CVE-2014-5031\n', '5.0'),
('CVE-2014-8109', 'https://vulners.com/cve/CVE-2014-8109\n', '4.3'),
('CVE-2015-3185', 'https://vulners.com/cve/CVE-2015-3185\n', '4.3'),
('CVE-2015-3306', 'https://vulners.com/cve/CVE-2015-3306\n', '10.0'),
('CVE-2016-0736', 'https://vulners.com/cve/CVE-2016-0736\n', '5.0'),
('CVE-2016-0777', 'https://vulners.com/cve/CVE-2016-0777', '4.0'),
('CVE-2016-0778', 'https://vulners.com/cve/CVE-2016-0778\n', '4.6'),
('CVE-2016-10708', 'https://vulners.com/cve/CVE-2016-10708\n', '5.0'),
('CVE-2016-1907', 'https://vulners.com/cve/CVE-2016-1907\n', '5.0'),
('CVE-2016-2161', 'https://vulners.com/cve/CVE-2016-2161\n', '5.0'),
('CVE-2016-4975', 'https://vulners.com/cve/CVE-2016-4975\n', '4.3'),
('CVE-2016-8612', 'https://vulners.com/cve/CVE-2016-8612', '3.3'),
('CVE-2016-8743', 'https://vulners.com/cve/CVE-2016-8743\n', '5.0'),
('CVE-2016-8858', 'https://vulners.com/cve/CVE-2016-8858\n', '7.8'),
('CVE-2017-15710', 'https://vulners.com/cve/CVE-2017-15710\n', '5.0'),
('CVE-2017-15715', 'https://vulners.com/cve/CVE-2017-15715\n', '6.8'),
('CVE-2017-15906', 'https://vulners.com/cve/CVE-2017-15906\n', '5.0'),
('CVE-2017-18190', 'https://vulners.com/cve/CVE-2017-18190\n', '5.0'),
('CVE-2017-18248', 'https://vulners.com/cve/CVE-2017-18248\n', '3.5'),
('CVE-2017-7679', 'https://vulners.com/cve/CVE-2017-7679\n', '7.5'),
('CVE-2017-9788', 'https://vulners.com/cve/CVE-2017-9788\n', '6.4'),
('CVE-2017-9798', 'https://vulners.com/cve/CVE-2017-9798\n', '5.0'),
('CVE-2018-11763', 'https://vulners.com/cve/CVE-2018-11763', '4.3'),
('CVE-2018-1283', 'https://vulners.com/cve/CVE-2018-1283\n', '3.5'),
('CVE-2018-1312', 'https://vulners.com/cve/CVE-2018-1312\n', '6.8'),
('CVE-2018-1333', 'https://vulners.com/cve/CVE-2018-1333\n', '5.0'),
('CVE-2018-15919', 'https://vulners.com/cve/CVE-2018-15919\n', '5.0'),
('CVE-2018-17199', 'https://vulners.com/cve/CVE-2018-17199\n', '5.0'),
('CVE-2018-4300', 'https://vulners.com/cve/CVE-2018-4300\n', '4.3'),
('CVE-2019-0211', 'https://vulners.com/cve/CVE-2019-0211\n', '7.2'),
('cve-test', 'test', '2.6');

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
-- Dumping data for table `vulnerabilities_list`
--

INSERT INTO `vulnerabilities_list` (`id`, `id_cve`, `id_port`) VALUES
(3860, 'CVE-2015-3306', 5131),
(3861, 'CVE-2013-4359', 5131),
(3862, 'CVE-2017-7679', 5133),
(3863, 'CVE-2014-0226', 5133),
(3864, 'CVE-2018-1312', 5133),
(3865, 'CVE-2017-15715', 5133),
(3866, 'CVE-2017-9788', 5133),
(3867, 'CVE-2014-0231', 5133),
(3868, 'CVE-2018-17199', 5133),
(3869, 'CVE-2017-15710', 5133),
(3870, 'CVE-2017-9798', 5133),
(3871, 'CVE-2016-8743', 5133),
(3872, 'CVE-2014-3523', 5133),
(3873, 'CVE-2016-0736', 5133),
(3874, 'CVE-2016-2161', 5133),
(3875, 'CVE-2016-4975', 5133),
(3876, 'CVE-2014-0117', 5133),
(3877, 'CVE-2014-8109', 5133),
(3878, 'CVE-2015-3185', 5133),
(3879, 'CVE-2014-0118', 5133),
(3880, 'CVE-2018-1283', 5133),
(3881, 'CVE-2016-8612', 5133),
(3882, 'CVE-2014-5031', 5135),
(3883, 'CVE-2017-18190', 5135),
(3884, 'CVE-2014-2856', 5135),
(3885, 'CVE-2018-4300', 5135),
(3886, 'CVE-2017-18248', 5135),
(3887, 'CVE-2014-5030', 5135),
(3888, 'CVE-2014-3537', 5135),
(3889, 'CVE-2013-6891', 5135),
(3890, 'CVE-2016-8858', 5138),
(3891, 'CVE-2016-1907', 5138),
(3892, 'CVE-2017-15906', 5138),
(3893, 'CVE-2016-10708', 5138),
(3894, 'CVE-2018-15919', 5138),
(3895, 'CVE-2016-0778', 5138),
(3896, 'CVE-2016-0777', 5138),
(3897, 'CVE-2010-3972', 5139),
(3898, 'CVE-2010-2730', 5139),
(3899, 'CVE-2010-1256', 5139),
(3900, 'CVE-2010-1899', 5139),
(3901, 'CVE-2012-2531', 5139),
(3902, 'CVE-2015-3306', 5147),
(3903, 'CVE-2013-4359', 5147),
(3904, 'CVE-2017-7679', 5149),
(3905, 'CVE-2014-0226', 5149),
(3906, 'CVE-2018-1312', 5149),
(3907, 'CVE-2017-15715', 5149),
(3908, 'CVE-2017-9788', 5149),
(3909, 'CVE-2014-0231', 5149),
(3910, 'CVE-2018-17199', 5149),
(3911, 'CVE-2017-15710', 5149),
(3912, 'CVE-2017-9798', 5149),
(3913, 'CVE-2016-8743', 5149),
(3914, 'CVE-2014-3523', 5149),
(3915, 'CVE-2016-0736', 5149),
(3916, 'CVE-2016-2161', 5149),
(3917, 'CVE-2016-4975', 5149),
(3918, 'CVE-2014-0117', 5149),
(3919, 'CVE-2014-8109', 5149),
(3920, 'CVE-2015-3185', 5149),
(3921, 'CVE-2014-0118', 5149),
(3922, 'CVE-2018-1283', 5149),
(3923, 'CVE-2016-8612', 5149),
(3924, 'CVE-2014-5031', 5151),
(3925, 'CVE-2017-18190', 5151),
(3926, 'CVE-2014-2856', 5151),
(3927, 'CVE-2018-4300', 5151),
(3928, 'CVE-2017-18248', 5151),
(3929, 'CVE-2014-5030', 5151),
(3930, 'CVE-2014-3537', 5151),
(3931, 'CVE-2013-6891', 5151),
(3966, 'CVE-2019-0211', 5216),
(3967, 'CVE-2017-15715', 5216),
(3968, 'CVE-2018-1312', 5216),
(3969, 'CVE-2018-1333', 5216),
(3970, 'CVE-2018-17199', 5216),
(3971, 'CVE-2017-15710', 5216),
(3972, 'CVE-2018-11763', 5216),
(3973, 'CVE-2018-1283', 5216),
(3974, 'CVE-2019-0211', 5219),
(3975, 'CVE-2017-15715', 5219),
(3976, 'CVE-2018-1312', 5219),
(3977, 'CVE-2018-1333', 5219),
(3978, 'CVE-2018-17199', 5219),
(3979, 'CVE-2017-15710', 5219),
(3980, 'CVE-2018-11763', 5219),
(3981, 'CVE-2018-1283', 5219),
(3994, 'CVE-2016-8858', 5280),
(3995, 'CVE-2016-1907', 5280),
(3996, 'CVE-2017-15906', 5280),
(3997, 'CVE-2016-10708', 5280),
(3998, 'CVE-2018-15919', 5280),
(3999, 'CVE-2016-0778', 5280),
(4000, 'CVE-2016-0777', 5280),
(4001, 'CVE-2010-3972', 5281),
(4002, 'CVE-2010-2730', 5281),
(4003, 'CVE-2010-1256', 5281),
(4004, 'CVE-2010-1899', 5281),
(4005, 'CVE-2012-2531', 5281);

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
  MODIFY `id_host` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=405;

--
-- AUTO_INCREMENT for table `ports`
--
ALTER TABLE `ports`
  MODIFY `id_port` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5288;

--
-- AUTO_INCREMENT for table `scanners`
--
ALTER TABLE `scanners`
  MODIFY `id_scanner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `vulnerabilities_list`
--
ALTER TABLE `vulnerabilities_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4006;

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
