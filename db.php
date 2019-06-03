<?php
function OpenConnection()
{
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "visual-otp";
	$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
	 
	return $conn;
}
 
function CloseConnection($conn)
{
 	$conn->close();
}

function CheckConnection($conn)
{
	if($conn->connect_error)
	{
		die("Connection failed ".$conn->connect_error);
	}
}
   
?>