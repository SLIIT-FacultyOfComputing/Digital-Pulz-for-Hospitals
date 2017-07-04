<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ReportModel extends CI_Model {

    public function getReportData($data) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "MainResults/getMainResultsByReqID/".$data;
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);    
        $decodeResponse = json_decode($response);		
        return $decodeResponse;
    }
	
	
	
	

}
