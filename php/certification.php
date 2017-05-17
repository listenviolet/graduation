<?php
	session_start(); 
	require('../fpdf181/fpdf.php');
	$code=$_SESSION["code"];
	$username=$_SESSION["username"];
	$classname=$_SESSION["classname"];
	$hwname=$_SESSION["hwname"];
	/*
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$show="Your certificaion code is ".$code.".";
	$pdf->Cell(40,10,$show);
	$pdf->Output();*/

	class PDF extends FPDF
    {
        function Header()
        {
          	//$this->Image('../img/banner-bg.jpg',10,10,50);
            $this->SetFont('Arial','B',20);
            $this->Cell(80);
            $this->Cell(30,20,'Certificaion',0,0,'C');
            //$this->SetTextColor(128);
            $this->Ln(20);
        }
    }

    // Instanciation of inherited class
    $pdf = new PDF();
    //$pdf->AliasNbPages();
    $pdf->AddPage();
    //$pdf->SetFont('Times','',16);
    $pdf->SetFont('Times','B',14);
  	$show_1="Dear ".$username." ,";
  	$show_2="your file(s) for class : ".$classname." , homework : ".$hwname.", was(were) uploaded.";
  	$show_3="Your certificaion code is ".$_SESSION["code"].".";
  	
	$pdf->Cell(0,10,$show_1,0,1);
	$pdf->Cell(0,10,$show_2,0,1);
	$pdf->Cell(0,10,$show_3,0,1);
    $pdf->Output();
?>