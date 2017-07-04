<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<?php

require_once('/tcpdf/config/tcpdf_config.php');
require_once('/tcpdf/tcpdf.php');


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, TRUE, 'UTF-8', false);

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setHeaderFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setHeaderMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//$pdf->setLanguageArray($l);

$pdf->SetFont('helvetica', '8', 30);

$pdf->AddPage();

$pdf->Write(0, 'Drug Report For Low Stock In Hand', '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

$pdf->SetCreator(PDF_CREATOR);

//========================================
$dusr = new Report_Controller();
$details = $dusr->drugReportNew();
$currentDate = date("F j, Y");
$id = $_POST['tablespaceDC'];
//========================================
// $drugD  = "piece1 piece2 piece3 piece4 piece5 piece6";

$tbl =$id;


$pdf->writeHTML($tbl, true, false, false, '');
$pdf->Output('activity_log_for_acs.pdf', 'I');
?>

