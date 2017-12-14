
<?php   
 foreach ($wards as $value)
 {
     $wardNo = $value->wardNo;
     $category = $value->category;
     $gender= $value->wardGender;
     
 }

  
?>  
<div class="row">    
          
    <div class="col-xs-3">
         <label for="dailyNo" >Ward No</label>
         <input style="background-color:#E0EEEE; " id="" name="" type="text" value="<?php echo $wardNo; ?>" class="form-control"  disabled/>
    </div>

    <div class="col-xs-3">
        <label for="dailyNo" >Ward Category </label>
        <input style="background-color:#E0EEEE; " id="" name="" type="text"  value="<?php echo $category; ?>" class="form-control" disabled/>
       
    </div>
    
    <div class="col-xs-3">
        <label for="dailyNo" > Ward Type </label>
        <input style="background-color:#E0EEEE; " id="" name="" type="text"  value="<?php echo $gender; ?>" class="form-control" disabled/>
       
    </div>
    
</div>
<br/>
<legend></legend>