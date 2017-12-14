<?php

//include 'application/models/Service_Caller/ServiceCaller.php';
/**
 * Description of wardAdmissionModel
 *
 * @author Hasangi
 */
class patientHistoryModel extends CI_Model {

    private $bhtNo;
    private $patientID;
    private $bedNo;
    private $wardNo;
    private $dailyNo;
    private $monthlyNo;
    private $yearlyNo;
    private $DoctorID;
    private $admitDateTime;
    private $patientComplain;
    private $previousHistory;
    private $createdUser;
    private $createdDateTime;
    private $LastUpdatedUser;
    private $LastUpdatedDateTime;

    public function getBhtNo() {
        return $this->bhtNo;
    }

    public function setBhtNo($bhtNo) {
        $this->bhtNo = $bhtNo;
    }

    public function getPatientID() {
        return $this->patientID;
    }

    public function setPatientID($patientID) {
        $this->patientID = $patientID;
    }

    public function getBedNo() {
        return $this->bedNo;
    }

    public function setBedNo($bedNo) {
        $this->bedNo = $bedNo;
    }

    public function getWardNo() {
        return $this->wardNo;
    }

    public function setWardNo($wardNo) {
        $this->wardNo = $wardNo;
    }

    public function getDailyNo() {
        return $this->dailyNo;
    }

    public function setDailyNo($dailyNo) {
        $this->dailyNo = $dailyNo;
    }

    public function getMonthlyNo() {
        return $this->monthlyNo;
    }

    public function setMonthlyNo($monthlyNo) {
        $this->monthlyNo = $monthlyNo;
    }

    public function getYearlyNo() {
        return $this->yearlyNo;
    }

    public function setYearlyNo($yearlyNo) {
        $this->yearlyNo = $yearlyNo;
    }

    public function getDoctorID() {
        return $this->DoctorID;
    }

    public function setDoctorID($DoctorID) {
        $this->DoctorID = $DoctorID;
    }

    public function getAdmitDateTime() {
        return $this->admitDateTime;
    }

    public function setAdmitDateTime($admitDateTime) {
        $this->admitDateTime = $admitDateTime;
    }

    public function getPatientComplain() {
        return $this->patientComplain;
    }

    public function setPatientComplain($patientComplain) {
        $this->patientComplain = $patientComplain;
    }

    public function getPreviousHistory() {
        return $this->previousHistory;
    }

    public function setPreviousHistory($previousHistory) {
        $this->previousHistory = $previousHistory;
    }

    public function getCreatedUser() {
        return $this->createdUser;
    }

    public function setCreatedUser($createdUser) {
        $this->createdUser = $createdUser;
    }

    public function getCreatedDateTime() {
        return $this->createdDateTime;
    }

    public function setCreatedDateTime($createdDateTime) {
        $this->createdDateTime = $createdDateTime;
    }

    public function getLastUpdatedUser() {
        return $this->LastUpdatedUser;
    }

    public function setLastUpdatedUser($LastUpdatedUser) {
        $this->LastUpdatedUser = $LastUpdatedUser;
    }

    public function getLastUpdatedDateTime() {
        return $this->LastUpdatedDateTime;
    }

    public function setLastUpdatedDateTime($LastUpdatedDateTime) {
        $this->LastUpdatedDateTime = $LastUpdatedDateTime;
    }

//    public function insertwardAdmission($unit) {
//
//        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
//        $data = $this->jsonSerialize($unit);
//        $ward_JSON_Obj = json_encode($data);
//        //print_r($ward_JSON_Obj);
//        //exit();
//        $serviceURL = SERVICE_BASE_URL . "Admission/addWardAdmission";
//        $media_Type = "application/json";
//        //$curRequest= new ServiceCaller();
//        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $ward_JSON_Obj, $media_Type);
//        return $response;
//    }

    public function jsonSerialize($unit) {
        return array(
            'bhtNo' => $this->bhtNo,
            'patientID' => $this->patientID,
            'bedNo' => $this->bedNo,
            'wardNo' => $this->wardNo,
            'dailyNo' => $this->dailyNo,
            'monthlyNo' => $this->monthlyNo,
            'yearlyNo' => $this->yearlyNo,
            'DoctorID' => $this->DoctorID,
            'admitDateTime' => $this->admitDateTime,
            'patientComplain' => $this->patientComplain,
            'previousHistory' => $this->previousHistory,
            'createdUser' => $this->createdUser,
            'createdDateTime' => $this->createdDateTime,
            'LastUpdatedUser' => $this->LastUpdatedUser,
            'LastUpdatedDateTime' => $this->LastUpdatedDateTime,
            'AdmissionUnit'=>$unit);
    }

//    public function getAllWardAdmissions() {
//        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
//        $serviceURL = SERVICE_BASE_URL . "Admission/getWardAdmission";
//        $media_Type = "application/json";
//        //$curRequest= new ServiceCaller();
//        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
//        $decodeResponse = json_decode($response);
//        return $decodeResponse;
//    }

//    public function getWardAdmissionDetails($bhtNo) {
//        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
//        $serviceURL = SERVICE_BASE_URL . "Admission/getWardAdmissionDetails/" . $bhtNo;
//        $media_Type = "application/json";
//        // $curRequest= new ServiceCaller();
//        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
//        $decodeResponse = json_decode($response);
//        return $decodeResponse;
//    }

    public function getPatientDetailsByPatientHIN($patientID) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "PatientHistory/getPatientHistoryByHIN/" . $patientID;
        
        
        $media_Type = "application/json";
        // $curRequest= new ServiceCaller();
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        return $response;
    }

//    public function UpdateDischarge($BhtNo,$discharjType,$remark,$LastUpdatedUser,$LastUpdatedDateTime) {
//        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
//        $data = $this->getUpdateJson($BhtNo,$discharjType,$remark,$LastUpdatedUser,$LastUpdatedDateTime);
//        $ward_JSON_Obj = json_encode($data);
//        $serviceURL = SERVICE_BASE_URL . "Admission/updateDischarge";
//        $media_Type = "application/json";
//        $response = $this->serviceCaller->curl_UPDATE_Request($serviceURL, $ward_JSON_Obj, $media_Type);
//        return $response;
//    }

//     public function getDoctorDesignature() {
//        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
//        $serviceURL = SERVICE_BASE_URL . "HrDesignation/getAllDesignationsByDoctorGroup";
//        $media_Type = "application/json";
//         $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
//        $decodeResponse = json_decode($response);
//        return $decodeResponse;
//    }
    
//    public function getUpdateJson($BhtNo,$discharjType,$remark,$LastUpdatedUser,$LastUpdatedDateTime) {
//        return array(
//            'BhtNo' => $BhtNo,
//            'discharjType' => $discharjType,
//            'remark' => $remark,          
//            'LastUpdatedUser' => $LastUpdatedUser,
//            'LastUpdatedDateTime' => $LastUpdatedDateTime
////        );
//    }
//    
//     public function getWardAdmissionByWardNo($wardNo) {
//        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
//        $serviceURL = SERVICE_BASE_URL . "Admission/getWardAdmissionByWardNo/" . $wardNo;
//        $media_Type = "application/json";
//        // $curRequest= new ServiceCaller();
//        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
//        $decodeResponse = json_decode($response);
//        return $decodeResponse;
//    }
//    
//    
//    public function updateAdmissionBedNo($BhtNo,$bedNo,$LastUpdatedUser,$LastUpdatedDateTime) {
//        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
//        $data = $this->getUpdateBedJson($BhtNo,$bedNo,$LastUpdatedUser,$LastUpdatedDateTime);
//        $ward_JSON_Obj = json_encode($data);
//        $serviceURL = SERVICE_BASE_URL . "Admission/updateAdmissionBedNo";
//        $media_Type = "application/json";
//        $response = $this->serviceCaller->curl_UPDATE_Request($serviceURL, $ward_JSON_Obj, $media_Type);
//        return $response;
//    }
//    
    
    public function getUpdateBedJson($BhtNo,$bedNo,$LastUpdatedUser,$LastUpdatedDateTime) {
        return array(
            'BhtNo' => $BhtNo,
            'bedNo' => $bedNo,          
            'LastUpdatedUser' => $LastUpdatedUser,
            'LastUpdatedDateTime' => $LastUpdatedDateTime
        );
    }

}

?>
