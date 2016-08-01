<?php

class Test_request extends CI_Controller{
    function __construct()
	{
		parent::__construct();

		$this->_init();
        $this->output->set_common_meta('Lab Orders', '', '');
        // add breadcrumbs
        $this->breadcrumbs->push('<i class="fa fa-home"></i>Home', '/test_request');
        $this->breadcrumbs->push('Lab Orders', 'null');
	}
	
	private function _init()
	{
		$this->output->set_template('default');
		$this->load->section('sidebar', 'includes/sidebar');
	}
	
    public function index()
	{
        $data['Requests']=$this->getAllTestRequests();
        $this->load->view('test_request',$data);
    }

    //get all test requests
    
    public function  getAllTestRequests()
    {
             $this->load->model('test_request_model','requests');
             $ss=$this->requests->getAlltRequests();
             return $ss;
    }


   

}

