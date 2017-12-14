package core.classes.opd;

import java.util.HashSet;
import java.util.Set;

import core.classes.BaseEntity;

public class OpdTreatment extends BaseEntity implements java.io.Serializable  {
	
	private int opdTreatmentId;
	private Visit visitId;
	private String status;
	private String remarks;
	private Boolean active;
	private Treatment treatments;
	
	public int getOpdTreatmentId() {
		return opdTreatmentId;
	}
	public void setOpdTreatmentId(int opdTreatmentId) {
		this.opdTreatmentId = opdTreatmentId;
	}
	public Visit getVisitId() {
		return visitId;
	}
	public void setVisitId(Visit visitId) {
		this.visitId = visitId;
	}
	public String getStatus() {
		return status;
	}
	public void setStatus(String status) {
		this.status = status;
	}
	public String getRemarks() {
		return remarks;
	}
	public void setRemarks(String remarks) {
		this.remarks = remarks;
	}
	public Boolean getActive() {
		return active;
	}
	public void setActive(Boolean active) {
		this.active = active;
	}
	public Treatment getTreatments() {
		return treatments;
	}
	public void setTreatments(Treatment treatments) {
		this.treatments = treatments;
	}



	
	

}
