<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PrescrptionTermModel
 *
 * @author Hasangi
 */
class PrescrptionTermModel extends CI_Model {

    //put your code here
    private $term_id;
    private $bht_no;
    private $no_of_terms;
    private $start_date;
    private $end_date;
    private $create_user;

    public function getUpdateJson($term_id, $end_date) {
        return array(
            'term_id' => $term_id,
            'end_date' => $end_date
        );
    }

    public function getInsertJson() {
        return array(
            'bht_no' => $this->bht_no,
            'no_of_terms' => $this->no_of_terms,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'create_user' => $this->create_user
        );
    }

    public function getTerm_id() {
        return $this->term_id;
    }

    public function setTerm_id($term_id) {
        $this->term_id = $term_id;
    }

    public function getBht_no() {
        return $this->bht_no;
    }

    public function setBht_no($bht_no) {
        $this->bht_no = $bht_no;
    }

    public function getNo_of_terms() {
        return $this->no_of_terms;
    }

    public function setNo_of_terms($no_of_terms) {
        $this->no_of_terms = $no_of_terms;
    }

    public function getStart_date() {
        return $this->start_date;
    }

    public function setStart_date($start_date) {
        $this->start_date = $start_date;
    }

    public function getEnd_date() {
        return $this->end_date;
    }

    public function setEnd_date($end_date) {
        $this->end_date = $end_date;
    }

    public function getCreate_user() {
        return $this->create_user;
    }

    public function setCreate_user($create_user) {
        $this->create_user = $create_user;
    }

    public function insertPrescrptionTerms() {

        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $data = $this->getInsertJson();
        $ward_JSON_Obj = json_encode($data);  
       // print_r($ward_JSON_Obj);
        //exit();
        $serviceURL = SERVICE_BASE_URL . "PrescriptionTerms/addNewTermPrescrption";
        $media_Type = "application/json";
        //$curRequest= new ServiceCaller();
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $ward_JSON_Obj, $media_Type);
        return $response;
    }
    
     public function UpdatePrescrptionTerms($term_id, $end_date) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $data = $this->getUpdateJson($term_id, $end_date);
        $ward_JSON_Obj = json_encode($data);
        $serviceURL = SERVICE_BASE_URL . "PrescriptionTerms/UpdateTermPrescrption";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_UPDATE_Request($serviceURL, $ward_JSON_Obj, $media_Type);
        return $response;
    }
     public function getPrescrptionTermsByBHTNo($bhtNo) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "PrescriptionTerms/getPrescrptionTermsByBHTNo/" . $bhtNo;
        $media_Type = "application/json";
        // $curRequest= new ServiceCaller();
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        $decodeResponse = json_decode($response);
        return $decodeResponse;
    }
    

}

?>
