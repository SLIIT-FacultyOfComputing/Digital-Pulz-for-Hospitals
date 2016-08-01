<?php
class Mri_test_fields_model extends CI_Model {

    public function getAllDepartments() {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "Category/getAllCategories/";
        $media_Type = "application/json";
        //$curRequest= new ServiceCaller();
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        return json_decode($response);
    }

    public function getAllLabs() {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "SubCategory/getAllSubCategories/";
        $media_Type = "application/json";
        //$curRequest= new ServiceCaller();
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        return json_decode($response);
    }

    public function getAllSpecimenTypes() {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "SpecimenType/getAllSpecimenTypes/";
        $media_Type = "application/json";
        //$curRequest= new ServiceCaller();
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        return json_decode($response);
    }

    public function addLabTest($data) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "TestNames/addNewtest/";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, json_encode($data), $media_Type);
        return $response;
    }

    public function getAllLabTestTypes() {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "TestNames/getAllTests";
        $media_Type = "application/json";
        //$curRequest= new ServiceCaller();
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        return json_decode($response);
    }

    public function getParentFields($data) {
            $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
            $serviceURL = SERVICE_BASE_URL . "ParentTestFields/getAllParenTestFields/".$data;
            $media_Type = "application/json";
            //$curRequest= new ServiceCaller();
            $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
           
            return $response;
    }

    public function addTestParentField($data) {
        
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "ParentTestFields/addNewParentTestField/";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, json_encode($data), $media_Type);
        return $response;
    }

    public function CheckForExistenceParents($data) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "MriTestFields/CheckForExistenceParents/";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, json_encode($data), $media_Type);
        return $response;
    }

    public function addParentFieldData($data) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "TestFieldsRange/addNewRanges/";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, json_encode($data), $media_Type);
        return $response;
    }

    //GetTestParentData
    public function getTestParentData($labTestId) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "ParentTestFields/getAllParenTestFields";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL,json_encode($labTestId),$media_Type);
        return json_decode($response);
    }

     public function getTestsubsData($labTestId) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "SubTestFields/GetSubFeilds";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL,json_encode($labTestId),$media_Type);
        return json_decode($response);
    }

    public function addTestSubField($data) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "SubTestFields/addNewSubTestField/";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, json_encode($data), $media_Type);
        return $response;
    }

    public function getSubFields($data) {
        // var_dump($data);
        // $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        //   $serviceURL = SERVICE_BASE_URL . "SubTestFields/getAllSubTestFields ";
        
        // $media_Type = "application/json";
        // //$curRequest= new ServiceCaller();
        // $response = $this->serviceCaller->curl_GET_All_Request($serviceURL,$media_Type);
        // var_dump( json_decode($response));
        // return $response;
         $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
            $serviceURL = SERVICE_BASE_URL . "SubTestFields/GetSubFeilds/".$data;
            $media_Type = "application/json";
            //$curRequest= new ServiceCaller();
            $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
            return $response;
    }

    public function addSubFieldData($data) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "TestFieldsRange/addNewSubRange/";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, json_encode($data), $media_Type);
        return $response;
    }
    
     public function getTestFieldRangeData($data) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "TestFieldsRange/getAllRanges";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        return json_decode($response);
    }

}