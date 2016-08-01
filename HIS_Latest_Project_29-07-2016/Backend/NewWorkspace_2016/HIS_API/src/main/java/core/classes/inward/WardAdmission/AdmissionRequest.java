package core.classes.inward.WardAdmission;

import java.util.Date;

import core.classes.api.user.AdminUser;
import core.classes.inward.admin.Ward;

public class AdmissionRequest {
	
	private int auto_id;
	private Inpatient patient_id;
	private String request_unit;
	private int is_read;
	private Ward transfer_ward;
	private String remark;
	private AdminUser create_user;
	private Date create_date_time;
	private int is_user_doctor;
	private AdminUser last_update_user;
	private Date last_update_date_time;
	private Admission bht_no;
	
	
	public Admission getBht_no() {
		return bht_no;
	}
	public void setBht_no(Admission bht_no) {
		this.bht_no = bht_no;
	}
	public int getAuto_id() {
		return auto_id;
	}
	public void setAuto_id(int auto_id) {
		this.auto_id = auto_id;
	}
	public Inpatient getPatient_id() {
		return patient_id;
	}
	public void setPatient_id(Inpatient patient_id) {
		this.patient_id = patient_id;
	}
	public String getRequest_unit() {
		return request_unit;
	}
	public void setRequest_unit(String request_unit) {
		this.request_unit = request_unit;
	}
	public int getIs_read() {
		return is_read;
	}
	public void setIs_read(int is_read) {
		this.is_read = is_read;
	}
	public Ward getTransfer_ward() {
		return transfer_ward;
	}
	public void setTransfer_ward(Ward transfer_ward) {
		this.transfer_ward = transfer_ward;
	}
	public String getRemark() {
		return remark;
	}
	public void setRemark(String remark) {
		this.remark = remark;
	}
	public AdminUser getCreate_user() {
		return create_user;
	}
	public void setCreate_user(AdminUser create_user) {
		this.create_user = create_user;
	}
	public Date getCreate_date_time() {
		return create_date_time;
	}
	public void setCreate_date_time(Date create_date_time) {
		this.create_date_time = create_date_time;
	}
	public int getIs_user_doctor() {
		return is_user_doctor;
	}
	public void setIs_user_doctor(int is_user_doctor) {
		this.is_user_doctor = is_user_doctor;
	}
	public AdminUser getLast_update_user() {
		return last_update_user;
	}
	public void setLast_update_user(AdminUser last_update_user) {
		this.last_update_user = last_update_user;
	}
	public Date getLast_update_date_time() {
		return last_update_date_time;
	}
	public void setLast_update_date_time(Date last_update_date_time) {
		this.last_update_date_time = last_update_date_time;
	}
	
}
