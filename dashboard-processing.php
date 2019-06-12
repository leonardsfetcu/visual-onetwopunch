<?php
require_once('db.php');

function array_get_range($array, $min, $max) {
    return array_filter($array, function($element) use ($min, $max) {
       return $element['score'] >= $min && $element['score'] <= $max; 
    });
}
function getAllDistinctVulns()
{
	$conn = OpenConnection();
	CheckConnection($conn);
	$sql = "select DISTINCT vulnerabilities.id_cve, vulnerabilities.score from vulnerabilities INNER JOIN vulnerabilities_list on vulnerabilities_list.id_cve=vulnerabilities.id_cve INNER JOIN ports on ports.id_port=vulnerabilities_list.id_port";
	$result = $conn->query($sql);
	CloseConnection($conn);
	return $result->fetch_all(MYSQLI_ASSOC);
}

function getLowVulnNumber()
{
	return count(array_get_range(getAllDistinctVulns(),0,3));
}

function getMediumVulnNumber()
{
	return count(array_get_range(getAllDistinctVulns(),3,5));
}

function getHighVulnNumber()
{
	return count(array_get_range(getAllDistinctVulns(),5,8));
}

function getCriticalVulnNumber()
{
	return count(array_get_range(getAllDistinctVulns(),8,10));
}

function getTotalVulnNumber()
{
	return getCriticalVulnNumber() + getHighVulnNumber() + getMediumVulnNumber() + getLowVulnNumber();
}

function getScanners()
{
	$conn = OpenConnection();
	CheckConnection($conn);
	$sql = "select scanners.* from scanners";
	$result = $conn->query($sql);
	CloseConnection($conn);
	return $result->fetch_all(MYSQLI_ASSOC);
}

function getHosts()
{	
	$conn = OpenConnection();
	CheckConnection($conn);
	$sql = "select hosts.* from hosts";
	$result = $conn->query($sql);
	CloseConnection($conn);
	return $result->fetch_all(MYSQLI_ASSOC);
}

function getPorts()
{
	$conn = OpenConnection();
	CheckConnection($conn);
	$sql = "select ports.* from ports";
	$result = $conn->query($sql);
	CloseConnection($conn);
	return $result->fetch_all(MYSQLI_ASSOC);
}

?>