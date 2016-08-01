<?php
/**
 * Created by PhpStorm.
 * User: mycomputer
 * Date: 6/3/14
 * Time: 7:45 AM
 */

include('../connection/connection.php');
if(isset($_GET['get_testRequest']))
{
    get_test_Request();
}
function get_test_Request(){

    $query = mysql_query("SELECT * FROM lab_labtestrequest ORDER BY labTestRequest_ID ASC") or die(mysql_error());
    $c=1;
    while($row = mysql_fetch_array($query)){
        $arr1['labTestRequest_ID'] = $row['labTestRequest_ID'];
        $arr1['ftest_ID'] = $row['ftest_ID'];
        $arr1['fpatient_ID'] = $row['fpatient_ID'];
        $arr1['flab_ID'] = $row['flab_ID'];
        $arr1['wardCOP_ID'] = $row['wardCOP_ID'];
        $arr1['comment'] = $row['comment'];
        $arr1['priority'] = $row['priority'];
        $arr1['status'] = $row['status'];
        $arr1['test_RequestDate'] = $row['test_RequestDate'];
        $arr1['test_DueDate'] = $row['test_DueDate'];
        $arr1['ftest_RequestPerson'] = $row['ftest_RequestPerson'];
        $arr1['fsample_CenterID'] = $row['fsample_CenterID'];

        $category[$c]=$arr1;
        $c++;
    }
    echo json_encode ($category);
}

?>