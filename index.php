<?php
require_once('dashboard-processing.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Visual OTP - Dashboard</title>  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
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
                    <h2 class="text-center"><?php echo getCriticalVulnNumber(); ?></h2>
                    <h6 class="text-center">Critical Risk</h6>
                </div>
                <div class="col-md bg-warning rounded" style="margin: 1px;">
                    <h2 class="text-center"><?php echo getHighVulnNumber(); ?></h2>
                    <h6 class="text-center">High Risk</h6>
                </div>
                <div class="col-md bg-success rounded" style="margin: 1px;">
                    <h2 class="text-center"><?php echo getMediumVulnNumber(); ?></h2>
                    <h6 class="text-center">Medium Risk</h6>
                </div>
                <div class="col-md bg-primary rounded" style="margin: 1px;">
                    <h2 class="text-center"><?php echo getLowVulnNumber(); ?></h2>
                    <h6 class="text-center">Low Risk</h6>
                </div>
            </div>
        </div>
        <div class="col-md border mt-2 mx-2">
             <div class="row">
                <div class="container-fluid">
                    <h4 class="text-secondary">Scanners Statistics</h4>
                </div>
            </div>
            <div class="row text-white">
                <div class="col-md" style="margin: 1px">
                    <div class="row" style="padding: 5px">
                        <div class="col bg-info rounded">
                            <h2 class="text-center"><?php echo count(getScanners()); ?></h2>
                            <h6 class="text-center">Scans</h6>
                        </div>
                    </div>
                </div>

                <div class="col-md" style="margin: 1px">
                    <div class="row" style="padding: 5px">
                        <div class="col bg-info rounded">
                            <h2 class="text-center"><?php echo count(getHosts()); ?></h2>
                            <h6 class="text-center">Hosts Found</h6>
                        </div>
                    </div>
                </div>

                <div class="col-md" style="margin: 1px">
                    <div class="row" style="padding: 5px">
                        <div class="col bg-info rounded">
                            <h2 class="text-center"><?php echo count(getPorts()); ?></h2>
                            <h6 class="text-center">Open Ports Found</h6>
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
<script src="js/jquery/jquery-3.4.1.min.js"></script>
<script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<script>

<?php 
$conn = OpenConnection();

$sql = "select count(vulnerabilities.id_cve) as total ,scanners.end from scanners INNER JOIN hosts on scanners.id_scanner=hosts.id_scanner INNER JOIN ports on hosts.id_host=ports.id_host INNER JOIN vulnerabilities_list on ports.id_port=vulnerabilities_list.id_port INNER JOIN vulnerabilities on vulnerabilities.id_cve=vulnerabilities_list.id_cve  WHERE vulnerabilities.score < 3 GROUP BY scanners.end ORDER BY scanners.end ASC";
$result = $conn->query($sql);
$lowVulnRows = $result->fetch_all(MYSQLI_ASSOC);

$sql = "select count(vulnerabilities.id_cve) as total ,scanners.end from scanners INNER JOIN hosts on scanners.id_scanner=hosts.id_scanner INNER JOIN ports on hosts.id_host=ports.id_host INNER JOIN vulnerabilities_list on ports.id_port=vulnerabilities_list.id_port INNER JOIN vulnerabilities on vulnerabilities.id_cve=vulnerabilities_list.id_cve  WHERE vulnerabilities.score >= 3 AND vulnerabilities.score < 5 GROUP BY scanners.end ORDER BY scanners.end ASC";
$result = $conn->query($sql);
$mediumVulnRows = $result->fetch_all(MYSQLI_ASSOC);

$sql = "select count(vulnerabilities.id_cve) as total ,scanners.end from scanners INNER JOIN hosts on scanners.id_scanner=hosts.id_scanner INNER JOIN ports on hosts.id_host=ports.id_host INNER JOIN vulnerabilities_list on ports.id_port=vulnerabilities_list.id_port INNER JOIN vulnerabilities on vulnerabilities.id_cve=vulnerabilities_list.id_cve  WHERE vulnerabilities.score >= 5 AND vulnerabilities.score < 8 GROUP BY scanners.end ORDER BY scanners.end ASC";
$result = $conn->query($sql);
$highVulnRows = $result->fetch_all(MYSQLI_ASSOC);

$sql = "select count(vulnerabilities.id_cve) as total ,scanners.end from scanners INNER JOIN hosts on scanners.id_scanner=hosts.id_scanner INNER JOIN ports on hosts.id_host=ports.id_host INNER JOIN vulnerabilities_list on ports.id_port=vulnerabilities_list.id_port INNER JOIN vulnerabilities on vulnerabilities.id_cve=vulnerabilities_list.id_cve  WHERE vulnerabilities.score >= 8 AND vulnerabilities.score <= 10 GROUP BY scanners.end ORDER BY scanners.end ASC";
$result = $conn->query($sql);
$criticalVulnRows = $result->fetch_all(MYSQLI_ASSOC);

$sql = "select scanners.end from scanners ORDER BY scanners.end ASC";
$result = $conn->query($sql);
$dates = $result->fetch_all(MYSQLI_ASSOC);

$sql = "select count(ports.id_port) as total,ports.port_number,ports.protocol from ports GROUP BY ports.port_number";
$result = $conn->query($sql);
$portsRows = $result->fetch_all(MYSQLI_ASSOC);

$sql = "select count(hosts.id_host) as total,hosts.OS from hosts GROUP by hosts.OS";
$result = $conn->query($sql);
$hostsRows = $result->fetch_all(MYSQLI_ASSOC);



$lowDataPoints = array();
$mediumDataPoints = array();
$highDataPoints = array();
$criticalDataPoints = array();
$portsDataPoints = array();
$hostsDataPoints = array();

for($i=0;$i<count($dates);$i++)
{
    array_push($lowDataPoints, array("x"=>$i,"y"=>0));
    for($j=0;$j<count($lowVulnRows);$j++)
    {
        if(strcmp($dates[$i]['end'],$lowVulnRows[$j]['end'])==0)
        {
            $lowDataPoints[$i]['y']=$lowVulnRows[$j]['total'];
        }    
    }

    array_push($mediumDataPoints, array("x"=>$i,"y"=>0));
    for($j=0;$j<count($mediumVulnRows);$j++)
    {
        if(strcmp($dates[$i]['end'],$mediumVulnRows[$j]['end'])==0)
        {
            $mediumDataPoints[$i]['y']=$mediumVulnRows[$j]['total'];
        }    
    }

    array_push($highDataPoints, array("x"=>$i,"y"=>0));
    for($j=0;$j<count($highVulnRows);$j++)
    {
        if(strcmp($dates[$i]['end'],$highVulnRows[$j]['end'])==0)
        {
            $highDataPoints[$i]['y']=$highVulnRows[$j]['total'];
        }    
    }

    array_push($criticalDataPoints, array("x"=>$i,"y"=>0));
    for($j=0;$j<count($criticalVulnRows);$j++)
    {
        if(strcmp($dates[$i]['end'],$criticalVulnRows[$j]['end'])==0)
        {
            $criticalDataPoints[$i]['y']=$criticalVulnRows[$j]['total'];
        }    
    }

}

$totalPorts = 0;
for($i=0;$i<count($portsRows);$i++)
{
    $totalPorts += $portsRows[$i]['total'];
}
for($i=0;$i<count($portsRows);$i++)
{
   array_push($portsDataPoints,array("label"=>$portsRows[$i]['port_number']."/".$portsRows[$i]['protocol'],"y"=>($portsRows[$i]['total']/$totalPorts)*100));
}

$totalHosts = 0;
for($i=0;$i<count($hostsRows);$i++)
{
  $totalHosts += $hostsRows[$i]['total'];
}

for($i=0;$i<count($hostsRows);$i++)
{
  array_push($hostsDataPoints, array("label"=>$hostsRows[$i]['OS'],"y"=>$hostsRows[$i]['total']/$totalHosts*100));
}

CloseConnection($conn);
?>
    window.onload = function () {
    var lineChart = new CanvasJS.Chart("lineChartContainer",
    {
     animationEnabled: true,
      title:{
      text: "Vulnerability Trend Over Time"  
      },
      axisX: {
        title: "Time"
      },
      axisY: {
        title: "Number Of Vulnerabilities"
      },
      data: [
      {        
        type: "line",
        color: "red",
        name: "Critical Vulnerabilities",
        showInLegend: true,
        toolTipContent: "Date: {x} <br>{name}: {y}",
        dataPoints: <?php echo json_encode($criticalDataPoints,JSON_NUMERIC_CHECK);  ?>
      },
        {        
        type: "line",
        color: "orange",
        showInLegend: true,
        name: "High Vulnerabilities",
        toolTipContent: "Date: {x} <br>{name}: {y}",
        dataPoints: <?php echo json_encode($highDataPoints,JSON_NUMERIC_CHECK);  ?>
      },
        {        
        type: "line",
        showInLegend: true,
        color:"green",
        name: "Medium Vulnerabilities",
        toolTipContent: "Date: {x} <br>{name}: {y}",
        dataPoints: <?php echo json_encode($mediumDataPoints,JSON_NUMERIC_CHECK);  ?>
      },
        {        
        type: "line",
        color: "blue",
        name: "Low Vulnerabilities",
        toolTipContent: "Date: {x} <br>{name}: {y}",
        showInLegend: true,
        dataPoints: <?php echo json_encode($lowDataPoints,JSON_NUMERIC_CHECK);  ?>
      }
      ]
    });
    var pieChartVuln = new CanvasJS.Chart("pieChartVuln", {
      animationEnabled: true,
      title: {
        text: "Open Port Distribution"
      },
      data: [{
        type: "pie",
        yValueFormatString: "#,##0.00\"%\"",
        indexLabel: "{label} ({y})",
        dataPoints: <?php echo json_encode($portsDataPoints); ?>
      }]
    });

     var pieChartOS = new CanvasJS.Chart("pieChartOS", {
      animationEnabled: true,
      title: {
        text: "Computers by Operating System"
      },
      data: [{
        type: "pie",
        yValueFormatString: "#,##0.00\"%\"",
        indexLabel: "{label} ({y})",
        dataPoints: <?php echo json_encode($hostsDataPoints); ?>
      }]
    });

    lineChart.render();
    pieChartOS.render();
    pieChartVuln.render();
  }
</script>
</body>
</html>

