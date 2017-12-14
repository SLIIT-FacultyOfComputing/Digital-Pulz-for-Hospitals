<?php
/**
 * Description of LiquidBlanceChartModel
 *
 * @author nipuna
 */
//include 'application/models/Service_Caller/ServiceCaller.php';

class LiquidBlanceChartModel {
   
    private $rowNo;
    private $bhtNo;
    private $dateTime;
    private $PO;
    private $IV;
    private $outPut;

    public function getRowNo() {
        return $this->rowNo;
    }

    public function getBhtNo() {
        return $this->bhtNo;
    }

    public function getDateTime() {
        return $this->dateTime;
    }

    public function getPO() {
        return $this->PO;
    }

    public function getIV() {
        return $this->IV;
    }

    public function getOutPut() {
        return $this->outPut;
    }

    public function setRowNo($rowNo) {
        $this->rowNo = $rowNo;
    }

    public function setBhtNo($bhtNo) {
        $this->bhtNo = $bhtNo;
    }

    public function setDateTime($dateTime) {
        $this->dateTime = $dateTime;
    }

    public function setPO($PO) {
        $this->PO = $PO;
    }

    public function setIV($IV) {
        $this->IV = $IV;
    }

    public function setOutPut($outPut) {
        $this->outPut = $outPut;
    }

public function getCordinates() {
        $serviceURL = SERVICE_BASE_URL . "LiquidBlanceChart/getChart";
        $media_Type = "application/json";
        //$curRequest = new ServiceCaller();
        $this->load->model('/Service_Caller/ServiceCaller','service');
        $response = $this->service->curl_GET_All_Request($serviceURL, $media_Type);
        $decodeResponse = json_decode($response);
        return $decodeResponse;
    }

}
