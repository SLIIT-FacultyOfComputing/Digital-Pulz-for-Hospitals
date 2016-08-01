<?php

class Specimen_Info extends CI_Controller {
    private function _init()
    {
        $this->output->set_template('default');
        $this->load->section('sidebar', 'includes/sidebar');
    }

    public function index(){
        $this->_init();
        $array = $this->uri->uri_to_assoc(3);
        $request_id = $array['ReqID'];
		
        if (empty($request_id)) {
            show_404();
        }
		
        $this->load->model('specimen_model', 'specimenModel');
        $specimen_types = $this->specimenModel->getSpecimen_types();
        $specimen_retension_types = $this->specimenModel->getSpecimen_retension_types();
        $data['specimen'] = $this->getSpecimen($request_id);
        $data['specimen_types'] = $specimen_types;
        $data['specimen_retension_types'] = $specimen_retension_types;
        $data['status'] = "";
        if(isset($array['status'])) {
            $status = $array['status'];
            if($status == "complete"){

            $data['specimen_in_details'] = $this->getSpecimenInDetails  ($request_id);
            $data['status'] = 'complete';
            }
        }
		
        $this->load->view('specimen_info', $data);
    }
    

    //get specimen indetails
    public function getSpecimenInDetails($request_id) {
        $this->load->model('test_request_model', 'requests');
        return $this->requests->getSpecimenInDetails($request_id);
    }
    

    //get specimen
    public function getSpecimen($request_id) {
        $this->load->model('test_request_model', 'requests');
        return $this->requests->getTestRequestByRequestID($request_id);
    }

    //add specimen
    public function add() {
        $curl_post_data = array(
            "remarks" => $_POST['remarks'],
            "stored_location" => $_POST['stored_location'],
            "stored_or_destroyed" => $_POST['stored_or_destroyed'],
            "fRetentionType_ID" => $_POST['retentionType'],
            "fSpecimentType_ID" => $_POST['SpecimenType'],
            "flabtestrequest_ID" => $_POST['flabtestrequest_ID'],
            "collected_date" => $_POST['collected_date'],
            "stored_destroyed_date" => $_POST['CompletedDate'],
            "fSpecimen_CollectedBy" => 1,
            "fSpecimen_ReceivededBy" => 2,
            "fSpecimen_DeliveredBy" => 3
        );
        $data_string = json_encode($curl_post_data);
        $this->load->model('specimen_model', 'specimenModel');
        $this->specimenModel->add($data_string);

        //update status
        $this->load->model('test_request_model', 'requests');
        $this->requests->setStatus(json_encode(array("reqID" => $_POST['flabtestrequest_ID'], "status" => "Sample Collected")));
        echo json_encode("status:1");
    }

}
