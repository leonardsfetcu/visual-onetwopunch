<?php

require_once('db.php');

function loadScannerFromXml($id_scanner)
{

    $conn = OpenConnection();
    $scans = array(array('date'=>'','time'=>'','ip'=>array()));

    $logPath = "logs/".$id_scanner; 
    $stdDir = array(".","..");
    $dates = array_diff(scandir($logPath), $stdDir);
    $scanCounter=0;
    // get scan filesystem structure in $scans
    foreach ($dates as $date) 
    {
        $timePath = $logPath."/".$date;
        if(is_file($timePath))
            continue;

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
    var_dump($scans);
    // parse xml files
    for($i=0;$i<count($scans);$i++)
    {
        // parse hosts
        for($j=0;$j<count($scans[$i]['ip']);$j++)
        {
            $ip=$iptype=$mac=$vendor=$os="unknown";
            $path = $logPath."/".$scans[$i]['date']."/".$scans[$i]['time']."/".$scans[$i]['ip'][$j]."/".$scans[$i]['ip'][$j].".xml";
            if(file_exists($path) == FALSE)
            {
                echo "NU EXISTA: ".$path;
                $tempIp=$scans[$i]['ip'][$j];
                $sql = "INSERT INTO hosts(id_host,IP,id_scanner) VALUES (NULL,'$tempIp','$id_scanner')";
                if ($conn->query($sql) === FALSE) 
                {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                } 
                continue;
            }
            $xml = simplexml_load_file($path);
            if(isset($xml->host->address[0]))
            {
                $addressAttr=$xml->host->address[0]->attributes();

                if(isset($addressAttr->addr))
                    $ip = $addressAttr->addr;
                if(isset($addressAttr->addrtype))
                    $iptype = $addressAttr->addrtype;
            }
            if(isset($xml->host->address[1]))
            {
                $addressAttr=$xml->host->address[1]->attributes();

                if(isset($addressAttr->addr))
                    $mac = $addressAttr->addr;
                if(isset($addressAttr->vendor))
                    $vendor = $addressAttr->vendor;
            }
            if(isset($xml->host->os->osmatch))
            {
                $osmatchAttr=$xml->host->os->osmatch->attributes();
                if(isset($osmatchAttr->name))
                    $os = $osmatchAttr->name;
            }    
                
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
                $portNumber = $protocol = $state = $reason = $servName = $prodName = $servVersion = $servExtra = " ";
            
                $portAttr = $port->attributes();
                if(isset($portAttr->portid))
                    $portNumber = $portAttr->portid;
                if(isset($portAttr->protocol))
                    $protocol = $portAttr->protocol;

                $stateAttr = $port->state->attributes();
                if(isset($stateAttr->state))
                    $state = $stateAttr->state;
                if(isset($stateAttr->reason))
                    $reason = $stateAttr->reason;
                if(isset($port->service))
                {
                    $serviceAttr = $port->service->attributes();
                    if(isset($serviceAttr->name))
                        $servName = $serviceAttr->name;
                    if(isset($serviceAttr->product))
                        $prodName = $serviceAttr->product;
                    if(isset($serviceAttr->version))
                        $servVersion = $serviceAttr->version;
                    if(isset($serviceAttr->extrainfo))
                        $servExtra = $serviceAttr->extrainfo;
                }

                $sql = "INSERT INTO ports(id_port,port_number,protocol,state,reason,service,product,version,extra,id_host) VALUES(NULL,'$portNumber','$protocol','$state','$reason','$servName','$prodName','$servVersion','$servExtra','$id_host')";

                if ($conn->query($sql) === TRUE) 
                {
                    $id_port = $conn->insert_id;
                    // parse vulnerabilities
                    if(isset($port->script))
                    {
                        foreach ($port->script as $script) 
                        {

                            if(strcmp($script->attributes()->id,"vulners")==0)
                            {

                                $cves = explode("\t",trim($script->elem));

                                $sanitizedCves = array();
                                for($k=0;$k<count($cves);$k++)
                                {
                                    if(strcmp($cves[$k],""))
                                        $sanitizedCves[] = $cves[$k];
                                }

                                for($k=0;$k<count($sanitizedCves);$k+=3)
                                {
                                    $cveName = $sanitizedCves[$k];
                                    $score = $sanitizedCves[$k+1];
                                    $link = $sanitizedCves[$k+2]; 

                                    $sql = "select vulnerabilities.id_cve from vulnerabilities where vulnerabilities.id_cve='".$cveName."'";
                                    $result = $conn->query($sql);
                                    if($result->num_rows == 0)
                                    {
                                        $sql = "INSERT INTO vulnerabilities(id_cve,score,link) VALUES('$cveName','$score','$link')";
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