<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Visual OTP - Dashboard</title>  
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
        <button type="button" class="btn btn-outline-info ml-3">Reports</button>
      </li>    
    </ul>
  </div>  
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-md border mt-2 mx-2">
             <div class="row">
                <div class="container-fluid">
                    <h4 class="text-secondary">Current Vulnerabilities</h4>
                </div>
            </div>
            <div class="row text-white" style="padding: 5px">
                <div class="col-md bg-danger rounded" style="margin: 1px;">
                    <h2 class="text-center">13</h2>
                    <h6 class="text-center">Critical Risk</h6>
                </div>
                <div class="col-md bg-warning rounded" style="margin: 1px;">
                    <h2 class="text-center">23</h2>
                    <h6 class="text-center">High Risk</h6>
                </div>
                <div class="col-md bg-success rounded" style="margin: 1px;">
                    <h2 class="text-center">3</h2>
                    <h6 class="text-center">Medium Risk</h6>
                </div>
                <div class="col-md bg-primary rounded" style="margin: 1px;">
                    <h2 class="text-center">21</h2>
                    <h6 class="text-center">Low Risk</h6>
                </div>
            </div>
        </div>
        <div class="col-md border mt-2 mx-2">
             <div class="row">
                <div class="container-fluid">
                    <h4 class="text-secondary">Dashboard</h4>
                </div>
            </div>
            <div class="row text-white">
                <div class="col-md" style="margin: 1px">
                    <div class="row" style="padding: 5px">
                        <div class="col bg-info rounded">
                            <h2 class="text-center">26</h2>
                            <h6 class="text-center">Scans</h6>
                        </div>
                    </div>
                </div>

                <div class="col-md" style="margin: 1px">
                    <div class="row" style="padding: 5px">
                        <div class="col bg-info rounded">
                            <h2 class="text-center">126</h2>
                            <h6 class="text-center">Hosts Found</h6>
                        </div>
                    </div>
                </div>

                <div class="col-md" style="margin: 1px">
                    <div class="row" style="padding: 5px">
                        <div class="col bg-info rounded">
                            <h2 class="text-center">26</h2>
                            <h6 class="text-center">Services Found</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<div class="container-fluid mt-2">
    <div class="row">
        <div id="pieChartOS" class="col-md mx-1" style="height: 250px;width: 100%">
        </div>
        <div id="pieChartVuln" class="col-md mx-1" style="height: 250px; width: 100%">
        </div>
    </div>
    <div class="row">
         <div id="lineChartContainer" style="height: 250px; width: 100%">
        </div>
    </div>
    
</div>
</body>
</html>

