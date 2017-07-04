<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AllergyModel
 *
 * @author Hasangi
 */
class AllergyModel extends CI_Model {

    private $allergyid;
    private $pid;
    private $visitid;
    private $name;
    private $status;
    private $remarks;
    private $createdate;
    private $createuser;
    private $lastupdate;
    private $lastupdateuser;
    private $active;
    private $userid;

    public function getAllergyid() {
        return $this->allergyid;
    }

    public function setAllergyid($allergyid) {
        $this->allergyid = $allergyid;
    }

    public function getPid() {
        return $this->pid;
    }

    public function setPid($pid) {
        $this->pid = $pid;
    }

    public function getVisitid() {
        return $this->visitid;
    }

    public function setVisitid($visitid) {
        $this->visitid = $visitid;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getRemarks() {
        return $this->remarks;
    }

    public function setRemarks($remarks) {
        $this->remarks = $remarks;
    }

    public function getCreatedate() {
        return $this->createdate;
    }

    public function setCreatedate($createdate) {
        $this->createdate = $createdate;
    }

    public function getCreateuser() {
        return $this->createuser;
    }

    public function setCreateuser($createuser) {
        $this->createuser = $createuser;
    }

    public function getLastupdate() {
        return $this->lastupdate;
    }

    public function setLastupdate($lastupdate) {
        $this->lastupdate = $lastupdate;
    }

    public function getLastupdateuser() {
        return $this->lastupdateuser;
    }

    public function setLastupdateuser($lastupdateuser) {
        $this->lastupdateuser = $lastupdateuser;
    }

    public function getActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function getUserid() {
        return $this->userid;
    }

    public function setUserid($userid) {
        $this->userid = $userid;
    }

    public function addAllergy() {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $patientJSON = json_encode($this->jsonSerialize());
        $service_url = SERVICE_BASE_URL . "Allergy/addAllergy";
        $MediaType = "application/json";
        $response = $this->serviceCaller->curl_POST_Request($service_url, $patientJSON, $MediaType);
        return $response;
    }

    public function updateAllergy() {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $patientJSON = json_encode($this->jsonSerialize());
        $service_url = SERVICE_BASE_URL . "Allergy/updateAllergy";
        $MediaType = "application/json";
        $response = $this->serviceCaller->curl_UPDATE_Request($service_url, $patientJSON, $MediaType);
        return $response;
    }

    public function getAllergies($patientID) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $service_url = SERVICE_BASE_URL . "Allergy/getAllergiesByPatient/".$patientID;
        $response = $this->serviceCaller->curl_GET_Request($service_url);
        $decodeResponse = json_decode($response);
        return $decodeResponse;
    }

    public function getAllergy($allrgyId) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $service_url = SERVICE_BASE_URL . "Allergy/getAllergy/" . $allrgyId;
        $response = $this->serviceCaller->curl_GET_Request($service_url);
        $decodeResponse = json_decode($response);
        return $decodeResponse;
    }

    public function jsonSerialize() {
        $post_data = array(
            "allergyid" => $this->allergyid,
            "pid" => $this->pid,
            "name" => $this->name,
            "status" => $this->status,
            "remarks" => $this->remarks,
            "userid" => $this->userid,
            "active" => $this->active,
            "visitid" => $this->visitid
        );
        return $post_data;
    }


}

?>
