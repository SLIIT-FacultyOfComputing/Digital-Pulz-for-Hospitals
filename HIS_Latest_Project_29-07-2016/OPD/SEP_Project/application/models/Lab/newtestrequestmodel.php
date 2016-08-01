<?php

include_once (FCPATH.'application/models/Service_Caller/servicecaller.php');

class Newtestrequestmodel extends CI_Model {

    public function Newtestrequestmodel(){}

    public function GetAllTests() {
        $this->load->model('Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "TestNames/getAllTests";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        return $response;
    }

    public function getAllTestNames() {
        $this->load->model('Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "TestNames/getAllTests";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        $decodeResponse = json_decode($response);
        return $decodeResponse;
    }

    public function GetAllPatients() {
        $this->load->model('Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "OutPatient/getAllPatients";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        return $response;
    }

    public function GetAllLabs() {
        $this->load->model('Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "Laboratories/getAllLaboratories";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        return $response;
    }

    public function GetAllSampleCentres() {
        $this->load->model('Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "SampleCenters/getAllSampleCenters";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        return $response;
    }

    public function AddRequest($data_string) {

         // print_r($data_string);
        $category_JSON_Obj = json_encode($data_string);  
        print_r($category_JSON_Obj);   
        $serviceURL = SERVICE_BASE_URL . "LabTestRequest/addLabTestRequest";
        
        $media_Type = "application/json";
    
        $curl_request  = new ServiceCaller();
        $response = $curl_request->curl_POST_Request($serviceURL, $category_JSON_Obj, $media_Type);        
        return json_decode($response);      
    }

}
