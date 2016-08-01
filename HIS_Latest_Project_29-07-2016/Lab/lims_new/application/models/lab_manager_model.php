<?php
class Lab_manager_model extends CI_Model {

    public function GetAlllabTypes() {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "LabType/getAllLabTypes";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        $decodeResponse = json_decode($response);
        return $decodeResponse;
    }
        
    public function GetAllDepts() {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "LabDepartments/getAllLabDepartments";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        $decodeResponse = json_decode($response);
        return $decodeResponse;
    }
    
    public function GetAlllaboratories() {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "Laboratories/getAllLaboratories";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        $decodeResponse = json_decode($response);
        return $decodeResponse;
    }
    
    public function addLaboraroty($cate) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $category_JSON_Obj = $cate;
        $serviceURL = SERVICE_BASE_URL . "Laboratories/addNewLaboratory";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $category_JSON_Obj, $media_Type);
        print_r($category_JSON_Obj);
        return $response;
    }
    
    public function addLabType($cate) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $category_JSON_Obj = $cate;
        $serviceURL = SERVICE_BASE_URL . "LabType/addLabType";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $category_JSON_Obj, $media_Type);
        print_r($category_JSON_Obj);
        return $response;
    }
    
    public function addLabDept($cate) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $category_JSON_Obj = $cate;
        $serviceURL = SERVICE_BASE_URL . "LabDepartments/addLabDepartment";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $category_JSON_Obj, $media_Type);
        print_r($category_JSON_Obj);
        return $response;
    }
    
    
    public function updateLabType($LabType) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $category_JSON_Obj = $LabType;
        $serviceURL = SERVICE_BASE_URL . "LabType/updateLabTypes";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $category_JSON_Obj, $media_Type);
        
        return $response;
    }
     public function updateLabDept($cate) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $category_JSON_Obj = $cate;
        $serviceURL = SERVICE_BASE_URL . "LabDepartments/updateLabDepts";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $category_JSON_Obj, $media_Type);
       
        return $response;
    }
    
    public function EditLaboraroty($cate) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $category_JSON_Obj = $cate;
        $serviceURL = SERVICE_BASE_URL . "Laboratories/updateLaboratories";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $category_JSON_Obj, $media_Type);
       
        return $response;
    }
    
    
    public function deleteLab($cate) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $category_JSON_Obj = $cate;
        $serviceURL = SERVICE_BASE_URL . "Laboratories/deleteLab/".$cate;
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $category_JSON_Obj, $media_Type);
       
        return $response;
    }
    
    
    
}