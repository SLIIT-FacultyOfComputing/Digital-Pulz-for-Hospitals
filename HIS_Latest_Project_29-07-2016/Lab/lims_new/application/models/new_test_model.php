<?php

class New_test_model extends CI_Model {

    public function GetAllCategories() {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "Category/getAllCategories";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        return $response;
    }

    public function GetAllSubCategoriesByCategoryID($ID) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "SubCategory/getSubCategoriesByCategoryID/" . $ID;
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        return $response;
    }

    public function GetSpecimenTypes($CID, $SID) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "SpecimenType/getAllSpecimenTypesByCIDSID/" . $CID . "/" . $SID;
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        return $response;
    }

    public function GetSpecimenRetTypes($CID, $SID) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');

        $serviceURL = SERVICE_BASE_URL . "SpecimenRetentionType/getAllSpecimenRetentionTypesBYCIDSID/" . $CID . "/" . $SID;
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        return $response;
    }

  public function GetRet($CID, $SID) {

        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "SpecimenRetentionType/getAllSpecimenRetentionTypesByCIDSID/" . $CID . "/" . $SID;
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        return $response;


    }
   

    public function AddCategory($cate) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $category_JSON_Obj = $cate;
        $serviceURL = SERVICE_BASE_URL . "Category/addCategory";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $category_JSON_Obj, $media_Type);
        return $response;
    }

    public function AddSubCategory($Subcate) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $Subcategory_JSON_Obj = $Subcate;
        $serviceURL = SERVICE_BASE_URL . "SubCategory/addSubCategory";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $Subcategory_JSON_Obj, $media_Type);
        return $response;
    }

    public function AddSpecimenType($Speci) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $specimenType_JSON_Obj = $Speci;
        $serviceURL = SERVICE_BASE_URL . "SpecimenType/addSpecimenType";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $specimenType_JSON_Obj, $media_Type);
        return $response;
    }

    public function AddSpecimenRetentionType($SpeciRet) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $specimenRetType_JSON_Obj = $SpeciRet;
        $serviceURL = SERVICE_BASE_URL . "SpecimenRetentionType/addSpecimenRetentionType";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $specimenRetType_JSON_Obj, $media_Type);
        return $response;
    }

    public function AddTestName($Test) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $Test_JSON_Obj = $Test;
        $serviceURL = SERVICE_BASE_URL . "TestNames/addNewtest";
        $media_Type = "application/json";
        
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $Test_JSON_Obj, $media_Type);
        return $response;

    }

    public function GetMaxParentID() {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "ParentTestFields/getMaxParentID";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        return $response;
    }

    public function GetMaxSubFieldID() {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "SubTestFields/getMaxSubTestFieldID";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        return $response;
    }

    public function getMaxTestNameID() {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "TestNames/getMaxTestID";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        return $response;
    }

    public function AddParentFields($results){
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $mainresults=$results;
        print_r($mainresults);
        $serviceURL=SERVICE_BASE_URL."ParentTestFields/addNewParentTestField";
        $media_Type="application/json";
        $response=$this->serviceCaller->curl_POST_Request($serviceURL,$mainresults,$media_Type);
        return $response;
    }

    public function AddParentFieldsRanges($ranges){

        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $Test_JSON_Obj = $ranges;
        $serviceURL = SERVICE_BASE_URL . "TestFieldsRange/addNewRange";
        $media_Type = "application/json";
        
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $Test_JSON_Obj, $media_Type);
        return $response;

    }
    public function addSubFiedls($subFields){

        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $Test_JSON_Obj = $subFields;
        $serviceURL = SERVICE_BASE_URL . "SubTestFields/addNewSubTestField";
        $media_Type = "application/json";
        print_r($Test_JSON_Obj);
        print_r("Hello this is model");
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $Test_JSON_Obj, $media_Type);
        return $response;

    }

    public function AddSubFieldsRanges($ranges){

        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $Test_JSON_Obj = $ranges;
        $serviceURL = SERVICE_BASE_URL . "TestFieldsRange/addNewSubRange";
        $media_Type = "application/json";
        print_r($Test_JSON_Obj);
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $Test_JSON_Obj, $media_Type);
        return $response;

    }
    








}
