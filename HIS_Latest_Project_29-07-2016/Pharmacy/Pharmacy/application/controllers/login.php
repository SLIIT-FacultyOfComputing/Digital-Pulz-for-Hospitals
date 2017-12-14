<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<?php

session_start();

class login extends CI_Controller {

    function __construct() {
        parent::__construct();
         $this->load->library('session');
      //  $this->load->model('login_model', '', TRUE);
    }

    function index() {      
        
        $this->logout();
        
    }

    function logout() {

        $this->load->library('session');
        $this->session->unset_userdata('logged_in');
        session_destroy();
        
        $data['in'] = FALSE ;
        $data['status'] = "";
        //$this->load->view('login_view',$data);
        $this->load->library('template');
            $this->template->title('Login');
            $this->template
                 ->set_layout('login') 
                 ->build('login_view',$data);

    }

    function login_validate() {
        //This method will have the credentials validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

        
        
        $UserName = $this->input->post('username');
        $Password = $this->input->post('password');
        
        if($UserName != "" && $Password != ""){
            
            $this->form_validation->run() ;
        }
               // == FALSE) {
            //Field validation failed. User redirected to login page
           
       // } else {
          
           
            
        //}
    }

    function check_database($password) {
        //Field validation succeeded.&nbsp; Validate against database
        $this->load->library('session');
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
                
            
             //   $this->session->set_userdata('logged_in', $sess_array);
				
            $_SESSION['user'] = $row['user_id']; // assign user id to user session
            
             $a =0;
			 $permission[$a] = '';
        foreach ($row['permission'] as $key => $value) {
           $permission[$a] = $value->permissionDiscription;
            $a++;
        }
        
        $_SESSION['permission'] = $permission;
        
             $this->session->set_userdata($newdata);
		  
			 ob_start();
			 
			if($row['role_id'] == '4')
			{
				redirect('/Report_Controller/report',$data);
			}
			
			if($row['role_id'] == '5')
			{
                            redirect('/Prescribe_Controller',$data);
							//print_r("Sahan");
							//exit();
			} 
			
        } else {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
           
            
            redirect(CLIENT_BASE_URL); 
            
        }
    }

}

?>
