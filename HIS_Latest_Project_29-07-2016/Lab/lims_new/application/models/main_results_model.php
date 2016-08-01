<?php

class Main_results_model extends CI_Model{    



  public function InsertMainResults($results){
            
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $mainresults=$results;
        print_r($mainresults);

        $serviceURL=SERVICE_BASE_URL."MainResults/addMainResults";
        $media_Type="application/json";
        $response=$this->serviceCaller->curl_POST_Request($serviceURL,$mainresults,$media_Type);
        return $response;
    }

	public function getAllPatientByID($PID) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "OutPatient/getPatientsByPID/".$PID;
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        $decodeResponse = json_decode($response);
        return $decodeResponse;
    }



}


