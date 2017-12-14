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
} ?>
    
  <?php ?>
    <!--<?php print_r($treatment)?>-->
    
    <!--<?php echo $treatment[0]->image;   ?>-->
     
    <table >       
        <tr>
           
            <th style="color: white">
            <h4>----------------------------------------------</h4>
            </th>
            <th style="color: #0044cc">                
            <h2>District Hospital Dompe </h2>
            </th>
             <td></td>
            <td></td>
            <td></td>
            <td></td>
            <th>
            <img src="<?php echo base_url(); ?>css/img/gov.png"  alt="User Image" /> 
                
            </th>
   
        </tr>
        </table>
    <table>
        <tr>
            <th style="color: white">
            <h1>------------------------------</h1>
            </th>
            
            <th style="color: #0044cc">                
            <h2>Diagnosis Ticket </h2>
            </th> 
           
            
        </tr>
             
    </table>
    <h6>-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</h6>
          
        <table>
              
         <tr>
             <td style="font-size: large">   Name Of the Patient            :</td>
            <td><?php echo "$patientName"; ?>          
           </td>
         </tr>
         <tr>
             <td>
                 
             </td>
             <td style="font: bold">--------------------------------------------</td>
         </tr>
          <tr>
             <td style="font-size: large">   Age            :</td>
            <td><?php
                    $oridate = date("d-m-Y ", $patientDateOfBirth / 1000);
                  
                    findage(date("d-m-Y", strtotime($oridate)));
                    ?><span style="padding:0 80px; " ></span>                    
           </td>
          </tr>
              <tr>
             <td>
                 
             </td>
             <td style="font: bold">--------------------------------------------</td>
         </tr>
         <tr>
            <td>Ward :</td>
             <td><?php echo "$wardNo"; ?>          
           </td>
            <td>
                 
             </td>
             <td style="color: white">
                 ---
             </td>
             <td style="font: bold">Bed Head Ticket Number :<?php echo "$bhtNo"; ?>     </td>
         
         
         </tr>
        
         <tr>
             <td>
                 
             </td>
             <td style="font: bold">--------------------------------------------</td>
             <td>
                 
             </td>
             <td style="color: white">
                 ------------------
             </td>
              <td style="color: white">
                 --------
              </td>
             <td style="font: bold">---------------------</td>
         </tr>
           <tr>
            <td>Date of Addmission :</td>
             <td><?php echo "$admitDate"; ?>          
           </td>
            <td>
                 
             </td>
             <td style="color: white">
                 ---
             </td>
             <td style="font: bold">Date of Discharge:<?php echo "$lastUpdatedDate"; ?>     </td>
         
         
         </tr>
          <tr>
             <td>
                 
             </td>
             <td style="font: bold">--------------------------------------------</td>
             <td>
                 
             </td>
             <td style="color: white">
                 ------------------
             </td>
              <td style="color: white">
                 --------
              </td>
             <td style="font: bold">---------------------</td>
         </tr>
         
           <tr>
               <td style="font-style: italic">  <h3> Investigation and Treatment</h3>  </td>
           
         </tr>
              <tr>
             <td style="font-size: large">   Admission Reason          :</td>
            <td><?php echo "$patientComplain"; ?>          
           </td>
         </tr>
         <tr>
             <td>
                 
             </td>
         </tr>
         
            <tr>
             <td style="font-size: large">   Admission Remarks          :</td>
            <td><?php echo "$previousHistory"; ?>          
           </td>
         </tr>
         <tr>
             <td>
                 
             </td>
         </tr>
           <tr>
             <td style="font-size: large">   Discharge Diagnosis         :</td>
            <td><?php echo "Bronchities"; ?>          
           </td>
         </tr>
         <tr>
             <td>
                 
             </td>
         </tr>
          <tr>
             <td style="font-size: large">   Discharge IMMR        :</td>
            <td><?php echo "N17 .. Chronic Kidney"; ?>
                <?php echo "diseases of Lungs"; ?>
           </td>
         </tr>
         <tr>
             <td>
                 
             </td>
         </tr>
          <tr>
             <td style="font-size: large">   Outcome        :</td>
            <td><?php echo "Discharged Recovered"; ?>          
           </td>
         </tr>
         <tr>
             <td>
                 
             </td>
         </tr>
         <tr>
             <td style="font-size: large">   Referred To        :</td>
            <td><?php echo "Medical Clinic(OPD) on 01 Oct "; ?>          
           </td>
         </tr>
          <tr>
             <td>
                 
             </td>
         </tr>
           <tr>
             <td style="font-size: large">   Discharged Remark       :</td>
            <td><?php echo "$remark"; ?>          
           </td>
         </tr>
         
         
         
         
         
         
         
         
        </table>   
    <table>
        
        
        
        
    </table>
       
    <p style="bottom: auto"></p>
    <table style="alignment-adjust: after-edge">
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
    
                <tr><td style="font-size: large"> Patient Diagnosis :</td></tr>
                <img src="<?php echo $treatment[0]->image;   ?>"  alt="User Image" style="height: 300px;width: 170px" />
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
  
    
        
        <tr>
             <td>
                 <?php echo " " . date("Y/m/d") . "<br>";?>
                 <?php echo "Date " ;?>
        
              
             </td>
                <th>
        <h1 style="color: white ">---------------------------------------</h1>
            </th>
             
             <td>
                
                     <img src="<?php echo "$value->sign"; ?>"  alt="User Image" style="height: 90px;width: 110px" /> 
                
                 <p>Signature and Designation</p>
                 <p>Medical Officer-3 D.H Dompe</p>
             
                 
             </td>
          
             
         </tr>
        
    </table>    
     
           
</page>


<?php 

$content = ob_get_contents();
ob_end_clean();

    $html2pdf->WriteHTML($content);
    $html2pdf->Output('exemple.pdf');
    read_file(exemple.pdf);
    ?>