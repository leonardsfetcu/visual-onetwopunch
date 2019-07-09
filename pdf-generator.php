<?php

require_once( "FPDF/fpdf.php" );
require_once("dashboard-processing.php");

// Begin configuration


if(isset($_GET['submit']))
{
	$parameters = explode("-",$_GET['submit']);
	if(is_numeric($parameters[1]))
	{
		generatePDF($parameters[1]);
	}
	
}
function generatePDF($id_scanner)
{
	$conn = OpenConnection();
	CheckConnection($conn);

	$tableHeaderTopTextColour = array( 255, 255, 255 );
	$tableHeaderTopFillColour = array( 125, 152, 179 );
	$tableHeaderTopProductTextColour = array( 0, 0, 0 );
	$tableHeaderTopProductFillColour = array( 143, 173, 204 );
	$tableHeaderLeftTextColour = array( 99, 42, 57 );
	$tableHeaderLeftFillColour = array( 184, 207, 229 );
	$tableBorderColour = array( 50, 50, 50 );
	$tableRowFillColour = array( 213, 170, 170 );
	$reportName = "Visual One-Two Punch Scanning Report";
	$reportNameYPos = 150;
	$logoFile = "FPDF/otp-logo.jpg";
	$logoXPos = 50;
	$logoYPos = 90;
	$logoWidth = 110;
	$columnLabels = array( "Q1", "Q2", "Q3", "Q4" );
	$rowLabels = array( "Low", "Medium", "High", "Critical" );
	$chartXPos = 20;
	$chartYPos = 250;
	$chartWidth = 160;
	$chartHeight = 80;
	$chartXLabel = "Vulnerabilities Impact";
	$chartYLabel = "No. of Appearances";
	$chartYStep = 5;

	$chartColours = array(
	                  array( 0, 123, 233 ),
	                  array( 40, 167, 69 ),
	                  array( 255, 193, 7 ),
	                  array( 220, 53, 69 ),
	                );

	$vulnData = array();
	$totalPorts = 0;
	$sql = "select count(vulnerabilities.id_cve) as total from vulnerabilities INNER JOIN vulnerabilities_list on vulnerabilities.id_cve=vulnerabilities_list.id_cve INNER JOIN ports on vulnerabilities_list.id_port=ports.id_port INNER JOIN hosts on hosts.id_host=ports.id_host INNER JOIN scanners on scanners.id_scanner=hosts.id_scanner WHERE scanners.id_scanner=".$id_scanner." and vulnerabilities.score < 3";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$vulnData[] = $row['total'];
	$sql = "select count(vulnerabilities.id_cve) as total from vulnerabilities INNER JOIN vulnerabilities_list on vulnerabilities.id_cve=vulnerabilities_list.id_cve INNER JOIN ports on vulnerabilities_list.id_port=ports.id_port INNER JOIN hosts on hosts.id_host=ports.id_host INNER JOIN scanners on scanners.id_scanner=hosts.id_scanner WHERE scanners.id_scanner=".$id_scanner." and vulnerabilities.score >=3 and vulnerabilities.score < 5";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$vulnData[] = $row['total'];
	$sql = "select count(vulnerabilities.id_cve) as total from vulnerabilities INNER JOIN vulnerabilities_list on vulnerabilities.id_cve=vulnerabilities_list.id_cve INNER JOIN ports on vulnerabilities_list.id_port=ports.id_port INNER JOIN hosts on hosts.id_host=ports.id_host INNER JOIN scanners on scanners.id_scanner=hosts.id_scanner WHERE scanners.id_scanner=".$id_scanner." and vulnerabilities.score >=5 and vulnerabilities.score < 8";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$vulnData[] = $row['total'];
	$sql = "select count(vulnerabilities.id_cve) as total from vulnerabilities INNER JOIN vulnerabilities_list on vulnerabilities.id_cve=vulnerabilities_list.id_cve INNER JOIN ports on vulnerabilities_list.id_port=ports.id_port INNER JOIN hosts on hosts.id_host=ports.id_host INNER JOIN scanners on scanners.id_scanner=hosts.id_scanner WHERE scanners.id_scanner=".$id_scanner." and vulnerabilities.score >=8 and vulnerabilities.score <= 10";

	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$vulnData[] = $row['total'];

	$sql = "select ports.* from ports INNER JOIN hosts on hosts.id_host=ports.id_host INNER JOIN scanners on scanners.id_scanner=hosts.id_scanner WHERE scanners.id_scanner=".$id_scanner;
	$result = $conn->query($sql);
	$portsData = $result->fetch_all(MYSQLI_ASSOC);
	$totalPorts = count($portsData);

	$sql = "select * from scanners WHERE scanners.id_scanner=".$id_scanner;
	$result=$conn->query($sql);
	$scannerData = $result->fetch_assoc();

	$sql = "select * from hosts INNER JOIN scanners on hosts.id_scanner=scanners.id_scanner WHERE scanners.id_scanner=".$id_scanner;
	$result = $conn->query($sql);
	$totalHosts = $result->fetch_all(MYSQLI_ASSOC);

	$sql = "select vulnerabilities.*, ports.id_host,ports.service, ports.id_port, ports.port_number, ports.protocol as total from vulnerabilities INNER JOIN vulnerabilities_list on vulnerabilities.id_cve=vulnerabilities_list.id_cve INNER JOIN ports on vulnerabilities_list.id_port=ports.id_port INNER JOIN hosts on hosts.id_host=ports.id_host INNER JOIN scanners on scanners.id_scanner=hosts.id_scanner WHERE scanners.id_scanner=".$id_scanner;
	$result=$conn->query($sql);
	$vulnRows = $result->fetch_all(MYSQLI_ASSOC);

	$technique = "";
	if($scannerData['sS'])
		$technique="TCP SYN Scan";

	if($scannerData['sT'])
		$technique="TCP Connect Scan";

	if($scannerData['sU'])
		$technique="UDP Scan";

	if($scannerData['sY'])
		$technique="SCTP Init Scan";

	if($scannerData['sN'])
		$technique="TCP NULL Scan";

	if($scannerData['sF'])
		$technique="TCP Fin Scan";

	if($scannerData['sX'])
		$technique="TCP Xmas Scan";

	if($scannerData['sA'])
		$technique="TCP ACK Scan";
	
	// End configuration


	/**
	  Create the title page
	**/

	$pdf = new FPDF( 'P', 'mm', 'A4' );
	$pdf->SetTitle("Visual OTP Scanning reportName");
	$pdf->SetCreator("Visual OTP");


	// add first page
	$pdf->AddPage();

	// header
	$pdf->SetFont('Times','',11);
	$pdf->SetTextColor(100,100,100);
	$pdf->Cell(0,5,"Academia Tehnica Militara \"Ferdinand I\" Bucuresti",0,0,'C');
	$pdf->Rect(10,8.5,190,8);

	// Logo
	$pdf->Image($logoFile, $logoXPos, $logoYPos, $logoWidth );

	// Report name and date
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont( 'Times', 'B', 24 );
	$pdf->Ln( $reportNameYPos );
	$pdf->Cell( 0, 10, $reportName, 0, 0, 'C' );
	$pdf->SetFont( 'Times', 'I', 14 );
	$pdf->Ln();
	$pdf->Cell( 0, 15, $scannerData['name'], 0, 0, 'C' );
	$pdf->Ln(8);
	$pdf->Cell( 0, 15, "Date: ".$scannerData['end'], 0, 0, 'C' );


	// add first page
	$pdf->AddPage();

	// header
	$pdf->SetFont('Times','',11);
	$pdf->SetTextColor(100,100,100);
	$pdf->Cell(0,5,"Academia Tehnica Militara \"Ferdinand I\" Bucuresti",0,0,'C');
	$pdf->Rect(10,8.5,190,8);
	$pdf->Ln();

	//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
	$pdf->SetTextColor(0,128,255);
	$pdf->SetFont('Times','B',22);
	$pdf->Cell(0,25,"1. Scanner Details");
	$pdf->Ln();

	$pdf->SetFillColor(200,200,200);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetDrawColor(0,0,0);


	// 
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(55,12,"Scanner Name",1,1,'L',true);
	$pdf->Cell(55,12,"Scanning Technique",1,1,'L',true);
	$pdf->Cell(55,12,"Target",1,1,'L',true);
	$pdf->Cell(55,12,"Host(s) found",1,1,'L',true);
	$pdf->Cell(55,12,"Ports found",1,1,'L',true);
	$pdf->Cell(55,12,"Vulnerabilities found",1,1,'L',true);

	$pdf->SetXY(65,40);
	$pdf->SetFont('Arial','',14);
	$pdf->Cell(135,12,$scannerData['name'],1,2,'L',true);
	$pdf->Cell(135,12,$technique,1,2,'L',true);
	$pdf->Cell(135,12,$scannerData['target'],1,2,'L',true);
	$pdf->Cell(135,12,count($totalHosts),1,2,'L',true);
	$pdf->Cell(135,12,$totalPorts,1,2,'L',true);
	$pdf->Cell(135,12,$vulnData[0]+$vulnData[1]+$vulnData[2]+$vulnData[3],1,2,'L',true);

	/***
	  Create the chart
	***/

	// Compute the X scale
	$xScale = count($rowLabels) / ( $chartWidth - 40 );

	// Compute the Y scale

	$maxTotal = 0;

	 foreach ( $vulnData as $dataCell )
	 {
	 	if($dataCell > $maxTotal)
	 		$maxTotal = $dataCell;
	 }
	 
	

	$yScale = $maxTotal / $chartHeight;
				
	// Compute the bar width
	$barWidth = ( 1 / $xScale ) / 1.5;

	// Add the axes:

	$pdf->SetFont( 'Arial', '', 10 );

	// X axis
	$pdf->Line( $chartXPos + 30, $chartYPos, $chartXPos + $chartWidth, $chartYPos );

	for ( $i=0; $i < count( $rowLabels ); $i++ ) {
	  $pdf->SetXY( $chartXPos + 40 +  $i / $xScale, $chartYPos );
	  $pdf->Cell( $barWidth, 10, $rowLabels[$i], 0, 0, 'C' );
	}

	// Y axis
	$pdf->Line( $chartXPos + 30, $chartYPos, $chartXPos + 30, $chartYPos - $chartHeight - 8 );

	if($yScale)
	{
		for ( $i=0; $i <= $maxTotal; $i += $chartYStep ) {
	  	$pdf->SetXY( $chartXPos + 7, $chartYPos - 5 - $i / $yScale );
	  	$pdf->Cell( 20, 10, number_format( $i ), 0, 0, 'R' );
	  	$pdf->Line( $chartXPos + 28, $chartYPos - $i / $yScale, $chartXPos + 30, $chartYPos - $i / $yScale );
	  }
	}

	// Add the axis labels
	$pdf->SetFont( 'Arial', 'B', 12 );
	$pdf->SetXY( $chartWidth / 2 + 20, $chartYPos + 8 );
	$pdf->Cell( 30, 10, $chartXLabel, 0, 0, 'C' );
	$pdf->SetXY( $chartXPos + 7, $chartYPos - $chartHeight - 12 );
	$pdf->Cell( 20, 10, $chartYLabel, 0, 0, 'R' );

	// Create the bars
	$xPos = $chartXPos + 40;
	$bar = 0;

	if($yScale)
	{
		foreach ( $vulnData as $dataRow ) {
	  // Create the bar
	  $colourIndex = $bar % count( $chartColours );
	  $pdf->SetFillColor( $chartColours[$colourIndex][0], $chartColours[$colourIndex][1], $chartColours[$colourIndex][2] );
	  $pdf->Rect( $xPos, $chartYPos - ( $dataRow / $yScale ), $barWidth, $dataRow / $yScale, 'DF' );
	  $xPos += ( 1 / $xScale );
	  $bar++;
		}
	}

	$pdf->AddPage('L');

	// header
	$pdf->SetFont('Times','',11);
	$pdf->SetTextColor(100,100,100);
	$pdf->SetDrawColor(0,0,0);
	$pdf->Cell(276,9,"Academia Tehnica Militara \"Ferdinand I\" Bucuresti",1,0,'C');
	$pdf->Ln(15);

	$i = 0;
	$counter = count($totalHosts);
	foreach ($totalHosts as $host) 
	{
		$pdf->SetTextColor(0,128,255);
		$pdf->SetFont('Times','B',22);
		$pdf->Cell(30,10,"Host Details",0,0,'L',false);
		$pdf->Ln(15);

		$pdf->SetFont('Arial','B',14);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetDrawColor(0,0,0);
		$pdf->SetFillColor(200,200,200);

		$pdf->Cell(50,10,"Host OS: ",'B',0,"L",false);
		$pdf->Cell(226,10,$host['OS'],'B',1,'L',false);
		$pdf->Cell(50,10,"Host IP: ",'B',0,"L",false);
		$pdf->Cell(226,10,$host['IP'],'B',1,'L',false);
		$pdf->Cell(50,10,"Host MAC: ",'B',0,"L",false);
		$pdf->Cell(226,10,$host['MAC'],'B',1,'L',false);
		$pdf->Cell(50,10,"Host MAC Vendor: ",'B',0,"L",false);
		$pdf->Cell(226,10,$host['mac_vendor'],'B',1,'L',false);

		$pdf->Ln(10);
		$pdf->SetTextColor(0,128,255);
		$pdf->SetFont('Times','B',22);
		$pdf->Cell(30,10,"Port Details",0,0,'L',false);
		$pdf->Ln(15);
		$pdf->SetFont('Arial','',14);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetDrawColor(255,255,255);
		$pdf->SetFillColor(200,200,200);

	//	$pdf->Cell(55,12,"Vulnerabilities found",1,1,'L',true);
		$pdf->Cell(30,10,"Port",1,0,'C',true);
		$pdf->Cell(26,10,"State",1,0,'C',true);
		$pdf->Cell(30,10,"Service",1,0,'C',true);
		$pdf->Cell(70,10,"Product",1,0,'C',true);
		$pdf->Cell(50,10,"Version",1,0,'C',true);
		$pdf->Cell(70,10,"Extra Info",1,0,'C',true);
		$pdf->Ln();

		$pdf->SetFont('Arial','',10);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetDrawColor(0,0,0);

		foreach ($portsData as $port) {
			if($port['id_host']===$host['id_host'])
			{
				$pdf->Cell(30,10,$port['port_number']."/".$port['protocol'],1,0,'C',false);
				$pdf->Cell(26,10,$port['state'],1,0,'C',false);
				$pdf->Cell(30,10,$port['service'],1,0,'C',false);
				$pdf->Cell(70,10,$port['product'],1,0,'C',false);
				$pdf->Cell(50,10,$port['version'],1,0,'C',false);
				$pdf->Cell(70,10,$port['extra'],1,1,'C',false);
			}			
		}

		$pdf->Ln(10);
		$pdf->SetTextColor(0,128,255);
		$pdf->SetFont('Times','B',22);
		$pdf->Cell(30,10,"Vulnerabilities Details",0,0,'L',false);
		$pdf->Ln(15);
				$pdf->SetTextColor(0,128,255);
		$pdf->SetFont('Times','B',22);
		$pdf->Cell(30,10,"Port",1,0,'C',true);
		$pdf->Cell(30,10,"Service",1,0,'C',true);
		$pdf->Cell(60,10,"CVE",1,0,'C',true);
		$pdf->Cell(30,10,"Score",1,0,'C',true);
		$pdf->Cell(80,10,"Link",1,0,'C',true);
		
		foreach ($vulnRows as $vuln) {
			if($vuln['id_host']===$host['id_host'])
			{
				$pdf->Ln(10);
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0,0,0);
				$pdf->SetDrawColor(0,0,0);
				$pdf->Cell(30,10,$vuln['port_number']."/".$port['protocol'],1,0,'C',false);
				$pdf->Cell(30,10,$vuln['service'],1,0,'C',false);
				$pdf->Cell(60,10,$vuln['id_cve'],1,0,'C',false);
				$pdf->Cell(30,10,$vuln['score'],1,0,'C',false);
				$pdf->Cell(80,10,$vuln['link'],1,0,'C',false);

			}
		}
		if($i != $counter - 1)
		{
			$pdf->AddPage('L');
			// header
			$pdf->SetFont('Times','',11);
			$pdf->SetTextColor(100,100,100);
			$pdf->SetDrawColor(0,0,0);
			$pdf->Cell(276,9,"Academia Tehnica Militara \"Ferdinand I\" Bucuresti",1,0,'C');
			$pdf->Ln(15);
		}
		$i++;

	}
	
	$pdf->Output("D","scan-report-".$id_scanner.".pdf");
	
}

?>
