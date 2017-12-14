<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of diagnoseModel
 *
 * @author Nirmani
 */
class diagnoseModel extends CI_Model {

    private $id;
    private $treat;
    private $image;
    private $bhtNo;
    private $create_user;
    private $create_date_time;
 
    function getId() {
        return $this->id;
    }

    function getTreat() {
        return $this->treat;
    }

    function getImage() {
        return $this->image;
    }

    function getBhtNo() {
        return $this->bhtNo;
    }

    function getCreate_user() {
        return $this->create_user;
    }

    function getCreate_date_time() {
        return $this->create_date_time;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTreat($treat) {
        $this->treat = $treat;
    }

    function setImage($image) {
        $this->image = $image;
    }

    function setBhtNo($bhtNo) {
        $this->bhtNo = $bhtNo;
    }

    function setCreate_user($create_user) {
        $this->create_user = $create_user;
    }

    function setCreate_date_time($create_date_time) {
        $this->create_date_time = $create_date_time;
    }

               
    public function jsonSerialize($bhtNo){	
        return array(
            'id'=>$this->id,
            'treat'=>$this->treat,
            'image'=>$this->image,
            'bhtNo'=>$this->bhtNo,
            'create_user'=>$this->create_user,
            'create_date_time'=>$this->create_date_time,
            'bhtNo'=>  $this->$bhtNo);	
        
    }  
    
     public function getDiagonseDetails($bhtNo) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "Diagnose/getDiagnoseByBHTNo/" . $bhtNo;
        $media_Type = "application/json";
        // $curRequest= new ServiceCaller();
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        $decodeResponse = json_decode($response);
        return $decodeResponse;
    }
    


}
