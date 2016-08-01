package core.classes.inward.treat;

import java.util.Date;

import core.classes.api.user.AdminUser;
import core.classes.inward.WardAdmission.Admission;

public class Diagnose {
      
	private int id;
	private String treat;
	private String image;
	private Admission bht_no;
	private AdminUser create_user;
	private Date create_date_time;
	public int getId() {
		return id;
	}
	public void setId(int id) {
		this.id = id;
	}
	public String getTreat() {
		return treat;
	}
	public void setTreat(String treat) {
		this.treat = treat;
	}
	public String getImage() {
		return image;
	}
	public void setImage(String image) {
		this.image = image;
	}
	public Admission getBht_no() {
		return bht_no;
	}
	public void setBht_no(Admission bht_no) {
		this.bht_no = bht_no;
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
	
	
	
	
}
