<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdmissionRequestModel
 *
 * @author Hasangi
 */
class AdmissionRequestModel extends CI_Model {

    private $auto_id;
    private $patient_id;
    private $request_unit;
    private $is_read;
    private $transfer_ward;
    private $remark;
    private $create_user;
    private $create_date_time;
    private $is_user_doctor;
    private $last_update_user;
    private $last_update_date_time;
    private $bht_no;

    public function getAuto_id() {
        return $this->auto_id;
    }

    public function setAuto_id($auto_id) {
        $this->auto_id = $auto_id;
    }

    public function getPatient_id() {
        return $this->patient_id;
    }

    public function setPatient_id($patient_id) {
        $this->patient_id = $patient_id;
    }

    public function getRequest_unit() {
        return $this->request_unit;
    }

    public function setRequest_unit($request_unit) {
        $this->request_unit = $request_unit;
    }

    public function getIs_read() {
        return $this->is_read;
    }

    public function setIs_read($is_read) {
        $this->is_read = $is_read;
    }

    public function getTransfer_ward() {
        return $this->transfer_ward;
    }

    public function setTransfer_ward($transfer_ward) {
        $this->transfer_ward = $transfer_ward;
    }

    public function getRemark() {
        return $this->remark;
    }

    public function setRemark($remark) {
        $this->remark = $remark;
    }

    public function getCreate_user() {
        return $this->create_user;
    }

    public function setCreate_user($create_user) {
        $this->create_user = $create_user;
    }

    public function getCreate_date_time() {
        return $this->create_date_time;
    }

    public function setCreate_date_time($create_date_time) {
        $this->create_date_time = $create_date_time;
    }

    public function getIs_user_doctor() {
        return $this->is_user_doctor;
    }

    public function setIs_user_doctor($is_user_doctor) {
        $this->is_user_doctor = $is_user_doctor;
    }

    public function getLast_update_user() {
        return $this->last_update_user;
    }

    public function setLast_update_user($last_update_user) {
        $this->last_update_user = $last_update_user;
    }

    public function getLast_update_date_time() {
        return $this->last_update_date_time;
    }

    public function setLast_update_date_time($last_update_date_time) {
        $this->last_update_date_time = $last_update_date_time;
    }

    public function getBht_no() {
        return $this->bht_no;
    }

    public function setBht_no($bht_no) {
        $this->bht_no = $bht_no;
    }

    public function jsonSerialize() {
        return array(
            'patient_id' => $this->patient_id,
            'request_unit' => $this->request_unit,
            'is_read' => $this->is_read,
            'transfer_ward' => $this->transfer_ward,
            'remark' => $this->remark,
            'create_user' => $this->create_user,
            'create_date_time' => $this->create_date_time,
            'is_user_doctor' => $this->is_user_doctor,
            'last_update_user' => $this->last_update_user,
            'last_update_date_time' => $this->last_update_date_time);
    }
    
     public function Updatejson() {
        return array(
            'auto_id' => $this->auto_id,
            'bht_no' => $this->bht_no,
            'last_update_user' => $this->last_update_user,
            'last_update_date_time' => $this->last_update_date_time);
    }
    public function UpdateAdmissionRequest()
    {
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $data=$this->Updatejson();
        $ward_JSON_Obj=json_encode($data);   
       
        $serviceURL=SERVICE_BASE_URL."AdmissionRequest/updateAdmisiionRequest";
        $media_Type="application/json";
        $response=$this->serviceCaller->curl_UPDATE_Request($serviceURL,$ward_JSON_Obj,$media_Type);
        return $response;
    } 
   
    public function insertaddAdmissionRequest() {

        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $data = $this->jsonSerialize();
        $ward_JSON_Obj = json_encode($data);  
      
        $serviceURL = SERVICE_BASE_URL . "AdmissionRequest/addAdmissionRequest";
        $media_Type = "application/json";
        //$curRequest= new ServiceCaller();
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $ward_JSON_Obj, $media_Type);
        return $response;
    }
     public function getAdmissionRequestCount($wardNo){
         
         $this->load->model('/Service_Caller/ServiceCaller','serviceCaller'); 
        
        $serviceURL=SERVICE_BASE_URL."AdmissionRequest/getNotReadAdmissionRequestByWard/".$wardNo;
        $media_Type="application/json";
        //$curRequest= new ServiceCaller();
        $response=$this->serviceCaller->curl_GET_All_Request($serviceURL,$media_Type);
        $decodeResponse=  json_decode($response);
        return $decodeResponse;
     
    }

     public function getSelectAdmissionReq($autoID){
         
         $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $serviceURL=SERVICE_BASE_URL."AdmissionRequest/getSelectAdmissionReq/".$autoID;
        $media_Type="application/json";
        //$curRequest= new ServiceCaller();
        $response=$this->serviceCaller->curl_GET_All_Request($serviceURL,$media_Type);
        $decodeResponse=  json_decode($response);
        return $decodeResponse;     
    }
}

?>
