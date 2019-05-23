<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Visual One-Two Punch</title>  
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
  <a class="navbar-brand" href="#">Visual OTP</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <button type="button" class="btn btn-outline-info ml-3">Dashboard</button>
      </li>
      <li class="nav-item">
        <button type="button" class="btn btn-outline-info ml-3">Scanner</button>
      </li>
      <li class="nav-item">
        <button type="button" class="btn btn-outline-info ml-3">Results</button>
      </li>
      <li class="nav-item">
        <button type="button" class="btn btn-outline-info ml-3">Reports</button>
      </li>    
    </ul>
  </div>  
</nav>
<br>
<div class="container-fluid">
    <div class="row">
        <div class="container-fluid">
            <h4 class="text-secondary">Current Vulnerabilities</h4>
        </div>
    </div>
    <div class="row text-white">
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
<div class="container-fluid">
    
    <div class="row px-2 my-4">
         <div id="lineChartContainer" style="height: 250px; width: 100%;">
        </div>
    </div>
    
    <div class="row p-3">
        <div id="pieChartOS" class="col-md" style="height: 250px;width: 100%">
        </div>
        <div id="pieChartVuln" class="col-md" style="height: 250px; width: 100%">
        </div>
    </div>
    
</div>
</body>
</html>

