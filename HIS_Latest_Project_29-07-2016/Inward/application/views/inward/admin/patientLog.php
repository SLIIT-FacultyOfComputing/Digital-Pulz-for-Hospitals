<br/><br/><br/>

<h3>
    Patient Log page
</h3>
<?php 
echo date('Y');
$date = new DateTime(date('Y-m-d'));
echo $date->format('Y');
echo $date->format('m');
echo $date->format('d');

?>



