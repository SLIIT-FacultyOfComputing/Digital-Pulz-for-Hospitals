package core.classes.lims;

import core.classes.inward.WardAdmission.Admission;



public class InwardLabTestRequest extends LabTestRequest {
	
	private int inwardlabtestrequest_ID;
	private Admission BHT; 
	
	

	public Admission getBHT() {
		return BHT;
	}
	public void setBHT(Admission bHT) {
		BHT = bHT;
	}
	public int getInwardlabtestrequest_ID() {
		return inwardlabtestrequest_ID;
	}
	public void setInwardlabtestrequest_ID(int inwardlabtestrequest_ID) {
		this.inwardlabtestrequest_ID = inwardlabtestrequest_ID;
	}
	
	

}
