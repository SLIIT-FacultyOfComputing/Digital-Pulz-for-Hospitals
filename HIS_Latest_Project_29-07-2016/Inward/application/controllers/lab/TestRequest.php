<?php

class TestRequest extends CI_Controller{
    
    public function index($bhtNo,$patientID){
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);
        
        
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigationBHT1',$data);


         $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);
         $this->load->view('inward/patientBHT/PatientDetails', $data);
          $data['history']=$this->getAllPatientByBHT($bhtNo); 

       // $this->load->view('lab/layout/Header');
        $data['Requests']=$this->getAllTestRequests();        
       // $this->load->view('his-layout/MainHeader');
        $this->load->view('lab/TestRequest',$data);
       // $this->load->view('lab/layout/sideMenu');

        $this->load->view('layout/footer1');
    }
    
     public function  getAllTestRequests()
    {
             $this->load->model('/lab/testRequestModel','requests');
             $ss=$this->requests->getAlltRequests();
             return $ss;
    }
    public function getDischargeType($bhtNo) {
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $admission = $this->admission->getWardAdmissionDetails($bhtNo);
        foreach ($admission as $value) {
            $discharjType = $value->dischargeType;
        }
        return $discharjType;
    }
    
     public function getAllPatientByBHT($bhtNo) {
        $this->load->model('/lab/testRequestModel', 'data');
        $ss = $this->data->getAllPatientByBHT($bhtNo);
        return $ss;
       
    }
}

