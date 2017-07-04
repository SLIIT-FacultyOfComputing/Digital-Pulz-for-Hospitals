<?php

session_start();

class wardManageC extends CI_Controller {

    function __construct() {

        parent:: __construct();
        $this->load->helper(array('url'));
        $this->view_data['base_url'] = base_url();
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


        $this->load->view('inward/admin/newWard');
        $data['Wards'] = $this->getAllWard();
        $this->load->view('inward/admin/wardManage', $data);
        $this->load->view('layout/footer1');
    }

    public function AddWardview() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
        
        //$this->load->view('layout/headerInward', $data);
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);
        

        $this->load->view('inward/admin/newWard');
        
        $this->load->view('inward/admin/addWard');
        $data['Wards'] = $this->getAllWard();
        $this->load->view('inward/admin/wardManage', $data);
        $this->load->view('layout/footer1');
    }

    public function RemoveWard() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }

        $this->load->model('/inward/admin/wardModel', 'wardModel');
        $this->wardModel->set_wardNo($this->input->post('wardNo'));
        $data['ss'] = $this->wardModel->deleteWard();

        //redirect('inward/wardManageC/index');
        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
        //$this->load->view('layout/headerInward', $data);

        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);

        $this->load->view('inward/admin/deleteSucess');
        $this->load->view('inward/admin/newWard');
        $data['Wards'] = $this->getAllWard();
        $this->load->view('inward/admin/wardManage', $data);
        $this->load->view('layout/footer1');
    }

    public function UpdateWardView() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
        
        //$this->load->view('layout/headerInward', $data);

        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);

        $wardlist = $this->getWardByWardNo($this->input->post('wardNo'));
        $data['wards'] = $wardlist;
        $this->load->view('inward/admin/updateWard', $data);
        $this->load->view('inward/admin/newWard');
        $data['Wards'] = $this->getAllWard();
        $this->load->view('inward/admin/wardManage', $data);
        $this->load->view('layout/footer1');
    }

    public function UpdateWardDetails() {

        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        $this->wardModel->set_wardNo($this->input->post('wardNo'));
        $this->wardModel->set_category($this->input->post('category'));
        $this->wardModel->set_wardGender($this->input->post('wardGender'));
        //$this->wardModel->set_noOfBed($this->input->post('noOfBed'));
        $ss = $this->wardModel->UpdateWard();


        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
        

        //$this->load->view('layout/headerInward', $data);
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);

        $data['Wards'] = $this->getAllWard();
        $this->load->view('inward/admin/updateSucess');
        $this->load->view('inward/admin/newWard');
        $this->load->view('inward/admin/wardManage', $data);
        $this->load->view('layout/footer1');
        //redirect('inward/wardManageC/index');
    }

    public function inserWardDetails() {

        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        $this->wardModel->set_wardNo($this->input->post('wardNo'));
        $this->wardModel->set_category($this->input->post('category'));
        $this->wardModel->set_wardGender($this->input->post('wardGender'));
        //$this->wardModel->set_noOfBed($this->input->post('noOfBed'));
        $ss = $this->wardModel->insertWard();
        //redirect('inward/wardManageC/index');


        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
       
        //$this->load->view('layout/headerInward', $data);
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);

        $data['Wards'] = $this->getAllWard();
        if ($ss == 'true') {
            $this->load->view('inward/admin/addSucess');
        } else {
            $this->load->view('inward/admin/addNotSucess');
        }
        $this->load->view('inward/admin/newWard');




        $this->load->view('inward/admin/wardManage', $data);
        $this->load->view('layout/footer1');
    }

    public function getAllWard() {
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        $list = $this->wardModel->getAllWards();
        return $list;
    }

    public function getWardByWardNo($wardNo) {
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        $wardObj = $this->wardModel->getWardByWardNo($wardNo);
        return $wardObj;
    }

    public function wardView() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['mywards'] = $this->getMywards();
        $data['count'] =($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
        //$this->load->view('layout/headerInward', $data);

        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);

        $wardlist = $this->getWardByWardNo($this->input->post('wardNo'));
        $data['wards'] = $wardlist;

        $data['beds'] = $this->getAllBedByWardNo($this->input->post('wardNo'));
        //$this->load->view('inward/admin/wardViewDetails',$data);
        $this->load->view('inward/admin/wardView', $data);
        $this->load->view('layout/footer1');
    }

    public function Ward() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $wardNo = $this->input->post('wardNo');
        $bedType = "Normal";
        $availabe = "free";
        $count = 1;
        $bedlist = $this->getAllBedByWardNo($wardNo);

        foreach ($bedlist as $value) {
            $count = $count + 1;
        }
        $this->load->model('/inward/admin/bedModel', 'bedModel');
        $this->bedModel->setBedNo($count);
        $this->bedModel->setBedType($bedType);
        $this->bedModel->setWardNo($wardNo);
        $this->bedModel->setAvailability($availabe);
        $ss = $this->bedModel->insertBed();
        $this->wardView();
    }

    public function getAllBedByWardNo($wardNo) {
        $this->load->model('/inward/admin/bedModel', 'bedModel');
        $list = $this->bedModel->getAllBedByWardNo($wardNo);
        return $list;
    }

    public function RemoveBed() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }

        $this->load->model('/inward/admin/bedModel', 'bedModel');
        $this->bedModel->setBedID($this->input->post('bedID'));
        $ss = $this->bedModel->deleteBed();

        // $this->wardView();
        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
        //$this->load->view('layout/headerInward', $data);
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);
        
        $this->load->view('inward/admin/deleteSucess');
        $wardlist = $this->getWardByWardNo($this->input->post('wardNo'));
        $data['wards'] = $wardlist;

        $data['beds'] = $this->getAllBedByWardNo($this->input->post('wardNo'));
        // $this->load->view('inward/admin/wardViewDetails',$data);
        $this->load->view('inward/admin/wardView', $data);
        $this->load->view('layout/footerInward');
    }

    public function UpdateBedView() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
        
        //$this->load->view('layout/headerInward', $data);
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);

        $wardlist = $this->getWardByWardNo($this->input->post('wardNo'));
        $data['wards'] = $wardlist;
        $data['beds'] = $this->getAllBedByWardNo($this->input->post('wardNo'));
        $data['bedID'] = $this->input->post('bedID');
        $data['bedNo'] = $this->input->post('bedNo');
        $data['bedType'] = $this->input->post('bedType');
        $data['wardNo'] = $this->input->post('wardNo');
        $data['availability'] = $this->input->post('availability');
        $data['patientID'] = $this->input->post('patientID');


        //$this->load->view('inward/admin/wardViewDetails',$data);
        $this->load->view('inward/admin/updateBed', $data);
        $this->load->view('inward/admin/wardView', $data);
        $this->load->view('layout/footer1');
    }

    public function UpdateBedDetails() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $this->load->model('/inward/admin/bedModel', 'bedModel');
        $this->bedModel->setBedID($this->input->post('bedID'));
        $this->bedModel->setBedNo($this->input->post('bedNo'));
        $this->bedModel->setBedType($this->input->post('bedType'));
        $this->bedModel->setWardNo($this->input->post('wardNo'));
        $this->bedModel->setAvailability($this->input->post('availability'));
        $this->bedModel->setPatientID($this->input->post('patientID'));
        $ss = $this->bedModel->UpdateBed();

        //$this->wardView();
        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
        
        //$this->load->view('layout/headerInward', $data);
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);

        $this->load->view('inward/admin/updateSucess');
        $wardlist = $this->getWardByWardNo($this->input->post('wardNo'));
        $data['wards'] = $wardlist;

        $data['beds'] = $this->getAllBedByWardNo($this->input->post('wardNo'));
        //$this->load->view('inward/admin/wardViewDetails',$data);
        $this->load->view('inward/admin/wardView', $data);
        $this->load->view('layout/footer1');
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
