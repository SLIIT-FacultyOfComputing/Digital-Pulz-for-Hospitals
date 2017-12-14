<?php

/**
 * Description of PatientModel
 *
 * @author Hasangi
 */
class PatientModel {
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
        
        
        public function getPid() {
            return $this->pid;
        }

        public function setPid($pid) {
            $this->pid = $pid;
        }

        public function getTitle() {
            return $this->title;
        }

        public function setTitle($title) {
            $this->title = $title;
        }

        public function getFullname() {
            return $this->fullname;
        }

        public function setFullname($fullname) {
            $this->fullname = $fullname;
        }

        public function getPersonalname() {
            return $this->personalname;
        }

        public function setPersonalname($personalname) {
            $this->personalname = $personalname;
        }

        public function getNic() {
            return $this->nic;
        }

        public function setNic($nic) {
            $this->nic = $nic;
        }

        public function getPassport() {
            return $this->passport;
        }

        public function setPassport($passport) {
            $this->passport = $passport;
        }

        public function getHin() {
            return $this->hin;
        }

        public function setHin($hin) {
            $this->hin = $hin;
        }

        public function getPhoto() {
            return $this->photo;
        }

        public function setPhoto($photo) {
            $this->photo = $photo;
        }

        public function getDob() {
            return $this->dob;
        }

        public function setDob($dob) {
            $this->dob = $dob;
        }

        public function getGender() {
            return $this->gender;
        }

        public function setGender($gender) {
            $this->gender = $gender;
        }

        public function getContactpname() {
            return $this->contactpname;
        }

        public function setContactpname($contactpname) {
            $this->contactpname = $contactpname;
        }

        public function getContactpno() {
            return $this->contactpno;
        }

        public function setContactpno($contactpno) {
            $this->contactpno = $contactpno;
        }

        public function getCstatus() {
            return $this->cstatus;
        }

        public function setCstatus($cstatus) {
            $this->cstatus = $cstatus;
        }

        public function getAddress() {
            return $this->address;
        }

        public function setAddress($address) {
            $this->address = $address;
        }

        public function getTelephone() {
            return $this->telephone;
        }

        public function setTelephone($telephone) {
            $this->telephone = $telephone;
        }

        public function getLang() {
            return $this->lang;
        }

        public function setLang($lang) {
            $this->lang = $lang;
        }

        public function getCitizen() {
            return $this->citizen;
        }

        public function setCitizen($citizen) {
            $this->citizen = $citizen;
        }

        public function getRemarks() {
            return $this->remarks;
        }

        public function setRemarks($remarks) {
            $this->remarks = $remarks;
        }

        public function getUserid() {
            return $this->userid;
        }

        public function setUserid($userid) {
            $this->userid = $userid;
        }

        public function getActive() {
            return $this->active;
        }

        public function setActive($active) {
            $this->active = $active;
        }

        public function getPatient($patientID)
	{
               $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
		$service_url = SERVICE_BASE_URL."OutPatient/getPatientsByPID/".$patientID;
		//$curl_request = new ServiceCaller();
		$response = $this->serviceCaller->curl_GET_Request($service_url);
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

}

?>
