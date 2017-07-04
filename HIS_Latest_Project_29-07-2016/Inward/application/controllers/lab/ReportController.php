<?php

class ReportController extends CI_Controller{

    public function index($bhtNo,$patientID){

	    $pid = $_GET['ReqID'];
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);
		
		$data1['Report'] = $this->getAllReportData($pid);
        $this->load->view('layout/headerBHT', $data);
        $this->load->view('lab/ReportView',$data1);

    }

	
	 public function getAllReportData($id)
    {
            $this->load->model('/lab/ReportModel','report');
            $ss=$this->report->getReportData($id);
            print_r($ss);
            return $ss;
        

    }

     public function getDischargeType($bhtNo) {
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $admission = $this->admission->getWardAdmissionDetails($bhtNo);
        foreach ($admission as $value) {
            $discharjType = $value->dischargeType;
        }
        return $discharjType;
    }

}
