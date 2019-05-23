<!DOCTYPE html>
<html>
<body>
<h1>adasd</h1>

<?php

echo 'Current PHP version: ' . phpversion();

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

    if( ! $xml = simplexml_load_string( $xml_string ) )
    {
        echo 'Unable to load XML string';
    }
    else
    {
        echo 'XML String loaded successfully';
    }


?>



</body>
</html>