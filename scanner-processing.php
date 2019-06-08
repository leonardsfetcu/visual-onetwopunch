<?php 
	require_once("db.php");
	include 'xmlparser.php';
	require_once('cleaner.php');

	$conn = OpenConnection();
	CheckConnection($conn);
	$last_id = -1; 

	if(isset($_POST['runScript']))
	{
		$id = $_POST['runScriptId'];

		$date = date('H:i:s d-m-Y');
		$sql = "UPDATE scanners SET start='".$date."' WHERE scanners.id_scanner=".$id;
		if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully";
		} else {
		    echo "Error updating record: " . $conn->error;
		}

		sleep(20);
		loadScannerFromXml($id);
		
		$sql = "UPDATE scanners SET state='FINISHED' WHERE scanners.id_scanner=".$id;
		if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully";
		} else {
		    echo "Error updating record: " . $conn->error;
		}
		$date = date('H:i:s d-m-Y');
		$sql = "UPDATE scanners SET end='".$date."' WHERE scanners.id_scanner=".$id;
		if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully";
		} else {
		    echo "Error updating record: " . $conn->error;
		}
    	removeLogs();
    	exit();
	}
	if(isset($_POST['deleteScanner']))
	{
		$scannerId = $_POST['id'];
		if ($conn->query("DELETE FROM scanners WHERE scanners.id_scanner=".$scannerId) === TRUE)
		{
		    echo "Record deleted successfully";
		}
		else
		{
		    echo "Error deleting record: " . $conn->error;
		}
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
		$sql = "INSERT INTO scanners(id_scanner,state,name,target,start,end,sS,sT,sU,sY,sN,sF,sA,sX,sM,sO,sW,urg,ack,psh,rst,syn,fin) VALUES (NULL,'PROCESSING','$name','$target',NULL,NULL,'$sS','$sT','$sU','$sY','$sN','$sF','$sA','$sX','$sM','$sO','$sW','$urg','$ack','$psh','$rst','$syn','$fin')";
		if ($conn->query($sql) === TRUE) 
		{
    		$last_id = $conn->insert_id;  
    		echo $last_id;  		
		} 
		else
		{
    		echo "Error: " . $sql . "<br>" . $conn->error;
		}
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