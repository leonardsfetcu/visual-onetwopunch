<!DOCTYPE html>
<html>
<head>
	<title>Visual OTP - Reports</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript" src="lineChart.js"></script>
</head>
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
			<h3>WiFiMotoc Network scanner</h3>
			<h5>Sat May 25 06:59:56 2019 – Sat May 25 07:05:04 2019</h5>
			<h5>100 hosts scanned. 3 hosts up. 97 hosts down. </h5>
		</div>
	</div>
	<div class="row p-4">
		<h4>Online Hosts</h4>
	</div>
	<div class="row">
		<div class="col-md mt-1">
			<div id="accordion">
			    <div class="card">
			    	<a class="card-link" data-toggle="collapse" href="#collapse1">
				        <div class="card-header">
					        10.10.2.5
				      	</div>
			      	</a>
			      	<div id="collapse1" class="collapse" data-parent="#accordion">  <!--Port 	Protocol 	State
Reason 	Service 	Product 	Version 	Extra Info -->
			        	<div class="card-body">
			          		<div class="table-responsive">
							    <table class="table table-bordered">
							    	<thead>
								        <tr style="background-color: rgb(200,200,200);">
									        <th>Port</th>
									        <th>Protocol</th>
									        <th>State</th>
									        <th>Reason</th>
									        <th>Service</th>
									        <th>Product</th>
									        <th>Version</th>
									        <th>Extra Info</th>
								        </tr>
							      	</thead>
							      	<tbody>
								        <tr style="background-color: rgb(223,240,216)">
								          <td>21</td>
								          <td>tcp</td>
								          <td>open</td>
								          <td>syn-ack</td>
								          <td>ftp</td>
								          <td>Microsoft ftpd</td>
								          <td> </td>
								          <td> </td>
								        </tr>
								        <tr>
								        	<td colspan="8">
								        		<div class="container">
								        			<h4>Vulnerabilities found</h4>
								        			<table class="table table-bordered">
												    	<thead>
													        <tr style="background-color: rgb(200,200,200);">
														        <th>CVE</th>
														        <th>Score</th>
														        <th>Link</th>
													        </tr>
												      	</thead>
												      	<tbody>
													        <tr>
													          <td>CVE-2016-8858</td>
													          <td>7.8</td>
													          <td>
													          	<a href="https://vulners.com/cve/CVE-2016-8858">
														          		https://vulners.com/cve/CVE-2016-8858
														        </a>
													          </td>
													        </tr>
													        <tr>
													          <td>CVE-2016-1908</td>
													          <td>7.5</td>
													          <td>
													          	<a href="https://vulners.com/cve/CVE-2016-1908">
														          		https://vulners.com/cve/CVE-2016-1908
														        </a>
													          </td>
													        </tr>
													        <tr>
													          <td>CVE-2016-1907</td>
													          <td>5.0</td>
													          <td>
													          	<a href="https://vulners.com/cve/CVE-2016-1907">
														          		https://vulners.com/cve/CVE-2016-1907
														        </a>
													          </td>
													        </tr>
													        <tr>
													          <td>CVE-2016-10708</td>
													          <td>5.0</td>
													          <td>
													          	<a href="https://vulners.com/cve/CVE-2016-10708">
														          		https://vulners.com/cve/CVE-2016-10708
														        </a>
													          </td>
													        </tr>
													        <tr>
													          <td>CVE-2018-15919</td>
													          <td>5.0</td>
													          <td>
													          	<a href="https://vulners.com/cve/CVE-2018-15919">
														          		https://vulners.com/cve/CVE-2018-15919
														        </a>
													      	  </td>
													        </tr>
													        <tr>
													          <td>CVE-2016-0778</td>
													          <td>4.6</td>
													          <td>
													          	<a href="https://vulners.com/cve/CVE-2016-0778">
														          		https://vulners.com/cve/CVE-2016-0778
														        </a>
													      	  </td>
													        </tr>
													        <tr>
													          <td>CVE-2016-0777</td>
													          <td>4.0</td>
													          <td>
														          	<a href="https://vulners.com/cve/CVE-2016-0777">
														          		https://vulners.com/cve/CVE-2016-0777
														          	</a>
													          </td>
													        </tr>
													    </tbody>
													</table>
								        		</div>
								        	</td>
								        </tr>
								        <tr style="background-color: rgb(223,240,216)">
								          <td>22</td>
								          <td>tcp</td>
								          <td>open</td>
								          <td>syn-ack</td>
								          <td>ssh</td>
								          <td>OpenSSH</td>
								          <td>7.1</td>
								          <td>protocol 2.0</td>
								        </tr>
								        <tr>
								        	<td colspan="8"></td>
								        </tr>
								        <tr style="background-color: rgb(223,240,216)">
								          <td>80</td>
								          <td>tcp</td>
								          <td>open</td>
								          <td>syn-ack</td>
								          <td>http</td>
								          <td>Microsoft IIS httpd</td>
								          <td>7.5</td>
								          <td> </td>
								        </tr>
								        <tr>
								        	<td colspan="8"></td>
								        </tr>
								        <tr style="background-color: rgb(223,240,216)">
								          <td>135</td>
								          <td>tcp</td>
								          <td>open</td>
								          <td>syn-ack</td>
								          <td>netbios-ssn</td>
								          <td>Microsoft Windows netbios-ssn</td>
								          <td> </td>
								          <td> </td>
								        </tr>
								        <tr>
								        	<td colspan="8"></td>
								        </tr>
								        <tr style="background-color: rgb(223,240,216)">
								          <td>445</td>
								          <td>tcp</td>
								          <td>open</td>
								          <td>syn-ack</td>
								          <td>microsoft-ds</td>
								          <td>Microsoft Windows Server 2008 R2 - 2012 microsoft-ds</td>
								          <td> </td>
								          <td> </td>
								        </tr>
								        <tr>
								        	<td colspan="8"></td>
								        </tr>
								        <tr style="background-color: rgb(223,240,216)">
								          <td>1617</td>
								          <td>tcp</td>
								          <td>open</td>
								          <td>syn-ack</td>
								          <td>rmiregistry</td>
								          <td>Java RMI</td>
								          <td> </td>
								          <td> </td>
								        </tr>
								        <tr>
								        	<td colspan="8"></td>
								        </tr>
								        <tr style="background-color: rgb(223,240,216)">
								          <td>3306</td>
								          <td>tcp</td>
								          <td>open</td>
								          <td>syn-ack</td>
								          <td>mysql</td>
								          <td>MySQL</td>
								          <td>5.5.20-log</td>
								          <td> </td>
								        </tr>
								        <tr>
								        	<td colspan="8"></td>
								        </tr>
								        <tr style="background-color: rgb(223,240,216)">
								          <td>3389</td>
								          <td>tcp</td>
								          <td>open</td>
								          <td>syn-ack</td>
								          <td>ms-wbt-server</td>
								          <td>Microsoft Terminal Service</td>
								          <td> </td>
								          <td> </td>
								        </tr>
								        <tr>
								        	<td colspan="8"></td>
								        </tr>
								        <tr style="background-color: rgb(223,240,216)">
								          <td>3700</td>
								          <td>tcp</td>
								          <td>open</td>
								          <td>syn-ack</td>
								          <td>giop</td>
								          <td>CORBA naming service</td>
								          <td> </td>
								          <td> </td>
								        </tr>
								        <tr>
								        	<td colspan="8"></td>
								        </tr>
								        <tr style="background-color: rgb(223,240,216)">
								          <td>4848</td>
								          <td>tcp</td>
								          <td>open</td>
								          <td>syn-ack</td>
								          <td>appserv-http</td>
								          <td> </td>
								          <td> </td>
								          <td> </td>
								        </tr>
								        <tr>
								        	<td colspan="8"></td>
								        </tr>
								        <tr style="background-color: rgb(223,240,216)">
								          <td>5985</td>
								          <td>tcp</td>
								          <td>open</td>
								          <td>syn-ack</td>
								          <td>http</td>
								          <td>Microsoft HTTPAPI httpd</td>
								          <td>2.0</td>
								          <td>SSDP/UPnP</td>
								        </tr>
								        <tr>
								        	<td colspan="8"></td>
								        </tr>
								        <tr style="background-color: rgb(223,240,216)">
								          <td>7676</td>
								          <td>tcp</td>
								          <td>open</td>
								          <td>syn-ack</td>
								          <td>java-message-service</td>
								          <td>Java Message Service</td>
								          <td>301</td>
								          <td> </td>
								        </tr>
								        <tr>
								        	<td colspan="8"></td>
								        </tr>
								        <tr style="background-color: rgb(223,240,216)">
								          <td>8009</td>
								          <td>tcp</td>
								          <td>open</td>
								          <td>syn-ack</td>
								          <td>ajp13</td>
								          <td>Apache Jserv</td>
								          <td> </td>
								          <td>Protocol v1.3</td>
								        </tr>
								        <tr>
								        	<td colspan="8"></td>
								        </tr>
								        <tr style="background-color: rgb(223,240,216)">
								          <td>8019</td>
								          <td>tcp</td>
								          <td>open</td>
								          <td>syn-ack</td>
								          <td>qbdb</td>
								          <td> </td>
								          <td> </td>
								          <td> </td>
								        </tr>
								        <tr>
								        	<td colspan="8">

								        	</td>
								        </tr>
								        <tr style="background-color: rgb(223,240,216)">
								          <td>8020</td>
								          <td>tcp</td>
								          <td>open</td>
								          <td>syn-ack</td>
								          <td>http</td>
								          <td>Apache httpd</td>
								          <td> </td>
								          <td> </td>
								        </tr>
							      	</tbody>
							    </table>
							</div>
			        	</div>
			    	</div>
			    </div>
			</div>
		</div>
	</div>	
	<div class="row">
		<div class="col-md mt-1">
			<div id="accordion">
			    <div class="card">
			    	<a class="card-link" data-toggle="collapse" href="#collapse2">
				        <div class="card-header">
					        10.10.2.23
				      	</div>
			      	</a>
			      	<div id="collapse2" class="collapse" data-parent="#accordion">
			        	<div class="card-body">
			          		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
			        	</div>
			    	</div>
			    </div>
			</div>
		</div>
	</div>	
	<div class="row">
		<div class="col-md mt-1">
			<div id="accordion">
			    <div class="card">
			        <a class="card-link" data-toggle="collapse" href="#collapse3">
				        <div class="card-header">
					        10.10.2.100
				      	</div>
			      	</a>
			      	<div id="collapse3" class="collapse" data-parent="#accordion">
			        	<div class="card-body">
			          		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
			        	</div>
			    	</div>
			    </div>
			</div>
		</div>
	</div>	
</div>



</body>
</html>