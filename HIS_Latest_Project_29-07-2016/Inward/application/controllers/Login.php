<?php

session_start();

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('login_model', '', TRUE);
    }

    function index() {        
        $this->load->view('login_view');
    }

    function logout() {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('Login/index');
    }

    function login_validate() {
        //This method will have the credentials validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

        if ($this->form_validation->run() == FALSE) {
            //Field validation failed. User redirected to login page
            redirect('Login'); 
            
        } else {
            redirect('inward/wardAdmissionC/index');
           // redirect('User_Home');   //Place to redirect user
        }
    }

    function check_database($password) {
        //Field validation succeeded.&nbsp; Validate against database
        $username = $this->input->post('username');

        //query the database
        $row = $this->login_model->login($username, $password);
		
        $_SESSION['user'] = -1;  // initialize user session
		
        if ($row) {
		
		// This code segment use normal DB call to validate user
//            $sess_array = array();
//            foreach ($result as $row) {
//                $sess_array = array(
//                    'UserId' => $row->user_id,
//                    'EmpId' => $row->employee_id,
//                    'Username' => $row->user_name,
//                    'RoleId' => $row->role_id
//                );
//                
//            
//                $this->session->set_userdata('logged_in', $sess_array);
//            $_SESSION['user'] = $row->user_id;
//            }
		
		// This code segment use web service to validate user ( DON'T REMOVE THIS COMMENTED CODES )
		
		
            $sess_array = array();
                $sess_array = array(
                    'UserId' => $row['user_id'],
                    'EmpId' => $row['employee_id'],
                    'Username' => $row['user_name'],
                    'RoleId' => $row['role_id']
                );
                
            
                $this->session->set_userdata('logged_in', $sess_array);
				
            $_SESSION['user'] = $row['user_id']; // assign user id to user session
            $_SESSION['EmpId']=$row['employee_id'];
            $_SESSION['RoleId']=$row['role_id'];
            $d=$this->login_model->getEmpByID($row['employee_id']);
            $_SESSION['empName']=$d[0][1].". ".$d[0][2]." ".$d[0][3];
            
            
             $a =0;
        foreach ($row['permission'] as $key => $value) {
           $permission[$a] = $value->permissionDiscription;
            $a++;
        }
        
        $_SESSION['permission'] = $permission;
        
            return TRUE;
			
        } else {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }

}

?>
