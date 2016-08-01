package core.classes.clinic;

import java.awt.Image;

import core.classes.opd.Patient;

public class clinic_xray {
	
	private String xray_id;
	private clinic_visit clinic_visit_id ;
	private String clinic_patient_name;
	private String clinic_problem;
	private Image clinic_image;
	private String clinic_remarks;
	
	
	public String getXray_id() {
		return xray_id;
	}
	public void setXray_id(String xray_id) {
		this.xray_id = xray_id;
	}
	public clinic_visit getClinic_visit_id() {
		return clinic_visit_id;
	}
	public void setClinic_visit_id(clinic_visit clinic_visit_id) {
		this.clinic_visit_id = clinic_visit_id;
	}
	public String getClinic_patient_name() {
		return clinic_patient_name;
	}
	public void setClinic_patient_name(String clinic_patient_name) {
		this.clinic_patient_name = clinic_patient_name;
	}
	public String getClinic_problem() {
		return clinic_problem;
	}
	public void setClinic_problem(String clinic_problem) {
		this.clinic_problem = clinic_problem;
	}
	public Image getClinic_image() {
		return clinic_image;
	}
	public void setClinic_image(Image clinic_image) {
		this.clinic_image = clinic_image;
	}
	public String getClinic_remarks() {
		return clinic_remarks;
	}
	public void setClinic_remarks(String clinic_remarks) {
		this.clinic_remarks = clinic_remarks;
	}
	
	
	
}
