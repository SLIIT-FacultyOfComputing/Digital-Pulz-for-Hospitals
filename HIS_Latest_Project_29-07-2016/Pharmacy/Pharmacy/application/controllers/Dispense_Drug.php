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

class Dispense_Drug extends CI_Controller {
    
    //var $_url = "http://10.0.0.1:8080/HIS_API";
    var $_url = SERVICE_BASE_URL;
 function Dispense_Drug()
    {
        parent::__construct();
        $this -> view_data['base_url'] = base_url();
    }
 

    public function index() {
//important      
	  //  $results = file_get_contents("http://localhost:8084/eHealth_new/PrescriptionController?pation=".$_POST['name1']);
	   //$data['val']= json_decode($results, true);
	  // $data['val']=$results; 
	   $data['val']="abc";
        $this->load->view('drug_dispense',$data);
	   
    }
	
	   public function getPrescriptionList()
    {
	$input= $this->input->post('id');  
			$this->load->library('curl');
			$url_path = $this->_url."DrugServices/getPrescriptionList/".$input;

			$res = $this->curl->simple_get($url_path);
 
			$result = json_encode(json_decode($res));
			echo $result;
	  

    }
	
	   public function drugDispense() {
        $input = $this->input->post('id');
        $_curlPostData = array(
            "dipense" => $input,
            "userid" => $this->session->userdata('user_id')
        );
        $data_string = json_encode($_curlPostData);

        $ch = curl_init($this->_url . 'DrugServices/dispenseDrug');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );

        $result = curl_exec($ch);
        echo $result;
    }

}
	
	
	
	


?>
