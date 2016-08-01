package core.classes.lims;


import core.classes.opd.Visit;



public class OPDLabTestRequest extends LabTestRequest {
	
	private int opdLabtestrequest_ID;
	private Visit visitID;
	
	public int getOpdLabtestrequest_ID() {
		return opdLabtestrequest_ID;
	}
	public void setOpdLabtestrequest_ID(int opdLabtestrequest_ID) {
		this.opdLabtestrequest_ID = opdLabtestrequest_ID;
	}
	public Visit getVisitID() {
		return visitID;
	}
	public void setVisitID(Visit visitID) {
		this.visitID = visitID;
	} 
	
	

	
	
	

}
