package core.classes.inward.prescription;

import java.util.Date;

import core.classes.api.user.AdminUser;
import core.classes.inward.WardAdmission.Admission;

public class PrescriptionTerms {
	private int term_id;
	private Admission bht_no;
	private int no_of_terms;
	private Date start_date;
	private Date end_date;
	private AdminUser create_user;
	
	public int getTerm_id() {
		return term_id;
	}
	public void setTerm_id(int term_id) {
		this.term_id = term_id;
	}
	public Admission getBht_no() {
		return bht_no;
	}
	public void setBht_no(Admission bht_no) {
		this.bht_no = bht_no;
	}
	public int getNo_of_terms() {
		return no_of_terms;
	}
	public void setNo_of_terms(int no_of_terms) {
		this.no_of_terms = no_of_terms;
	}
	public Date getStart_date() {
		return start_date;
	}
	public void setStart_date(Date start_date) {
		this.start_date = start_date;
	}
	public Date getEnd_date() {
		return end_date;
	}
	public void setEnd_date(Date end_date) {
		this.end_date = end_date;
	}
	public AdminUser getCreate_user() {
		return create_user;
	}
	public void setCreate_user(AdminUser create_user) {
		this.create_user = create_user;
	}
	
	
}
