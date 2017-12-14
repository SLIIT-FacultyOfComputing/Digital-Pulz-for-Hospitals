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

class PatientModel {
	
	public function PatientModel(){}
	  
	private $pid;
	private $title;
	private $fullname;
	private $personalname;
	private $nic;
	private $passport;  			
	private $hin;
	private $photo;
	private $dob;
	private $gender;
	private $contactpname;
	private $contactpno;
	private $cstatus; 
	private $address;
	private $telephone;
	private $lang;
	private $citizen;
	private $blood;
	private $remarks;
	private $userid;  
	private $active;
	
	public function get_pid() { return $this->pid; }
	public function get_active() { return $this->active; } 	
	public function get_title() { return $this->title; } 
	public function get_fullname() { return $this->fullname; } 
	public function get_personalname() { return $this->personalname; } 
	public function get_nic() { return $this->nic; } 
	public function get_passport() { return $this->passport; } 
	public function get_hin() { return $this->hin; } 
	public function get_photo() { return $this->photo; } 
	public function get_dob() { return $this->dob; } 
	public function get_gender() { return $this->gender; } 
	public function get_contactpname() { return $this->contactpname; } 
	public function get_contactpno() { return $this->contactpno; } 
	public function get_cstatus() { return $this->cstatus; } 
	public function get_address() { return $this->address; } 
	public function get_telephone() { return $this->telephone; } 
	public function get_lang() { return $this->lang; } 
	public function get_citizen() { return $this->citizen; }
	public function get_blood() { return $this->blood; } 
	public function get_remarks() { return $this->remarks; } 
	public function get_userid() { return $this->userid; } 
	public function set_title($x) { $this->title = $x; } 
	public function set_fullname($x) { $this->fullname = $x; } 
	public function set_personalname($x) { $this->personalname = $x; } 
	public function set_nic($x) { $this->nic = $x; } 
	public function set_active($x) { $this->active = $x; } 
	public function set_passport($x) { $this->passport = $x; } 
	public function set_hin($x) { $this->hin = $x; } 
	public function set_photo($x) { $this->photo = $x; } 
	public function set_dob($x) { $this->dob = $x; } 
	public function set_gender($x) { $this->gender = $x; } 
	public function set_contactpname($x) { $this->contactpname = $x; } 
	public function set_contactpno($x) { $this->contactpno = $x; } 
	public function set_cstatus($x) { $this->cstatus = $x; } 
	public function set_address($x) { $this->address = $x; } 
	public function set_telephone($x) { $this->telephone = $x; } 
	public function set_lang($x) { $this->lang = $x; } 
	public function set_citizen($x) { $this->citizen = $x; }
	public function set_blood($x) { $this->blood = $x; } 
	public function set_remarks($x) { $this->remarks = $x; } 
	public function set_userid($x) { $this->userid = $x; } 
	public function set_pid($x) { $this->pid = $x; } 

	public function addPatient()
	{
		$patientJSON   = json_encode($this->jsonSerialize());
		$service_url = SERVICE_BASE_URL."OutPatient/registerPatient";
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
                $response =  $curl_request->curl_POST_Request($service_url,$patientJSON,$MediaType);
		return $response;
	}
	 
	public function updatePatient()
	{
		$patientJSON  = json_encode($this->jsonSerialize());
		$service_url =  SERVICE_BASE_URL."OutPatient/updatePatient";
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
	    $response = $curl_request->curl_POST_Request($service_url,$patientJSON,$MediaType);
		return $response;
	} 
    
	public function getPatient()
	{
		$service_url = SERVICE_BASE_URL."OutPatient/getPatientsByPID/".$this->pid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
        
        public function getAlleryList()
	{
		$service_url = SERVICE_BASE_URL."LiveSearch/allergyLivesearch";
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
        
	
	public function getDoctorPatients($docid,$visit_type)
	{
		$service_url = SERVICE_BASE_URL."OutPatient/getPatientsForDoctor/".$docid."/".$visit_type;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
	public function getAllPatients()
	{
		$service_url = SERVICE_BASE_URL."OutPatient/getAllPatients";
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
	public function getVillageOnSearch($village)
	{
		$service_url = SERVICE_BASE_URL."Village/getVillageOnSearch/".$village;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	public function jsonSerialize()
	{
			$post_data = array(
				"pid" => $this->pid,
				"title" => $this->title,
				"fullname" => $this->fullname,
				"personalname" => $this->personalname,
				"nic" => $this->nic,
				"passport" => $this->passport,						
				"hin" => $this->hin,
				"photo" =>  $this->photo,
				"dob" => $this->dob,
				"gender" => $this->gender,
				"contactpname" => $this->contactpname,
				"contactpno" => $this->contactpno,
				"cstatus" => $this->cstatus,
				"address" => $this->address,
				"telephone" => $this->telephone,
				"lang" => $this->lang,
				"citizen" => $this->citizen,
				"blood" => $this->blood,
				"remarks" => $this->remarks,
				"active" => $this->active,
				"userid" =>  $this->userid
		);
		return $post_data;
	}
	 
}
?>