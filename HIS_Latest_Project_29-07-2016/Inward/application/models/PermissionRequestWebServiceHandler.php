<?php

class PermissionRequestWebServiceHandler extends CI_Model {

    function GetAllPermissionRequest() {
        $user = json_decode(
            file_get_contents(SERVICE_BASE_URL.'AdminPermissionRequestService/getAllPermissionRequests')
        );
        
        return $user;
    }
    
    function GetUnApprovedPermissionRequests() {
        $permission = json_decode(
            file_get_contents(SERVICE_BASE_URL.'AdminPermissionRequestService/getUnApprovedPermissionRequests')
        );
        
        return $permission;
    }
    
    function GetPermissionRequest($requestId) {
        $permission = json_decode(
            file_get_contents(SERVICE_BASE_URL.'AdminPermissionRequestService/getPermissionRequest/'.$requestId)
        );
        
        return $permission;
    }
    
    
    function GetApprovedPermissionRequest($requestId) {
        $permission = json_decode(
            file_get_contents(SERVICE_BASE_URL.'AdminPermissionRequestService/getApprovedPermissionRequest/'.$requestId)
        );
        
        return $permission;
    }
    
    
    function InsertPermissionRequest($requestDetails)
    {
        // initialize model
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        
        // create json object
        $request_JSON_Obj=json_encode($requestDetails);
        
        // call webservice 
        $serviceURL=SERVICE_BASE_URL."AdminPermissionRequestService/addNewPermissionRequest";
        $media_Type="application/json";
        $response=$this->serviceCaller->curl_POST_Request($serviceURL,$request_JSON_Obj,$media_Type);
        $result = json_decode($response);
       
        return  $result;
       
    }
    
    function UpdatePermissionRequest($requestDetails)
    {
        
        // initialize model
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        
        // create json object
        $request_JSON_Obj=json_encode($requestDetails);
        
        // call webservice 
        $serviceURL=SERVICE_BASE_URL."AdminPermissionRequestService/updatePermissionRequest";
        $media_Type="application/json";
        $response=$this->serviceCaller->curl_UPDATE_Request($serviceURL,$request_JSON_Obj,$media_Type);
        $result = json_decode($response);
        
        return $result;
    }
    
}

?>
