package core.classes.lims;

import java.util.Date;

public class SubFieldResults {
	
	private int subFieldResult_ID;
	private String subFieldResult;
	private MainResults fMResultID;
	private SubTestFields fSubF_ID;
	private ParentTestFields fParentF_ID;
	private Date result_FinalizedDate;
	
	public MainResults getfMResultID() {
		return fMResultID;
	}

	public void setfMResultID(MainResults fMResultID) {
		this.fMResultID = fMResultID;
	}

	
	
	public int getSubFieldResult_ID() {
		return subFieldResult_ID;
	}

	public void setSubFieldResult_ID(int subFieldResult_ID) {
		this.subFieldResult_ID = subFieldResult_ID;
	}

	public String getSubFieldResult() {
		return subFieldResult;
	}

	public void setSubFieldResult(String subFieldResult) {
		this.subFieldResult = subFieldResult;
	}

	public SubTestFields getfSubF_ID() {
		return fSubF_ID;
	}

	public void setfSubF_ID(SubTestFields fSubF_ID) {
		this.fSubF_ID = fSubF_ID;
	}

	public ParentTestFields getfParentF_ID() {
		return fParentF_ID;
	}

	public void setfParentF_ID(ParentTestFields fParentF_ID) {
		this.fParentF_ID = fParentF_ID;
	}

	public Date getResult_FinalizedDate() {
		return result_FinalizedDate;
	}

	public void setResult_FinalizedDate(Date result_FinalizedDate) {
		this.result_FinalizedDate = result_FinalizedDate;
	}

	

}
