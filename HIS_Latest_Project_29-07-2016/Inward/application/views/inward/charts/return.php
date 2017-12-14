<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
        $name='root';
        $pass='';
        
        
   $data = $_POST['Date'];
   $salin = $_POST['salin'];
   $oral = $_POST['oral'];

try{
 
$handler = new PDO('mysql:host=localhost;dbname=practice',$name,$pass);
$handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$result = $handler->prepare("insert into `cron`(cron_time, oral, saline) values ('".$data."', '".$oral."', '".$salin."')");
$result->execute();

if($result)
{
    echo 'succefully';
}else
{
    echo 'no successfull';
}

 
}
 catch (PDOException $e)
 {
     echo $e->getMessage().'</br>';
     echo $e->getCode();
 }
        
        ?>