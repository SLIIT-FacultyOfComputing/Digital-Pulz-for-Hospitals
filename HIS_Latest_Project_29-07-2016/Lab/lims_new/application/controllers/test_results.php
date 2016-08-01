<?php

class Test_results extends CI_Controller{
    
    public function index(){
        $this->_init();
        $array = $this->uri->uri_to_assoc(3);
        $pid = $array['PID'];
        $data['history']=$this->getAllPatientTests($pid); 
        $data1['patient']=$this->getAllPatientByID($pid);
        $request_id = $array['ReqID'];
        $this->load->model('test_request_model', 'requests');
        $data['specimen'] = $this->requests->getTestRequestByRequestID($request_id);
        $this->load->view('test_results',$data,$data1);
    }

    private function _init()
    {
        $this->output->set_template('default');
        $this->load->section('sidebar', 'includes/sidebar');
    }
     
     //get all fields
    
    public function  getAllFields()
    {
         
         if(isset($_POST['ID']))
        {
             $Data=  array();
             $ID = $_POST['ID'];
             $this->load->model('parent_test_fields_model','Fields');
             $ss=$this->Fields->getFields($ID);
            


             $c=1;
                $result = array();
                 foreach ($ss as $key => $value) {


                  $nikan = array(
                      'parent_FieldID'=>$value->parent_FieldID,
                      'parent_FieldName'=>$value->parent_FieldName
                  );
                  array_push($Data, $nikan);
                  
                 }
           
              echo json_encode($Data);
         }
           
    }

    //add main results
    
    public function AddMainResults()

    {
        if (isset($_POST['results'])) {
            $Data = $_POST['results'];

            $data_string = json_encode($Data);
            $this->load->model('main_results_model', 'TestName');
            $ss = $this->TestName->InsertMainResults($data_string);
            
            //update status
			$this->load->model('test_request_model', 'requests');
			$this->requests->setStatus(json_encode(array("reqID" => $_POST['ReqID'], "status" => "Report Issued")));
        }

    }

    //get all patient test

    public function getAllPatientTests($pid) {
        $this->load->model('test_request_model', 'data');
        $ss = $this->data->getAllTestByID($pid);
        return $ss;
    }

    public function getAllPatientTestsAjax() {
        if(isset($_POST['pid'])) {
            $pid = $_POST['pid'];
            $this->load->model('test_request_model', 'data');
            $ss = $this->data->getAllTestByID($pid);
            echo json_encode($ss);
        } else {
            echo 'false';
        }
    }

    //get all patient ID 
    
    public function getAllPatientByID($pid) {
         $this->load->model('main_results_model', 'patient');
         $ss = $this->patient->getAllPatientByID($pid);
         return $ss;  
    }
    
    
    
}

