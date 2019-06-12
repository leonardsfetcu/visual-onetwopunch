<?php
	require_once("db.php");
	$conn = OpenConnection();
	CheckConnection($conn);
	if(isset($_GET['submit']))
	{
		$parameters = explode("-",$_GET['submit']);
		if(is_numeric($parameters[1]))
		{
			$sql = 'select `scanners`.`name`,`scanners`.`start`,`scanners`.`end`,`scanners`.`target`,COUNT(`hosts`.`id_host`) as `num_hosts` from `scanners` INNER JOIN `hosts` on `scanners`.`id_scanner`=`hosts`.`id_scanner` WHERE `scanners`.`id_scanner`="'.$parameters[1].'"';
			$result = $conn->query($sql);
			if($result->num_rows == 1)
			{
				$row = $result->fetch_assoc();
				$scanName = $row['name'];
				$start = $row['start'];
				$end = $row['end'];
				$target = $row['target'];
				$num_hosts = $row['num_hosts'];
			}
		}
		else
		{
			exit();
		}
	}
	else
	{
		exit();
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Visual OTP - Reports</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript" src="lineChart.js"></script>
</head>
<style>
code {
	padding-left: 20px;
	margin: 0;
}
hr {
	margin: 0;
	padding: 0;
}
.card-link:hover {
	background-color: rgb(121, 169, 247);
	color: white;
}
</style>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <h5 class="navbar-brand" href="#">Visual OTP</h5>
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

<div class="container pb-4 border border-top-0">
	<div class="row">
		<div class="col-md bg-info text-white p-4">
			<h1>Scan Report</h1>
			<h3><?php echo $scanName; ?></h3>
			<h5><?php echo $start." - ".$end; ?></h5>
			<h5><?php echo $num_hosts." host(s) up."; ?></h5>
		</div>
	</div>
	<div class="row p-4">
		<h4>Online Hosts</h4>
	</div>
	
			    <?php

					$sql = 'SELECT hosts.* from hosts INNER JOIN scanners on hosts.id_scanner=scanners.id_scanner WHERE scanners.id_scanner='.$parameters[1];
					$result = $conn->query($sql);
					if($result->num_rows>0)
					{
						$hosts = $result->fetch_all(MYSQLI_ASSOC);
					
			    		foreach ($hosts as $host) 
			    		{	
				    		echo '<div class="row"><div class="col-md mt-1"><div id="accordion'.$host['id_host'].'"><div class="card"><a class="card-link" data-toggle="collapse" href="#collapse'.$host['id_host'].'"><div class="card-header">'.$host['IP'].'</div></a><div id="collapse'.$host['id_host'].'" class="collapse" data-parent="#accordion'.$host['id_host'].'"><code>OS: '.$host['OS'].'</code><hr><code>MAC: '.$host['MAC'].'</code><hr><code>Vendor: '.$host['mac_vendor'].'</code><hr><div class="card-body"><div class="table-responsive"><table class="table table-bordered"><thead><tr style="background-color: rgb(200,200,200);"><th>Port</th><th>Protocol</th><th>State</th><th>Reason</th><th>Service</th><th>Product</th><th>Version</th><th>Extra Info</th></tr></thead><tbody>';
				    		$sql = 'SELECT ports.* from ports where ports.id_host='.$host['id_host'];
				    		$result = $conn->query($sql);
				    		if($result->num_rows>0)
				    		{

				    			$ports = $result->fetch_all(MYSQLI_ASSOC);
				    			foreach ($ports as $port) 
				    			{

				    				echo '<tr style="background-color: rgb(223,240,216)"><td>'.$port['port_number'].'</td><td>'.$port['protocol'].'</td><td>'.$port['state'].'</td><td>'.$port['reason'].'</td><td>'.$port['service'].'</td><td>'.$port['product'].'</td><td>'.$port['version'].'</td><td>'.$port['extra'].'</td></tr>';
									
				    				$sql = "select vulnerabilities.* from vulnerabilities INNER JOIN vulnerabilities_list on vulnerabilities.id_cve=vulnerabilities_list.id_cve INNER JOIN ports on ports.id_port=vulnerabilities_list.id_port WHERE ports.id_port=".$port['id_port'];
				    				$result=$conn->query($sql);
				    				if($result->num_rows>0)
				    				{
				    					echo '<tr><td colspan="8"><div class="container"><h4>Vulnerabilities found</h4><table class="table table-bordered"><thead><tr style="background-color: rgb(200,200,200);"><th>CVE</th><th>Score</th><th>Link</th></tr></thead><tbody>';

				    					$vulnerabilities = $result->fetch_all(MYSQLI_ASSOC);
				    					foreach ($vulnerabilities as $vulnerability) {
				  							echo '<tr><td>'.$vulnerability['id_cve'].'</td><td>'.$vulnerability['score'].'</td><td><a href="'.$vulnerability['link'].'" target="_blank">'.$vulnerability['link'].'</a></td></tr>';
				    					}
				    					echo '</tbody></table></div></td></tr>';
				    				}
				    			}
				    		}
			    			echo '</tbody></table></div></div></div></div></div></div></div>';
			    		}
			    	}
			    ?>	
			    </div>
			</div>
		</div>
	</div>	
</div>
<script src="js/jquery/jquery-3.4.1.min.js"></script>
<script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
</body>
</html>