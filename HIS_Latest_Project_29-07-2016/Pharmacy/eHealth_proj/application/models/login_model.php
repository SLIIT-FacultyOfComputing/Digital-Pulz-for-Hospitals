<?php

class Login_Model extends CI_Model {

    function login($username, $password) {

        // Normal DB call to validate user from DB

        /* $this->db->select('user_id, employee_id, user_name, role_id');
          $this->db->from('admin_user');
          $this->db->where('user_name', $username);
          $this->db->where('password','1000:'. md5($password));
          $this->db->limit(1);
          $query = $this->db->get();

          print_r($query->result());
          exit();

          if ($query->num_rows() == 1) {
          return $query->result();
          } else {
          return false;
          } */


        // Use web service to validate user from DB
        // initialize model
        $this->load->model('servicecaller', 'serviceCaller');

        // create json object
        $data = array('user_name' => $username, 'password' => $password);
        $user_JSON_Obj = json_encode($data);

        // call webservice 
        $serviceURL = SERVICE_BASE_URL . "UserService/userValidation";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $user_JSON_Obj, $media_Type);


        // get return database result
        $user = json_decode($response);
		

        if ($user) {

            $u = array('user_id' => $user[0]->userId, 'employee_id' => $user[0]->hrEmployee->empId
                , 'user_name' => $user[0]->userName, 'role_id' => $user[0]->adminUserroles->roleId, 'permission' => $user[0]->adminUserroles->adminPermissions);

  //  print_r($user[0]);
        


            return $u;
        } else {
            return FALSE;
        }
    }

}

?>
