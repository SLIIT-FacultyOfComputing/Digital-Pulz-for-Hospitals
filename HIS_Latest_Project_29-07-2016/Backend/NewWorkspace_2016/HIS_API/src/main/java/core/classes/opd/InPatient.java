/**
 * 
 */
package core.classes.opd;

import java.util.Date;

/**
 * @author  
 * 
 */
public class InPatient extends Patient {

	private String pContactPerson;
	private Date pdeathDate;
	private String pWard;

	public InPatient() {
	}

	public void setContactPerson(String contactPerson) {
		this.pContactPerson = contactPerson;
	}

	public String getContactPerson() {
		return this.pContactPerson;
	}

	public void setDeathDate(Date deathDate) {
		this.pdeathDate = deathDate;
	}

	public Date getDeathDate() {
		return this.pdeathDate;
	}

	public void setWard(String ward) {
		this.pWard = ward;
	}

	public String getWard() {
		return this.pWard;
	}
}
