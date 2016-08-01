package core.classes.clinic;
import java.util.Date;

import core.classes.api.user.AdminUser;

public class clinic_patient_queue {
	
	
	private String clinic_queue_token_no;
	private clinic_visit clinic_visit_id;
	private String clinic_visit_type;
	private String clinic_queue_assign_date;
	private AdminUser clinic_queue_assign_by;
	private String clinic_queue_status;
	
	public String getClinic_queue_token_no() {
		return clinic_queue_token_no;
	}
	public void setClinic_queue_token_no(String clinic_queue_token_no) {
		this.clinic_queue_token_no = clinic_queue_token_no;
	}
	public clinic_visit getClinic_visit_id() {
		return clinic_visit_id;
	}
	public void setClinic_visit_id(clinic_visit clinic_visit_id) {
		this.clinic_visit_id = clinic_visit_id;
	}
	public String getClinic_visit_type() {
		return clinic_visit_type;
	}
	public void setClinic_visit_type(String clinic_visit_type) {
		this.clinic_visit_type = clinic_visit_type;
	}
	public String getClinic_queue_assign_date() {
		return clinic_queue_assign_date;
	}
	public void setClinic_queue_assign_date(String clinic_queue_assign_date) {
		this.clinic_queue_assign_date = clinic_queue_assign_date;
	}
	public AdminUser getClinic_queue_assign_by() {
		return clinic_queue_assign_by;
	}
	public void setClinic_queue_assign_by(AdminUser clinic_queue_assign_by) {
		this.clinic_queue_assign_by = clinic_queue_assign_by;
	}
	public String getClinic_queue_status() {
		return clinic_queue_status;
	}
	public void setClinic_queue_status(String clinic_queue_status) {
		this.clinic_queue_status = clinic_queue_status;
	}
	
	
	
}
