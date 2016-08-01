package core.classes.inward.prescription;

import java.util.Date;

import core.classes.api.user.AdminUser;
import core.classes.inward.WardAdmission.Admission;

public class InwardNurseNote {
	private int note_id;
	private Admission bht_no;	
	private String P_note;
	private AdminUser create_user;
	private Date datetime;
	
	
	public InwardNurseNote() {
	}

	public InwardNurseNote(int note_id, Admission bht_no, String P_note,
			AdminUser create_user, Date datetime) {
		
		this.note_id=note_id;
		this.bht_no=bht_no;
		this.P_note=P_note;
		this.create_user=create_user;
		this.datetime=datetime;
	}
	
	public int getNote_id() {
		return note_id;
	}
	public void setNote_id(int note_id) {
		this.note_id = note_id;
	}
	public Admission getBht_no() {
		return bht_no;
	}
	public void setBht_no(Admission bht_no) {
		this.bht_no = bht_no;
	}
	
	public String getP_note() {
		return P_note;
	}
		
	public void setP_note(String P_note) {
		this.P_note = P_note;
	}
	public AdminUser getCreate_user() {
		return create_user;
	}
	public void setCreate_user(AdminUser create_user) {
		this.create_user = create_user;
	}
	
	public Date getDatetime() {
		return this.datetime;
	}

	public void setDatetime(Date datetime) {
		this.datetime = datetime;
	}
	
	
}
