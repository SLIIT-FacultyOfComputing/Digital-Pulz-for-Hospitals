<?php

class Lab_manager extends CI_Controller {
    private function _init()
    {
        $this->output->set_template('default');
        $this->load->section('sidebar', 'includes/sidebar');
    }


    public function index() {
        $this->_init();
        $data['labTypes']=$this->GetAlllabTypes(); 
        $data['Depts']=$this->GetAllDepts(); 
        $data['laboratories']=$this->GetAlllaboratories();
        $this->load->view('lab_manager',$data);
    }

    //get all lab types
    
    public function GetAlllabTypes() {
        $this->load->model('lab_manager_model', 'labtypes');
        $ss = $this->labtypes->GetAlllabTypes();
        return $ss;
    }
    
    //get all depts
    public function GetAllDepts() {
        $this->load->model('lab_manager_model', 'depts');
        $ss = $this->depts->GetAllDepts();
        return $ss;
    }

    //get all laboratories
     public function GetAlllaboratories() {
        $this->load->model('lab_manager_model', 'lab');
        $ss = $this->lab->GetAlllaboratories();
        return $ss;
    }
    
    //add laboratory
    function addLaboraroty() {

        if (isset($_POST['LabData'])) {
            $Data = $_POST['LabData'];
            $curl_post_data = array(
                "flabType_ID" => $Data[0],
                "flabDept_ID" => $Data[1],
                "lab_Dept_Count" => $Data[2],
                "flab_AddedUserID" => $Data[3],
                "lab_Name" => $Data[4],
                "lab_Incharge" => $Data[5],
                "location" => $Data[6],
                "email" => $Data[7],
                "contactNumber1" => $Data[8],
                "contactNumber2" => $Data[9]  
            );
            $data_string = json_encode($curl_post_data);
            $this->load->model('lab_manager_model', 'cate');
            $ss = $this->cate->addLaboraroty($data_string);
        }
    }
    
    //add new lab type
    function addLabType() {

        if (isset($_POST['LabData'])) {
            $Data = $_POST['LabData'];
            $curl_post_data = array(
                "lab_Type_Name" => $Data[0]
            );
            $data_string = json_encode($curl_post_data);
            $this->load->model('lab_manager_model', 'cate');
            $ss = $this->cate->addLabType($data_string);
        }
    }
    
    //add lab dept
    function addLabDept() {

        if (isset($_POST['LabData'])) {
            $Data = $_POST['LabData'];
            $curl_post_data = array(
                "labDept_Name" => $Data[0]
            );
            $data_string = json_encode($curl_post_data);
            $this->load->model('lab_manager_model', 'cate');
            $ss = $this->cate->addLabDept($data_string);
        }
    }
    
    //Migrating Ajax Functions Related to This Controller : Dush


    //update lab
    public function updateLab() {
        $this->_init();
        $array = $this->uri->uri_to_assoc(3);
        $data['LabID']=$array['LID'];
        $data['LabName']=$array['Lab'];
        $this->load->view('edit_lab_type',$data);
    }

      //delete lab
       public function deleteLab() {
        $this->_init();
        $array = $this->uri->uri_to_assoc(3);
        $data['LabID']=$array['LID'];
        $this->load->view('lab_manager',$data);
    }

    public function updateLabAjax(){

        if (isset($_POST['lab'])) {
            $Data = $_POST['lab'];
            $curl_post_data = array(
                "labType_ID" => $Data[0],
                "lab_Type_Name" => $Data[1]
            );
            $data_string = json_encode($curl_post_data);
            $this->load->model('lab_manager_model', 'lab');

            $ss = $this->lab->updateLabType($data_string);
            return $ss;
        }


    }
     
     //update labdept
    public function updateLabDept() {
        $this->_init();
        $array = $this->uri->uri_to_assoc(3);
        $data['DID']=$array['DID'];
        $data['DeptName']=$array['Dept'];
        $this->load->view('edit_lab_department',$data);
    }

    public function updateLabDeptAjax(){

        if (isset($_POST['lab'])) {
            $Data = $_POST['lab'];
            $curl_post_data = array(
                "labDept_ID" => $Data[0],
                "labDept_Name" => $Data[1]
            );
            $data_string = json_encode($curl_post_data);
            $this->load->model('lab_manager_model', 'lab');

            $ss = $this->lab->updateLabDept($data_string);
            return $ss;
        }


    }

    //edit laborartoty

    public function EditLaboraroty() {
        $this->_init();
        $array = $this->uri->uri_to_assoc(3);
        $data['LabID']=$array['LID'];
        $data['LabName']=urldecode($array['LabName']);
        $data['type']=urldecode($array['type']);
        $data['dept']=urldecode($array['dept']);
        $data['count']=urldecode($array['count']);
        $data['incharge']=urldecode($array['incharge']);
        $data['location']=urldecode($array['location']);
        $data['email']=urldecode($array['email']);
        $data['con1']=urldecode($array['con1']);
        $data['con2']=urldecode($array['con2']);
        $data['labTypes']=$this->GetAlllabTypes();
        $data['Depts']=$this->GetAllDepts();
        $this->load->view('edit_laboratories',$data);
    }
    function EditLaborarotyAjax() {
        if (isset($_POST['LabData'])) {
            $Data = $_POST['LabData'];
            $curl_post_data = array(
                "flabType_ID" => $Data[0],
                "flabDept_ID" => $Data[1],
                "lab_Dept_Count" =>$Data[2],
                "flabLast_UpdatedUserID" => $Data[3],
                "lab_ID" => $Data[4],
                "lab_Name" => $Data[5],
                "lab_Incharge" => $Data[6],
                "location" => $Data[7],
                "email" => $Data[8],
                "contactNumber1" => $Data[9],
                "contactNumber2" => $Data[10]
            );
            $data_string = json_encode($curl_post_data);
            $this->load->model('lab_manager_model', 'cate');
            $ss = $this->cate->EditLaboraroty($data_string);
            return $ss;
        }
    }
   
}