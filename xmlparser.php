<?php

require_once('db.php');
function loadScannerFromXml($id_scanner)
{

    $conn = OpenConnection();
    $scans = array(array('date'=>'','time'=>'','ip'=>array()));

    $logPath = "logs"; 
    $stdDir = array(".","..");
    $dates = array_diff(scandir($logPath), $stdDir);
    $scanCounter=0;
    // get scan filesystem structure in $scans
    foreach ($dates as $date) 
    {
        $timePath = $logPath."/".$date;
        $times = array_diff(scandir($timePath),$stdDir);
        foreach($times as $time)
        {
            $scanPath = $timePath."/".$time;
            if(file_exists($scanPath."/live-hosts.txt"))
            {
                $file = fopen($scanPath."/live-hosts.txt","r");
                if($file)
                {
                    $scans[$scanCounter]['date'] = $date;
                    $scans[$scanCounter]['time'] = $time;
                    while(! feof($file))
                    {
                        $ip = fgets($file);
                        if($ip == "")
                            continue;
                        $scans[$scanCounter]['ip'][] = rtrim($ip);
                    }
                    $scanCounter++;

                    fclose($file);
                }
            }
        }
    }

    // parse xml files
    for($i=0;$i<count($scans);$i++)
    {
        // parse hosts
        for($j=0;$j<count($scans[$i]['ip']);$j++)
        {
            $path = "logs/".$scans[$i]['date']."/".$scans[$i]['time']."/".$scans[$i]['ip'][$j]."/".$scans[$i]['ip'][$j].".xml";
            $xml = simplexml_load_file($path) or die("Can't parse xml string");
            $ip = $xml->host->address[0]->attributes()->addr;
            $iptype = $xml->host->address[0]->attributes()->addrtype;
            $mac = $xml->host->address[1]->attributes()->addr;
            $vendor = $xml->host->address[1]->attributes()->vendor;
            $os = $xml->host->os->osmatch->attributes()->name;
            $sql = "INSERT INTO hosts(id_host,OS,IP,MAC,mac_vendor,id_scanner) VALUES (NULL,'$os','$ip','$mac','$vendor','$id_scanner')";
            if ($conn->query($sql) === TRUE) 
            {
                $id_host = $conn->insert_id;
            } 
            else
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
                exit();
            }
            // parse ports
            foreach($xml->host->ports->port as $port)
            {

                $portNumber = $protocol = $state = $reason = $servName = $prodName = $servVersion = $servExtra = "";
            
                $portNumber = $port->attributes()->portid;
                $protocol = $port->attributes()->protocol;
                $state = $port->state->attributes()->state;
                $reason = $port->state->attributes()->reason;
                if(isset($port->service))
                {
                    $servName = $port->service->attributes()->name;
                    $prodName = $port->service->attributes()->product;
                    $servVersion = $port->service->attributes()->version;
                    $servExtra = $port->service->attributes()->extrainfo;
                }
                $sql = "INSERT INTO ports(id_port,port_number,protocol,state,reason,service,product,version,extra,id_host) VALUES(NULL,'$portNumber','$protocol','$state','$reason','$servName','$prodName','$servVersion','$servExtra','$id_host')";
                if ($conn->query($sql) === TRUE) 
                {
                    $id_port = $conn->insert_id;
                    // parse vulnerabilities
                    if(isset($port->script))
                    {
                        foreach ($port->script as $script) {
                            if($script->attributes()->id == "vulners")
                            {
                                $cves = explode("\t",trim($script->elem));
                                for($k=0;$k<count($cves)/5;$k++)
                                {
                                    $cveName = $cves[$k*5];
                                    $score = $cves[$k*5+2];
                                    $sql = "select vulnerabilities.id_cve from vulnerabilities where vulnerabilities.id_cve='".$cveName."'";
                                    $result = $conn->query($sql);
                                    if($result->num_rows == 0)
                                    {
                                        $sql = "INSERT INTO vulnerabilities(id_cve,score) VALUES('$cveName','$score')";
                                        if ($conn->query($sql) === FALSE)
                                        {
                                            exit();
                                        }
                                    }
                                    $sql = "INSERT INTO vulnerabilities_list(id,id_cve,id_port) VALUES(NULL,'$cveName','$id_port')";
                                    if ($conn->query($sql) === FALSE)
                                    {
                                        exit();
                                    }
                                }
                            }
                        }
                    }
                } 
                else
                {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    exit();
                }
            }
        }
    }

    CloseConnection($conn);
}



?>