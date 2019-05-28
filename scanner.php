<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Visual OTP - Scanner</title>  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript" src="lineChart.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
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
        <button type="button" class="btn btn-outline-info ml-3">Reports</button>
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
			<h3>Create a new scanner</h3>
			  	<div class="row">
					<div class="col-md px-4 py-2">
						<label for="usr">Scanner name</label>
						<input type="text" class="form-control" id="usr">
					</div>
				</div>
			  	<div class="row">
					<div class="col-md px-4 py-2">
						<label for="usr">Target IP/network:</label>
						<input type="text" class="form-control" id="usr">
					</div>
				</div>
				<div class="row">
					<div class="col-md px-4 py-2">
						<label for="methods">Select TCP Scanning Technique</label>
					    <select name="cars" class="custom-select" id="methods">
					      <option value="volvo">TCP SYN scan</option>
					      <option value="fiat">TCP connect scan</option>
					      <option value="audi">SCTP INIT scan</option>
						      <option selected>TCP NULL scan</option>
					      <option value="volvo">TCP FIN scan</option>
					      <option value="fiat">TCP Xmas scan</option>
					      <option value="audi">TCP ACK scan</option>
						      <option value="volvo">TCP Window scan</option>
					      <option value="fiat">TCP Maimon scan</option>
					      <option value="fiat">IP Protocol scan</option>
					      <option value="audi">Custom TCP scan</option>
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
						    <input type="checkbox" class="custom-control-input" id="switch1">
						    <label class="custom-control-label" for="switch1">Enable UDP Scanning</label>
					  	</div>
					</div>
				</div>
				<div class="row px-4">
					<button type="button" class="btn btn-primary btn-block">Submit</button>
				</div>
		</div>
	</div>
</div>
<div class="container my-5">
	<div class="row bg-info">
		<div class="col-md text-center">
			<h3 class="text-white p-4">Scanner List</h3>
		</div>
	</div>	
	<div class="row">
		<div class="col-md">
			<table class="table table-hover table-responsive">
			    <thead class="thead-dark">
				    <tr>
				    	<th>Status</th>
					    <th>Scanner</th>
					    <th>Target</th>
					    <th>Last scan</th>
					    <th class="w-50">Vulnerabilities</th>
					    <th align="center">Actions</th>
				    </tr>
			    </thead>
			    <tbody>
					<tr>
						<td style="padding-left: 20px">
							<div class="spinner-border text-muted"></div>
						</td>
						<td>Metasploitable3 - Ubuntu Server scanner</td>
						<td>172.128.28.5</td>
						<td>10/05/2019 22:09:15</td>
						<td>
							<div class="progress border">
								<div class="progress-bar bg-primary" style="width:40%">
							    </div>
							    <div class="progress-bar bg-success" style="width:25%">
							    </div>
							    <div class="progress-bar bg-warning" style="width:10%">
							    </div>
							    <div class="progress-bar bg-danger" style="width:5%">
							    </div>
  							</div>
						</td>
						<td>
							<i class="fas fa-redo-alt fa-lg"></i>
							<i class="fas fa-trash-alt fa-lg" style="color: red; margin-left: 10px"></i>
						</td>
					</tr>
					<tr>
						<td class="px-4">
							<i class="far fa-check-circle fa-lg" style="color:green;"></i>
						</td>
						<td>Metasploitable3 - Windows 2008 Server R2 scanner</td>
						<td>192.168.0.100</td>
						<td>11/04/2019 12:29:05</td>
						<td>
							<div class="progress border">
							   <div class="progress-bar bg-primary" style="width:34%">
							    </div>
							    <div class="progress-bar bg-success" style="width:28%">
							    </div>
							    <div class="progress-bar bg-warning" style="width:10%">
							    </div>
							    <div class="progress-bar bg-danger" style="width:5%">
							    </div>
  							</div>
						</td>
						<td>
							<i class="fas fa-redo-alt fa-lg"></i>
							<i class="fas fa-trash-alt fa-lg" style="color: red; margin-left: 10px"></i>
						</td>
					</tr>
					<tr>
						<td class="px-4">
							<i class="far fa-check-circle fa-lg" style="color:green;"></i>
						</td>
						<td>Metasploitable2 - Linux scanner</td>
						<td>172.128.28.5</td>
						<td>19/04/2019 15:43:07</td>
						<td>
							<div class="progress border">
							    <div class="progress-bar bg-primary" style="width:4%">
							    </div>
							    <div class="progress-bar bg-success" style="width:65%">
							    </div>
							    <div class="progress-bar bg-warning" style="width:10%">
							    </div>
							    <div class="progress-bar bg-danger" style="width:21%">
							    </div>
  							</div>
						</td>
						<td>
							<i class="fas fa-redo-alt fa-lg"></i>
							<i class="fas fa-trash-alt fa-lg" style="color: red;margin-left: 10px;"></i>
						</td>
					</tr>
					<tr>
						<td class="px-4">
							<i class="far fa-check-circle fa-lg" style="color:green;"></i>
						</td>
						<td>WiFiMotoc Network scanner</td>
						<td>10.10.2.1/18</td>
						<td>21/04/2019 09:29:05</td>
						<td>
							<div class="progress border">
							    <div class="progress-bar bg-primary" style="width:40%">
							    </div>
							    <div class="progress-bar bg-success" style="width:25%">
							    </div>
							    <div class="progress-bar bg-warning" style="width:10%">
							    </div>
							    <div class="progress-bar bg-danger" style="width:5%">
							    </div>
  							</div>
						</td>
						<td>
							<i class="fas fa-redo-alt fa-lg"></i>
							<i class="fas fa-trash-alt fa-lg" style="color: red; margin-left: 10px"></i>
						</td>
					</tr>
					<tr>
						<td class="px-4">
							<i class="far fa-check-circle fa-lg" style="color:green;"></i>
						</td>
						<td>DVL scanner</td>
						<td>172.128.28.5</td>
						<td>21/04/2019 12:36:55</td>
						<td>
							<div class="progress border">
								<div class="progress-bar bg-primary" style="width:40%">
							    </div>
							    <div class="progress-bar bg-success" style="width:25%">
							    </div>
							    <div class="progress-bar bg-warning" style="width:10%">
							    </div>
							    <div class="progress-bar bg-danger" style="width:5%">
							    </div>
  							</div>
						</td>
						<td>
							<i class="fas fa-redo-alt fa-lg"></i>
							<i class="fas fa-trash-alt fa-lg" style="color: red; margin-left: 10px"></i>
						</td>
					</tr>
					<tr>
						<td class="px-4">
							<i class="far fa-check-circle fa-lg" style="color:green;"></i>
						</td>
						<td>Kioptrix Lvl 2 scanner</td>
						<td>192.168.0.100</td>
						<td>23/04/2019 16:55:05</td>
						<td>
							<div class="progress border">
							   <div class="progress-bar bg-primary" style="width:34%">
							    </div>
							    <div class="progress-bar bg-success" style="width:28%">
							    </div>
							    <div class="progress-bar bg-warning" style="width:10%">
							    </div>
							    <div class="progress-bar bg-danger" style="width:5%">
							    </div>
  							</div>
						</td>
						<td>
							<i class="fas fa-redo-alt fa-lg"></i>
							<i class="fas fa-trash-alt fa-lg" style="color: red; margin-left: 10px"></i>
						</td>
					</tr>
					<tr>
						<td class="px-4">
							<i class="far fa-check-circle fa-lg" style="color:green;"></i>
						</td>
						<td>Kioptrix Lvl 1 scanner</td>
						<td>172.128.28.5</td>
						<td>30/04/2019 00:00:05</td>
						<td>
							<div class="progress border">
							    <div class="progress-bar bg-primary" style="width:4%">
							    </div>
							    <div class="progress-bar bg-success" style="width:65%">
							    </div>
							    <div class="progress-bar bg-warning" style="width:10%">
							    </div>
							    <div class="progress-bar bg-danger" style="width:21%">
							    </div>
  							</div>
						</td>
						<td>
							<i class="fas fa-redo-alt fa-lg"></i>
							<i class="fas fa-trash-alt fa-lg" style="color: red; margin-left: 10px"></i>
						</td>
					</tr>
					<tr>
						<td class="px-4">
							<i class="far fa-check-circle fa-lg" style="color:green;"></i>
						</td>
						<td>WiFiStudenti Network scanner</td>
						<td>10.10.2.1/18</td>
						<td>05/05/2019 12:29:05</td>
						<td>
							<div class="progress border">
							    <div class="progress-bar bg-primary" style="width:40%">
							    </div>
							    <div class="progress-bar bg-success" style="width:25%">
							    </div>
							    <div class="progress-bar bg-warning" style="width:10%">
							    </div>
							    <div class="progress-bar bg-danger" style="width:5%">
							    </div>
  							</div>
						</td>
						<td>
							<i class="fas fa-redo-alt fa-lg"></i>
							<i class="fas fa-trash-alt fa-lg" style="color: red; margin-left: 10px"></i>
						</td>
					</tr>
			    </tbody>
		    </table>
		</div>
	</div>
		   
</div>
</body>
</html>