<?php
session_start();

class Dispense_Drug_Reports extends CI_Controller {
    
    //var $_url = "http://10.0.0.1:8080/HIS_API";
    var $_url = SERVICE_BASE_URL;
 function Dispense_Drug_Reports()
    {
        parent::__construct();
        $this -> view_data['base_url'] = base_url();
    }
 

    public function index() {
//important      
	  //  $results = file_get_contents("http://localhost:8084/eHealth_new/PrescriptionController?pation=".$_POST['name1']);
	   //$data['val']= json_decode($results, true);
	  // $data['val']=$results; 
        
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }
        
        $this->load->view('layout/header_pharmacy');
        $this->load->view('dispense_reports');
	   

    }
	
	   
	
	
	   public function viewReport()
    {
	$this->load->library('curl');
	//$date = $this -> input -> post('date');
	$date=$_GET['date'];
	 $results = $this->curl->simple_get($this->_url.'DrugServices/getDescriptionListByDate/'.$date);
	 $data['report'] = json_decode($results);
	 $data['date'] = $date;
	 $this->load->view('dipense_report_viewer',$data);
	}
	
	   public function viewReportPdf()
    {
	 $this->load->library('parser');
		  $this->load->helper('file'); 
	       $this->load->helper(array('dompdf', 'file'));
		 $this->load->library('curl');  
   $date=$_GET['date'];
	 $results = $this->curl->simple_get($this->_url.'DrugServices/getDescriptionListByDate/'.$date);
	 $data['report'] = json_decode($results);
	 $data['date'] = $date;
$html = $this->parser->parse('dipense_report_viewer', $data);

     pdf_create($html, 'dipense_report_viewer');
	}
	
	/*public function viewer(){
	// $this->load->view('dipense_report_viewer');
	       $this->load->helper(array('dompdf', 'file'));
     // page info here, db calls, etc.     
     //$html = $this->load->view('dipense_report_viewer');
	 $html =
  '<html><body>'.
  '<p>Put your html here, or generate it with your favourite '.
  'templating system.</p>'.
  '</body></html>';

     pdf_create($html, 'dipense_report_viewer.pdf');
	echo $this->load->view('dipense_report_viewer');
	}*/
	
}
	
	
	





?>
