package core.classes.clinic;

import core.classes.opd.Patient;

public class clinic_patient_history {
	
	
	private String clinic_history_ID;
	private clinic_visit clinic_visit_id;
	private clinic_patient_treatment treatment ;
	
	
	public String getClinic_history_ID() {
		return clinic_history_ID;
	}
	public void setClinic_history_ID(String clinic_history_ID) {
		this.clinic_history_ID = clinic_history_ID;
	}
	public clinic_visit getClinic_visit_id() {
		return clinic_visit_id;
	}
	public void setClinic_visit_id(clinic_visit clinic_visit_id) {
		this.clinic_visit_id = clinic_visit_id;
	}
	public clinic_patient_treatment getTreatment() {
		return treatment;
	}
	public void setTreatment(clinic_patient_treatment treatment) {
		this.treatment = treatment;
	}
	
	
	
	
	
	
	
	
}
