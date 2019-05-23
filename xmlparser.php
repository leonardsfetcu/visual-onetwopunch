<?php 

try {
	echo "test2";
    $xml = simplexml_load_file("output-nmap-scan.xml");
    echo "string";

} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>