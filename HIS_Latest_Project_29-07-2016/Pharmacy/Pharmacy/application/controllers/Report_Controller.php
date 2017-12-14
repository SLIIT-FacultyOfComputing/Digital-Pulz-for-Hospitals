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

class Report_Controller extends CI_Controller
{

    //var $_url = "http://10.0.0.1:8080/HIS_API";
    var $_url = SERVICE_BASE_URL;
	function Report_Controller()
	{
		parent::__construct();
                if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }
                
		$this->load->helper('url');

	}
	
	
	function index() 
	{
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }
        
        $this->load->library('template');
        $this->template->title('Patients');
        $this->template
                ->set_layout('panelpatientlayout') 
                ->build('report_view');        
        //$this->load->view('report_view');
		//$this->db_table();
		//$this->drugReport();
            
	}
	
	function drugReport()
	{
            if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
                $this->load->library('curl');
                
		prep_pdf();
                $results = $this->curl->simple_get($this->_url.'DrugServices/getDrug');
               
		//Getting the contents of the GetDrug Servlet
//        $results = file_get_contents("http://localhost:8084/eHealth_new/GetDrug");
//        
		//Decode the JSON Object
                if($results == 'error')
                {

                    echo '<script type="text/javascript">'; 
                    echo 'alert("No drugs to be expired within 90 days!");
                    window.location.href="'.CLIENT_BASE_URL.'index.php/Report_Controller"'; 
                    echo '</script>';    

                    //echo'<script language = "javascript">';
                    //echo 'alert("Test Message")';
                    //echo 'window.location.href=''';
                   // echo '</script>';
                   // redirect(CLIENT_BASE_URL.'index.php/Report_Controller');
                    //$this->load->view('report_view');
                }
                else {
                        $results1 = json_decode($results);

                        //Cast the std Objects which are in the returned JSON Object to arrays
                        $nameArr = (array) $results1->{'nameObject'};
                        $srNoArr = (array) $results1->{'srNoObject'};
                        $bqtyArr = (array) $results1->{'bqtyObject'};
                        $bNoArr = (array) $results1->{'bNoObject'};
                        $manDArr = (array) $results1->{'manDObject'};
                        $expDArr = (array) $results1->{'expDObject'};

                        //Get the number of elements in the array
                        $count = count($nameArr);

                        //print_r($new);
                        $i=1;
                        for($j=0; $j<$count; $j++)
                        {
                                //assign the attributes of the JSON objects to variables
                                        $dname = $nameArr['drug'.$i];
                                        $srNo = $srNoArr['srNo'.$i];
                                        $bqty = $bqtyArr['bqty'.$i];
                                        $bNo = $bNoArr['bNo'.$i];
                                        $manD = $manDArr['manD'.$i];
                                        $expD = $expDArr['expD'.$i];

                                        //Put the variabls in a Key-Value Array
                                        $db_data[] = array('srNo' => $srNo,'dname' => $dname, 'bNo' => $bNo, 'bqty' => $bqty, 'manD' => $manD, 'expD' => $expD);


                                $i++;
                        }

                        //Initialize an Array for Column headers in the Drug Report
                        $col_names = array(
                                        'srNo' => 'Drug Sr_No',
                                        'dname' => 'Drug Name',
                                        'bNo' => 'Batch No',
                                        'bqty' => 'Quantity',
                                        'manD' => 'Manufactured Date',
                                        'expD' => 'Expiry Date'
                                        );

                                       // print_r($db_data);	
                                $this->cezpdf->ezTable($db_data, $col_names, 'Drugs to be Expired within 90 days', array('width'=>550));
                                $this->cezpdf->ezStream();
                                 
            }
        
	}
        
        function sss() {

            if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }
            
        if ($this->input->post('edituser_submit') == true) {
            $data = $this->input->post('selectedmethod');


            $username = $data;

            $this->load->library('curl');
            $results = $this->curl->simple_get($this->_url.'DrugServices/getUserDetails/' . $username);
            //$results = file_get_contents("http://localhost:8084/eHealth_new/GetDrugCategory");
            $results1 = json_decode($results);
            $cat['new'] = (array) $results1;
            $count = count($cat['new']);

            $seasons = array();
            $i = 1;
            for ($j = 0; $j < $count; $j++) {
                //assign the attributes of the JSON objects to variables
                $dcat = $cat['new']['urd' . $i];
                //Put the variabls in a Key-Value Array
                //print_r($dcat . "\n");

                $seasons[] = $dcat;
                // $usernameArr = $dcat;
                $db_data[$dcat] = $dcat;
                $i++;
            }

           
            $data1 = array(
                '1' => $seasons[0],
                '2' => $seasons[1],
                '3' => $seasons[2],
                '4' => $seasons[3],
                '5' => $seasons[4],
                '6' => $seasons[5],
                '7' => $seasons[6]
            );
            $this->session->set_userdata($data1);
            $this->load->view('editUser');
            
        }
    }

    function report() {
        
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }
        
        //$this->load->view('/layout/header_pharmacy');

        $this->load->library('template');
            $this->template->title('Report');
            $this->template
                 ->set_layout('panelpatientlayout') 
                 ->build('drugReport');
        
        //$this->load->view('drugReport');
        //$this->load->view('opd_Demo');
        
    }
    
    function drugReportNew() {
        
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }
        
        $this->load->library('curl');
        $results = $this->curl->simple_get($this->_url.'DrugServices/drugreport');
        //$results = file_get_contents("http://localhost:8084/eHealth_new/GetDrugCategory");
        $results1 = json_decode($results);
        $cat['new'] = (array) $results1;
        $count = count($cat['new']);

        $seasons = array();
        $i = 1;
        for ($j = 0; $j < $count; $j++) {
            //assign the attributes of the JSON objects to variables
            $dcat = $cat['new']['rot' . $i];
            //Put the variabls in a Key-Value Array
            //	print_r($dcat."\n");

            $seasons[] = $dcat; // $usernameArr = $dcat;
            $db_data[$dcat] = $dcat;
            $i++;
        }

        //$report .= $seasons[1] . "\r\n";
        //$report .= $seasons[2] . "\r\n";
        //$report .= $seasons[3] . "\r\n";
        //$report .= $seasons[4] . "\r\n";

        return $seasons;
        // include_once 'dompdf\dompdf_config.inc.php';
        // $dompdf = new DOMPDF();
        // $dompdf->load_html($report);
        // $dompdf->render();
        // $dompdf->stream('Sanple.pdf');
        //   echo '<script type=\'text/javascript\'>';
        //   echo 'alert("' . $results . '");';
        //   echo '</script>';
    }

    function report_pdfA() {

        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }
        
        $this->load->view('report_pdfA');
    }
    function report_pdfB() {

        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }
        
        $this->load->view('report_pdfB');
    }
    
    function requestMailDrug() {
        
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }
        
        //$this->load->view('layout/header_pharmacy');
        //$this->load->view('drugRequestEmail');
        $this->load->library('template');
        $this->template->title('Mail');
        $this->template
                ->set_layout('panelpatientlayout') 
                ->build('drugRequestEmail');
    }

    function sendRequestMail() {
        
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }
        
         $id = $_POST['id'];
         $from = $_POST['from'];
         $to = $_POST['to'];
         $subject = $_POST['subject'];
         $content = $_POST['cont'];

        $this->mailMethod($to, $from, $subject, $content);

         $druId = urlencode($id);
         $cont = urlencode($content);

//        $this->load->library('curl');
//        $results = $this->curl->simple_get($this->_url.'/rest/DrugServices/insertMail/' . $druId . '/' . $cont);
        
     //   if (strcmp($this->session->userdata('userRoleName'),"Chief Pharmacist") == 0){

            $_serviceUrl = $this->_url."DrugServices/insertMail";
            //$_serviceUrl = "http://env-9821234.jelastic.servint.net/pharmacy/rest/DrugServices/updateDrug";
            $_curl = curl_init($_serviceUrl);

            $_curlPostData = array(
              "drugid"    => $id,
              "content" => $content
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
       // } else {
              //  echo "fail";
      //  }
        
        $this->report();
    }

    function mailMethod($to, $from, $subject, $text) {
        
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }
        
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => '465',
            'smtp_user' => 'ehealthpharmacy111@gmail.com',
            'smtp_pass' => 'pharmacy123',
            'mailtype' => 'text'
        );

        // recipient, sender, subject, and you message
        $to = $to;
        $from = $from;
        $subject = $subject;
        $message = $text;

        // load the email library that provided by CI
        $this->load->library('email', $config);
        // this will bind your attributes to email library
        $this->email->set_newline("\r\n");
        $this->email->from($from, 'Your Company');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        // send your email. if it produce an error it will print 'Fail to send your message!' for you
        if ($this->email->send()) {
            echo '<script type=\'text/javascript\'>';
            echo 'alert(" Message sent successfully ");';
            echo '</script>';
        } else {
            echo $this->email->print_debugger();
            echo '<script type=\'text/javascript\'>';
            echo 'alert("Fail to send your message!");';
            echo '</script>';
        }
    }

    function getMailHistory(){

        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }

        $this->load->library('curl');
        $results = $this->curl->simple_get($this->_url.'DrugServices/getMailHistory');
        $results1 = json_decode($results);
        return $results1;

}


}

?>
