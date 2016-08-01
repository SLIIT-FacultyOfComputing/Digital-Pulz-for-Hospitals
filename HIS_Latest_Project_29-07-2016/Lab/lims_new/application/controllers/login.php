<?php

session_start();

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $data['in'] = FALSE;
        $this->load->view('login_view',$data);
    }

    function logout() {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        
        $data['in'] = TRUE;
        $this->load->view('login_view',$data);
    }

    function login_validate() {
        //This method will have the credentials validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

        $this->form_validation->run() ;
    }

    function check_database($password) {
        //Field validation succeeded.&nbsp; Validate against database
        $username = $this->input->post('username');

        $this->load->model('login_model');
        //query the database
        $row = $this->login_model->login($username, $password);
		
        $_SESSION['user'] = -1;  // initialize user session
	
        
        if ($row) {
            $data['status'] = 'ok';
                
                $newdata = array(
				'username'   =>   $row['user_name'],
				'userfullname'   =>  $row['user_name'],
				'userid'     => $row['user_id'],
				'userlevel'  => $row['role_id'],
				'logged_in'  => TRUE,
				'qhold'  => FALSE
               );
                
            $_SESSION['user'] = $row['user_id']; // assign user id to user session
            
             $a =0;
        foreach ($row['permission'] as $key => $value) {
           $permission[$a] = $value->permissionDiscription;
            $a++;
        }
        
        $_SESSION['role_id'] = $row['role_id'];
        
        $this->session->set_userdata($newdata);
		  
			 redirect('test_request');
                         
			
        }  else {
           
        $data['in'] = FALSE;
        $data['status'] = "Invalid username or password";
        $this->load->helper('url');
        $this->load->library('template');
        $this->template->title('Login');
        $this->template
            ->set_layout('login') 
            ->build('login_view',$data); 
        }
    }

}

?>
