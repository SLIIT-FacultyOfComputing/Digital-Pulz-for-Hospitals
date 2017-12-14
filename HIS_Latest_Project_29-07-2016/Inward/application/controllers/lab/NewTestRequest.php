 <?php

class Newtestrequest extends CI_Controller {

    public function index($bhtNo,$patientID) {
        
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);
        
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigationBHT1',$data);

        $data['TestNames']=$this->GetAllTestNames();
        
        $this->load->view('Lab/NewTestRequest', $data);
        $data['leftnavpage'] = 'lab';
        
        $this->load->view('layout/footer1');

    }

    public function GetAllTestNames() {
       
        $this->load->model('/Lab/labtestmanagermodel', 'TestNames');
        $ss = $this->TestNames->getAllTestNames();
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
        $this->load->model('/Lab/newtestrequestmodel', 'cate');
        $ss = $this->cate->AddRequest($curl_post_data);

    }
    }
   
    public function getDischargeType($bhtNo) {
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $admission = $this->admission->getWardAdmissionDetails($bhtNo);
        foreach ($admission as $value) {
            $discharjType = $value->dischargeType;
        }
        return $discharjType;
    }
   
}
