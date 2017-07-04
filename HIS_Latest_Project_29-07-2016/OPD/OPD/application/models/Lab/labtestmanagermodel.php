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
class labtestmanagermodel extends CI_Model {

    public function getAlltCategories() {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "Category/getAllCategories";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        $decodeResponse = json_decode($response);
        return $decodeResponse;
    }
    
    
    public function getAllSubCategories() {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "SubCategory/getAllSubCategories";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        $decodeResponse = json_decode($response);
        return $decodeResponse;
    }
    
    public function getPatient($pid)
    {
        $this->load->model('Service_Caller/ServiceCaller', 'serviceCaller');
        $service_url = SERVICE_BASE_URL."OutPatient/getPatientsByPID/".$pid;
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($service_url, $media_Type);
        return $response;
    }
    
    public function getAllTestNames() {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "TestNames/getAllTests";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        $decodeResponse = json_decode($response);
        return $decodeResponse;
    }
     public function updateCategory($cate) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $category_JSON_Obj = $cate;
        $serviceURL = SERVICE_BASE_URL . "Category/updateCategories";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $category_JSON_Obj, $media_Type);
        print_r($response);
        return $response;
    }
     public function updateSubCategory($cate) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $category_JSON_Obj = $cate;
        $serviceURL = SERVICE_BASE_URL . "SubCategory/updateSubCategories";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $category_JSON_Obj, $media_Type);
        print_r($response);
        return $response;
    }
    
    public function updateTestNames($cate) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $category_JSON_Obj = $cate;
        $serviceURL = SERVICE_BASE_URL . "TestNames/updateTestNamesTest";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $category_JSON_Obj, $media_Type);
        print_r($response);
        return $response;
    }
    
    
    
    

}






