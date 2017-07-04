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

require_once('/application/views/tcpdf/config/tcpdf_config.php');
require_once('/application/views/tcpdf/tcpdf.php');


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
//========================================
// $drugD  = "piece1 piece2 piece3 piece4 piece5 piece6";

$tbl = '
            <div font color="#FF0000" align="center">
            <p><font color="green"><h1>'.$currentDate.'</h1></font></p>
            </div>
            <table cellspacing="0" cellpadding="4" border="2">
            <thead>
            <tr>
                    <th bgcolor="#5D7B9D"><font color="#fff" font size="15">Drug Name</font></th>
                    <th bgcolor="#5D7B9D"><font color="#fff" font size="15">Unit Type</font></th>
                    <th bgcolor="#5D7B9D"><font color="#fff" font size="15">Drug Category </font></th>
                    <th bgcolor="#5D7B9D"><font color="#fff" font size="15">Drug Price</font></th>
                    <th bgcolor="#5D7B9D"><font color="#FF0000" font size="15">Drug Quantity</font></th>

           </tr>

            
            </thead>';
$s = 0;
foreach ($details as $value) {
    $drugPcs = explode(":", $details[$s]);
    $level="";
    if($drugPcs[4]<=$drugPcs[6])
    {
        $level = '<td><font color="#FF0000" font size="12">' . $drugPcs[4] . '</font></td>';
    }
    else if($drugPcs[4]<=$drugPcs[7])
    {
        $level = '<td><font color="#F2730A" font size="12">' . $drugPcs[4] . '</font></td>';
    }
    //$drugPcs = explode(":", $details[$s]);
    $tbl .= ' <tr>
                <td>' . $drugPcs[0] . '</td>
                <td>' . $drugPcs[5] . '</td>    
                <td>' . $drugPcs[2] . '</td>
                <td>' . $drugPcs[3] . '</td>'
                .$level.
            '</tr>';
    $s++;
}

$tbl .='</table>';


$pdf->writeHTML($tbl, true, false, false, '');
$pdf->Output('activity_log_for_acs.pdf', 'I');
?>

