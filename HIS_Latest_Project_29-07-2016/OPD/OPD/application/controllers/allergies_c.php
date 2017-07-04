<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<?php
session_start();

class allergies_c extends CI_Controller {

    var $_site_base_url = SITE_BASE_URL;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
    }

    public function view() {
        
    }

    public function add($pid, $visitid, $status = '0') {

        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect($this->_site_base_url);
            }
        } else {
            redirect($this->_site_base_url);
        }


        $data['status'] = $status;

        $data['pid'] = $pid;
        $data['visitid'] = $visitid;
        $data['title'] = 'Add Allergy';

        $this->load->view('Components/headerInward', $data);

        // loading left side navigation
        $data['leftnavpage'] = '';
        $this->load->view('Components/left_navbar', $data);
        //************************************************************************************
        // show patient profile mini
        $this->load->model('PatientModel', 'patient');
        $this->patient->set_pid($pid);
      //  $data['allergyList']=  json_decode($this->patient->getAlleryList());
        $data['pprofile'] = json_decode($this->patient->getPatient());
        //$this->load->view('patient_profile_mini_v', $data);
        //****************************************************************************
        $data['allergyList']=  json_decode($this->patient->getAlleryList());
        $this->load->view('allergy_m_v', $data);

       /* $this->load->library('template');
                $this->template->title('Add Allergy');
                $this->template
                ->set_layout('panellayout')
                ->build('allergy_m_v',$data);*/
        $this->load->view('Components/bottom');
    }

    public function edit($pid, $alid, $status = '0') {
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect($this->_site_base_url);
            }
        } else {
            redirect($this->_site_base_url);
        }
        $data['status'] = $status;

        $data['pid'] = $pid;
        $data['alid'] = $alid;

        $data['visitid'] = '0';
        $data['title'] = 'Edit Allergy';

        $this->load->view('headerInward', $data);

        // loading left side navigation
        $data['leftnavpage'] = '';
        $this->load->view('left_navbar_v', $data);
        //************************************************************************************
        // show patient profile mini
        $this->load->model('PatientModel', 'patient');
        $this->patient->set_pid($pid);
        $data['pprofile'] = json_decode($this->patient->getPatient());
        $this->load->view('patient_profile_mini_v', $data);
        //****************************************************************************
        // load data for the selected allergy
        $this->load->model('AllergyModel', 'allergy');
        $this->allergy->set_allergyid($alid);
        $data['allergy'] = json_decode($this->allergy->getAllergy());
        //****************************************************************************				

        $this->load->library('template');
                $this->template->title('Add Allergy');
                $this->template
                ->set_layout('panellayout')
                ->build('visit_m_v',$data);

        $this->load->view('allergy_m_v', $data);

        $this->load->view('bottom');
    }

    public function save($pid, $visitid) {
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect($this->_site_base_url);
            }
        } else {
            redirect($this->_site_base_url);
        }
        $this->load->model('AllergyModel', 'allergy');
        $this->allergy->set_pid($pid);
        $this->allergy->set_name($this->input->post('alname'));
        $this->allergy->set_status($this->input->post('status'));
        $this->allergy->set_remarks($this->input->post('remarks'));
        $this->allergy->set_userid($this->session->userdata('userid'));
        $this->allergy->set_active(1);
        $this->allergy->set_visitid($visitid);

        $data['status'] = $this->allergy->addAllergy();
        $this->add($pid, $visitid, $data['status']);
    }

    public function update($pid, $alid) {
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect($this->_site_base_url);
            }
        } else {
            redirect($this->_site_base_url);
        }
        $this->load->model('AllergyModel', 'allergy');

        $this->allergy->set_allergyid($alid);
        $this->allergy->set_name($this->input->post('alname'));
        $this->allergy->set_status($this->input->post('status'));
        $this->allergy->set_remarks($this->input->post('remarks'));
        $this->allergy->set_userid($this->session->userdata('userid'));
        $this->allergy->set_active($this->input->post('active'));

        $data['status'] = $this->allergy->updateAllergy();

        $this->edit($pid, $alid, $data['status']);
    }

    function getAllergyList() {

        $this->load->library('curl');
        $_resultFromService = $this->curl->simple_get('http://localhost:8080/HIS_API/rest/LiveSearch/allergyLivesearch');
        $_resultsAfterDecode = json_decode($_resultFromService, true);
        echo json_encode($_resultsAfterDecode);
    }

}
?>