<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PrescrptionItemModel
 *
 * @author Hasangi
 */
class PrescrptionItemModel extends CI_Model{
        private $auto_id;
	private $term_id;
	private $drug_id;
	private $dose;
	private $frequency;
	private $status;
        
        public function getUpdateJson($auto_id, $status) {
        return array(
            'auto_id' => $auto_id,
            'status' => $status
        );
    }

    public function getInsertJson() {
        return array(
            
            'term_id' => $this->term_id,
            'drug_id' => $this->drug_id,
            'dose' => $this->dose,
            'frequency' => $this->frequency,
            'status' => $this->status
        );
    }
       
        
        public function getAuto_id() {
            return $this->auto_id;
        }

        public function setAuto_id($auto_id) {
            $this->auto_id = $auto_id;
        }

        public function getTerm_id() {
            return $this->term_id;
        }

        public function setTerm_id($term_id) {
            $this->term_id = $term_id;
        }

        public function getDrug_id() {
            return $this->drug_id;
        }

        public function setDrug_id($drug_id) {
            $this->drug_id = $drug_id;
        }

        public function getDose() {
            return $this->dose;
        }

        public function setDose($dose) {
            $this->dose = $dose;
        }

        public function getFrequency() {
            return $this->frequency;
        }

        public function setFrequency($frequency) {
            $this->frequency = $frequency;
        }

        public function getStatus() {
            return $this->status;
        }

        public function setStatus($status) {
            $this->status = $status;
        }

    public function addNewPrescrptionItem() {

        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $data = $this->getInsertJson();
        $ward_JSON_Obj = json_encode($data);
        //print_r($ward_JSON_Obj);
        //exit();
        $serviceURL = SERVICE_BASE_URL . "PrescriptionItem/addNewPrescrptionItem";
        $media_Type = "application/json";
        //$curRequest= new ServiceCaller();
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $ward_JSON_Obj, $media_Type);
        return $response;
    }
    
     public function UpdatePrescrptionItem($auto_id, $status) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $data = $this->getUpdateJson($auto_id, $status);
        $ward_JSON_Obj = json_encode($data);
        $serviceURL = SERVICE_BASE_URL . "PrescriptionItem/UpdatePrescrptionItem";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_UPDATE_Request($serviceURL, $ward_JSON_Obj, $media_Type);
        return $response;
    }
     public function getPrescrptionItemsByBHTNo($bhtNo) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "PrescriptionItem/getPrescrptionItemsByBHTNo/" . $bhtNo;
        $media_Type = "application/json";
        // $curRequest= new ServiceCaller();
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        $decodeResponse = json_decode($response);
        return $decodeResponse;
    }
    
     public function getPrescrptionItemsByTermID($term_id) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "PrescriptionItem/getPrescrptionItemsByTermID/" . $term_id;
        $media_Type = "application/json";
        // $curRequest= new ServiceCaller();
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        $decodeResponse = json_decode($response);
        return $decodeResponse;
    }
    
}

?>
