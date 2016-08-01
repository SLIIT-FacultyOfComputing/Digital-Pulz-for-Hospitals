<?php

session_start();

class Report_view extends CI_Controller{
   
    
var $_url = SERVICE_BASE_URL;
    function Report_view()
    {
        parent::__construct();
                if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }
                
        $this->load->helper('url');

    }
    


	
	
    public function index(){
      
        
		// getting value from url
		$req_id = $this->uri->uri_to_assoc(3);

        
      
        
        

        //update status
        $this->load->model('test_request_model', 'requests');
        $this->requests->setStatus(json_encode(array("reqID" => $req_id, "status" => "Report Issued")));
        $data['abc']=$this->get();
       // var_dump($data['abc']);
       
       $this->load->view('print_pdf',$data);
    }

    // public function  getAllReport()
    // {

    //     if (isset($_POST['ID'])) {
    //         $Data = $_POST['ID'];
    //         $this->load->model('report_modal','report');
    //         $ss=$this->report->getReportData($Data);
    //         print_r($ss);
    //         return $ss;
    //     }
    // }

      public function  get()
    {

            // var_dump($id);
            $req = $this->uri->uri_to_assoc(3);
            $id = $req['ReqID'];
            
            $this->load->model('report_modal','report');
            $ss = json_decode($this->report->getReportData($id),true);
           
            return $ss;
    }



}
