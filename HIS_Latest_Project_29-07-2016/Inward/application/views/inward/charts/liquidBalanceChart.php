<html>
    <head>
       <link rel="stylesheet" href="lib/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<!--     <link href="lib/Bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
         <link href="lib/Bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">-->
<!--          <script type="text/javascript" src="lib/Bootstrap/js/jquery.js"></script>-->
           <script src="lib/morris.min.js"></script>
         <style type="text/css">
             
             #display{
                 
                 height: 400px;
                 width:  200px;
                 float: right;
                 margin: -130px 64px 25px 24px;
             }
             
         </style>
     
    </head>
    <body>
        
        
        <?php
        $name='root';
        $pass='';

try{
 
$handler = new PDO('mysql:host=localhost;dbname=practice',$name,$pass);
$handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$result1 = $handler->prepare("SELECT * FROM cron ORDER BY cron_time DESC");
$result1->execute();
$ret1 = $result1->fetchAll();




$result2 = $handler->prepare("SELECT cron_time, oral, saline FROM cron ORDER BY id DESC LIMIT 1");
$result2->execute();
$ret2 = $result2->fetch(PDO::FETCH_ASSOC);
$arr[] = $ret2;
 
}
 catch (PDOException $e)
 {
     echo $e->getMessage().'</br>';
     echo $e->getCode();
 }
        
        ?>
        <div id="myfirstchart" style="height: 250px;">
         
        </div>
        <div id="con">
            
               <div id="left" style="float: left;margin: 23px 20px 20px 95px">
          
            <label>Date and Time :</label><input type="text" name="Date" id="Date"/><br><br>
            </div>
            <div id="right" style="float: right;margin: 23px 441px -28px -11px">
                <label>Oral        : </label><input type="text" name="oral" id="oral"/><br><br> 
                <label>Salin       : </label><input type="text" name="salin" id="salin"/><br><br>
                
            </div>
            
            <input type="submit" class="btn btn-primary" style="margin: 57px 34px -28px 505px" id="submit" name="submit" value="submit"/>
        </div>
        <div id="display">
            <?php foreach($arr as $row) {?>
            <span id="da" style="color: red"><?php echo $row['cron_time'] ?></span><br> 
            <span id="or" style="color: blue"><?php  echo $row['oral'] ?></span><br>
            <span id="sa" style="color: green"><?php echo $row['saline'] ?></span><br> 
            <?php  }?>
            
        </div>
        <script type="text/javascript">
            var ret;
            $(function(){

  $(document).ready(function(){  
  
$("#submit").click(function(){
 
var Date = $("#Date").val();
var salin = $("#salin").val();
var oral = $("#oral").val();
//var Out = $("#Out").val();

// Returns successful data submission message when the entered information is stored in database.
var dataString = 'Date=+'+Date +'&salin='+ salin + '&oral='+ oral ;
if(Date === '' || salin===''||oral==='')
{
	alert("Please Fill All Fields");
}
else
{
	//AJAX code to submit form.
	$.ajax({
			type: "POST",
			url: "return.php",
			data: dataString,
			cache: false,
			success: function(result){
		           alert(result);
									}
	});
}
return false;
});
});
});
 
 new Morris.Line({
 
  element: 'myfirstchart',
  
   data: <?php echo json_encode($ret1);?>,
 
    xkey: 'cron_time',
 
    ykeys: ['oral','saline'],
 
    labels: ['oral','saline'],
 
    lineColors: ['#5A5AE5','#AE383C'],
    xLabels: 'hour',

    smooth: true,
    resize: true
});
 </script>
    </body>
</html>