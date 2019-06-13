<?php

/*
  An Example PDF Report Using FPDF
  by Matt Doyle

  From "Create Nice-Looking PDFs with PHP and FPDF"
  http://www.elated.com/articles/create-nice-looking-pdfs-php-fpdf/
*/

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

	$sql = "select count(ports.id_port) as total from ports INNER JOIN hosts on hosts.id_host=ports.id_host INNER JOIN scanners on scanners.id_scanner=hosts.id_scanner WHERE scanners.id_scanner=".$id_scanner;
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$totalPorts = $row['total'];
	$sql = "select * from scanners WHERE scanners.id_scanner=".$id_scanner;
	$result=$conn->query($sql);
	$scannerRow = $result->fetch_assoc();
	$technique = "";
	if($scannerRow['sS'])
		$technique="TCP SYN Scan";

	if($scannerRow['sT'])
		$technique="TCP Connect Scan";

	if($scannerRow['sU'])
		$technique="UDP Scan";

	if($scannerRow['sY'])
		$technique="SCTP Init Scan";

	if($scannerRow['sN'])
		$technique="TCP NULL Scan";

	if($scannerRow['sF'])
		$technique="TCP Fin Scan";

	if($scannerRow['sX'])
		$technique="TCP Xmas Scan";

	if($scannerRow['sA'])
		$technique="TCP ACK Scan";

	if($scannerRow['sW'])
		$technique="TCP Window Scan";

	if($scannerRow['sM'])
		$technique="TCP Maimon Scan";

	if($scannerRow['sO'])
		$technique="IP Protocol Scan";

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
	$pdf->Cell( 0, 15, "Scanner name", 0, 0, 'C' );
	$pdf->Ln(8);
	$pdf->Cell( 0, 15, "Date: 10/06/2019", 0, 0, 'C' );


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
	$pdf->Cell(135,12,$scannerRow['name'],1,2,'L',true);
	$pdf->Cell(135,12,$technique,1,2,'L',true);
	$pdf->Cell(135,12,"172.28.128.1/24",1,2,'L',true);
	$pdf->Cell(135,12,"3",1,2,'L',true);
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

	$pdf->Output("D","scan-report.pdf");
	/**
	  Create the table
	**/
/*
	$pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2] );
	$pdf->Ln( 15 );

	// Create the table header row
	$pdf->SetFont( 'Arial', 'B', 15 );

	// "PRODUCT" cell
	$pdf->SetTextColor( $tableHeaderTopProductTextColour[0], $tableHeaderTopProductTextColour[1], $tableHeaderTopProductTextColour[2] );
	$pdf->SetFillColor( $tableHeaderTopProductFillColour[0], $tableHeaderTopProductFillColour[1], $tableHeaderTopProductFillColour[2] );
	$pdf->Cell( 46, 12, " PRODUCT", 1, 0, 'L', true );

	// Remaining header cells
	$pdf->SetTextColor( $tableHeaderTopTextColour[0], $tableHeaderTopTextColour[1], $tableHeaderTopTextColour[2] );
	$pdf->SetFillColor( $tableHeaderTopFillColour[0], $tableHeaderTopFillColour[1], $tableHeaderTopFillColour[2] );

	for ( $i=0; $i<count($columnLabels); $i++ ) {
	  $pdf->Cell( 36, 12, $columnLabels[$i], 1, 0, 'C', true );
	}

	$pdf->Ln( 12 );

	// Create the table data rows

	$fill = false;
	$row = 0;

	foreach ( $data as $dataRow ) {

	  // Create the left header cell
	  $pdf->SetFont( 'Arial', 'B', 15 );
	  $pdf->SetTextColor( $tableHeaderLeftTextColour[0], $tableHeaderLeftTextColour[1], $tableHeaderLeftTextColour[2] );
	  $pdf->SetFillColor( $tableHeaderLeftFillColour[0], $tableHeaderLeftFillColour[1], $tableHeaderLeftFillColour[2] );
	  $pdf->Cell( 46, 12, " " . $rowLabels[$row], 1, 0, 'L', $fill );

	  // Create the data cells
	  $pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
	  $pdf->SetFillColor( $tableRowFillColour[0], $tableRowFillColour[1], $tableRowFillColour[2] );
	  $pdf->SetFont( 'Arial', '', 15 );

	  for ( $i=0; $i<count($columnLabels); $i++ ) {
	    $pdf->Cell( 36, 12, ( '$' . number_format( $dataRow[$i] ) ), 1, 0, 'C', $fill );
	  }

	  $row++;
	  $fill = !$fill;
	  $pdf->Ln( 12 );
	}



	/***
	  Serve the PDF
	***/
}

?>