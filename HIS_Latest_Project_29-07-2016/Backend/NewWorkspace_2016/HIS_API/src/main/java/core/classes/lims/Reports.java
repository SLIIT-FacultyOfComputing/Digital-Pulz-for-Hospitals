package core.classes.lims;

import java.util.Date;
import java.util.HashSet;
import java.util.Set;

import core.classes.opd.OutPatient;
import core.classes.opd.Patient;

public class Reports {
	
	private int report_ID;
	private OutPatient fPatient_ID;
	private LabTestRequest fTestRequest_ID;
	private Date issued_Date;
	
	private Set<MainResults> labMainresultses = new HashSet<MainResults>();
	
	public int getReport_ID() {
		return report_ID;
	}

	public void setReport_ID(int report_ID) {
		this.report_ID = report_ID;
	}


	public Date getIssued_Date() {
		return issued_Date;
	}

	public void setIssued_Date(Date issued_Date) {
		this.issued_Date = issued_Date;
	}

	public Set<MainResults> getLabMainresultses() {
		return labMainresultses;
	}

	public void setLabMainresultses(Set<MainResults> labMainresultses) {
		this.labMainresultses = labMainresultses;
	}
	public LabTestRequest getfTestRequest_ID() {
		return fTestRequest_ID;
	}

	public void setfTestRequest_ID(LabTestRequest fTestRequest_ID) {
		this.fTestRequest_ID = fTestRequest_ID;
	}

	public OutPatient getfPatient_ID() {
		return fPatient_ID;
	}

	public void setfPatient_ID(OutPatient fPatient_ID) {
		this.fPatient_ID = fPatient_ID;
	}

}
