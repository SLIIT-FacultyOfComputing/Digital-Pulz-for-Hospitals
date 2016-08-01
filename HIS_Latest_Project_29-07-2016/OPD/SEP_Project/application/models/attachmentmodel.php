<?php

include_once 'servicecaller.php';

class AttachmentModel {
	
	public function AttachmentModel(){}

	private $attchid;
	private $attach_type;
	private $pid;
	private $attached_by;
	private $attach_description;
	private $attach_comment;
	private $attach_name;
	private $attach_link;
	private $createdate;
	private $createuser;
	private $lastupdate;
	private $lastupdateuser;
	private $active;
	private $userid;

	public function get_attchid() { return $this->attchid; } 
	public function get_attach_type() { return $this->attach_type; } 
	public function get_pid() { return $this->pid; } 
	public function get_attached_by() { return $this->attached_by; } 
	public function get_attach_description() { return $this->attach_description; } 
	public function get_attach_comment() { return $this->attach_comment; } 
	public function get_attach_name() { return $this->attach_name; } 
	public function get_attach_link() { return $this->attach_link; } 
	public function get_createdate() { return $this->createdate; } 
	public function get_createuser() { return $this->createuser; } 
	public function get_lastupdate() { return $this->lastupdate; } 
	public function get_lastupdateuser() { return $this->lastupdateuser; } 
	public function get_active() { return $this->active; } 
	public function get_userid() { return $this->userid; } 
	public function set_attchid($x) { $this->attchid = $x; } 
	public function set_attach_type($x) { $this->attach_type = $x; } 
	public function set_pid($x) { $this->pid = $x; } 
	public function set_attached_by($x) { $this->attached_by = $x; } 
	public function set_attach_description($x) { $this->attach_description = $x; } 
	public function set_attach_comment($x) { $this->attach_comment = $x; } 
	public function set_attach_name($x) { $this->attach_name = $x; } 
	public function set_attach_link($x) { $this->attach_link = $x; } 
	public function set_createdate($x) { $this->createdate = $x; } 
	public function set_createuser($x) { $this->createuser = $x; } 
	public function set_lastupdate($x) { $this->lastupdate = $x; } 
	public function set_lastupdateuser($x) { $this->lastupdateuser = $x; } 
	public function set_active($x) { $this->active = $x; } 
	public function set_userid($x) { $this->userid = $x; } 

  
	public function addAttachment()
	{
		$patientJSON   = json_encode($this->jsonSerialize());
		$service_url = SERVICE_BASE_URL."Attachments/addAttachment";
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
	    $response =  $curl_request->curl_POST_Request($service_url,$patientJSON,$MediaType);
		return $response;
	}
  
	public function updateAttachment()
	{
		$patientJSON   = json_encode($this->jsonSerialize());
		$service_url = SERVICE_BASE_URL."Attachments/updateAttachments";
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
		$response =  $curl_request->curl_POST_Request($service_url,$patientJSON,$MediaType);
		return $response;
	}

	public function getAttachments()
	{
		$service_url = SERVICE_BASE_URL."Attachments/getAttachmentByPID/".$this->pid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
	public function getAttachment()
	{
		$service_url = SERVICE_BASE_URL."Attachments/getAttachmentByAttachID/".$this->attchid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
	public function jsonSerialize()
	{
		$post_data = array(
				"attchid" => $this->attchid,
				"pid" => $this->pid,
				"filetype" => $this->attach_type,
				"attachname" => $this->attach_name,
				"AttachedBy" => $this->attached_by,
				"Remarks" => $this->attach_description,
                                "comment" => $this->attach_comment,
				"filepath" => $this->attach_link,
				"userid" =>  $this->userid,
				"active" =>  $this->active,
				"visitid" => '0'
		);
		return $post_data;
	}
	 
}
?>