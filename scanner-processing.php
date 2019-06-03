<?php 
	require_once("db.php");
	$conn = OpenConnection();
	CheckConnection($conn);


	if(isset($_POST['msg']))
	{
		echo "succes!";
		exit();
	}
	if(isset($_POST['action']))
	{
		switch ($_POST['action']) {
			case 'play':
				echo 'am trimis play';
				break;
			case 'replay':
				echo 'am trimis replay';
				break;				
			case 'pause':
				echo 'am trimis pause';
				break;
			case 'pdf':
				echo 'am trimis pdf';
				break;			
			case 'delete':
				echo 'am trimis delete';
				break;
			case 'view':
				echo 'am trimis view';
				break;
			default:
				echo 'error';
				break;
		}
		exit();
	}
	if(isset($_POST['id_scanner']))
	{
		echo "id_scanner trimis";
		exit();
	}
?>