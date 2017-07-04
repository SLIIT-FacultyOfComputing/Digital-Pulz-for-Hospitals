<?php

session_start();

/**
 * Description of transferAdmissionC
 *
 * @author Hasangi
 */
class transferAdmissionC extends CI_Controller {

    public function index() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount() + $this->getAdmissionRequestCount());
        $this->load->view('layout/header1', $data);
         $this->load->view('layout/navigation1', $data);

        if ($this->getInternalTransferCount() != 0) {

            $this->load->model('/inward/transfer/InternalTrasferModel', 'internaltransfer');
            $mywards = $this->getMywards();
            $resultarray = array();
            foreach ($mywards as $val) {

                $list = $this->internaltransfer->getInternalTransferByWard($val->wardNo);
                $resultarray = array_merge($resultarray, $list);
            }
            $data['transfer'] = $resultarray;
            $this->load->view('inward/transferAdmission/tansferAdmission', $data);
        }

        if ($this->getAdmissionRequestCount() != 0) {
            $Requestarray = array();
            $this->load->model('/inward/AdmissionRequestModel', 'request');
            $mywardss = $this->getMywards();
            $Requestarray = array();
            foreach ($mywardss as $val) {

                $lists = $this->request->getAdmissionRequestCount($val->wardNo);
                $Requestarray = array_merge($Requestarray, $lists);
            }
            $data['requestAdmit'] = $Requestarray;
            $this->load->view('inward/transferAdmission/AdmissionRequestView', $data);
        }
        if(($this->getInternalTransferCount() + $this->getAdmissionRequestCount())==0)
        {
            $this->load->view('inward/transferAdmission/EmptyView');
        }

        $this->load->view('layout/footer1');
    }
     public function getAllWard() {
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        $list = $this->wardModel->getAllWards();
        return $list;
    }

    public function transferView() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount() + $this->getAdmissionRequestCount());
        //$this->load->view('layout/headerInward', $data);
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);
        //load transfer list
        $mywards = $this->getMywards();
        $resultarray = array();
        foreach ($mywards as $val) {

            $list = $this->internaltransfer->getInternalTransferByWard($val->wardNo);
            $resultarray = array_merge($resultarray, $list);
        }
        $data['transfer'] = $resultarray;

        //load doctor data
        $this->load->model('/user/EmployeeModel', 'EModel');
        //$doctype = "Doctor";
        //$data['doctor'] = $this->EModel->getAll_Employees_ByType($doctype);      
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['designature'] = $this->admission->getDoctorDesignature();

        $this->load->model('/inward/transfer/InternalTrasferModel', 'internaltransfer');
        $transview = $this->internaltransfer->getInternalTransferByID($this->input->post('tranferId'));
        $data['transview'] = $transview;

        foreach ($transview as $value) {
            $transferWard = $value->transferWard->wardNo;
        }
        $data['beds'] = $this->getFreeBeds($transferWard);

        $this->load->view('inward/transferAdmission/transter', $data);
        $this->load->view('inward/transferAdmission/tansferAdmission');
        $this->load->view('layout/footer1');
    }

    public function getMywards() {
        if($_SESSION['RoleId'] == '2'){
            return $this->getAllWard();
        }else{
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        return $this->wardModel->getWardByEmpID($_SESSION['EmpId']);     
        }
    }

    public function getInternalTransferCount() {
        $this->load->model('/inward/transfer/InternalTrasferModel', 'internaltransfer');


        $mywards = $this->getMywards();
        $count = 0;
        foreach ($mywards as $val) {


            $list = $this->internaltransfer->getInternalTransferByWard($val->wardNo);

            foreach ($list as $value) {
                $count = $count + 1;
            }
        }

        return $count;
    }

    public function InsertwardAdmission() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        //update ward_bed table for admission
        $this->load->model('/inward/admin/bedModel', 'bedModel');
        $bed = $this->bedModel->geBedByWardNoAndBedNo($this->input->post('wardNo'), $this->input->post('bedNo'));

        foreach ($bed as $value) {
            $bed_id = $value->bedID;
            $bed_no = $value->bedNo;
            $bed_type = $value->bedType;
            $ward_no = $value->wardNo->wardNo;
            $availble = $value->availability;
        }

        if ($availble == 'free') {




            $admitteddatetime = new DateTime($this->input->post('admitDateTime'));
            $currentYear = $admitteddatetime->format("Y");
            $currentMonth = $admitteddatetime->format("m");
            $currentDate = $admitteddatetime->format("d");


            //get yearly,monthlyndaily number according to theadmitted date
            $YearlyNo = 1;
            $dailyNo = 1;
            $monthlyNo = 1;
            $wardAdmission = $this->getAllWardAdmissions();

            foreach ($wardAdmission as $value) {
                if (!empty($value)) {
                    //&& ($currentYear==date("Y", $value->admitDateTime/1000))
                    if (($YearlyNo <= $value->yearlyNo)) {
                        $YearlyNo = $value->yearlyNo;
                        $year = date("Y", $value->admitDateTime / 1000);
                    }


                    if (($monthlyNo <= $value->monthlyNo)) {
                        $monthlyNo = $value->monthlyNo;
                        $month = date("m", $value->admitDateTime / 1000);
                    }

                    if (($dailyNo <= $value->dailyNo)) {

                        $dailyNo = $value->dailyNo;
                        $date = date("d", $value->admitDateTime / 1000);
                    }
                }
            }


            //get Next Yealy No
            if ($currentYear == $year) {
                $YearlyNo = $YearlyNo + 1;
            }
            //get Next Monthly No
            if ($currentMonth == $month) {
                $monthlyNo = $monthlyNo + 1;
            }
            //get Next Daily No
            if ($currentDate == $date) {
                $dailyNo = $dailyNo + 1;
            }


            //Get BHT no
            $NowYear = date('Y');
            $bht = $NowYear . $YearlyNo;


            //set time zone for sri lanka
            date_default_timezone_set("Asia/Colombo");

            $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
            $this->admission->setBhtNo($bht);
            $this->admission->setPatientID($this->input->post('patientID'));
            $this->admission->setBedNo($this->input->post('bedNo'));
            $this->admission->setWardNo($this->input->post('wardNo'));
            $this->admission->setDailyNo($dailyNo);
            $this->admission->setMonthlyNo($monthlyNo);
            $this->admission->setYearlyNo($YearlyNo);
            $this->admission->setDoctorID($this->input->post('DoctorID'));
            $this->admission->setAdmitDateTime($this->input->post('admitDateTime'));
            $this->admission->setPatientComplain($this->input->post('patientComplain'));
            $this->admission->setPreviousHistory($this->input->post('previousHistory'));
            $this->admission->setCreatedUser($_SESSION['user']);
            $this->admission->setCreatedDateTime(date('Y-m-d\TH:i'));
            $this->admission->setLastUpdatedUser($_SESSION['user']);
            $this->admission->setLastUpdatedDateTime(date('Y-m-d\TH:i'));
            $ss = $this->admission->insertwardAdmission("WARD");


            $this->load->model('/inward/admin/bedModel', 'bedModel');
            $this->bedModel->setBedID($bed_id);
            $this->bedModel->setBedNo($bed_no);
            $this->bedModel->setBedType($bed_type);
            $this->bedModel->setWardNo($ward_no);
            $this->bedModel->setAvailability($bht);
            $this->bedModel->setPatientID($this->input->post('patientID'));
            $s = $this->bedModel->UpdateBed();

            $this->load->model('/inward/transfer/InternalTrasferModel', 'internaltransfer');
            $this->internaltransfer->setTransferId($this->input->post('TransferId'));
            $this->internaltransfer->setNewbhtNo($bht);
            $j = $this->internaltransfer->UpdateTransfer();




//riderect page

            if ($ss == 'true') {
                $data['mywards'] = $this->getMywards();
                $data['count'] = ($this->getInternalTransferCount() + $this->getAdmissionRequestCount());
                $this->load->view('layout/headerInward', $data);

                $this->load->model('/inward/transfer/InternalTrasferModel', 'internaltransfer');
                $mywards = $this->getMywards();
                $resultarray = array();
                foreach ($mywards as $val) {

                    $list = $this->internaltransfer->getInternalTransferByWard($val->wardNo);
                    $resultarray = array_merge($resultarray, $list);
                }
                $data['transfer'] = $resultarray;

                $this->load->view('inward/transferAdmission/admissionSucess');
                $this->load->view('inward/transferAdmission/tansferAdmission', $data);
                $this->load->view('layout/footerInward');
            } else {
                $data['mywards'] = $this->getMywards();
                $data['count'] = $this->getInternalTransferCount();
                $this->load->view('layout/headerInward', $data);

                $this->load->model('/inward/transfer/InternalTrasferModel', 'internaltransfer');
                $mywards = $this->getMywards();
                $resultarray = array();
                foreach ($mywards as $val) {

                    $list = $this->internaltransfer->getInternalTransferByWard($val->wardNo);
                    $resultarray = array_merge($resultarray, $list);
                }
                $data['transfer'] = $resultarray;

                $this->load->view('inward/transferAdmission/admissionNotSucess');
                $this->load->view('inward/transferAdmission/tansferAdmission', $data);
                $this->load->view('layout/footerInward');
            }
        }
    }

    public function getAllWardAdmissions() {
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $ss = $this->admission->getAllWardAdmissions();
        return $ss;
    }

    public function getFreeBeds($wardNo) {

        $this->load->model('/inward/admin/bedModel', 'bedModel');
        return ($this->bedModel->getFreeBedByWardNo($wardNo));
    }

    public function getAdmissionRequestCount() {
        $this->load->model('/inward/AdmissionRequestModel', 'request');


        $mywards = $this->getMywards();
        $count = 0;
        foreach ($mywards as $val) {


            $list = $this->request->getAdmissionRequestCount($val->wardNo);

            foreach ($list as $value) {
                $count = $count + 1;
            }
        }

        return $count;
    }

    public function AdmissionRequestView() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount() + $this->getAdmissionRequestCount());


        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);


        //load transfer list
        $this->load->model('/inward/AdmissionRequestModel', 'request');
        $mywards = $this->getMywards();
        $resultarray = array();
        foreach ($mywards as $val) {

            $list = $this->request->getAdmissionRequestCount($val->wardNo);
            $resultarray = array_merge($resultarray, $list);
        }
        $data['requestAdmit'] = $resultarray;


        //load doctor data
        $this->load->model('/user/EmployeeModel', 'EModel');
        //$doctype = "Doctor";
        //$data['doctor'] = $this->EModel->getAll_Employees_ByType($doctype);      
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['designature'] = $this->admission->getDoctorDesignature();

        $this->load->model('/inward/transfer/InternalTrasferModel', 'internaltransfer');
        $transview = $this->request->getSelectAdmissionReq($this->input->post('auto_id'));
        $data['transview'] = $transview;

        foreach ($transview as $value) {
            $transferWard = $value->transfer_ward->wardNo;
        }
        $data['beds'] = $this->getFreeBeds($transferWard);

        $this->load->view('inward/transferAdmission/request', $data);
        $this->load->view('inward/transferAdmission/AdmissionRequestView', $data);
        $this->load->view('layout/footer1');
    }

    public function WardRequestAdmission() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        //update ward_bed table for admission
        $this->load->model('/inward/admin/bedModel', 'bedModel');
        $bed = $this->bedModel->geBedByWardNoAndBedNo($this->input->post('wardNo'), $this->input->post('bedNo'));

        foreach ($bed as $value) {
            $bed_id = $value->bedID;
            $bed_no = $value->bedNo;
            $bed_type = $value->bedType;
            $ward_no = $value->wardNo->wardNo;
            $availble = $value->availability;
        }

        if ($availble == 'free') {

            $admitteddatetime = new DateTime($this->input->post('admitDateTime'));
            $currentYear = $admitteddatetime->format("Y");
            $currentMonth = $admitteddatetime->format("m");
            $currentDate = $admitteddatetime->format("d");


            //get yearly,monthlyndaily number according to theadmitted date
            $YearlyNo = 1;
            $dailyNo = 1;
            $monthlyNo = 1;
            $wardAdmission = $this->getAllWardAdmissions();

            foreach ($wardAdmission as $value) {
                if (!empty($value)) {
                    //&& ($currentYear==date("Y", $value->admitDateTime/1000))
                    if (($YearlyNo <= $value->yearlyNo)) {
                        $YearlyNo = $value->yearlyNo;
                        $year = date("Y", $value->admitDateTime / 1000);
                    }


                    if (($monthlyNo <= $value->monthlyNo)) {
                        $monthlyNo = $value->monthlyNo;
                        $month = date("m", $value->admitDateTime / 1000);
                    }

                    if (($dailyNo <= $value->dailyNo)) {

                        $dailyNo = $value->dailyNo;
                        $date = date("d", $value->admitDateTime / 1000);
                    }
                }
            }


            //get Next Yealy No
            if ($currentYear == $year) {
                $YearlyNo = $YearlyNo + 1;
            }
            //get Next Monthly No
            if ($currentMonth == $month) {
                $monthlyNo = $monthlyNo + 1;
            }
            //get Next Daily No
            if ($currentDate == $date) {
                $dailyNo = $dailyNo + 1;
            }


            //Get BHT no
            $NowYear = date('Y');
            $bht = $NowYear . $YearlyNo;


            //set time zone for sri lanka
            date_default_timezone_set("Asia/Colombo");

            $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
            $this->admission->setBhtNo($bht);
            $this->admission->setPatientID($this->input->post('patientID'));
            $this->admission->setBedNo($this->input->post('bedNo'));
            $this->admission->setWardNo($this->input->post('wardNo'));
            $this->admission->setDailyNo($dailyNo);
            $this->admission->setMonthlyNo($monthlyNo);
            $this->admission->setYearlyNo($YearlyNo);
            $this->admission->setDoctorID($this->input->post('DoctorID'));
            $this->admission->setAdmitDateTime($this->input->post('admitDateTime'));
            $this->admission->setPatientComplain($this->input->post('patientComplain'));
            $this->admission->setPreviousHistory($this->input->post('previousHistory'));
            $this->admission->setCreatedUser($_SESSION['user']);
            $this->admission->setCreatedDateTime(date('Y-m-d\TH:i'));
            $this->admission->setLastUpdatedUser($_SESSION['user']);
            $this->admission->setLastUpdatedDateTime(date('Y-m-d\TH:i'));
            $ss = $this->admission->insertwardAdmission($this->input->post('request_unit'));
            

            $this->load->model('/inward/admin/bedModel', 'bedModel');
            $this->bedModel->setBedID($bed_id);
            $this->bedModel->setBedNo($bed_no);
            $this->bedModel->setBedType($bed_type);
            $this->bedModel->setWardNo($ward_no);
            $this->bedModel->setAvailability($bht);
            $this->bedModel->setPatientID($this->input->post('patientID'));
            $s = $this->bedModel->UpdateBed();

           $this->load->model('/inward/AdmissionRequestModel', 'request');
           $this->request->setAuto_id($this->input->post('autoid'));
            $this->request->setLast_update_user($_SESSION['user']);
             $this->request->setLast_update_date_time(date('Y-m-d\TH:i'));
              $this->request->setBht_no($bht);
           
           $j = $this->request->UpdateAdmissionRequest();

//riderect page

            if ($ss == 'true') {
                $data['mywards'] = $this->getMywards();
                $data['count'] = ($this->getInternalTransferCount() + $this->getAdmissionRequestCount());
                $this->load->view('layout/headerInward', $data);

                $this->load->model('/inward/transfer/InternalTrasferModel', 'internaltransfer');
                $mywards = $this->getMywards();
                $resultarray = array();
                foreach ($mywards as $val) {

                    $list = $this->internaltransfer->getInternalTransferByWard($val->wardNo);
                    $resultarray = array_merge($resultarray, $list);
                }
                $data['transfer'] = $resultarray;

                $this->load->view('inward/transferAdmission/admissionSucess');
                $this->load->view('inward/transferAdmission/tansferAdmission', $data);
                $this->load->view('layout/footerInward');
            } else {
                $data['mywards'] = $this->getMywards();
                $data['count'] = $this->getInternalTransferCount();
                
                //$this->load->view('layout/headerInward', $data);
                
                $this->load->view('layout/header1', $data);
                $this->load->view('layout/navigation1', $data);

                $this->load->model('/inward/transfer/InternalTrasferModel', 'internaltransfer');
                $mywards = $this->getMywards();
                $resultarray = array();
                foreach ($mywards as $val) {

                    $list = $this->internaltransfer->getInternalTransferByWard($val->wardNo);
                    $resultarray = array_merge($resultarray, $list);
                }
                $data['transfer'] = $resultarray;

                $this->load->view('inward/transferAdmission/admissionNotSucess');
                $this->load->view('inward/transferAdmission/tansferAdmission', $data);
                //$this->load->view('layout/footerInward');
                $this->load->view('layout/footer1');
            }
        }
    }
    
    public function getInternalTransferByBHTNo($bhtNo) {

        $this->load->model('/inward/transfer/InternalTrasferModel', 'internaltransfer');
        return ($this->internaltransfer->getInternalTransferByBHTNo($bhtNo));
    }

}

?>
