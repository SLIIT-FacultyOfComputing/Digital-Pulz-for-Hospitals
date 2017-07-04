<?php

//include 'application/models/Service_Caller/ServiceCaller.php';

class patientmodel {
	
	public function patientmodel(){}
	  
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
	public function set_remarks($x) { $this->remarks = $x; } 
	public function set_userid($x) { $this->userid = $x; } 
	public function set_pid($x) { $this->pid = $x; } 

    //get patient details for ward admission
	public function getPatient()
	{
             //$this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
		$service_url = SERVICE_BASE_URL."OutPatient/getPatientsByPID/".$this->pid;
		//$curl_request = new ServiceCaller();
		$response = $this->curl_GET_Request($service_url);
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
				"remarks" => $this->remarks,
				"active" => $this->active,
				"userid" =>  $this->userid
		);
		return $post_data;
	}
        
         public function curl_GET_Request($service_url)
	{
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$curl_response = curl_exec($curl);
		curl_close($curl);
		return $curl_response;
	}

	 
}
?>