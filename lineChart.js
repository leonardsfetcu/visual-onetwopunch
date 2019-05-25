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
        dataPoints: [
        { x: 10, y: 21 },
        { x: 20, y: 25},
        { x: 30, y: 20 },
        { x: 40, y: 25 },
        { x: 50, y: 27 },
        { x: 60, y: 28 },
        { x: 70, y: 28 },
        { x: 80, y: 24 },
        { x: 90, y: 26}
      
        ]
      },
        {        
        type: "line",
        color: "orange",
        showInLegend: true,
        name: "High Vulnerabilities",
        toolTipContent: "Date: {x} <br>{name}: {y}",
        dataPoints: [
        { x: 10, y: 31 },
        { x: 20, y: 35},
        { x: 30, y: 30 },
        { x: 40, y: 35 },
        { x: 50, y: 35 },
        { x: 60, y: 38 },
        { x: 70, y: 38 },
        { x: 80, y: 34 },
        { x: 90, y: 44}
      
        ]
      },
        {        
        type: "line",
        showInLegend: true,
        color:"green",
        name: "Medium Vulnerabilities",
        toolTipContent: "Date: {x} <br>{name}: {y}",
        dataPoints: [
        { x: 10, y: 45 },
        { x: 20, y: 50},
        { x: 30, y: 40 },
        { x: 40, y: 45 },
        { x: 50, y: 45 },
        { x: 60, y: 48 },
        { x: 70, y: 43 },
        { x: 80, y: 41 },
        { x: 90, y: 28}
      
        ]
      },
        {        
        type: "line",
        color: "blue",
        name: "Low Vulnerabilities",
        toolTipContent: "Date: {x} <br>{name}: {y}",
        showInLegend: true,
        dataPoints: [
        { x: 10, y: 71 },
        { x: 20, y: 55},
        { x: 30, y: 50 },
        { x: 40, y: 65 },
        { x: 50, y: 95 },
        { x: 60, y: 68 },
        { x: 70, y: 28 },
        { x: 80, y: 34 },
        { x: 90, y: 14}
      
        ]
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
        dataPoints: [
        {label: "Port 80",y:"43.0"},
        {label:"Port 443",y:"31"},
        {label:"Port 21",y:"12"},
        {label:"Port 22",y:"7"},
        {label:"Port 135",y:"3"},
        {label:"Port 8080",y:"4"}
        ]
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
        dataPoints: [
        {label: "Windows 7",y:"64.02"},
        {label:"Windows Server 2008 R2",y:"12.55"},
        {label:"Ubuntu",y:"8.47"},
        {label:"Linux 64bit",y:"6.08"},
        {label:"BSD",y:"4.29"},
        {label:"Others",y:"4.59"}
        ]
      }]
    });

    lineChart.render();
    pieChartOS.render();
    pieChartVuln.render();
  }