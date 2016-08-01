<?php

class Login_Model extends CI_Model {

    function login($username, $password) {
      
        // Use web service to validate user from DB
        // initialize model
        $this->load->model('Service_Caller/ServiceCaller', 'servicecaller');

        // create json object
        $data = array('user_name' => $username, 'password' => $password);
        $user_JSON_Obj = json_encode($data);

        // call webservice 
        $serviceURL = SERVICE_BASE_URL . "UserService/userValidation";
        $media_Type = "application/json";
        $response = $this->servicecaller->curl_POST_Request($serviceURL, $user_JSON_Obj, $media_Type);


        // get return database result
        $user = json_decode($response);

        if ($user) {

            $u = array('user_id' => $user[0]->userId, 'employee_id' => $user[0]->hrEmployee->empId
                , 'user_name' => $user[0]->userName, 'role_id' => $user[0]->adminUserroles->roleId, 'permission' => $user[0]->adminUserroles->adminPermissions);

            return $u;
        } else {
            return FALSE;
        }
    }

}

?>
