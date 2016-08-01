<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Frequency_Controller extends CI_Controller
{
    
    //var $_url = "http://10.0.0.1:8080/HIS_API";
    var $_url = SERVICE_BASE_URL;
    /**
     * Constructer
     *  
     * @category Front_End
     */
    function Frequency_Controller() 
    {
        parent::__construct();
        $this->view_data['base_url'] = base_url();
    }
    /**
     * Send_The_Add_Drug_View
     *  
     * @category Front_End
     * @return view Add_Drug
     */
    function index() 
    {
        if ((strcmp($this->session->userdata('userRoleName'),"Chief Pharmacist") == 0) || (strcmp($this->session->userdata('userRoleName'),"Assistent Pharmacist") == 0))
        {
            $this->load->view('Add_Drug');
            
        } else {
            $this->load->view('Login');
            
        }
    }
    function frequencyMgr(){

        $this->load->library('curl');
        $results = $this->curl->simple_get($this->_url.'DrugServices/getPharmFrequency');
        $this->load->view('frequency');
    }
    function updateFreq() {
        // $this->load->view('frequency');
        $s = $_POST['but'];
        //echo "<br>";
        //echo "<br>";
        //$st = substr($s, 1, 1);
        //echo "<br>";
        $val1 = $_POST['drug_freq_' . $s . ''];
        //echo "<br>";
        $id1 = $_POST['id_' . $s . ''];

        $val = urlencode($val1);
        $id = urlencode($id1);
        //echo $val;
        //echo $id;

//        $this->load->library('curl');
//        $results = $this->curl->simple_get($this->_url.'/rest/DrugServices/updateFrequency/' . $id . '/' . $val);
//
//        header('Location: ' . $_SERVER['HTTP_REFERER']);
        if (strcmp($this->session->userdata('userRoleName'),"Chief Pharmacist") == 0){

            $_serviceUrl = $this->_url."DrugServices/updateFrequency";
            //$_serviceUrl = "http://env-9821234.jelastic.servint.net/pharmacy/rest/DrugServices/updateDrug";
            $_curl = curl_init($_serviceUrl);

            $_curlPostData = array(
              "frequencyId"   => $id1,
              "frequency"    => $val1
            );


            $_dataString = json_encode($_curlPostData);

            curl_setopt($_curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($_curl, CURLOPT_POSTFIELDS, $_dataString);
            curl_setopt($_curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $_curl, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($_dataString))
            );

            $_result = curl_exec($_curl);
            echo $_result;
            echo '<script type=\'text/javascript\'>';
            echo 'alert("Frequency updated successfully!!!");';
            echo '</script>';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
                echo "fail";
        }
    }

    function getFreqFromDb() {
        $this->load->library('curl');
        $results = $this->curl->simple_get($this->_url.'DrugServices/getPharmFrequency');
        $results1 = json_decode($results);
        //return json_encode($results1);
        return $results1;

    }

    function addFrequency(){
      $frequency = $_POST['add_freq_db'];
      
      $frequencyEd = urlencode($frequency);

//      $this->load->library('curl');
//      $results = $this->curl->simple_get($this->_url.'/rest/DrugServices/addFrequency/' . $frequencyEd);
//
//      header('Location: ' . $_SERVER['HTTP_REFERER']);
      if (strcmp($this->session->userdata('userRoleName'),"Chief Pharmacist") == 0){

            $_serviceUrl = $this->_url."DrugServices/addFrequency";
            //$_serviceUrl = "http://env-9821234.jelastic.servint.net/pharmacy/rest/DrugServices/updateDrug";
            $_curl = curl_init($_serviceUrl);

            $_curlPostData = array(
              "frequency"    => $frequency
            );


            $_dataString = json_encode($_curlPostData);

            curl_setopt($_curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($_curl, CURLOPT_POSTFIELDS, $_dataString);
            curl_setopt($_curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $_curl, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($_dataString))
            );

            $_result = curl_exec($_curl);
            echo $_result;
            echo '<script type=\'text/javascript\'>';
            echo 'alert("Frequency Added successfully!!!");';
            echo '</script>';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
                echo "fail";
        }
    }

    function post() {
        // echo "hello000000000000000";

        if (isset($_POST['name']) === TRUE && empty($_POST['name']) === FALSE) {

            echo $nam = $_POST['name'];
        }

        if (isset($_POST['id']) === TRUE && empty($_POST['id']) === FALSE) {

            echo $id = $_POST['id'];
        }
    }

}
?>
