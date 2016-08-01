package core.classes.clinic;
import java.util.Date;

import core.classes.api.user.AdminUser;

public class clinic_schedule {
	
	private int schedule_id;
	private clinic_visit clinic_visit_id;
	private int mobile_no;
	private Date clinic_datetime;
	private AdminUser create_user;
	
	
	public int getSchedule_id() {
		return schedule_id;
	}
	public void setSchedule_id(int schedule_id) {
		this.schedule_id = schedule_id;
	}
	public clinic_visit getClinic_visit_id() {
		return clinic_visit_id;
	}
	public void setClinic_visit_id(clinic_visit clinic_visit_id) {
		this.clinic_visit_id = clinic_visit_id;
	}
	public int getMobile_no() {
		return mobile_no;
	}
	public void setMobile_no(int mobile_no) {
		this.mobile_no = mobile_no;
	}
	public Date getClinic_datetime() {
		return clinic_datetime;
	}
	public void setClinic_datetime(Date clinic_datetime) {
		this.clinic_datetime = clinic_datetime;
	}
	public AdminUser getCreate_user() {
		return create_user;
	}
	public void setCreate_user(AdminUser create_user) {
		this.create_user = create_user;
	}
	
	
	
}
