package core.classes.lims;

import java.util.Date;
import java.util.HashSet;
import java.util.Set;

import core.classes.api.user.AdminUser;
import core.classes.inward.WardAdmission.Inpatient;
import core.classes.opd.OutPatient;
import core.classes.opd.Patient;


public class LabTestRequest {
	private int labTestRequest_ID;
	private TestNames ftest_ID;
	private OutPatient fpatient_ID;
	//private Inpatient fIpatient_ID;
	
	
	private Laboratories flab_ID;
	private String comment;
	private String priority;
	private String status;
	private Date test_RequestDate;
	private Date test_DueDate;
	private AdminUser ftest_RequestPerson;
	//private SampleCenters fsample_CenterID;

	private Set<MainResults> labMainresultses = new HashSet<MainResults>();
	private Set<Specimen> Specimens = new HashSet<Specimen>();
	
	public Set<Specimen> getSpecimens() {
		return Specimens;
	}
	public void setSpecimens(Set<Specimen> specimens) {
		Specimens = specimens;
	}
	public Set<MainResults> getLabMainresultses() {
		return labMainresultses;
	}
	public void setLabMainresultses(Set<MainResults> labMainresultses) {
		this.labMainresultses = labMainresultses;
	}
	public int getLabTestRequest_ID() {
		return labTestRequest_ID;
	}
	public void setLabTestRequest_ID(int labTestRequest_ID) {
		this.labTestRequest_ID = labTestRequest_ID;
	}
	
	public TestNames getFtest_ID() {
		return ftest_ID;
	}
	public void setFtest_ID(TestNames ftest_ID) {
		this.ftest_ID = ftest_ID;
	}


	public OutPatient getFpatient_ID() {
		return fpatient_ID;
	}
	public void setFpatient_ID(OutPatient fpatient_ID) {
		this.fpatient_ID = fpatient_ID;
	}

	
	public String getComment() {
		return comment;
	}
	public void setComment(String comment) {
		this.comment = comment;
	}
	public String getPriority() {
		return priority;
	}
	public void setPriority(String priority) {
		this.priority = priority;
	}
	public String getStatus() {
		return status;
	}
	public void setStatus(String status) {
		this.status = status;
	}
	public Date getTest_RequestDate() {
		return test_RequestDate;
	}
	public void setTest_RequestDate(Date test_RequestDate) {
		this.test_RequestDate = test_RequestDate;
	}
	public Date getTest_DueDate() {
		return test_DueDate;
	}
	public void setTest_DueDate(Date test_DueDate) {
		this.test_DueDate = test_DueDate;
	}
	public AdminUser getFtest_RequestPerson() {
		return ftest_RequestPerson;
	}
	public void setFtest_RequestPerson(AdminUser ftest_RequestPerson) {
		this.ftest_RequestPerson = ftest_RequestPerson;
	}
	
	public Laboratories getFlab_ID() {
		return flab_ID;
	}
	public void setFlab_ID(Laboratories flab_ID) {
		this.flab_ID = flab_ID;
	}
		

}
