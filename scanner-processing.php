<?php 
	require_once("db.php");
	$conn = OpenConnection();
	CheckConnection($conn);


	if(isset($_POST['newScanner']))
	{
		var_dump($_POST);
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
		echo $sql;
		if ($conn->query($sql) === TRUE) 
		{
    		$last_id = $conn->insert_id;
    		echo "New record created successfully. Last inserted ID is: " . $last_id;
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
			case 'delete':
				//echo 'am trimis delete';
				break;
			case 'view':
				//echo 'am trimis view';
				break;
			default:
				break;
		}
		exit();
	}
	if(isset($_POST['play]']))
	{
		echo 'dadada';
		exit();
	}
	if(isset($_POST['id_scanner']))
	{
		echo "id_scanner trimis";
		exit();
	}
?>