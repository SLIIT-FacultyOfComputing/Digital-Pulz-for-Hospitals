package core.classes.clinic;
import java.util.Date;

import core.classes.api.user.AdminUser;
import core.classes.opd.Patient;

public class clinic_visit {
	
	private String clinic_visit_id;
	private Patient patient;
	private Date clinic_visit_date;
	private String clinic_visit_type;
	private AdminUser  clinic_visit_createuser;
	
	
	public String getClinic_visit_id() {
		return clinic_visit_id;
	}
	public void setClinic_visit_id(String clinic_visit_id) {
		this.clinic_visit_id = clinic_visit_id;
	}
	public Patient getPatient() {
		return patient;
	}
	public void setPatient(Patient patient) {
		this.patient = patient;
	}
	public Date getClinic_visit_date() {
		return clinic_visit_date;
	}
	public void setClinic_visit_date(Date clinic_visit_date) {
		this.clinic_visit_date = clinic_visit_date;
	}
	public String getClinic_visit_type() {
		return clinic_visit_type;
	}
	public void setClinic_visit_type(String clinic_visit_type) {
		this.clinic_visit_type = clinic_visit_type;
	}
	public AdminUser getClinic_visit_createuser() {
		return clinic_visit_createuser;
	}
	public void setClinic_visit_createuser(AdminUser clinic_visit_createuser) {
		this.clinic_visit_createuser = clinic_visit_createuser;
	}
	
	
}
