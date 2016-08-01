<?php



class Report_modal extends CI_Model {

    public function getReportData($data) {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL . "MainResults/getMainResultsByReqID/".$data;
        $media_Type = "application/json";
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);        
        return $response;
    }

}
