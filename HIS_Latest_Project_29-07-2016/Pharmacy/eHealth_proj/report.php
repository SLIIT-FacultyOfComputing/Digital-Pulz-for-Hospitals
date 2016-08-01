<?php

class Report extends CI_Controller
{

	function Report()
	{
		parent::__construct();
		$this->load->helper('url');
	}
	
	
	function index() 
	{	
		//$this->db_table();
		$this->drugReport();
	}
	
	/*function db_table()
	{
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		
		prep_pdf(); // creates the footer for the document we are creating.

		$query = $this->db->query("Select d_name, d_type, d_qty, d_dosage, d_frequency from mst_Drugs");
		
		foreach ($query->result() as $row)
		{
  			 //echo $row->title;
  			 //$db_data[] = $row;
  			 //echo $row;
  			 $dname = $row -> d_name;
  			 $dtype = $row -> d_type;
  			 $dqty = $row -> d_qty;
  			 $ddos = $row -> d_dosage;
  			 $dfreq = $row -> d_frequency;
  			 
  			 $db_data[] = array('dname' => $dname, 'type' => $dtype, 'qty' => $dqty, 'dos' => $ddos, 'freq' => $dfreq);


		}
		
		//$db_data[] = array('name' => 'Jon Doe', 'phone' => '111-222-3333', 'email' => 'jdoe@someplace.com', 'address' => 'abcdef, ghijk', 'job' => 'Software Engineer');
		
		
		//echo $db_data[0];	
		
		$col_names = array(
			'dname' => 'Drug Name',
			'type' => 'Drug Type',
			'qty' => 'Quantity',
			'dos' => 'Dosage',
			'freq' => 'Frequency'
			);
		
		$this->cezpdf->ezTable($db_data, $col_names, 'Drug Details', array('width'=>550));
		$this->cezpdf->ezStream();

	}*/
	
	function drugReport()
	{
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		
		prep_pdf();
	
		//Getting the contents of the GetDrug Servlet
        $results = file_get_contents("http://localhost:8084/eHealth_new/GetDrug");
        
		//Decode the JSON Object 
        $results1 = json_decode($results);
        
        //Cast the std Objects which are in the returned JSON Object to arrays
        $nameArr = (array) $results1->{'nameObject'};
        $typeArr = (array) $results1->{'typeObject'};
        $qtyArr = (array) $results1->{'qtyObject'};
        $dosArr = (array) $results1->{'dosObject'};
        $freqArr = (array) $results1->{'freqObject'};
        
        //Get the number of elements in the array
        $count = count($nameArr);
        
        //print_r($new);
        $i=1;
        for($j=0; $j<$count; $j++)
        {
        	//assign the attributes of the JSON objects to variables
        	$dname = $nameArr['drug'.$i];
  			$dtype = $typeArr['type'.$i];
  			$dqty = $qtyArr['qty'.$i];
  			$ddos = $dosArr['dos'.$i];
  			$dfreq = $freqArr['freq'.$i];
  			
  			//Put the variabls in a Key-Value Array
  			$db_data[] = array('dname' => $dname, 'type' => $dtype, 'qty' => $dqty, 'dos' => $ddos, 'freq' => $dfreq);

        	
        	$i++;
        }
        
        //Initialize an Array for Column headers in the Drug Report
        $col_names = array(
			'dname' => 'Drug Name',
			'type' => 'Drug Type',
			'qty' => 'Quantity',
			'dos' => 'Dosage',
			'freq' => 'Frequency'
			);
		
			
		$this->cezpdf->ezTable($db_data, $col_names, 'Drug Details', array('width'=>550));
		$this->cezpdf->ezStream();

        
        //foreach($new as $val)
        //{
        //	echo $val;
        //}
        //echo json_encode(($results1);
        //$name = array($results1->{'nameObject'});
        //$name_new = $name[0];
        //print_r($name_new);
        //echo $results1->{'nameObject'}->{'drug2'};
        //echo $name->{'drug2'};
        //$new = $results1;
                
        
	}

}

?>