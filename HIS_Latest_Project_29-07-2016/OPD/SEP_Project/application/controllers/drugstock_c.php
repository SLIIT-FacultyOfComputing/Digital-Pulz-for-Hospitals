<?php

class drugstock_c  extends CI_Controller{

	public function getstock()
	{
		$this->load->model('prescriptionmodel');
		$data = $this->prescriptionmodel->getDrugStocks();

		echo $data;
	}

}
?>