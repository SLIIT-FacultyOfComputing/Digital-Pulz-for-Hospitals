<?php


 $conn = mysqli_connect("localhost","root","");

 mysqli_select_db($conn,"HIS");
 


 // $array = $this->uri->uri_to_assoc(3);
 // $reqID = $array['ReqID'];

 // $res = $conn->query("select * from lab_mainresults where ftest_request_id= '".$reqID."'");

require("fpdf/fpdf.php");
//require('/opt/lampp/htdocs/lims_new/application/views/img/red-plus.png');
// $aa = $res->fetch_assoc();
// $tt = $aa['mainresult'];

$fn = $abc[0]['fParentF_ID']['fTest_NameID']['fTest_CreateUserID']['hrEmployee']['firstName'];
$ln = $abc[0]['fParentF_ID']['fTest_NameID']['fTest_CreateUserID']['hrEmployee']['lastName'];

$dob = $abc[0]['fTestRequest_ID']['fpatient_ID']['patientDateOfBirth'];

$date = date('Y') - date('Y', $dob/1000);


$pdf = new FPDF();

$pdf->AddPage();


$pdf->Image('/opt/lampp/htdocs/lims_new/application/views/fpdf/img/logo.png',6,10,40,0,'PNG');
$pdf->Image('/opt/lampp/htdocs/lims_new/application/views/fpdf/img/red-plus-th.png',180,15,15,0,'PNG');


$pdf->SetFont('Helvetica','',25);
$pdf->Cell(0,10,"Base Hospital",0,1,'C');

$pdf->SetFont('Helvetica','',20);
$pdf->Cell(0,10,"Medical Laboratory Service",0,1,'C');
//$pdf->Line(1,1);

$pdf->SetFont('Helvetica','',15);
$pdf->Cell(0,8,"44, Panadura Road,Pokunuwita",0,1,'C');

$pdf->SetFont('Helvetica','',12);
$pdf->Cell(0,6,"Tel : 0112842970",0,1,'C');
$pdf->Cell(0,4,"Email : his@gmail.com",0,1,'C');

$pdf->Ln(6);
$pdf->Line(6,50,202,50);

$pdf->Cell(0,4,"CONFIDENTIAL",0,1,'R');

$pdf->Ln(6);

$pdf->setFont('Helvetica','',12);
$pdf->Cell(6,2,"Patient Name ",0,0,'L');
$pdf->setFont('Helvetica','',12);
$pdf->Cell(6,2,"                                  :  ".$abc[0]['fTestRequest_ID']['fpatient_ID']['patientFullName'],0,1, 'L');

$pdf->setFont('Helvetica','',12);
$pdf->Cell(6,10,'Age',0,0,'L');
$pdf->setFont('Helvetica','',12);
$pdf->Cell(6,10,'                                  :  ' .$date,0,1, 'L');

$pdf->setFont('Helvetica','',12);
$pdf->Cell(6,2,'Gender',0,0,'L');
$pdf->setFont('Helvetica','',12);
$pdf->Cell(6,2,'                                  :  ' .$abc[0]['fTestRequest_ID']['fpatient_ID']['patientGender'],0,1, 'L');

$pdf->setFont('Helvetica','',12);
$pdf->Cell(6,10,'Reference No',0,0,'L');
$pdf->setFont('Helvetica','',12);
$pdf->Cell(6,10,'                                  :  ' .$abc[0]['result_ID'],0,1, 'L');

$pdf->setFont('Helvetica','',12);
$pdf->Cell(6,2,'Requested By',0,0,'L');
$pdf->setFont('Helvetica','',12);
$pdf->Cell(6,2,'                                  :  ' .$fn.$ln ,0,1, 'L');

$pdf->setFont('Helvetica','B',12);
$pdf->Cell(6,10,'Specimen',0,0,'L');
$pdf->setFont('Helvetica','',12);
$pdf->Cell(6,10,'                                  :  BLOOD',0,1, 'L');

$pdf->Ln();

$pdf->SetFont('Helvetica','U',15);
$pdf->Cell(0,6,$abc[0]['fTestRequest_ID']['ftest_ID']['test_Name'],0,1,'C');

$pdf->Ln();

/*$pdf->SetFont('Helvetica','',10);*/
$pdf->Cell(55,10,'',0,0,'L',0);
$pdf->Cell(10,10,'',0,0,'L',0);
$pdf->SetFont('Helvetica','U',12);
$pdf->Cell(40,10,'Result',0,0,'C',0);
$pdf->Cell(30,10,'',0,0,'L',0);
$pdf->SetFont('Helvetica','U',12);
$pdf->Cell(50,10,'Reference Range',0,0,'C',0);

$pdf->Ln();
$S=0;
foreach ($abc as $key => $value) {


	$res = $conn->query("select * from lab_testfieldsrange where fparent_field_id = '".$abc[$S]['fParentF_ID']['parent_FieldID']."' AND gender = '".$abc[0]['fTestRequest_ID']['fpatient_ID']['patientGender']."'");
    $aa = $res->fetch_assoc();
    $tt = $aa['unit'];

    $range = $aa['min_val'];
    $mrange = $aa['max_val'];
	# code...
	$pdf->setFont('Helvetica','',12);
	$pdf->Cell(55,8,$abc[$S]['fParentF_ID']['parent_FieldName'],0,0,'L',0);
	$pdf->Cell(10,8,'-',0,0,'C',0);
	$pdf->SetFont('Helvetica','',12);
	if($range<$abc[$S]['mainResult'] && $mrange>$abc[$S]['mainResult'])
	{
	   $pdf->Cell(40,8,$abc[$S]['mainResult'],0,0,'C',0);

	}
	else
	{
		$pdf->SetTextColor(255, 0, 0);
		$pdf->Cell(40,8,$abc[$S]['mainResult'],0,0,'C',0);

	}
	
	$pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(30,8,$tt,0,0,'C',0);



    $r = "(".$range."-".$mrange.")";
    if($r == "(0-0)"){
    	$r=" ";
    }



	$pdf->Cell(50,8,$r,0,0,'C',0);
    

	$S++;
	
$pdf->Ln();

}

$pdf->Ln(10);

$pdf->SetY(270);
$pdf->setFont('Helvetica','',10);
$pdf->Cell(55,5,'Date   :  '.date('d/m/y'),0,0,'L',0);

$pdf->output();

?>