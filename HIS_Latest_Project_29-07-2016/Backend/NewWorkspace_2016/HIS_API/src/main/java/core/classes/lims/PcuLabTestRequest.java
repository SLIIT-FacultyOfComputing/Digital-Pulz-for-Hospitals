package core.classes.lims;


import core.classes.pcu.PcuAdmition;



public class PcuLabTestRequest extends LabTestRequest {
	
	private int pcu_lab_test_request_id;
	private PcuAdmition admintionID;
	
	
	
	public int getPcu_lab_test_request_id() {
		return pcu_lab_test_request_id;
	}
	public void setPcu_lab_test_request_id(int pcu_lab_test_request_id) {
		this.pcu_lab_test_request_id = pcu_lab_test_request_id;
	}
	public PcuAdmition getAdmintionID() {
		return admintionID;
	}
	public void setAdmintionID(PcuAdmition admintionID) {
		this.admintionID = admintionID;
	} 
	
	

	
	

}
