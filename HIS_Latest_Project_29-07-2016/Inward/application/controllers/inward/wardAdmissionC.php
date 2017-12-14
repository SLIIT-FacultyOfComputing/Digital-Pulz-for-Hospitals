<?php

session_start();

class wardAdmissionC extends CI_Controller {

    public function index() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
        
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);
        
        $data['WardAdmissions'] = $this->getAllWardAdmissions();

        //$this->load->view('inward/wardAdmission/newAdmission');

        $this->load->view('inward/wardAdmission/admissionHome', $data);
        $this->load->view('layout/footer1');

       // $this->load->view('layout/a');
    }
     public function getAllWard() {
        $this->load->model('inward/admin/wardModel', 'wardModel');
        $list = $this->wardModel->getAllWards();
        return $list;
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
        //echo $mywards;
        //die();
        foreach ($mywards as $val) {


            $list = $this->internaltransfer->getInternalTransferByWard($val->wardNo);

            foreach ($list as $value) {
                $count = $count + 1;
            }
        }

        return $count;
    }

    public function newAdmission() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);
        $this->load->view('inward/wardAdmission/wardAdmission');
        $this->load->view('layout/footer1');
    }

    public function admissionSearch() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);
        $this->load->view('inward/wardAdmission/newAdmission');
        $data['Ward'] = $this->getWardAdmissionDetails($this->input->post('bhtNo'));
        $this->load->view('inward/wardAdmission/admissionSearch', $data);

        $data['WardAdmissions'] = $this->getAllWardAdmissions();
        $this->load->view('inward/wardAdmission/admissionHome', $data);
        $this->load->view('layout/footer1');
    }

//Patient search view from this
    public function SearchPatientView() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);
        $this->load->view('inward/wardAdmission/wardAdmission');

        $this->load->model('/opd/patientmodel', 'patient');
        
        $this->patient->set_pid(substr($this->input->post('patientID'),4,6));

        $data['patients'] = json_decode($this->patient->getPatient());
        $this->load->view('inward/wardAdmission/patientSearch', $data);

        //load patient admission form
        //set patient ID
        $data['pid'] = $this->input->post('patientID');
        //set ward list
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        $data['Wards'] = $this->wardModel->getAllWards();
        //set doctor

        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['designature'] = $this->admission->getDoctorDesignature();

        //$this->load->model('/user/EmployeeModel', 'EModel');
        //$doctype = "Doctor";
        // $data['doctor'] = $this->EModel->getAll_Employees_ByType($doctype);



        $this->load->view('inward/wardAdmission/patientAdmission', $data);

        $this->load->view('layout/footer1');
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
            $sss = $this->admission->insertwardAdmission("WARD");








            if ($sss != null) {
                $this->load->model('/inward/admin/bedModel', 'bedModel');
                $this->bedModel->setBedID($bed_id);
                $this->bedModel->setBedNo($bed_no);
                $this->bedModel->setBedType($bed_type);
                $this->bedModel->setWardNo($ward_no);
                $this->bedModel->setAvailability($bht);
                $this->bedModel->setPatientID($this->input->post('patientID'));
                $ss = $this->bedModel->UpdateBed();
                redirect('inward/wardAdmissionC/admissionSucessView');
            } else {
                $this->admissionSearch();
                //redirect('inward/wardAdmissionC/SearchPatientView');
            }
        
    }

    public function admissionNotSucess() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
        $this->load->view('layout/headerInward', $data);
        $this->load->view('inward/wardAdmission/admissionNotSucess');
        $this->load->view('inward/wardAdmission/wardAdmission');

        $this->load->model('/opd/PatientModel', 'patient');
        $this->patient->set_pid($this->input->post('patientID'));

        $data['patients'] = json_decode($this->patient->getPatient());
        $this->load->view('inward/wardAdmission/patientSearch', $data);

        //load patient admission form
        //set patient ID
        $data['pid'] = $this->input->post('patientID');
        //set ward list
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        $data['Wards'] = $this->wardModel->getAllWards();
        //set doctor
        $this->load->model('/user/EmployeeModel', 'EModel');
        $doctype = "Doctor";
        $data['doctor'] = $this->EModel->getAll_Employees_ByType($doctype);

        $this->load->view('inward/wardAdmission/patientAdmission', $data);

        $this->load->view('layout/footerInward');
    }

    public function admissionSucessView() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
        $this->load->view('layout/headerInward', $data);
        $this->load->view('inward/wardAdmission/admissionSucess');
        //$this->load->view('inward/wardAdmission/wardAdmission');
        //  $this->load->view('inward/wardAdmission/newAdmission');
        $data['WardAdmissions'] = $this->getAllWardAdmissions();
        $this->load->view('inward/wardAdmission/admissionHome', $data);
        $this->load->view('layout/footerInward');
    }

    public function getAllWardAdmissions() {
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $ss = $this->admission->getAllWardAdmissions();
        return $ss;
    }

    public function getWardAdmissionDetails($bhtNo) {
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $ss = $this->admission->getWardAdmissionDetails($bhtNo);
        return $ss;
    }

    public function getDoctorDesignature() {
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $ss = $this->admission->getDoctorDesignature();
        return $ss;
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

}

?>
