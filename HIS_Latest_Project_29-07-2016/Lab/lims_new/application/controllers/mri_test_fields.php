<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mri_test_fields extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('mri_test_fields_model','fields');
    }

    private function _init()
    {
        $this->output->set_template('default');
        $this->load->section('sidebar', 'includes/sidebar');
    }

    public function index()
    {
        $this->_init();
        $data['departments'] = $this->fields->getAllDepartments();
        $data['labs'] = $this->fields->getAllLabs();
        $data['specTypes'] = $this->fields->getAllSpecimenTypes();
        $this->load->view("mri_test_fields", $data);
    }

    //ad test names

    public function add_test_name() {
        $data = array("success"=>false);
        $return = $this->fields->addLabTest($_POST);
        
        if($return==true) {
            //$data["success"] = true;
        }
        echo json_encode($data);
    }

    //get all lab test types

    public function getAllLabTestTypes() {
        $data = $this->fields->getAllLabTestTypes();
        echo json_encode($data);
    }
     
     //get test parent types
    public function getTestParentTypes() {
        if(isset($_POST["labTestId"])) {
            echo $this->fields->getParentFields($_POST["labTestId"]);
        }
    }

    //add test parent field

    public function addTestParentField() {
        $data = array("message"=>"Unknown Error");
        if(isset($_POST["labTestId"]) && isset($_POST["testName"])
            && !empty($_POST["labTestId"]) && !empty($_POST["testName"])) {
            $send = array("lab_test_id"=>$_POST["labTestId"],"test_field_name"=>$_POST["testName"]);
            $ret = $this->fields->addTestParentField($send);
            if($ret==true){
                $data["message"] = true;
            }
        } else {
            $data["message"] = "Required Field Missing";
        }
        echo json_encode($data);
    }

    //check for exictence of parentdata

    public function checkForExistenceOfParentData() {
        $data = array("success"=>"false");
        if(isset($_POST["gender"]) && isset($_POST["parent_id"])) {
            $send = array("gender"=>$_POST["gender"],"parentId"=>$_POST["parent_id"]);
            $ret = $this->fields->CheckForExistenceParents($send);
            if($ret==true){
                $data["success"] = true;
            }
        }
        echo json_encode($data);
    }

    //add parentfield data

    public function addParentFieldData() {
        $data = array("success"=>"Unknown Error");
        if(isset($_POST["gender"]) && isset($_POST["parentID"]) && isset($_POST["minValue"])
            && isset($_POST["maxValue"]) && isset($_POST["minAge"]) && isset($_POST["maxAge"])
            && !empty($_POST["gender"]) && !empty($_POST["parentID"]) && !empty($_POST["minValue"])
            && !empty($_POST["maxValue"]) && !empty($_POST["minAge"]) && !empty($_POST["maxAge"])
        ){
            $send = $_POST;
            $ret = $this->fields->addParentFieldData($send);
            if($ret==true)
                $data["success"]=true;
            else
                $data["success"]="Failed to add data";
        }else {
            $data["success"]="Required field missing";
        }
        echo json_encode($data);
    }

     //get test parentfield data
    
    public function getTestParentFieldData() {
        $pageData = '<table id="viewDataTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Field Name</th>
                        <th>Gender</th>
                        <th>Min Value</th>
                        <th>Max Value</th>
                        <th>Min Age</th>
                        <th>Max Age</th>
                        <th>Unit</th>
                    </tr>
                    </thead>
                    <tbody>';
        if(isset($_POST["labTestId"]) && !empty($_POST["labTestId"])) {
            $ret = json_decode(json_encode($this->fields->getTestFieldRangeData($_POST["labTestId"]),true));
            foreach($ret as $row) {
                if(isset($row->fparentfield_ID->parent_FieldName))
                $pageData .= '<tr>';
                $pageData .= '<td>'.$row->fparentfield_ID->parent_FieldName.'<span></td>';
                $pageData .= '<td>'.$row->gender.'</td>';
                $pageData .= '<td><span class="badge bg-green">'.$row->minVal.'<span></td>';
                $pageData .= '<td><span class="badge bg-red">'.$row->maxVal.'<span></td>';
                $pageData .= '<td><span class="badge bg-green">'.$row->minage.'<span></td>';
                $pageData .= '<td><span class="badge bg-red">'.$row->maxage.'<span></td>';
                $pageData .= '<td>'.$row->unit.'</td>';
                $pageData .= '</tr>';
            }
        }
        $pageData .= '</tbody>
                    <tfoot>
                    <tr>
                        <th>Field Name</th>
                        <th>Gender</th>
                        <th>Min Value</th>
                        <th>Max Value</th>
                        <th>Min Age</th>
                        <th>Max Age</th>
                        <th>Unit</th>
                    </tr>
                    </tfoot>
                </table>';
        echo $pageData;
        
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Sub Field FunctionS

    //addtest sub fields

    public function addTestSubField() {

        if(isset($_POST["parentField"]) && isset($_POST["testName"])
            && !empty($_POST["parentField"]) && !empty($_POST["testName"])) {
            $send = array("parentField"=>$_POST["parentField"],"testName"=>$_POST["testName"]);
            $ret = $this->fields->addTestSubField($send);

            if($ret==true){
                $data["message"] = true;
            }
        } else {
            $data["message"] = "Required Field Missing";
        }
        echo json_encode($data);
    }

    //get testsub types

    public function getTestsubsTypes() {


         if(isset($_POST["parentField"])) {
            echo $this->fields->getSubFields($_POST["parentField"]);
        }

    }

    //add subfield data

    public function addSubFieldData() {
        $data = array("success"=>"Unknown Error");
        if(isset($_POST["gender"]) && isset($_POST["parentID"]) && isset($_POST["minValue"])
            && isset($_POST["maxValue"]) && isset($_POST["minAge"]) && isset($_POST["maxAge"])
            && !empty($_POST["gender"]) && !empty($_POST["parentID"]) && !empty($_POST["minValue"])
            && !empty($_POST["maxValue"]) && !empty($_POST["minAge"]) && !empty($_POST["maxAge"])
        ){
            $send = $_POST;
            $ret = $this->fields->addSubFieldData($send);
            if($ret==true)
                $data["success"]=true;
            else
                $data["success"]="Failed to add data";
        }else {
            $data["success"]="Required field missing";
        }
        echo json_encode($data);
    }
}
