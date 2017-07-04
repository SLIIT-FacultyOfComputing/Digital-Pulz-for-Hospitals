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

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        //  $this->load->model('login_model', '', TRUE);
    }
	
	function index() {
	
        $data['in'] = FALSE;
		$data['status'] = "";
		$this->load->library('template');
		$this->template->title('Login');
		$this->template
			->set_layout('login') // application/views/layouts/two_col.php
			->build('login_view',$data); // views/welcome_message
       // $this->load->view('login_view',$data);
	   }

       function signup()
       {
           $data['status'] = "";
           $this->load->library('template');
           $this->template->title('Login');
           $this->template
            ->set_layout('login') // application/views/layouts/two_col.php
            ->build('newuser/signup',$data);

           $username = $this->input->post('username');

           print_r($username);

       }

       function sign_up_form()
       {

        $data['in'] = FALSE;
        $data['status'] = "";
        $this->load->library('template');
        $this->template->title('Login');
        $this->template
            ->set_layout('login') // application/views/layouts/two_col.php
            ->build('login_view',$data);
       }


       function signup_validate()
       {
            $username = $this->input->post('username');
            $gender = $this->input->post('gender');
            $datepicker = $this->input->post('datepicker');
            $priority = $this->input->post('priority');
            $civil_status = $this->input->post('civil_status');
            $password = $this->input->post('password');
            
            if ($priority == "D") {
                $priority = 1;
            }
            else{
                $priority = 2;
            }
            
            $this->load->model('login_model' , 'login');
            $maxEmpID = $this->login->getMaxEmployeeID();

            $intMaxEmpID=filter_var($maxEmpID, FILTER_SANITIZE_NUMBER_INT); 

            $newEmpId = (int)$intMaxEmpID++;

            $newuser = array(
                'roleId' => $priority,
                'employeeId' => $newEmpId,
                'userName' => $username,
                'password' => $password,
                'username' => $username,
                'userfullname' => $username,
                'userid' => $newEmpId,
                'userlevel' => $priority,
                'logged_in' => TRUE,
                'qhold' => FALSE

            );

            $result = $this->login->RegisterUser($newuser);
           
        
        if ($result) {


            $data['status'] = 'ok';

            $_SESSION['user'] = -1; 

             $_SESSION['role_id'] = $priority;

            $this->session->set_userdata($newuser);
 
            ob_start();

            if ($newuser['roleId'] == '1') {
            
                redirect('doctor_home_c/view/5', $data);
            }

            if ($newuser['roleId'] == '2') {
                
                redirect('operator_home_c/view/3/2', $data);
            }
        } else {
           
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

    function logout() {
		
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('roleId');
        $this->session->unset_userdata('employeeId');
        $this->session->unset_userdata('userName');
        $this->session->unset_userdata('userfullname');
        $this->session->unset_userdata('userid');
        $this->session->unset_userdata('userlevel');
        $this->session->unset_userdata('qhold');
        session_destroy();

        $data['in'] = TRUE;
        $data['status'] = "";
		
        $this->load->library('template');
		$this->template->title('Login');
		$this->template
			->set_layout('login') // application/views/layouts/two_col.php
			->build('login_view',$data);
    }

    function login_validate() {
        //This method will have the credentials validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

        $this->form_validation->run();
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
                'username' => $row['user_name'],
                'userfullname' => $row['user_name'],
                'userid' => $row['user_id'],
                'userlevel' => $row['role_id'],
                'logged_in' => TRUE,
                'qhold' => FALSE
            );


            //   $this->session->set_userdata('logged_in', $sess_array);

            $_SESSION['user'] = $row['user_id']; // assign user id to user session

            $a = 0;
            foreach ($row['permission'] as $key => $value) {
               $permission[$a] = $value->permissionDiscription;
                $a++;

            }

            // $_SESSION['permission'] = $permission;
            $_SESSION['role_id'] = $row['role_id'];

            $this->session->set_userdata($newdata);

            ob_start();

            if ($row['role_id'] == '1') {
			
                redirect('doctor_home_c/view/5', $data);
            }

            if ($row['role_id'] == '2') {
				
                redirect('operator_home_c/view/3/2', $data);
            }
        } else {
           
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
