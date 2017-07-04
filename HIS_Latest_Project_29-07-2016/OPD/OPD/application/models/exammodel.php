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

include_once 'servicecaller.php';

class ExamModel {
	
	public function ExamModel(){}

	private $patexamid;
	private $pid;
	private $visitid;
	private $examdate;
	private $weight;
	private $height;
	private $bmi;
	private $sys_bp;
	private $diast_bp;
	private $temprature;
	private $active;
	private $userid;

	public function get_patexamid() { return $this->patexamid; } 
	public function get_pid() { return $this->pid; } 
	public function get_visitid() { return $this->visitid; } 
	public function get_examdate() { return $this->examdate; } 
	public function get_weight() { return $this->weight; } 
	public function get_height() { return $this->height; } 
	public function get_bmi() { return $this->bmi; } 
	public function get_sys_bp() { return $this->sys_bp; } 
	public function get_diast_bp() { return $this->diast_bp; } 
	public function get_temprature() { return $this->temprature; } 
	public function get_active() { return $this->active; } 
	public function get_userid() { return $this->userid; } 
	public function set_patexamid($x) { $this->patexamid = $x; } 
	public function set_pid($x) { $this->pid = $x; } 
	public function set_visitid($x) { $this->visitid = $x; } 
	public function set_examdate($x) { $this->examdate = $x; } 
	public function set_weight($x) { $this->weight = $x; } 
	public function set_height($x) { $this->height = $x; } 
	public function set_bmi($x) { $this->bmi = $x; } 
	public function set_sys_bp($x) { $this->sys_bp = $x; } 
	public function set_diast_bp($x) { $this->diast_bp = $x; } 
	public function set_temprature($x) { $this->temprature = $x; } 
	public function set_active($x) { $this->active = $x; } 
	public function set_userid($x) { $this->userid = $x; } 

	public function addExam()
	{
		$patientJSON   = json_encode($this->jsonSerialize());
		$service_url = SERVICE_BASE_URL."Exams/addExamination";
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
	    $response =  $curl_request->curl_POST_Request($service_url,$patientJSON,$MediaType);
		return $response;
	}
  
	public function updateExam()
	{
		$patientJSON   = json_encode($this->jsonSerialize());
		$service_url = SERVICE_BASE_URL."Exams/updateExamination";
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
	    $response =  $curl_request->curl_POST_Request($service_url,$patientJSON,$MediaType);
		return $response;
	}
  
  
	public function getExams()
	{
		$service_url = SERVICE_BASE_URL."Exams/getexamByPID/".$this->pid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
	public function getExam()
	{
		$service_url = SERVICE_BASE_URL."Exams/getexamByExamID/".$this->patexamid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
	public function getVisitExams()
	{
		$service_url = SERVICE_BASE_URL."Exams/getExamsByVisit/".$this->visitid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
	public function jsonSerialize()
	{
		$post_data = array(
			"patexamid" =>   $this->patexamid,
			"pid" =>   $this->pid,
			"Height" => $this->height,
			"Weight" => $this->weight,
			"bmi" => $this->bmi,
			"ExamDate" => $this->examdate,
			"Temperature" => $this->temprature,
			"SysBP" => $this->sys_bp,
			"DiastBP" => $this->diast_bp,
			"userid" =>  $this->userid,
			"visitid" =>  $this->visitid,
			"active" =>  $this->active,
		);
		return $post_data;
	}
	 
}
?>