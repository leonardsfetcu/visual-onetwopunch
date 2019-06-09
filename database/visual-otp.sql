-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: iun. 09, 2019 la 08:14 PM
-- Versiune server: 10.3.15-MariaDB
-- Versiune PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `visual-otp`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `hosts`
--

CREATE TABLE `hosts` (
  `id_host` int(11) NOT NULL,
  `OS` varchar(200) NOT NULL,
  `IP` varchar(100) NOT NULL,
  `MAC` varchar(100) NOT NULL,
  `mac_vendor` varchar(50) NOT NULL,
  `id_scanner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `hosts`
--

INSERT INTO `hosts` (`id_host`, `OS`, `IP`, `MAC`, `mac_vendor`, `id_scanner`) VALUES
(81, 'Microsoft Windows 7 SP0 - SP1, Windows Server 2008 SP1, Windows Server 2008 R2, Windows 8, or Windows 8.1 Update 1', '172.28.128.3', '08:00:27:5F:3A:EF', 'Oracle VirtualBox virtual NIC', 46),
(82, 'Linux 3.2 - 4.9', '172.28.128.4', '08:00:27:48:64:BF', 'Oracle VirtualBox virtual NIC', 46);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `ports`
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

--
-- Eliminarea datelor din tabel `ports`
--

INSERT INTO `ports` (`id_port`, `port_number`, `protocol`, `state`, `reason`, `service`, `product`, `version`, `extra`, `id_host`) VALUES
(2350, 21, 'TCP', 'open', 'syn-ack', 'ftp', 'Microsoft ftpd', '', '', 81),
(2351, 22, 'TCP', 'open', 'syn-ack', 'ssh', 'OpenSSH', '7.1', 'protocol 2.0', 81),
(2352, 80, 'TCP', 'open', 'syn-ack', 'http', 'Microsoft HTTPAPI httpd', '2.0', 'SSDP/UPnP', 81),
(2353, 135, 'TCP', 'open', 'syn-ack', 'msrpc', 'Microsoft Windows RPC', '', '', 81),
(2354, 139, 'TCP', 'open', 'syn-ack', 'netbios-ssn', 'Microsoft Windows netbios-ssn', '', '', 81),
(2355, 445, 'TCP', 'open', 'syn-ack', 'microsoft-ds', 'Microsoft Windows Server 2008 R2 - 2012 microsoft-ds', '', '', 81),
(2356, 1617, 'TCP', 'open', 'syn-ack', 'rmiregistry', 'Java RMI', '', '', 81),
(2357, 3306, 'TCP', 'open', 'syn-ack', 'mysql', 'MySQL', '5.5.20-log', '', 81),
(2358, 3389, 'TCP', 'open', 'syn-ack', 'tcpwrapped', '', '', '', 81),
(2359, 3700, 'TCP', 'open', 'syn-ack', 'giop', 'CORBA naming service', '', '', 81),
(2360, 4848, 'TCP', 'open', 'syn-ack', 'appserv-http', '', '', '', 81),
(2361, 5985, 'TCP', 'open', 'syn-ack', 'http', 'Microsoft HTTPAPI httpd', '2.0', 'SSDP/UPnP', 81),
(2362, 7676, 'TCP', 'open', 'syn-ack', 'java-message-service', 'Java Message Service', '301', '', 81),
(2363, 8009, 'TCP', 'open', 'syn-ack', 'ajp13', 'Apache Jserv', '', 'Protocol v1.3', 81),
(2364, 8019, 'TCP', 'open', 'syn-ack', 'qbdb', '', '', '', 81),
(2365, 8020, 'TCP', 'open', 'syn-ack', 'http', 'Apache httpd', '', '', 81),
(2366, 8022, 'TCP', 'open', 'syn-ack', 'http', 'Apache Tomcat/Coyote JSP engine', '1.1', '', 81),
(2367, 8027, 'TCP', 'open', 'syn-ack', '', '', '', '', 81),
(2368, 8028, 'TCP', 'open', 'syn-ack', 'postgresql', 'PostgreSQL DB', '', '', 81),
(2369, 8031, 'TCP', 'open', 'syn-ack', 'unknown', '', '', '', 81),
(2370, 8032, 'TCP', 'open', 'syn-ack', 'desktop-central', 'ManageEngine Desktop Central DesktopCentralServer', '', '', 81),
(2371, 8080, 'TCP', 'open', 'syn-ack', 'http', 'Sun GlassFish Open Source Edition', ' 4.0', '', 81),
(2372, 8181, 'TCP', 'open', 'syn-ack', 'intermapper', '', '', '', 81),
(2373, 8282, 'TCP', 'open', 'syn-ack', 'http', 'Apache Tomcat/Coyote JSP engine', '1.1', '', 81),
(2374, 8383, 'TCP', 'open', 'syn-ack', 'http', 'Apache httpd', '', '', 81),
(2375, 8443, 'TCP', 'open', 'syn-ack', 'https-alt', '', '', '', 81),
(2376, 8444, 'TCP', 'open', 'syn-ack', 'desktop-central', 'ManageEngine Desktop Central DesktopCentralServer', '', '', 81),
(2377, 8484, 'TCP', 'open', 'syn-ack', 'http', 'Jetty', 'winstone-2.8', '', 81),
(2378, 8585, 'TCP', 'open', 'syn-ack', 'http', 'Apache httpd', '2.2.21', '(Win64) PHP/5.3.10 DAV/2', 81),
(2379, 8686, 'TCP', 'open', 'syn-ack', 'rmiregistry', 'Java RMI', '', '', 81),
(2380, 9200, 'TCP', 'open', 'syn-ack', 'http', 'Elasticsearch REST API', '1.1.1', 'name: Warstrike; Lucene 4.7', 81),
(2381, 9300, 'TCP', 'open', 'syn-ack', 'vrace', '', '', '', 81),
(2382, 47001, 'TCP', 'open', 'syn-ack', 'http', 'Microsoft HTTPAPI httpd', '2.0', 'SSDP/UPnP', 81),
(2383, 49152, 'TCP', 'open', 'syn-ack', 'msrpc', 'Microsoft Windows RPC', '', '', 81),
(2384, 49153, 'TCP', 'open', 'syn-ack', 'msrpc', 'Microsoft Windows RPC', '', '', 81),
(2385, 49154, 'TCP', 'open', 'syn-ack', 'msrpc', 'Microsoft Windows RPC', '', '', 81),
(2386, 49155, 'TCP', 'open', 'syn-ack', 'msrpc', 'Microsoft Windows RPC', '', '', 81),
(2387, 49156, 'TCP', 'open', 'syn-ack', 'unknown', '', '', '', 81),
(2388, 49165, 'TCP', 'open', 'syn-ack', 'rmiregistry', 'Java RMI', '', '', 81),
(2389, 49169, 'TCP', 'open', 'syn-ack', 'unknown', '', '', '', 81),
(2390, 49209, 'TCP', 'open', 'syn-ack', 'msrpc', 'Microsoft Windows RPC', '', '', 81),
(2391, 49246, 'TCP', 'open', 'syn-ack', 'msrpc', 'Microsoft Windows RPC', '', '', 81),
(2392, 49268, 'TCP', 'open', 'syn-ack', 'ssh', 'Apache Mina sshd', '0.8.0', 'protocol 2.0', 81),
(2393, 49269, 'TCP', 'open', 'syn-ack', 'jenkins-listener', 'Jenkins TcpSlaveAgentListener', '', '', 81),
(2394, 137, 'UDP', 'open', 'udp-response', 'netbios-ns', 'Microsoft Windows netbios-ns', '', 'workgroup: WORKGROUP', 81),
(2395, 21, 'TCP', 'open', 'syn-ack', 'ftp', 'ProFTPD', '1.3.5', '', 82),
(2396, 22, 'TCP', 'open', 'syn-ack', 'ssh', 'OpenSSH', '6.6.1p1 Ubuntu 2ubun', 'Ubuntu Linux; protocol 2.0', 82),
(2397, 80, 'TCP', 'open', 'syn-ack', 'http', 'Apache httpd', '2.4.7', '', 82),
(2398, 111, 'TCP', 'open', 'syn-ack', 'rpcbind', '', '2-4', 'RPC #100000', 82),
(2399, 139, 'TCP', 'open', 'syn-ack', 'netbios-ssn', 'Samba smbd', '3.X - 4.X', 'workgroup: WORKGROUP', 82),
(2400, 445, 'TCP', 'open', 'syn-ack', 'netbios-ssn', 'Samba smbd', '3.X - 4.X', 'workgroup: WORKGROUP', 82),
(2401, 631, 'TCP', 'open', 'syn-ack', 'ipp', 'CUPS', '1.7', '', 82),
(2402, 3306, 'TCP', 'open', 'syn-ack', 'mysql', 'MySQL', '', 'unauthorized', 82),
(2403, 3500, 'TCP', 'open', 'syn-ack', 'http', 'WEBrick httpd', '1.3.1', 'Ruby 2.3.7 (2018-03-28)', 82),
(2404, 6667, 'TCP', 'open', 'syn-ack', 'irc', 'UnrealIRCd', '', '', 82),
(2405, 6697, 'TCP', 'open', 'syn-ack', 'irc', 'UnrealIRCd', '', '', 82),
(2406, 8067, 'TCP', 'open', 'syn-ack', 'irc', 'UnrealIRCd', '', '', 82),
(2407, 8080, 'TCP', 'open', 'syn-ack', 'http', 'Jetty', '8.1.7.v20120910', '', 82),
(2408, 8181, 'TCP', 'open', 'syn-ack', 'http', 'WEBrick httpd', '1.3.1', 'Ruby 2.3.7 (2018-03-28)', 82),
(2409, 59581, 'TCP', 'open', 'syn-ack', 'status', '', '1', 'RPC #100024', 82),
(2410, 111, 'UDP', 'open', 'udp-response', 'rpcbind', '', '2-4', 'RPC #100000', 82),
(2411, 137, 'UDP', 'open', 'udp-response', 'netbios-ns', 'Samba nmbd netbios-ns', '', 'workgroup: WORKGROUP', 82);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `scanners`
--

CREATE TABLE `scanners` (
  `id_scanner` int(11) NOT NULL,
  `state` enum('READY','PROCESSING','FINISHED') NOT NULL,
  `name` varchar(150) NOT NULL,
  `target` varchar(20) NOT NULL,
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

--
-- Eliminarea datelor din tabel `scanners`
--

INSERT INTO `scanners` (`id_scanner`, `state`, `name`, `target`, `start`, `end`, `sS`, `sT`, `sU`, `sY`, `sN`, `sF`, `sX`, `sA`, `sW`, `sM`, `sO`, `urg`, `ack`, `psh`, `rst`, `syn`, `fin`) VALUES
(46, 'FINISHED', 'scanner for my home', '10.10.1.2/24', '19:38:50 08-06-2019', '19:39:16 08-06-2019', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `vulnerabilities`
--

CREATE TABLE `vulnerabilities` (
  `id_cve` varchar(20) NOT NULL,
  `description` varchar(600) NOT NULL,
  `score` decimal(3,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `vulnerabilities`
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
-- Structură tabel pentru tabel `vulnerabilities_list`
--

CREATE TABLE `vulnerabilities_list` (
  `id` int(11) NOT NULL,
  `id_cve` varchar(20) NOT NULL,
  `id_port` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `vulnerabilities_list`
--

INSERT INTO `vulnerabilities_list` (`id`, `id_cve`, `id_port`) VALUES
(1029, 'CVE-2016-8858', 2351),
(1030, 'CVE-2016-1907', 2351),
(1031, 'CVE-2017-15906', 2351),
(1032, 'CVE-2016-10708', 2351),
(1033, 'CVE-2018-15919', 2351),
(1034, 'CVE-2016-0778', 2351),
(1035, 'CVE-2016-0777', 2351),
(1036, 'CVE-2013-2249', 2378),
(1037, 'CVE-2017-7668', 2378),
(1038, 'CVE-2017-7679', 2378),
(1039, 'CVE-2017-3167', 2378),
(1040, 'CVE-2017-3169', 2378),
(1041, 'CVE-2012-0883', 2378),
(1042, 'CVE-2013-1862', 2378),
(1043, 'CVE-2014-0098', 2378),
(1044, 'CVE-2012-4557', 2378),
(1045, 'CVE-2014-0231', 2378),
(1046, 'CVE-2011-3368', 2378),
(1047, 'CVE-2013-6438', 2378),
(1048, 'CVE-2011-3607', 2378),
(1049, 'CVE-2011-4317', 2378),
(1050, 'CVE-2012-4558', 2378),
(1051, 'CVE-2012-0053', 2378),
(1052, 'CVE-2012-3499', 2378),
(1053, 'CVE-2013-1896', 2378),
(1054, 'CVE-2016-4975', 2378),
(1055, 'CVE-2016-8612', 2378),
(1056, 'CVE-2012-2687', 2378),
(1057, 'CVE-2012-0021', 2378),
(1058, 'CVE-2011-4415', 2378),
(1059, 'CVE-2015-3306', 2395),
(1060, 'CVE-2013-4359', 2395),
(1061, 'CVE-2017-7679', 2397),
(1062, 'CVE-2018-1312', 2397),
(1063, 'CVE-2017-15715', 2397),
(1064, 'CVE-2014-0226', 2397),
(1065, 'CVE-2018-17199', 2397),
(1066, 'CVE-2014-0231', 2397),
(1067, 'CVE-2017-9798', 2397),
(1068, 'CVE-2016-2161', 2397),
(1069, 'CVE-2016-0736', 2397),
(1070, 'CVE-2017-15710', 2397),
(1071, 'CVE-2014-3523', 2397),
(1072, 'CVE-2016-8743', 2397),
(1073, 'CVE-2014-0117', 2397),
(1074, 'CVE-2014-8109', 2397),
(1075, 'CVE-2016-4975', 2397),
(1076, 'CVE-2015-3185', 2397),
(1077, 'CVE-2014-0118', 2397),
(1078, 'CVE-2018-1283', 2397),
(1079, 'CVE-2016-8612', 2397),
(1080, 'CVE-2014-5031', 2401),
(1081, 'CVE-2017-18190', 2401),
(1082, 'CVE-2014-2856', 2401),
(1083, 'CVE-2018-4300', 2401),
(1084, 'CVE-2017-18248', 2401),
(1085, 'CVE-2014-5030', 2401),
(1086, 'CVE-2014-3537', 2401),
(1087, 'CVE-2013-6891', 2401),
(1088, 'CVE-2018-16395', 2403),
(1089, 'CVE-2018-16396', 2403),
(1090, 'CVE-2018-16395', 2408),
(1091, 'CVE-2018-16396', 2408);

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `hosts`
--
ALTER TABLE `hosts`
  ADD PRIMARY KEY (`id_host`),
  ADD KEY `hosts_ibfk_1` (`id_scanner`);

--
-- Indexuri pentru tabele `ports`
--
ALTER TABLE `ports`
  ADD PRIMARY KEY (`id_port`),
  ADD KEY `FK_PORTS_HOSTS` (`id_host`);

--
-- Indexuri pentru tabele `scanners`
--
ALTER TABLE `scanners`
  ADD PRIMARY KEY (`id_scanner`);

--
-- Indexuri pentru tabele `vulnerabilities`
--
ALTER TABLE `vulnerabilities`
  ADD PRIMARY KEY (`id_cve`);

--
-- Indexuri pentru tabele `vulnerabilities_list`
--
ALTER TABLE `vulnerabilities_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vulnerabilities_list_ibfk_1` (`id_cve`),
  ADD KEY `vulnerabilities_list_ibfk_2` (`id_port`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `hosts`
--
ALTER TABLE `hosts`
  MODIFY `id_host` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT pentru tabele `ports`
--
ALTER TABLE `ports`
  MODIFY `id_port` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2412;

--
-- AUTO_INCREMENT pentru tabele `scanners`
--
ALTER TABLE `scanners`
  MODIFY `id_scanner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pentru tabele `vulnerabilities_list`
--
ALTER TABLE `vulnerabilities_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1092;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `hosts`
--
ALTER TABLE `hosts`
  ADD CONSTRAINT `hosts_ibfk_1` FOREIGN KEY (`id_scanner`) REFERENCES `scanners` (`id_scanner`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constrângeri pentru tabele `ports`
--
ALTER TABLE `ports`
  ADD CONSTRAINT `FK_PORTS_HOSTS` FOREIGN KEY (`id_host`) REFERENCES `hosts` (`id_host`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constrângeri pentru tabele `vulnerabilities_list`
--
ALTER TABLE `vulnerabilities_list`
  ADD CONSTRAINT `vulnerabilities_list_ibfk_1` FOREIGN KEY (`id_cve`) REFERENCES `vulnerabilities` (`id_cve`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vulnerabilities_list_ibfk_2` FOREIGN KEY (`id_port`) REFERENCES `ports` (`id_port`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
