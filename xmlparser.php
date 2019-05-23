<!DOCTYPE html>
<html>
<head>
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap-theme.css" rel="stylesheet" />
</head>
<body>
<h1>adasd</h1>

<?php


$xml_string = '<?xml version="1.0" encoding="iso-8859-1"?>
<users>
  <user>
    <firstname>Sheila</firstname>
    <surname>Green</surname>
    <address>2 Good St</address>
    <city>Campbelltown</city>
    <country>Australia</country>
    <contact>
      <phone>1234 1234</phone>
      <url>http://example.com</url>
      <email>pamela@example.com</email>
    </contact>
    </user>
</users>';

$xml = simplexml_load_file("output-nmap-scan.xml") or die("Can't parse xml string");

var_dump($xml->attributes());

echo "<br><br>Scanner: " . $xml->attributes()->scanner . "<br>";
echo "Args: " . $xml->attributes()->args . "<br>";
echo "Start: " . $xml->attributes()->start . "<br>";
echo "Startstr: " . $xml->attributes()->startstr . "<br>";
echo "Version: " . $xml->attributes()->version . "<br>";
echo "XMLPutVersion: " . $xml->attributes()->xmloutputversion . "<br>";

echo "<br><br>";
echo "Scan Type: " . $xml->scaninfo->attributes()->type . "<br>";
echo "Scan Protocol: " . $xml->scaninfo->attributes()->protocol . "<br>";
echo "Scan number services: " . $xml->scaninfo->attributes()->numservices . "<br>";
echo "Services: " . $xml->scaninfo->attributes()->services . "<br>";

for($idx = 0;$idx < count($xml->taskbegin);$idx++)
{
    echo "Task Begin: " . $xml->taskbegin[$idx]->attributes()->task . " Date: " . gmdate('r', intval($xml->taskbegin[$idx]->attributes()->time));
    echo "<br>";
    echo "Task End: " . $xml->taskend[$idx]->attributes()->task . " Date: " . gmdate('r', intval($xml->taskend[$idx]->attributes()->time));
    echo "<br><br>";

}

echo "<br><br>";
echo "<br><br>";    

echo "Host IPv4 Address: " . $xml->host->address[0]->attributes()->addr . "<br>";
echo "Host MAC Address: " . $xml->host->address[1]->attributes()->addr . "<br>";
echo "Host Network Card Vendor: " . $xml->host->address[1]->attributes()->vendor . "<br>";

echo "Found " . count($xml->host->ports->port) . " open ports<br>";
$result = "&#xa;&#x9;CVE-2016-8858&#x9;&#x9;7.8&#x9;&#x9;https://vulners.com/cve/CVE-2016-8858&#xa;&#x9;CVE-2016-1908&#x9;&#x9;7.5&#x9;&#x9;https://vulners.com/cve/CVE-2016-1908&#xa;&#x9;CVE-2016-1907&#x9;&#x9;5.0&#x9;&#x9;https://vulners.com/cve/CVE-2016-1907&#xa;&#x9;CVE-2016-10708&#x9;&#x9;5.0&#x9;&#x9;https://vulners.com/cve/CVE-2016-10708&#xa;&#x9;CVE-2018-15919&#x9;&#x9;5.0&#x9;&#x9;https://vulners.com/cve/CVE-2018-15919&#xa;&#x9;CVE-2017-15906&#x9;&#x9;5.0&#x9;&#x9;https://vulners.com/cve/CVE-2017-15906&#xa;&#x9;CVE-2016-0778&#x9;&#x9;4.6&#x9;&#x9;https://vulners.com/cve/CVE-2016-0778&#xa;&#x9;CVE-2016-0777&#x9;&#x9;4.0&#x9;&#x9;https://vulners.com/cve/CVE-2016-0777";

echo "<br><b>";

$explosion = explode("&#xa;&#x9;",$result);

for ($i=0; $i < count($explosion); $i++) { 
    if($explosion[$i]!="")
    {
        $explosion[$i] = explode("&#x9;&#x9;",$explosion[$i]);
        $name = $explosion[$i][0];
        $score = $explosion[$i][1];
        $link = $explosion[$i][2];
        echo "Name: ".$name."  Score: ".$score."  Link: <a href=".$link.">".$link."</a><br>";
    }
}

?>



<script src="js/bootstrap.min.js"></script>
</body>
</html>