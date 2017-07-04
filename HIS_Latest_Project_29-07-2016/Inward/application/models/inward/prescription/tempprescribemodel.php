<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TempPrescribeModel
 *
 * @author Hasangi
 */
class TempPrescribeModel extends CI_Model{
    //put your code here
    private $auto_id;
	private $term_id;
	private $drug_id;
	private $dose;
	private $frequency;
	
        
        public function getUpdateJson($auto_id, $dose,$frequency) {
        return array(
            'auto_id' => $auto_id,
            'dose' => $dose,
             'frequency' => $frequency
        );
    }

    public function getInsertJson() {
        return array(
            
            'term_id' => $this->term_id,
            'drug_id' => $this->drug_id,
            'dose' => $this->dose,
            'frequency' => $this->frequency
            
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
        $serviceURL = SERVICE_BASE_URL . "TempPrescribe/addNewPrescrptionItem";
        $media_Type = "application/json";
        //$curRequest= new ServiceCaller();
        $response = $this->serviceCaller->curl_POST_Request($serviceURL, $ward_JSON_Obj, $media_Type);
        return $response;
    }
    
     public function UpdatePrescrptionItem( $auto_id, $dose,$frequency) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $data = $this->getUpdateJson($auto_id, $dose,$frequency);
        $ward_JSON_Obj = json_encode($data);
        $serviceURL = SERVICE_BASE_URL . "TempPrescribe/UpdatePrescrptionItem";
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_UPDATE_Request($serviceURL, $ward_JSON_Obj, $media_Type);
        return $response;
    }
    
    
     public function getPrescrptionItemsByTermID($term_id) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "TempPrescribe/getPrescrptionItemsByTermID/" . $term_id;
        $media_Type = "application/json";
        // $curRequest= new ServiceCaller();
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        $decodeResponse = json_decode($response);
        return $decodeResponse;
    }
    
    public function deletePrescrptionTemp() {
          $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $data=array('auto_id'=>  $this->getAuto_id());
        $ward_JSON_Obj=json_encode($data);
        $serviceURL=SERVICE_BASE_URL."TempPrescribe/deleteTempPrescription/";
        $media_Type="application/json";
        //$curRequest= new ServiceCaller();
        $response=$this->serviceCaller->curl_DELETE_Request($serviceURL,$ward_JSON_Obj,$media_Type);
        return $response;
    }
    
}

?>
