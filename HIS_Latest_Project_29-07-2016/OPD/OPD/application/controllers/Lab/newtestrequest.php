<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<?php

class Newtestrequest extends CI_Controller {

    public function index($pid,$visitid) {
       // $this->load->view('headerInward');
        //$this->load->view('Lab/his-layout/MainHeader');
        $this->load->library('session');
        $pntDetails = $this->session->userdata('userPatientDetails');
        //print_r($pntDetails);
        // $data['patientDetalis'] = (int) ($pntDetails);
        $data['patientDetalis'] = (int) substr($pntDetails, 4,6);
        $data['TestNames']=$this->GetAllTestNames();
        // $data['test']=$this->AddRequest();
        // $this->load->view('Lab/NewTestRequest', $data);
        //$this->load->view('Lab/layout/sideMenu');
        $data['leftnavpage'] = 'lab';
        $data['pid'] = $pid;
        $data['visitid'] = $visitid;
       // $this->load->view('left_navbar_v', $data);
        

        $this->load->view('Components/headerInward',$data);
      
                // loading left side navigation
        $data['leftnavpage'] = '';
        $this->load->view('Components/left_navbar',$data);

        $data['pprofile'] = json_decode( $this->GetPatient($pid) );
        $data['allergy'] = json_decode(json_encode($data['pprofile']->allergies), TRUE);

        $this->load->view('Lab/NewTestRequest',$data);

        //$this->load->view('Components/bottom');
    }

    public function GetAllTestNames() {
       
        $this->load->model('/Lab/labtestmanagermodel', 'TestNames');
        $ss = $this->TestNames->getAllTestNames();
        return $ss;
     
    }

    public function GetPatient($pid) {
       
        $this->load->model('/Lab/labtestmanagermodel', 'TestNames');
        $ss = $this->TestNames->GetPatient($pid);
        return $ss;
     
    }

    public function AddRequest() {
     
        
        // $_test_name = $this->input->post('test_name');
        // $_patient_id = $this->input->post('patient_id');
        // $_lab_id = $this->input->post('lab_id');
        // $_comment = $this->input->post('comment');
        // $_priority = $this->input->post('priority');
        // $_due_date = $this->input->post('due_date');
        // $_sample_center = $this->input->post('sample_center');
        print_r($_POST);

          if(isset($_POST['Request'])){
            $Data = $_POST['Request'];
            $Data = json_decode($Data,true);

            $curl_post_data = array(
            
            "ftest_ID" => $Data[0],
            "fpatient_ID" => $Data[1],
            "flab_ID" => $Data[2],
            "comment" => $Data[3],
            "priority" =>$Data[4],
            "status" => $Data[5],
            "DueDate" => $Data[6],
            "Doc" => $Data[7],
            "visit_ID" => $Data[8],
            "ftest_RequestPerson" => "1",
            // "status" => "Sample Required"
       
        // );

         // $curl_post_data = array(
         //    "ftest_ID" => $_test_name,
         //    "fpatient_ID" => $_patient_id,
         //    "flab_ID" => "13",
         //    "ftest_RequestPerson" => "1",
         //    "comment" => $_comment,
         //    "priority" => $_priority,
         //    "status" => "SNC",
         //    "DueDate" => $_due_date
        );


        //$data_string = json_encode($curl_post_data);
        $this->load->model('/Lab/Newtestrequestmodel', 'cate');
        $ss = $this->cate->AddRequest($curl_post_data);

   }
    // public function GetAllPatients() {

    //     $this->load->model('/Lab/newtestrequestmodel', 'tests');
    //     $ss = $this->tests->GetAllPatients();
    //     print_r($ss);
    //     return $ss;
    //     //  exit;
    // }

    // public function GetAllLabs() {

    //     $this->load->model('/Lab/newtestrequestmodel', 'tests');
    //     $ss = $this->tests->GetAllLabs();
    //     print_r($ss);
    //     exit;
    //     return $ss;
    // }

    // public function GetAllSampleCentres() {

    //     $this->load->model('/Lab/newtestrequestmodel', 'tests');
    //     $ss = $this->tests->GetAllSampleCentres();
    //     print_r($ss);
    //     exit;
    //     return $ss;
    // }

    // public function response() {
    //     $this->load->view('headerInward');
    //     $data['leftnavpage'] = 'lab';
    //     $this->load->view('left_navbar_v', $data);
    //     $this->load->view('Lab/LabRequestSucess');
    // }
}}
