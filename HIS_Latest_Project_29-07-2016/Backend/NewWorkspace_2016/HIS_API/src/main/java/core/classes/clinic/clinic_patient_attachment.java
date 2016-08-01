package core.classes.clinic;

import java.awt.Image;
import java.sql.Date;

import core.classes.api.user.AdminUser;

public class clinic_patient_attachment {
	
	private String attachment_ID;
	private clinic_visit clinic_visit_ID;
	private String attachment_type;
	private String description;
	private AdminUser create_user;
	private Date create_date;
	
	public String getAttachment_ID() {
		return attachment_ID;
	}
	public void setAttachment_ID(String attachment_ID) {
		this.attachment_ID = attachment_ID;
	}
	public clinic_visit getClinic_visit_ID() {
		return clinic_visit_ID;
	}
	public void setClinic_visit_ID(clinic_visit clinic_visit_ID) {
		this.clinic_visit_ID = clinic_visit_ID;
	}
	public String getAttachment_type() {
		return attachment_type;
	}
	public void setAttachment_type(String attachment_type) {
		this.attachment_type = attachment_type;
	}
	public String getDescription() {
		return description;
	}
	public void setDescription(String description) {
		this.description = description;
	}
	public AdminUser getCreate_user() {
		return create_user;
	}
	public void setCreate_user(AdminUser create_user) {
		this.create_user = create_user;
	}
	public Date getCreate_date() {
		return create_date;
	}
	public void setCreate_date(Date create_date) {
		this.create_date = create_date;
	}
	
	
	
	
	
}
