<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class patientHistoryModel extends CI_Model{
    
//        private $patientID;
//	private $patientTitle;
//	private $patientFullName;
//	private $patientPersonalUsedName;
//	private $patientNIC;
//	private $patientHIN;
//	private $patientPassport;
//	private $patientPhoto;
//	private $patientDateOfBirth;
//	private $patientTelephone;
//	private $patientGender;
//	private $patientCivilStatus;
//	private $patientPreferredLanguage;
//	private $patientCitizenship;
//	private $patientContactPName;
//	private $patientContactPNo;
//	private $patientAddress;
//	private $patientCreateDate;
//	private $patientCreateUser;
//	private $patientLastUpdate;
//	private $patientLastUpdateUser;
//	private $patientRemarks;
//	private $patientActive;
// 
//
//  public function getpatientID() {
//        return $this->patientID;
//    }
//
//    public function setpatientID($patientID) {
//        $this->patientID = patientID;
//    }
//
// public function getpatientTitle() {
//        return $this->patientTitle;
//    }
//
//    public function setpatientTitle($patientTitle) {
//        $this->patientTitle = patientTitle;
//    }
//    
//     public function getpatientFullName() {
//        return $this->patientFullName;
//    }
//
//    public function setpatientFullName($patientFullName) {
//        $this->patientPersonalUsedName = patientPersonalUsedName;
//    }
//    
//     public function getpatientPersonalUsedName() {
//        return $this->patientPersonalUsedName;
//    }
//
//    public function setpatientPersonalUsedName($patientPersonalUsedName) {
//        $this->patientPersonalUsedName = patientPersonalUsedName;
//       
//    }
//    
//    public function getpatientNIC() {
//        return $this->patientNIC;
//    }
//
//    public function setpatientNIC($patientNIC) {
//        $this->patientNIC = patientNIC;
//    }
//    
//    public function getpatientPassport() {
//        return $this->patientNIC;
//    }
//
//    public function setpatientPassport($patientPassport) {
//        $this->patientNIC = patientNIC;
//    }
//    
//      public function getpatientPhoto() {
//        return $this->patientPhoto;
//    }
//
//    public function setpatientPhoto($patientPhoto) {
//        $this->patientPhoto = patientPhoto;
//    }
//    
//    public function getpatientDateOfBirth() {
//        return $this->patientDateOfBirth;
//    }
//
//    public function setpatientDateOfBirth($patientDateOfBirth) {
//        $this->patientDateOfBirth = patientDateOfBirth;
//    }
//    
//    public function getpatientDateOfBirth() {
//        return $this->patientDateOfBirth;
//    }
//
//    public function setpatientDateOfBirth($patientDateOfBirth) {
//        $this->patientDateOfBirth = patientDateOfBirth;
//    }
         public function getPatientDetailsByPatientHIN($patientID) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "OutPatient/getPatientByHIN/" . $patientID;
       
        $media_Type = "application/json";
        // $curRequest= new ServiceCaller();
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        return $response;
    }       
}
//
// public function getUpdateBedJson($BhtNo,$bedNo,$LastUpdatedUser,$LastUpdatedDateTime) {
//        return array(
//            'BhtNo' => $BhtNo,
//            'bedNo' => $bedNo,          
//            'LastUpdatedUser' => $LastUpdatedUser,
//            'LastUpdatedDateTime' => $LastUpdatedDateTime
//        );
    

