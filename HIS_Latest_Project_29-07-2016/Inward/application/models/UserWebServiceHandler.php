<?php

class UserWebServiceHandler extends CI_Model {

    function GetAllUsers() {
        $user = json_decode(
            file_get_contents(SERVICE_BASE_URL.'UserService/getActiveUsers')
        );
 
        return $user;
    }
    
    
    function GetUserRolePermissions($userId,$roleId) {
        $user = json_decode(
            file_get_contents(SERVICE_BASE_URL.'UserService/getUserRolePermission/'.$userId.'/'.$roleId)
        );
 
        return $user;
    }
    
    
    function InsertUser($userDetails)
    {

//        print_r($userDetails);
//        exit();
        
        // initialize model
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        
        // create json object
       // $data=array('userName'=>$username,'password'=>'1000:'. md5($password));
        $user_JSON_Obj=json_encode($userDetails);
        
        // call webservice 
        $serviceURL=SERVICE_BASE_URL."UserService/registerUser";
        $media_Type="application/json";
        $response=$this->serviceCaller->curl_POST_Request($serviceURL,$user_JSON_Obj,$media_Type);
        $result = json_decode($response);
       
        return  $result;
       
    }
    
    function UpdateUser($userDetails)
    {
        // initialize model
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        
        // create json object
        $user_JSON_Obj=json_encode($userDetails);
        
        // call webservice 
        $serviceURL=SERVICE_BASE_URL."UserService/updateUser";
        $media_Type="application/json";
        $response=$this->serviceCaller->curl_UPDATE_Request($serviceURL,$user_JSON_Obj,$media_Type);
        $result = json_decode($response);
        
        
        return $result;
    }
    
    function UpdateUserName($userDetails)
    {

        
        // initialize model
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        
        // create json object
        $user_JSON_Obj=json_encode($userDetails);
        
        // call webservice 
        $serviceURL=SERVICE_BASE_URL."UserService/updateUserName";
        $media_Type="application/json";
        $response=$this->serviceCaller->curl_UPDATE_Request($serviceURL,$user_JSON_Obj,$media_Type);
        $result = json_decode($response);
        
        
        return $result;
    }
    
     function DeleteUser($userDetails)
    {

//        print_r($userDetails);
//        exit();
        
        // initialize model
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        
        // create json object
       // $data=array('userName'=>$username,'password'=>'1000:'. md5($password));
        $user_JSON_Obj=json_encode($userDetails);
        
        // call webservice 
        $serviceURL=SERVICE_BASE_URL."UserService/updateUser";
        $media_Type="application/json";
        $response=$this->serviceCaller->curl_DELETE_Request($serviceURL,$user_JSON_Obj,$media_Type);
        $result = json_decode($response);
        
//        print_r($result);
//        exit();
        
        return $result;
    }
    
    
    function GetUser($id) {
        
        $user = json_decode(
            file_get_contents('http://localhost:8080/HIS_API/rest/UserService/getUserByUsrID/'.$id)
        );
 
        
        return $user;
        
    }
}
?>
