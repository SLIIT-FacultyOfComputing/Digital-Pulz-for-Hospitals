
<?php

class Sample_centre_manager extends CI_Controller {
    private function _init()
    {
        $this->output->set_template('default');
        $this->load->section('sidebar', 'includes/sidebar');
    }

    public function index() {
        $data['SSTypes']=$this->GetAllSampleTypes(); 
        $data['SampleCenter']=$this->GetAllSampleCenters();
        $this->_init();
        $this->load->view('sample_centre_manager',$data);
    }

    //get all sample types
    
    public function GetAllSampleTypes() {
        $this->load->model('sample_centre_manager_modal', 'labtypes');
        $ss = $this->labtypes->GetAllSampleTypes();
        return $ss;
    }

    //fet all sample centers
    
    public function GetAllSampleCenters() {
        $this->load->model('sample_centre_manager_modal', 'depts');
        $ss = $this->depts->GetAllSampleCenters();
        return $ss;
    }

    //add sample center
    
   
    function addSampleCenter() {

        if (isset($_POST['LabData'])) {
            $Data = $_POST['LabData'];
            $curl_post_data = array(
                "fSampleCenterType_ID" => $Data[0],
                "fSampleCenter_AddedUserID" => $Data[1],
                "sampleCenter_Name" => $Data[2],
                "sampleCenter_Incharge" => $Data[3],
                "location" => $Data[4],
                "email" => $Data[5],
                "contactNumber1" => $Data[6],
                "contactNumber2" => $Data[7]
            );
            $data_string = json_encode($curl_post_data);
            $this->load->model('sample_centre_manager_modal', 'cate');
            $ss = $this->cate->addSampleCenter($data_string);
        }
    }

    //add sample center type
    function addSampleCenterType() {

        if (isset($_POST['LabData'])) {
            $Data = $_POST['LabData'];
            $curl_post_data = array(
                "sample_Center_TypeName" => $Data[0]
            );
            $data_string = json_encode($curl_post_data);
            $this->load->model('sample_centre_manager_modal', 'cate');
            $ss = $this->cate->addSampleCenterType($data_string);
        }
    }

    //Migrating Ajax Functions Related to This Controller : Dush

    public function updateLab() {
        $this->_init();
        $array = $this->uri->uri_to_assoc(3);
        $data['LabID']=$array['LID'];
        $data['LabName']=$array['Lab'];
        $this->load->view('edit_lab_type',$data);
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

    //update sample center

    public function UpdateSampleCenter() {
        $this->_init();
        $array = $this->uri->uri_to_assoc(3);
        $data['scid']=$array['SCID'];
        $data['type']=$array['type'];
        $data['name']=$array['name'];
        $data['incharge']=$array['incharge'];
        $data['location']=$array['location'];
        $data['email']=urldecode($array['email']);
        $data['con1']=$array['con1'];
        $data['con2']=$array['con2'];
        $data['SSTypes']=$this->GetAllSampleTypes();
        $this->load->view('edit_sample_center',$data);
    }
    function UpdateSampleCenterAjax() {
        if (isset($_POST['LabData'])) {
            $Data = $_POST['LabData'];
            $curl_post_data = array(



                "fSampleCenterType_ID" => $Data[0],
                "fSampleCenter_AddedUserID" => $Data[1],
                "sampleCenter_ID" =>$Data[2],
                "sampleCenter_Name" =>$Data[3],
                "sampleCenter_Incharge" => $Data[4],
                "location" => $Data[5],
                "email" => $Data[6],
                "contactNumber1" => $Data[7],
                "contactNumber2" => $Data[8]
            );
            $data_string = json_encode($curl_post_data);
            $this->load->model('sample_centre_manager_modal', 'cate');
            $ss = $this->cate->UpdateSampleCenter($data_string);
            return $ss;
        }
    }

    //update sample center types

public function UpdateSampleCenterTypes() {
         
        $this->_init();
        $array = $this->uri->uri_to_assoc(3);
        $data['scid']=$array['SCID'];
        $data['type']=$array['type'];
        $data['SSTypes']=$this->GetAllSampleTypes();
        $this->load->view('edit_sample_center_type',$data);
    }

    public function UpdateSampleCenterTypesAjax(){

        if (isset($_POST['lab'])) {
            $Data = $_POST['lab'];
            $curl_post_data = array(
                "sampleCenterType_ID" => $Data[0],
                "sample_Center_TypeName" => $Data[1]
            );
            $data_string = json_encode($curl_post_data);
            $this->load->model('sample_centre_manager_modal', 'sc');

            $ss = $this->sc->UpdateSampleCenterTypes($data_string);
            return $ss;
        }


    }

}
