<?php 
class login_c extends CI_Controller {
	 var $_site_base_url=SITE_BASE_URL;
	public function __construct()
	{
		parent::__construct();		
	}
	
	public function index()
	{
		$data['title'] = "Login to OpenHMS";
		$data['status'] = "";
	 
		$logged_in = $this->session->userdata('logged_in');
		
		if($logged_in == TRUE)
		{
			ob_start();
			if($this->session->userdata('userlevel')== '1')
			{
				redirect('doctor_home_c/view/5',$data);
			}
			
			if($this->session->userdata('userlevel')== '2')
			{
				redirect('operator_home_c/view/1',$data);
			}
		}
		
		$this->load->view('header',$data);;
		$this->load->view('login_v',$data);
		
	}
	
	public function login()
	{ 
	
	 

		$this->load->model('ServiceModel','service');
		$loginResponse = json_decode($this->service->validateUser(  $this->input->post('uname'),$this->input->post('pass')));
		
 		if($loginResponse == false)
		{
			$data['status'] = 'error'; 
			 
			$data['title'] = "Login to OpenHMS";
			$this->load->view('header',$data);;
			$this->load->view('login_v');
	
		}else
		{
			$data['status'] = 'ok';
			 
			$newdata = array(
				'username'   =>   $loginResponse[0]->userName ,
				'userfullname'   =>  $loginResponse[0]->userName,
				'userid'     => $loginResponse[0]->userID,
				'userlevel'  => $loginResponse[0]->userRoles->userRoleID ,
				'logged_in'  => TRUE,
				'qhold'  => FALSE
               );

			$this->session->set_userdata($newdata);
		  
			 ob_start();
			 
			if($loginResponse[0]->userRoles->userRoleID == '1')
			{
				redirect('doctor_home_c/view/5',$data);
			}
			
			if($loginResponse[0]->userRoles->userRoleID == '2')
			{
				redirect('operator_home_c/view/1',$data);
			}   
		}
		 
	}
	
	
	public function logout()
	{
		$newdata = array( 
				'username'   => '',
				'userfullname'   => '',
				'userid'     => '',
				'userlevel'  => '' ,
				'logged_in'  => FALSE
		);
		$this->session->unset_userdata($newdata);
		redirect('login_c/',$newdata);
	}
}
?>