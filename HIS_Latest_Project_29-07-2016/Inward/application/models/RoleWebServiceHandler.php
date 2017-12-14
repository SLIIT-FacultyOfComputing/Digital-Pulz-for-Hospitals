<?php

class RoleWebServiceHandler extends CI_Model {

    function GetAllRoles() {
        $roles = json_decode(
            file_get_contents(SERVICE_BASE_URL.'UserRoleService/getActiveUserRoles')
        );
 
        return $roles;
    }
    
    function GetRole($roleId) {
        $roles = json_decode(
            file_get_contents(SERVICE_BASE_URL.'UserRoleService/getSingleUserRole/'.$roleId)
        );
 
        return $roles;
    }
    
    
     function InsertRole($roleDetails)
    {

//        print_r($userDetails);
//        exit();
        
        // initialize model
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        
        // create json object
       // $data=array('userName'=>$username,'password'=>'1000:'. md5($password));
        $role_JSON_Obj=json_encode($roleDetails);
        
        // call webservice 
        $serviceURL=SERVICE_BASE_URL."UserRoleService/userRoleRegistration";
        $media_Type="application/json";
        $response=$this->serviceCaller->curl_POST_Request($serviceURL,$role_JSON_Obj,$media_Type);
        $result = json_decode($response);
       
        return  $result;
       
    }
    
    
    function UpdateRole($roleDetails)
    {

//        print_r($userDetails);
//        exit();
        
        // initialize model
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        
        // create json object
       // $data=array('userName'=>$username,'password'=>'1000:'. md5($password));
        $role_JSON_Obj=json_encode($roleDetails);
        
        // call webservice 
        $serviceURL=SERVICE_BASE_URL."UserRoleService/updateUserRole";
        $media_Type="application/json";
        $response=$this->serviceCaller->curl_UPDATE_Request($serviceURL,$role_JSON_Obj,$media_Type);
        $result = json_decode($response);
       
        return  $result;
       
    }
    
    function DeleteRole($roleDetails)
    {

//        print_r($userDetails);
//        exit();
        
        // initialize model
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        
        // create json object
       // $data=array('userName'=>$username,'password'=>'1000:'. md5($password));
        $role_JSON_Obj=json_encode($roleDetails);
        
        // call webservice 
        $serviceURL=SERVICE_BASE_URL."UserRoleService/updateUserRole";
        $media_Type="application/json";
        $response=$this->serviceCaller->curl_DELETE_Request($serviceURL,$role_JSON_Obj,$media_Type);
        $result = json_decode($response);
       
        return  $result;
       
    }
    
}
?>
