<?php
require_once("html2pdf/html2pdf.class.php");
$html2pdf = new HTML2PDF('P','A4','fr');
ob_start();
?>

<page>
    <h3>Patient History Details</h3>
    
    <h4>Patient Basic Details</h4> 
    
    <table>
        
        <tr>
            <td>Full name:</td>
            <td><?php echo "$patients->patientFullName"; ?> </td>
        </tr>
         <tr>
             <td><?php echo ""; ?> </td>
        </tr>
        <tr>
          <td>Nic:</td>
          <td> <?php echo "$patients->patientNIC"; ?> </td>            
        </tr>
         <tr>
             <td><?php echo ""; ?> </td>
        </tr>                 
        <tr>
            <td>Gender:</td>
            <td><?php echo "$patients->patientGender"; ?> </td>
        </tr>
         <tr>
             <td><?php echo ""; ?> </td>
        </tr>                 
        <tr>
            <td>HIN :</td>
            <td><?php echo "$patients->patientHIN"; ?> </td>
        </tr>
        <tr>
             <td><?php echo ""; ?> </td>
        </tr>
         <tr>
            <td>Patient Address</td>
            <td><?php echo "$patients->patientAddress";  ?></td>    
        </tr>
         <tr>
             <td><?php echo ""; ?> </td>
        </tr>
        <tr>
            <td>Patient Date of Birth</td>
            <td><?php echo "$patients->dateOfBirth";  ?></td>    
        </tr>
         <tr>
             <td><?php echo ""; ?> </td>
        </tr>
    </table>
    
    <h4>Patient Past ward Admitted Details </h4>
    <table>
        <tr>
            <td>Bhead Head Ticket Number :</td>
            <td><?php echo "$patients->bhtNo";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>
        <tr>
            <td>Patient Address:</td>
            <td><?php echo "$patients->patientAddress";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>  
        <tr>
            <td>Discharge Type:</td>
            <td><?php echo "$patients->dischargeType";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>  
        
    </table>   
        
        <h4>Patient Past Clinic Details </h4>
        
        <table>
        <tr>
            <td>Clinic Visit Date :</td>
            <td><?php echo "$patients->clinicVisitDate";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>
         <tr>
            <td>Clinic Visit ID :</td>
            <td><?php echo "$patients->clinicVisitId";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>
         <tr>
            <td>Clinic Remark :</td>
            <td><?php echo "$patients->clinicRemarks";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>
        
        
    </table>
         <h4>Patient Past History Details</h4>
         <table>
        <tr>
            <td>History Last Updated :</td>
            <td><?php echo "$patients->historylastupdateDate";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>
             <tr>
            <td>History Record :</td>
            <td><?php echo "$patients->historyRecord";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>
                 
         </table>
          <h4>Patient Past Operation Details</h4>
         <table>
        <tr>
            <td>Operation Description :</td>
            <td><?php echo "$patients->operationDiscription";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>
             <tr>
            <td>Operation Type :</td>
            <td><?php echo "$patients->operationType";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>
                 
         </table>
           <h4>Patient Past Allergy Details</h4>
         <table>
        <tr>
            <td>Allergy Name :</td>
            <td><?php echo "$patients->allergyName";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>
             <tr>
            <td>Allergy Status:</td>
            <td><?php echo "$patients->allergyStatus";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>
        <tr>
            <td>Drug ID:</td>
            <td><?php echo "$patients->drugId";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>  
        <tr>
            <td>Diagnosis:</td>
            <td><?php echo "$patients->diagnosis";  ?></td>    
        </tr>            
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>
         </table>
          
           <h4>Patient OPD Details</h4>
           <table>
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>  
        <tr>
            <td>Opd visit Date:</td>
            <td><?php echo "$patients->opdVisitDate";  ?></td>    
        </tr>   
        
        <tr>
          <td><?php echo ""; ?> </td>
        </tr>  
        <tr>
            <td>Opd visit Date:</td>
            <td><?php echo "$patients->visitRemarks";  ?></td>    
        </tr>   
        
      </table>
          
          
          
          
          
          
        
</page>


<?php 

$content = ob_get_contents();
ob_end_clean();


    $html2pdf->WriteHTML($content);
    
    $html2pdf->Output('exemple.pdf');
   
    
    //$html2pdf->Output('C:\xampp\htdocs\Inward\exemple.pdf','F');
    readfile('exemple.pdf');
    
    //$temp_file_name='example.pdf';
    //ZIP the PDF file
    $zip=new ZipArchive();
    //$file=$temp_file_name;
    //give the path that zip file needs to be save
    $zip->open('C:\xampp\htdocs\Inward\zipfile.zip',  ZipArchive::CREATE);
    //path that pdf has been saved
    $zip->addFile('example.pdf');
    
    $zip->close();
    
    
    
//    $temp_file_name='example.zip';
//    
//    $zip=new ZipArchive();
//    
//    $file=$temp_file_name;
//    
//    $zip->open($file,  ZipArchive::OVERWRITE);
//    $zip->addFile('example.pdf', 'abc.pdf');
//    $zip->close();
//    
    header('Content-type:application/zip');
    header('Content-Disposition: attachment; filename="zipfile.zip"');
    readfile('zipfile.zip');
?>