package core.classes.clinic;
import java.util.Date;

import core.classes.opd.PrescribeItem;
import core.classes.opd.Prescription;

public class clinic_patient_treatment {
	
	private int treatment_id;
	private clinic_visit clinic_visit_id;	
	private Date clinic_date;
	private Prescription prescriptionItems_ID;
	private String clinic_doc;	
	private String clinic_diagnosis;
	private String clinic_remarks;
	
	
	public int getTreatment_id() {
		return treatment_id;
	}
	public void setTreatment_id(int treatment_id) {
		this.treatment_id = treatment_id;
	}
	public clinic_visit getClinic_visit_id() {
		return clinic_visit_id;
	}
	public void setClinic_visit_id(clinic_visit clinic_visit_id) {
		this.clinic_visit_id = clinic_visit_id;
	}
	public Date getClinic_date() {
		return clinic_date;
	}
	public void setClinic_date(Date clinic_date) {
		this.clinic_date = clinic_date;
	}
	public Prescription getPrescriptionItems_ID() {
		return prescriptionItems_ID;
	}
	public void setPrescriptionItems_ID(Prescription prescriptionItems_ID) {
		this.prescriptionItems_ID = prescriptionItems_ID;
	}
	public String getClinic_doc() {
		return clinic_doc;
	}
	public void setClinic_doc(String clinic_doc) {
		this.clinic_doc = clinic_doc;
	}
	public String getClinic_diagnosis() {
		return clinic_diagnosis;
	}
	public void setClinic_diagnosis(String clinic_diagnosis) {
		this.clinic_diagnosis = clinic_diagnosis;
	}
	public String getClinic_remarks() {
		return clinic_remarks;
	}
	public void setClinic_remarks(String clinic_remarks) {
		this.clinic_remarks = clinic_remarks;
	}
	
	
}
