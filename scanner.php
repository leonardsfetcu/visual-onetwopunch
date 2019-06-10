<?php
require_once('db.php');

$conn = OpenConnection();

CheckConnection($conn);

$processing = '<td id="state" value"PROCESSING" style="padding-left: 20px"><div class="spinner-border text-muted"></div></td>';
$finished = '<td id="state" value="FINISHED" class="px-4"><i class="far fa-check-circle fa-lg" style="color:green;"></i></td>';
$ready = '<td id="state" value="READY" class="px-4"><i class="far fa-question-circle fa-lg" style="color: gray;"></i></td>';

function array_get_range($array, $min, $max) {
    return array_filter($array, function($element) use ($min, $max) {
       return $element['score'] >= $min && $element['score'] <= $max; 
    });
}



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Visual OTP - Scanner</title>  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">    
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<style>
.btn-custom {
  background-color: white;
  border: 2px solid DodgerBlue;
  border-radius: 5px;
  color: black;
  padding: 5px 8px;
  font-size: 18px;
  cursor: pointer;
  margin-left: 2px;
}


/* Darker background on mouse-over */
.btn-custom:hover {
  background-color: DodgerBlue;
  color: white;
}
.del:hover {
	background-color: DodgerBlue;
	color: red;
}
</style>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
	<h5 class="navbar-brand">Visual OTP</h5>
  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    	<span class="navbar-toggler-icon"></span>
  	</button>
	<div class="collapse navbar-collapse" id="collapsibleNavbar">
	    <ul class="navbar-nav">
		    <li class="nav-item">
		        <a href="index.php"><button type="button" class="btn btn-outline-info ml-3">Dashboard</button></a>
		    </li>
	      	<li class="nav-item">
	        	<a href="scanner.php"><button type="button" class="btn btn-outline-info ml-3">Scanner</button></a>
	      	</li>
	      	<li class="nav-item">
	        	<a href="reports.php"><button type="button" class="btn btn-outline-info ml-3">Reports</button></a>
	      	</li>    
	    </ul>
	</div>  
</nav>
<div class="container" style="margin-top:60px">
	<div class="row bg-info">
		<div class="col-md text-center">
			<h3 class="text-white p-4">Scanner Settings</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md border border-top-0 pb-4 pt-2">
			<!-- The Modal -->
			<div class="modal fa-redo-alt" id="deleteModal">
			  <div class="modal-dialog">
			    <div class="modal-content">

			      <!-- Modal Header -->
			      <div class="modal-header">
			        <h4 class="modal-title">Scanner delete</h4>
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			      </div>

			      <!-- Modal body -->
			      <div class="modal-body">
			        Are you sure you want to delete this scanner?
			      </div>

			      <!-- Modal footer -->
			      <div class="modal-footer">
			        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
			        <button id="delete" type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
			      </div>

			    </div>
			  </div>
			</div>

			<h3>Create a new scanner</h3>
			  	<div class="row">
					<div class="col-md px-4 py-2">
						<label for="usr">Scanner name</label>
						<input type="text" class="form-control" id="name">
					</div>
				</div>
			  	<div class="row">
					<div class="col-md px-4 py-2">
						<label for="usr">Target IP/network:</label>
						<input type="text" class="form-control" id="target">
					</div>
				</div>
				<div class="row">
					<div class="col-md px-4 py-2">
						<label for="methods">Select TCP Scanning Technique</label>
					    <select name="cars" class="custom-select" id="methods">
					      <option value="sS">TCP SYN scan</option>
					      <option value="sT">TCP connect scan</option>
					      <option value="sY">SCTP INIT scan</option>
						  <option value="sN">TCP NULL scan</option>
					      <option value="sF">TCP FIN scan</option>
					      <option value="sX">TCP Xmas scan</option>
					      <option value="sA">TCP ACK scan</option>
						  <option value="sW">TCP Window scan</option>
					      <option value="sM">TCP Maimon scan</option>
					      <option value="sO">IP Protocol scan</option>
					      <option value="custom">Custom TCP scan</option>
					    </select>
					</div>
					<div class="col-md">
						<div class="row px-4 pt-2">
							<label>TCP Header Flags</label>
						</div>
						<div class="row px-4 pb-2">
						    <div class="custom-control custom-checkbox custom-control-inline mb-3">
						      <input type="checkbox" disabled="disabled" class="custom-control-input" id="checkUrg" name="example1">
						      <label class="custom-control-label" for="checkUrg">URG</label>
						    </div>
						    <div class="custom-control custom-checkbox custom-control-inline mb-3">
						      <input type="checkbox" disabled="disabled" class="custom-control-input" id="checkAck" name="example1">
						      <label class="custom-control-label" for="checkAck">ACK</label>
						    </div>
						    <div class="custom-control custom-checkbox custom-control-inline mb-3">
						      <input type="checkbox" disabled="disabled" class="custom-control-input" id="checkPsh" name="example1">
						      <label class="custom-control-label" for="checkPsh">PSH</label>
						    </div>
						    <div class="custom-control custom-checkbox custom-control-inline mb-3">
						      <input type="checkbox" disabled="disabled" class="custom-control-input" id="checkRst" name="example1">
						      <label class="custom-control-label" for="checkRst">RST</label>
						    </div>
						    <div class="custom-control custom-checkbox custom-control-inline mb-3">
						      <input type="checkbox" disabled="disabled" class="custom-control-input" id="checkSyn" name="example1">
						      <label class="custom-control-label" for="checkSyn">SYN</label>
						    </div>
						    <div class="custom-control custom-checkbox custom-control-inline mb-3">
						      <input type="checkbox" disabled="disabled" class="custom-control-input" id="checkFin" name="example1">
						      <label class="custom-control-label" for="checkFin">FIN</label>
						    </div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md px-4 py-2">
						<div class="custom-control custom-switch custom-control-inline">
						    <input type="checkbox" class="custom-control-input" id="switchUdp">
						    <label class="custom-control-label" for="switchUdp">Enable UDP Scanning</label>
					  	</div>
					</div>
				</div>
				<div class="row px-4">
					<button id="submitBtn" type="button" class="btn btn-primary btn-block">Submit</button>
				</div>
		</div>
	</div>
</div>
<div class="container my-5 border border-top-0">
	<div class="row bg-info">
		<div class="col-md text-center">
			<h3 class="text-white p-4">Scanner List</h3>
		</div>
	</div>	
	<div class="row">
		<div class="table-responsive">
			<table class="table table-hover">
			    <thead class="thead-dark">
				    <tr>
				    	<th style="width: 2%">Status</th>
					    <th style="width: 15%">Scanner</th>
					    <th style="width: 8%">Target</th>
					    <th style="width: 15%">Last scan</th>
					    <th style="width: 43%">Vulnerabilities</th>
					    <th style="width: 17%">Actions</th>
				    </tr>
			    </thead>
			    <tbody>
			    	<?php
			    		$sql = "select * from scanners order by scanners.id_scanner DESC";
			    		$scannerResult = $conn->query($sql);
			    		if($scannerResult->num_rows>0)
			    		{
			    			while($scannerRow = $scannerResult->fetch_assoc())
			    			{
			    				echo '<tr id="row" value="'.$scannerRow['id_scanner'].'">';

			    				if($scannerRow['state'] == "READY")
			    				{
			    					echo $ready;
			    				}
			    				if($scannerRow['state'] == "PROCESSING")
			    				{
			    					echo $processing;
			    				}
			    				if($scannerRow['state'] == "FINISHED")
			    				{
			    					echo $finished;
			    				}

								echo '<td id="name">'.$scannerRow['name'].'</td><td id="target">'.$scannerRow['target'].'</td><td id="end">'.$scannerRow['end'].'</td>';

								$vulnResult = $conn->query("select vulnerabilities.score from vulnerabilities INNER JOIN vulnerabilities_list on vulnerabilities_list.id_cve=vulnerabilities.id_cve INNER JOIN ports on vulnerabilities_list.id_port=ports.id_port INNER JOIN hosts on hosts.id_host=ports.id_host INNER JOIN scanners on scanners.id_scanner=hosts.id_scanner where scanners.id_scanner=".$scannerRow['id_scanner']);

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
								echo '<td id="vulnerabilities"><div class="progress border"><div id="low" class="progress-bar bg-primary" style="width:'.$widthLow.'%"></div><div id="medium" class="progress-bar bg-success" style="width:'.$widthMedium.'%"></div><div id="high" class="progress-bar bg-warning" style="width:'.$widthHigh.'%"></div><div id="critical" class="progress-bar bg-danger" style="width:'.$widthCritical.'%"></div></div></td>';
								echo '<td class="actions">';
									if($scannerRow['state'] == "READY")
									{
										echo '<div id="btn-action" style="display:inline;"><button class="btn-custom" id="play"><i class="fas fa-play"></i></button></div>';
									}
				    				if($scannerRow['state'] == "PROCESSING")
				    				{
				    					echo '<div id="btn-action" style="display:inline;"><button class="btn-custom" id="stop"><i class="fas fa-stop"></i></button></div>';
				    				}
				    				if($scannerRow['state'] == "FINISHED")
				    				{
				    					echo '<div id="btn-action" style="display:inline;"><button class="btn-custom" id="replay"><i class="fas fa-redo-alt"></i></button></div>';
				    				}
									echo '<button class="btn-custom del" id="pdf"><i class="far fa-file-pdf"></i></button><button class="btn-custom del" id="delete" data-toggle="modal" data-id="'.$scannerRow['id_scanner'].'"><i class="fas fa-trash-alt"></i></button><form style="display:inline;" method="GET" action="reports.php"><button class="btn-custom" name ="submit" value="view-'.$scannerRow['id_scanner'].'"><i class="fas fa-eye"></i></button></form></td></tr>';
			    			}
			    		}
			    		CloseConnection($conn);
			    	?>
			    </tbody>
		    </table>
		</div>
	</div>		   
</div>
<script src="js/jquery/jquery-3.4.1.min.js"></script>
<script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<script src="js/scanners.js"></script>
</body>
</html>