<?php
session_start();

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of prescribe_controller
 *
 * @author Mushi
 */
class Prescribe_Controller extends CI_Controller {
    
    
    var $_url = SERVICE_BASE_URL;
    //put your code here
    function Prescribe_Controller()
    {
       
        parent::__construct();
        $this->load->model('Drug_model');
        $this -> view_data['base_url'] = base_url();
    }
    
    function index()
    {
        $data['val']="abc";
        $this->load->library('curl');
        $_resultFromService = $this->curl->simple_get($this->_url.'PharmacyServices/drugStockTable');
        $persons = json_decode($_resultFromService, true);
        $data['drugsStock']=$persons;
        /*$this->load->view('drug_dispense',$data);*/
        $this->load->library('template');
            $this->template->title('Drug Dispense');
            $this->template
              ->set_layout('pharmacist') 
              ->build('drug_dispense',$data);

        
    }
    
    public function updateStatus(){
       
        $pres_id = $this->input->post('pres_id');
     
        $result = $this->Drug_model->updateStatus($pres_id);
        echo $result;
    }
            
    function load_prescription()
    {
        $this->load->library('curl');
        $pid = $this -> input -> post('pid');
        
        if($pid == NULL)
        {
            $this->load->view('enter_pid');
        }
        else{
        $results = $this->curl->simple_get($this->_url.'DrugServices/getPres/'.$pid);
        
        if($results == 'error')
        {
            $this->index();
            print "<script type=\"text/javascript\">alert('There are no Prescription for this Patient');</script>";
        }
        else {
		//Decode the JSON Object 
        $results1 = json_decode($results);
        $pidArr = (array) $results1->{'pidObject'};
        $dnameArr = (array) $results1->{'dnameObject'};
        $dosArr = (array) $results1->{'dosObject'};
        $freqArr = (array) $results1->{'freqObject'};
        $qtyArr = (array) $results1->{'qtyObject'};
        $count = count($pidArr);
        
        
        $this->load->library('table');
        $tmpl = array ( 'table_open'  => '<table id="test" class="table" style="background-color:lightblue;" border="1" cellpadding="2" cellspacing="0" class="mytable">', 
                         'heading_row_start'   => '<tr style="background-color:blue;color:white;">',
                         'heading_row_end'     => '</tr>',
                         'heading_cell_start'  => '<th>',
                         'heading_cell_end'    => '</th>',
                         'row_start'           => '<tr>',
                         'row_end'             => '</tr>',
                         'cell_start'          => '<td>',
                         'cell_end'            => '</td>',
                         'table_close'         => '</table>');

	$this->table->set_template($tmpl);
        $this->table->set_heading('PID', 'Drug Name', 'Dosage','Frequency','Quantity');
        $i=0;
        $k=1;
        for($j=0; $j<$count; $j++)
        {
        	//assign the attributes of the JSON objects to variables
                        $pid = $pidArr['pid'.$i];
  			$dname = $dnameArr['dname'.$i];
  			$dos = $dosArr['dos'.$i];
  			$freq = $freqArr['freq'.$i];
  			$qty = $qtyArr['qty'.$i];
                        
                        $new['dname'.$k]= $dname;
                        $new['qty'.$k] = $qty;
  			
  			//Put the variabls in a Key-Value Array
  			$this->table->add_row($pid, $dname, $dos, $freq, $qty);
        	
        	$i++;
        }
        
        $this->load->library('calendar');
        
        $new['new'] = $this->table->generate();
        $new['new1'] = $this->calendar->generate();
        $this->load->view('viewPrescription',$new);
        }
        }
    }
    
    public function getPrescriptionList()
    {
        
	$input= $this->input->post('id');
        //working up to this
	
	$this->load->library('curl');
	$url_path = $this->_url."Prescription/getPrescriptionsByPatientID/".$input;

	$res = $this->curl->simple_get($url_path);
 
	$result = json_encode(json_decode($res));
	echo $result;
	  

    }

    public function drugDispense()
    {
         $input= $this->input->post('id');
         $inputNew = json_decode($input);
         $_curlPostData = array(
            "dispense" => $inputNew,
            "userid" => $_SESSION["user"]
        );
		$data_string = json_encode($_curlPostData); 
               
        $ch = curl_init($this->_url.'DrugServices/dispenseDrug');                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data_string))                                                                       
        );                                                                                                                   
 
        $result = curl_exec($ch);
        echo $result;
    }
    
    public function drugDispense_new()
    {
         $json_string= $this->input->post('id');
         $userid = $_SESSION['user'];
         $input = json_decode($json_string);
         
         $item_array = $input->dispenseList;        
        
         
         for($i=0; $i<count($item_array);$i++){
             //remove quntity
             //pharm_asst_stock 
             //DSrNo //qty
             $result = $this->Drug_model->getQty($item_array[$i]->DSrNo);
             $OldQty = $result->drugQty;
             if($OldQty > $item_array[$i]->qty){
                 $NewQty = $OldQty - $item_array[$i]->qty;
                 //update pharm_asst_stock 
                 $this->Drug_model->updateAsTbl($item_array[$i]->DSrNo, $userid, $NewQty);
                 
                 //update status
                  $this->Drug_model->updateStatus($input->PrescriptionId);
                  echo 'success';
             } else {
                 echo 'error';
             }
         }
         
         
		                                                                       
         //echo $input;
      
    }
    
    public function test(){
        $str = '{"PrescriptionId":7,"dispenseList":[{"qty":10,"DSrNo":11,"user":"chinthaka"}]} ';
        $input = json_decode($str);
          $userid = $_SESSION['user'];
         $item_array = $input->dispenseList;        
        
         
         for($i=0; $i<count($item_array);$i++){
             //remove quntity
             //pharm_asst_stock 
             //DSrNo //qty
             $result = $this->Drug_model->getQty($item_array[$i]->DSrNo);
             $OldQty = $result->drugQty;
             //echo $OldQty;
             if($OldQty > $item_array[$i]->qty){
                 $NewQty = $OldQty - $item_array[$i]->qty;
                 //echo $NewQty;
                 //update pharm_asst_stock
                 //echo $item_array[$i]->DSrNo.$userid;
                 $this->Drug_model->updateAsTbl($item_array[$i]->DSrNo, $userid, $NewQty);
                 
                 //update status
                  $this->Drug_model->updateStatus($input->PrescriptionId);
             }
         }
              
    }
    
}

?>
