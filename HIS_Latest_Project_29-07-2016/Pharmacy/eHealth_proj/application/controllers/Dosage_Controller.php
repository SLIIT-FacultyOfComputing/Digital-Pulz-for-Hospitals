<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of prescribe_controller
 *
 * @author Mushi
 */
class Dosage_Controller extends CI_Controller {
    
    //var $_url = "http://10.0.0.1:8080/HIS_API";
    var $_url = SERVICE_BASE_URL;
    //put your code here
    function Dosage_Controller()
    {
        parent::__construct();
        $this -> view_data['base_url'] = base_url();
    }
    
    function index()
    {
        $data['val']="abc";
        $this->load->view('drug_dosages',$data);
        
    }
    
    
    
    public function getDosages()
    {
	//$input= $this->input->post('id');  
	
	$this->load->library('curl');
	$url_path = $this->_url."DrugServices/getDosages";

	$res = $this->curl->simple_get($url_path);
 
	$result = json_encode(json_decode($res));
	echo $result;
	  

    }

    public function insrtDosages()
    {
         $input= $this->input->post('dosages');                                                         
        $data_string = $input;                                                                                   
 
        $ch = curl_init($this->_url.'DrugServices/saveDosages');                                                                      
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
