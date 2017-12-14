<?php
require_once("html2pdf/html2pdf.class.php");
$html2pdf = new HTML2PDF('P','A4','fr');
ob_start();
?>

<page>
<?php 
foreach ($wardadmission as $value) {
    $patientitle = $value->patientID->patientTitle;
    $patientName = $value->patientID->patientFullName;
    $wardNo = $value->wardNo;
    $bhtNo = $value->bhtNo;
    $patientID = $value->patientID->patientID;
    $bedNo = $value->bedNo;
    $dailyNo = $value->dailyNo;
    $monthlyNo = $value->monthlyNo;
    $yearlyNo = $value->yearlyNo;
    $Doctnametitle = $value->doctorID->title;
    $Doctfname = $value->doctorID->firstName;
    $Doctlname = $value->doctorID->lastName;
    $admitDate = date("Y-m-d ", $value->admitDateTime / 1000);
    $admitTime = date(" h:ia", $value->admitDateTime / 1000);
    $patientComplain = $value->patientComplain;
    $previousHistory = $value->previousHistory;
    $discharjType = $value->dischargeType;
    $remark = $value->remark;
    $lastUpdatedDate = date("Y-m-d ", $value->lastUpdatedDateTime / 1000);
    $lastUpdatedTime = date(" h:ia", $value->lastUpdatedDateTime / 1000);
    $status=$value->status;
    $sign=$value->sign;
    $dischargediagnosis=$value->dischargediagnosis;
    $outcomes=$value->dischargediagnosis;
    $referredto=$value->referredto;

    $patientPersonalUsedName = $value->patientID->patientPersonalUsedName;
    $patientNIC = $value->patientID->patientNIC;
    $patientGender = $value->patientID->patientGender;
    $patientDateOfBirth = $value->patientID->patientDateOfBirth;
    $patientTelephone = $value->patientID->patientTelephone;
    $patientCivilStatus = $value->patientID->patientCivilStatus;
    $patientPreferredLanguage = $value->patientID->patientPreferredLanguage;
    $patientCitizenship = $value->patientID->patientCitizenship;
    $patientAddress = $value->patientID->patientAddress;
    $patientContactPName = $value->patientID->patientContactPName;
    $patientContactPNo = $value->patientID->patientContactPNo;
    
}
function findage($dob) {
    $localtime = getdate();
    $today = $localtime['mday'] . "-" . $localtime['mon'] . "-" . $localtime['year'];
    $dob_a = explode("-", $dob);
    $today_a = explode("-", $today);
    $dob_d = $dob_a[0];
    $dob_m = $dob_a[1];
    $dob_y = $dob_a[2];
    $today_d = $today_a[0];
    $today_m = $today_a[1];
    $today_y = $today_a[2];
    $years = $today_y - $dob_y;
    $months = $today_m - $dob_m;
    if ($today_m . $today_d < $dob_m . $dob_d) {
        $years--;
        $months = 12 + $today_m - $dob_m;
    }

    if ($today_d < $dob_d) {
        $months--;
    }

    $firstMonths = array(1, 3, 5, 7, 8, 10, 12);
    $secondMonths = array(4, 6, 9, 11);
    $thirdMonths = array(2);

    if ($today_m - $dob_m == 1) {
        if (in_array($dob_m, $firstMonths)) {
            array_push($firstMonths, 0);
        } elseif (in_array($dob_m, $secondMonths)) {
            array_push($secondMonths, 0);
        } elseif (in_array($dob_m, $thirdMonths)) {
            array_push($thirdMonths, 0);
        }
    }
    echo "~$years years $months months";
}
?>
 <?php

foreach ($details as $values) {
 $patientHIN=$values->patientID->patientHIN;
 $patientID=$value->patientID->patientHIN;
}
 ?>
    <div style="margin-left: 350px">
    <img src="<?php echo base_url(); ?>css/img/gov.png"  alt="User Image" /> </div>
    <div style="color: blueviolet; margin-left: 50px">
         
    <h1>Patient Archived History Details Of Dompe Hospital </h1>
   
    </div>
    <h4>Patient Basic Details</h4> 
    <table>
        <tr>
           <td>Full name:</td>
            <td><?php echo "$patientName"; ?> 
            </td>
            </tr>
        <tr>          
            <td><?php echo ""; ?> </td>
        </tr>
        <tr>
            <td>Patient NIC:</td>
            <td><?php echo "$patientNIC "; ?> </td>
        </tr>
        <tr>
            
            <td><?php echo ""; ?> </td>
        </tr>
        <tr>
            <td>Patient Gender:</td>
            <td><?php echo "$patientGender"; ?> 
            </td>
        </tr>
        <tr>
            <td><?php echo ""; ?> </td>
        </tr>
        <tr>
            <td> Patient Address:</td>
            <td><?php echo "$patientAddress"; ?> 
            </td>  
        </tr>
        <tr>
        <td><?php echo ""; ?> </td> 
        </tr>
        <tr>
        <td> Patient HIN:</td>
        <td><?php echo "12340000012"; ?>   </td>
        </tr>
        <tr>
        <td><?php echo ""; ?> </td>
        </tr>
      
        <tr>
        <td>Patient Age:</td>
         <td>
             <?php
                    $oridate = date("d-m-Y ", $patientDateOfBirth / 1000);  
                    findage(date("d-m-Y", strtotime($oridate)));
                    ?> 
                               
           </td>   
        </tr>
        
        <tr>
             <td>Patient Date of Birth:</td>
            
        </tr>
     
        
    </table>
    
      <h4>Patient Past ward Admitted Details </h4>
      <table>
          <tr>
             
                   
          <td>Bhead Head Ticket Number :</td>
          <td><?php echo "$bhtNo";  ?></td>    
          <td><?php echo ""; ?> </td>                  
          </tr>
          <tr>
        <td><?php echo ""; ?> </td>
        </tr>
          <tr>
          <td>Patient Discharge Details:</td>
          <td><?php echo "$discharjType"; ?> </td>
          <td><?php echo ""; ?> </td> 
          </tr>
          <tr>
        <td><?php echo ""; ?> </td>
        </tr>
          <tr>
          <td>Patient Admitted Date:</td>
          <td><?php echo "$admitDate"; ?> </td>
          <td><?php echo ""; ?> </td>  
          </tr>
          <tr>
          <td><?php echo ""; ?> </td>
          </tr>
          <tr>
          <td>Patient Admitted Time:</td>
          <td><?php echo "$admitTime"; ?> </td>
          <td><?php echo ""; ?> </td>  
          </tr>
          <tr>
        <td><?php echo ""; ?> </td>
        </tr>
                  
      </table>
       
      
      <h4>Patient Past Clinic Details </h4>
        
      <table>
          
      
        <tr>
            <td>Clinic Visit ID :</td>
            <td><?php echo "C001";  ?></td>    
        </tr>
        
         <tr>
         <td><?php echo ""; ?> </td>
        </tr>
        <tr>
        <td>Clinic Visit Date :</td>
        <td><?php echo "$lastUpdatedDate";  ?></td>    
        </tr>
        
         <tr>
         <td><?php echo ""; ?> </td>
        </tr>
        <tr>
        <td>Clinic Remark :</td>
        <td><?php echo "Patient Has to do a Surgery";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>
          
      </table>
<h4>Patient Past History Details</h4>
<table>
        <tr>
            <td>History Last Updated :</td>
            <td><?php echo "$lastUpdatedDate";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>
             <tr>
            <td>History Record :</td>
            <td><?php echo "$previousHistory";  ?><?php echo "(Bacterial)";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>
                 
         </table>
    
    <h4>Patient Past Operation Details</h4>
         <table>
        <tr>
            <td>Operation Description :</td>
            <td><?php echo "Minor opertation in Kidney";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>
             <tr>
            <td>Operation Type :</td>
            <td><?php echo "Major surgery";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>
                 
         </table>
    
     <h4>Patient Past Allergy Details</h4>
         <table>
        <tr>
            <td>Allergy Name :</td>
            <td><?php echo "Peanut";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>
             <tr>
            <td>Allergy Status:</td>
            <td><?php echo "Faint and Feaver";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>
        <tr>
            <td>Drug ID:</td>
            <td><?php echo "D001";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>  
        <tr>
            <td>Diagnosis:</td>
            <td><?php echo "Direct damage to the kidneys themselves";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>
         </table>
    
    
    


//<?php
//print_r($value)
//?>

</page>


<?php 
//Turn implicit flush on/off
$content = ob_get_contents();
ob_end_clean();

$html2pdf->WriteHTML($content);
$html2pdf->Output('./save/example.pdf','F');

$zip = new ZipArchive;
//Create the archive if it does not exist.
if ($zip->open('./save/patient1001.zip',ZIPARCHIVE::CREATE) === TRUE) {
    $zip->addFile('./save/example.pdf', 'newname.pdf');
    $zip->close();
    $file = './save/patient1001.zip';
    if (headers_sent()) {
      echo 'HTTP header already sent';
    } else {
        if (!is_file($file)) {
            header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
            echo 'File not found';
        } else if (!is_readable($file)) {
            header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
            echo 'File not readable';
        } else {
            header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: Binary");
            header("Content-Length: ".filesize($file));
            header("Content-Disposition: attachment; filename=\"".basename($file)."\"");
            readfile($file);
            exit;
        }
    }

} else {
    echo 'failed';
}
