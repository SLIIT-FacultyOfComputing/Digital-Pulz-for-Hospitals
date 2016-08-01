 
<style>
body{
	background-color:lightgray;
}

#doccontent{
	background-color:white;
	width: 70%;
	height: 100%;
}

#docinfo{
 
 
	float: right;
	position: fixed;
	width: 100%;
	left: 72%;
	top: 8px;
	height: 45%;
}

#doccomment{
	background-color: lightgray;
	float: right;
	position: fixed;
	width: 100%;
	left: 72%;
	top: 35%;
	height:100%;
}

</style>
 
<div id="doccontent" class="span4">


 
		<?php
			 $file =  basename($attachment[0]->attachLink ).PHP_EOL;
		    if( preg_match('/^.*\.(jpg|jpeg|png)$/i',$attachment[0]->attachLink))
			{
				 echo "<img src='".base_url()."/uploads/". $file ."'  width='650' height='500'/>"; 
			}else
			{
				echo "<object   style='height:100%;width:100%' data='"."".base_url()."/uploads/".$file."' type='application/pdf' width='650' height='500'></object>";
			}			
		?> 
 
</div>

<div id="docinfo">

		  <table class="table" style="width:20%;color:black;font-size:14px">
             
		   
			  <tr >
                <td><strong>Patient</strong> </td>
                 
				 <td><?php echo $pprofile->patientHIN  ;?></td>
              
              
            </tr>
			
            <tr>
                <td><strong>Patient Name</strong> </td>
                <td><?php echo "$pprofile->patientTitle $pprofile->patientFullName" ;?></td>
                
            </tr>
            
			   
            <tr>
			  
                <td><strong>Attachment </strong> </td>
                <td><?php echo $attachment[0]->attachName;  ?></td>
                 
            </tr>
			
			  <tr>
                <td><strong>Description</strong> </td>
                <td><?php echo $attachment[0]->attachDescription;  ?></td>
                 
            </tr>
			
			 <tr>
                <td></td>
                <td></td>
            </tr>
			
			<tr>
                  <td><strong>Attached By</strong> </td>
                <td><?php echo $attachment[0]->attachCreateUser->userName;  ?></td>
                 
            </tr>
			
			
        </table>

</div>
 