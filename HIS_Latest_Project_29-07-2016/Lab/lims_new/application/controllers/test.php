<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');

		$this->_init();
	}

	private function _init()
	{
		$this->output->set_template('default');
		$this->load->section('sidebar', 'includes/sidebar');
	}

	public function index()
	{
		$this->load->view('new_test');
	}
}