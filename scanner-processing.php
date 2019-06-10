<?php 
	require_once("db.php");
	include 'xmlparser.php';
	require_once('cleaner.php');

	set_time_limit(0);
	$conn = OpenConnection();
	CheckConnection($conn);
	$last_id = -1; 

	function array_get_range($array, $min, $max) {
    return array_filter($array, function($element) use ($min, $max) {
       return $element['score'] >= $min && $element['score'] <= $max; 
    });
}

	if(isset($_POST['runScript']))
	{	
		$id = $_POST['runScriptScannerId'];
		
		$sql = "UPDATE scanners SET state='PROCESSING' WHERE scanners.id_scanner=".$id;
		if ($conn->query($sql) === FALSE) {
		    echo "Error updating record: " . $conn->error;
		}

		$date = date('H:i:s d-m-Y');
		$sql = "UPDATE scanners SET start='".$date."' WHERE scanners.id_scanner=".$id;
		if ($conn->query($sql) === FALSE) {
		    echo "Error updating record: " . $conn->error;
		}

		sleep(10);
		loadScannerFromXml($id);
		
		$sql = "UPDATE scanners SET state='FINISHED' WHERE scanners.id_scanner=".$id;
		if ($conn->query($sql) === FALSE) {
		    echo "Error updating record: " . $conn->error;
		}
		$date = date('H:i:s d-m-Y');
		$sql = "UPDATE scanners SET end='".$date."' WHERE scanners.id_scanner=".$id;
		if ($conn->query($sql) === FALSE) {
		    echo "Error updating record: " . $conn->error;
		}
    	//removeLogs();
    	CloseConnection($conn);
		exit();
	}

	if(isset($_POST['vulnUpdate']))
	{
		$id = $_POST['id_scanner'];

		$vulnResult = $conn->query("select vulnerabilities.score from vulnerabilities INNER JOIN vulnerabilities_list on vulnerabilities_list.id_cve=vulnerabilities.id_cve INNER JOIN ports on vulnerabilities_list.id_port=ports.id_port INNER JOIN hosts on hosts.id_host=ports.id_host INNER JOIN scanners on scanners.id_scanner=hosts.id_scanner where scanners.id_scanner=".$id);

		$widthLow=$widthMedium=$widthHigh=$widthCritical=0;
		

		if($vulnResult->num_rows>0)
		{
			$vulnRows = $vulnResult->fetch_all(MYSQLI_ASSOC);

			$numLow = count(array_get_range($vulnRows,0,3));
			$numMedium = count(array_get_range($vulnRows,3,5));
			$numHigh = count(array_get_range($vulnRows,5,8));
			$numCritical = count(array_get_range($vulnRows,8,10));

			$numVuln = $numLow + $numMedium + $numHigh + $numCritical;
			$widthLow = $numLow/$numVuln*100;
			$widthMedium = $numMedium/$numVuln*100;
			$widthHigh = $numHigh/$numVuln*100;
			$widthCritical = $numCritical/$numVuln*100;
		}
		
		$timeResult = $conn->query("select scanners.end, scanners.state from scanners where scanners.id_scanner=".$id);
		$row = $timeResult->fetch_assoc();
		$result = array('widthLow'=>$widthLow,'widthMedium'=>$widthMedium,'widthHigh'=>$widthHigh,'widthCritical'=>$widthCritical,'end'=>$row['end'],'state'=>$row['state']);
		echo json_encode($result);
		
		CloseConnection($conn);
		exit();
	}
	if(isset($_POST['deleteHosts']))
	{
		$id = $_POST['id'];
		$sql = 'DELETE FROM hosts WHERE hosts.id_scanner='.$id;
		if($conn->query($sql)===FALSE)
		{
			echo "Error deleting hosts: ".$conn->error;
		}
		CloseConnection($conn);
		exit();
	}
	if(isset($_POST['deleteScanner']))
	{
		$scannerId = $_POST['id'];
		if ($conn->query("DELETE FROM scanners WHERE scanners.id_scanner=".$scannerId) === FALSE)
		{
		    echo "Error deleting record: " . $conn->error;
		}
		
		CloseConnection($conn);
		exit();
	}
	if(isset($_POST['newScanner']))
	{
		$name = $_POST['name'];
		$target = $_POST['target'];
		$urg=$ack=$rst=$psh=$syn=$fin=0;
		$sS=$sT=$sU=$sY=$sN=$sF=$sA=$sX=$sM=$sO=$sW=0;
		switch ($_POST['technique']) {
			case 'sS':	$sS = true;
				break;
			case 'sT':	$sT = true;
				break;
			case 'sU':	$sU = true;
				break;
			case 'sY':	$sY = true;
				break;
			case 'sN':	$sN = true;
				break;
			case 'sF':	$sF = true;
				break;
			case 'sA':	$sA = true;
				break;
			case 'sX':	$sX = true;
				break;
			case 'sM':	$sM = true;
				break;
			case 'sO':	$sO = true;
				break;
			case 'sW':	$sW = true;
				break;
			case 'custom':
				$urg = $_POST["urg"];
				$ack = $_POST["ack"];
				$rst = $_POST["rst"];
				$psh = $_POST["psh"];
				$syn = $_POST["syn"];
				$fin = $_POST["fin"];
				break;
			default:
				# code...
				break;
		}
		$sql = "INSERT INTO scanners(id_scanner,state,name,target,start,end,sS,sT,sU,sY,sN,sF,sA,sX,sM,sO,sW,urg,ack,psh,rst,syn,fin) VALUES (NULL,'READY','$name','$target',NULL,NULL,'$sS','$sT','$sU','$sY','$sN','$sF','$sA','$sX','$sM','$sO','$sW','$urg','$ack','$psh','$rst','$syn','$fin')";
		if ($conn->query($sql) === TRUE) 
		{
    		$last_id = $conn->insert_id;  
    		//echo $last_id;  		
		} 
		else
		{
    		//echo "Error: " . $sql . "<br>" . $conn->error;
		}
		CloseConnection($conn);
		exit();
	}
	if(isset($_POST['action']))
	{
		switch ($_POST['action']) {
			case 'replay':
				//echo 'am trimis replay';
				break;				
			case 'pdf':
				//echo 'am trimis pdf';
				break;			
			default:
				break;
		}
		exit();
	}
	if(isset($_POST['play]']))
	{
		exit();
	}
	if(isset($_POST['id_scanner']))
	{
		exit();
	}
?>