<?php
/**
* Created by PhpStorm.
* User: Sharmal VAIO
* Date: 6/2/14
* Time: 11:30 PM
*/
include('../connection/connection.php');

if( $_POST ){
    if(isset($_POST['post_newFeldName']))
    {

        post_new_FeldName($_POST['post_newFeldName']);
    }
    elseif(isset($_POST['post_newSubFeldName']))
    {

        post_new_Sub_FeldName($_POST['post_newSubFeldName']);
    }
    elseif(isset($_POST['post_newSpecimenFeldName']))
    {

        post_new_Specimen_FeldName($_POST['post_newSpecimenFeldName']);
    }
    elseif(isset($_POST['post_newSpecimenRetFeldName']))
    {

        post_newSpecimenRetFeldName($_POST['post_newSpecimenRetFeldName']);
    }
    elseif(isset($_POST['data']))
    {

        inset_testnameData($_POST['data']);
    }
    elseif(isset($_POST['data2']))
    {

        inset_randeData($_POST['data2']);
    }
    elseif(isset($_POST['data3']))
    {

        inset_range2Data($_POST['data3']);
    }
}
else{
    echo('hellossss');
}
function post_new_FeldName($name){

    $query = "INSERT INTO lab_testcategory (category_IDName,category_Name) VALUES ('ts','$name')";
    $data = mysql_query ($query)or die(mysql_error());
    $success_msg='inserted';
    echo($success_msg);
}
function post_new_Sub_FeldName($name){

    $query = "INSERT INTO lab_testsubcategory (subCategory_IDName,sub_CategoryName) VALUES ('subn','$name')";
    $data = mysql_query ($query)or die(mysql_error());
    $success_msg='inserted';
    echo($success_msg);
}
function post_new_Specimen_FeldName($name){

    $query = "INSERT INTO lab_specimentype (specimen_TypeName) VALUES ('$name')";
    $data = mysql_query ($query)or die(mysql_error());
    $success_msg='inserted';
    echo($success_msg);
}
function post_newSpecimenRetFeldName($name){

    $query = "INSERT INTO lab_specimenretentiontype (retention_TypeName) VALUES ('$name')";
    $data = mysql_query ($query)or die(mysql_error());
    $success_msg='inserted';
    echo($success_msg);
}
function inset_testnameData($name){

    $query = "INSERT INTO lab_testnames (test_Name,fTest_CategoryID,fTest_Sub_CategoryID) VALUES ('$name[0]',$name[1],$name[2])";
    $data = mysql_query ($query)or die(mysql_error());
    $success_msg='inserted';
    echo($success_msg);
}
function inset_randeData($name){

    $query = "INSERT INTO lab_testfieldsrange (gender,age,unit,minVal,maxVal) VALUES ('$name[0]',$name[1],'$name[2]',$name[3],$name[4])";
    $data = mysql_query ($query)or die(mysql_error());


    $query = mysql_query("SELECT * FROM lab_testfieldsrange ORDER BY range_ID ASC") or die(mysql_error());

    while($row = mysql_fetch_array($query)){
        $arr1= $row['range_ID'];
    }

    $query = mysql_query("SELECT * FROM lab_testnames ORDER BY test_ID ASC") or die(mysql_error());

    while($row = mysql_fetch_array($query)){
        $arr2= $row['test_ID'];
    }
    $query = "INSERT INTO lab_parenttestfields (parentField_IDName,parent_FieldName,fTest_RangeID,fTest_NameID) VALUES ('WF','$name[5]',$arr1,$arr2)";
    $data = mysql_query ($query)or die(mysql_error());



    $success_msg='inserted';
    echo($success_msg);
}
function inset_range2Data($name){

    $query = "INSERT INTO lab_testfieldsrange (gender,age,unit,minVal,maxVal) VALUES ('$name[0]',$name[1],'$name[2]',$name[3],$name[4])";
    $data = mysql_query ($query)or die(mysql_error());


    $query = mysql_query("SELECT * FROM lab_testfieldsrange ORDER BY range_ID ASC") or die(mysql_error());

    while($row = mysql_fetch_array($query)){
        $arr1= $row['range_ID'];
    }

    $query = mysql_query("SELECT * FROM lab_testnames ORDER BY test_ID ASC") or die(mysql_error());

    while($row = mysql_fetch_array($query)){
        $arr2= $row['test_ID'];
    }
    $query = "INSERT INTO lab_subtestfields (subField_IDName,subtest_FieldName,fPar_Test_FieldID,fTest_RangeID) VALUES ('WF','$name[5]',$arr2,$arr1)";
    $data = mysql_query ($query)or die(mysql_error());



    $success_msg='inserted';
    echo($success_msg);
}

?>