<?php
/**
 * Created by PhpStorm.
 * User: Sharmal VAIO
 * Date: 6/2/14
 * Time: 10:16 PM
 */
    include('../connection/connection.php');
if(isset($_GET['get_category']))
{
    get_category();
}
elseif(isset($_GET['get_SubCategory']))
{
    get_sub_category();
}
elseif(isset($_GET['get_SpecimenType']))
{
    get_Specimen_Type();
}
elseif(isset($_GET['get_SelectSpecimenRetentionTyp']))
{
    get_Select_Specimen_Retention_Typ();
}
    function get_category(){

        $query = mysql_query("SELECT * FROM lab_testcategory ORDER BY category_ID ASC") or die(mysql_error());
        $c=1;
        while($row = mysql_fetch_array($query)){
            $arr1['category_ID'] = $row['category_ID'];
            $arr1['category_IDName'] = $row['category_IDName'];
            $arr1['category_Name'] = $row['category_Name'];

            $category[$c]=$arr1;
            $c++;
        }
        echo json_encode ($category);
    }
    function get_sub_category(){

        $query = mysql_query("SELECT * FROM lab_testsubcategory ORDER BY sub_CategoryID ASC") or die(mysql_error());
        $c=1;
        while($row = mysql_fetch_array($query)){
            $arr1['sub_CategoryID'] = $row['sub_CategoryID'];
            $arr1['subCategory_IDName'] = $row['subCategory_IDName'];
            $arr1['sub_CategoryName'] = $row['sub_CategoryName'];
            $arr1['fCategory_ID'] = $row['fCategory_ID'];

            $category[$c]=$arr1;
            $c++;
        }
        echo json_encode ($category);
    }
    function get_Specimen_Type(){

        $query = mysql_query("SELECT * FROM lab_specimentype ORDER BY specimenType_ID ASC") or die(mysql_error());
        $c=1;
        while($row = mysql_fetch_array($query)){
            $arr1['specimenType_ID'] = $row['specimenType_ID'];
            $arr1['specimen_TypeName'] = $row['specimen_TypeName'];
            $arr1['fCategry_ID'] = $row['fCategry_ID'];
            $arr1['fSub_CategoryID'] = $row['fSub_CategoryID'];

            $category[$c]=$arr1;
            $c++;
        }
        echo json_encode ($category);
    }
    function get_Select_Specimen_Retention_Typ(){

        $query = mysql_query("SELECT * FROM lab_specimenretentiontype ORDER BY retention_TypeID ASC") or die(mysql_error());
        $c=1;
        while($row = mysql_fetch_array($query)){
            $arr1['retention_TypeID'] = $row['retention_TypeID'];
            $arr1['retention_TypeName'] = $row['retention_TypeName'];
            $arr1['duration'] = $row['duration'];
            $arr1['fCategory_ID'] = $row['fCategory_ID'];

            $category[$c]=$arr1;
            $c++;
        }
        echo json_encode ($category);
    }
?>