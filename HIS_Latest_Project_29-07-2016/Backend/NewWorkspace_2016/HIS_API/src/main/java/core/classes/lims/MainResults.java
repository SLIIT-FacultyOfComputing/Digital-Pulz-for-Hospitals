package core.classes.lims;

import java.util.Date;
import java.util.HashSet;
import java.util.Set;

public class MainResults {

	private int result_ID;
	private String mainResult;
	private LabTestRequest fTestRequest_ID;
	private ParentTestFields fParentF_ID;
	
	private Date result_FinalizedDate;
	
	private Set<SubFieldResults> labSubfieldresultses = new HashSet<SubFieldResults>();
	
	

	
	
	public int getResult_ID() {
		return result_ID;
	}

	public void setResult_ID(int result_ID) {
		this.result_ID = result_ID;
	}

	public String getMainResult() {
		return mainResult;
	}

	public void setMainResult(String mainResult) {
		this.mainResult = mainResult;
	}

	public LabTestRequest getfTestRequest_ID() {
		return fTestRequest_ID;
	}

	public void setfTestRequest_ID(LabTestRequest fTestRequest_ID) {
		this.fTestRequest_ID = fTestRequest_ID;
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

	public Set<SubFieldResults> getLabSubfieldresultses() {
		return labSubfieldresultses;
	}

	public void setLabSubfieldresultses(Set<SubFieldResults> labSubfieldresultses) {
		this.labSubfieldresultses = labSubfieldresultses;
	}

	
}
