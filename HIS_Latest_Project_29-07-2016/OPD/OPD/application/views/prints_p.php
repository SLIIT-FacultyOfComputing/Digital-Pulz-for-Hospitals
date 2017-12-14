<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<?php if($reportType == "Visits" & $outType == "HTML format" ){?>
		
			<div style="background-color: #ad6704; width:1000px; height:150px; margin:0px 0px 25px 210px;">
			<IMG STYLE="position:absolute; TOP:20px; right:210px; WIDTH:100px; HEIGHT:120px" SRC="<?php  echo base_url('/application/images/Emblem_of_Sri_Lanka.svg.png'); ?>">
                        <h1 style="margin-left: 10px;alignment-adjust: central">Homagama Base Hospital</h1>
			<?php echo "<h3 style='margin-left: 10px'>OPD Visit Report From</h3> <h3 style='margin-left: 10px'>".$fromdate." To ".$todate. "</h3>" ;?>
			</div>
	
            <table class="table table-hover" style=" width:1000px; margin:0px 0px 0px 210px;">
            <tr>
                <td></td>
                <td style="color: #888888"><strong>PatientID</strong> </td>
				<td style="color: #888888"><strong>Patient Name</strong> </td>			
                <td style="color: #888888"><strong>Visit Date</strong> </td>
				<td style="color: #888888"><strong>Visit Doctor</strong></td>
                <td style="color: #888888"><strong>Visit Complaint</strong></td>
                <td style="color: #888888"><strong>Visit Remark</strong></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php foreach($visits as $row) { ?>
            <tr style="border:1px solid;">
                <td style="padding-left: 5px"></td>
		<td style="padding-left: 5px"><?php echo  $row->patient->patientID;?></td>
		<td style="padding-left: 5px"><?php echo  $row->patient->patientTitle.$row->patient->patientFullName;?></td>
                <td style="padding-left: 5px"><?php echo  $row->visitDate;?></td>
		<td style="padding-left: 5px"><?php echo $row->visitCreateUser->hrEmployee->firstName." ".$row->visitCreateUser->hrEmployee->lastName;?></td>
                <td style="padding-left: 5px"><?php echo $row->visitComplaint?></td>
                <td style="padding-left: 5px"><?php echo $row->visitRemarks;?></td>
				 <td></td>
            </tr>
           <?php }?>
            
        </table>
        
        </div>
	
<?php } else if($reportType == "Visits" & $outType == "PDF format" ){



	require('\fpdf\fpdf.php');

	$pdf = new FPDF();
	$pdf->AddPage();
        $pdf->Ln();
       // $image = "http://localhost/SEP_Project/application/images/Emblem_of_Sri_Lanka.svg.png";
       $image1 = base_url('/application/images/Emblem_of_Sri_Lanka.svg.png');
 
	$pdf->SetFont('Arial','B',18);
	

	$pdf->SetFillColor(208,123,18);
  
	$pdf->Cell(0,30,"Homagama Base Hospital",0,1,'L',true);
	
	$pdf->Ln(-2);
	$pdf->SetFont('Arial','B',12); 
	$pdf->Cell(0,6,"OPD Visit Report From ".$fromdate." To ".$todate ,0,1,'L',true);
	  $pdf->Image($image1, $pdf->GetX()+160, $pdf->GetY()-30, 20);
	$pdf->Ln();
        
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(30,7,"PatientID",1);
	$pdf->Cell(60,7,"Patient Name",1);
	$pdf->Cell(23,7,"Visit Date",1);
	$pdf->Cell(47,7,"Visit Doctor",1);
	$pdf->Cell(30,7,"Visit Complaint",1);
	//$pdf->Cell(20,7,"Remarks",1);
 
	$pdf->Ln();
	
    foreach($visits as $row)
   {    $pdf->SetFont('Arial','',10);
                $pdf->Cell(30,6,$row->patient->patientID,1);
		$pdf->Cell(60,6,$row->patient->patientTitle.$row->patient->patientFullName,1);
                $pdf->Cell(23,6, $row->visitDate ,1);
		$pdf->Cell(47,6,$row->visitCreateUser->hrEmployee->firstName." ".$row->visitCreateUser->hrEmployee->lastName,1);
		$pdf->Cell(30,6, $row->visitComplaint ,1);
		//$pdf->Cell(20,6, $row->visitRemarks,1);
		 
		$pdf->Ln();
    }
	   
	 
	$pdf->Output();
	 
 
} else if($reportType == "Visits" & $outType == "Excel format" ){
	  
	 /** Error reporting */
	error_reporting(E_ALL);

	/** Include path **/
	ini_set('include_path', '\opt\lampp\htdocs\PHPExcel_1.7.9_doc\Classes');

	/** PHPExcel */
	include 'PHPExcel.php';

	/** PHPExcel_Writer_Excel2007 */
	include 'PHPExcel/Writer/Excel2007.php';

	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set properties
 
	$objPHPExcel->getProperties()->setCreator("HIS");
	$objPHPExcel->getProperties()->setLastModifiedBy("HIS");
	$objPHPExcel->getProperties()->setTitle("Visit Report Document");
	$objPHPExcel->getProperties()->setSubject("Visit Report Document");
	$objPHPExcel->getProperties()->setDescription("Visit Report Document");


	// Add Header
	$objPHPExcel->setActiveSheetIndex(0);
	
	$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
	$objPHPExcel->getActiveSheet()->mergeCells('A2:F2');
	
	  
	$objRichText = new PHPExcel_RichText();
	$objRichText->createText();
	$objText = $objRichText->createTextRun('Hospital Name');
	$objText->getFont()->setBold(true); 
	$objText->getFont()->setSize(20);
	$objPHPExcel->getActiveSheet()->getCell('A1')->setValue($objRichText);

	$objRichText2 = new PHPExcel_RichText();
	$objRichText2->createText();
	$objText2 = $objRichText2->createTextRun("OPD Visit Report From ".$fromdate." To ".$todate); 
	$objText2->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getCell('A2')->setValue($objRichText2);


	$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getFill()
	->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	->getStartColor()->setARGB('C5D9F1');	

	$objPHPExcel->getActiveSheet()->getStyle('A2:F2')->getFill()
	->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	->getStartColor()->setARGB('C5D9F1');
	
	// Add Titles
	$objPHPExcel->getActiveSheet()->SetCellValue('A4', 'PatientID');
	$objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Patient Name');
	$objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Visit Date');
	$objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Visit Doctor');
	$objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Visit Complaint');
	$objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Remarks');
	
	$objPHPExcel->getActiveSheet()->getStyle('A4:F4')->getFont()->setBold(true); 
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25); 
	
	
	// Add data
	$index = 5;
    foreach($visits as $row)
    {
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$index, $row->patient->patientHIN );
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$index, $row->patient->patientTitle.$row->patient->patientFullName );
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$index, $row->visitDate );
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$index, "Doctors Name" );
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$index, $row->visitComplaint);
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$index, $row->visitRemarks);

		$index++;
    }
 
	// Rename sheet
	$objPHPExcel->getActiveSheet()->setTitle('Visit Report');
 
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="VisitReport.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output'); 
	
	Redirect('http://localhost/OPD/index.php/reports_c/view', true);
	 
}?>


