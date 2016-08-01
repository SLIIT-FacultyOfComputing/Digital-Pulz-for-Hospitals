package core.classes.opd;

import java.util.Date;
import java.util.HashSet;
import java.util.Set;

/***
 * Prescription class contains all the attributes and there getters and setters.
 * @author MIYURU
 *
 */
public class Prescription {
 
	private int prescriptionID;
	private Date prescriptionDate;
	private int prescriptionPrescribedBy;
	private int prescriptionStatus;
	private Date prescriptionCreateDate;
	private int prescriptionCreateUser;
	private Date prescriptionLastUpdate;
	private int prescriptionLastUpdateUser;
	private Visit visit;
	
	public Set<PrescribeItem> prescribeItems=new HashSet<PrescribeItem>();
	  
	public int getPrescriptionID() {
		return prescriptionID;
	}

	public void setPrescriptionID(int prescriptionID) {
		this.prescriptionID = prescriptionID;
	}

	public Date getPrescriptionDate() {
		return prescriptionDate;
	}

	public void setPrescriptionDate(Date prescriptionDate) {
		this.prescriptionDate = prescriptionDate;
	}

	public int getPrescriptionPrescribedBy() {
		return prescriptionPrescribedBy;
	}

	public void setPrescriptionPrescribedBy(int prescriptionPrescribedBy) {
		this.prescriptionPrescribedBy = prescriptionPrescribedBy;
	}

	public int getPrescriptionStatus() {
		return prescriptionStatus;
	}

	public void setPrescriptionStatus(int prescriptionStatus) {
		this.prescriptionStatus = prescriptionStatus;
	}

	public Date getPrescriptionCreateDate() {
		return prescriptionCreateDate;
	}

	public void setPrescriptionCreateDate(Date prescriptionCreateDate) {
		this.prescriptionCreateDate = prescriptionCreateDate;
	}

	public int getPrescriptionCreateUser() {
		return prescriptionCreateUser;
	}

	public void setPrescriptionCreateUser(int prescriptionCreateUser) {
		this.prescriptionCreateUser = prescriptionCreateUser;
	}

	public Date getPrescriptionLastUpdate() {
		return prescriptionLastUpdate;
	}

	public void setPrescriptionLastUpdate(Date prescriptionLastUpdate) {
		this.prescriptionLastUpdate = prescriptionLastUpdate;
	}

	public int getPrescriptionLastUpdateUser() {
		return prescriptionLastUpdateUser;
	}

	public void setPrescriptionLastUpdateUser(int prescriptionLastUpdateUser) {
		this.prescriptionLastUpdateUser = prescriptionLastUpdateUser;
	}

	public Visit getVisit() {
		return visit;
	}

	public void setVisit(Visit visit) {
		this.visit = visit;
	}

	public Set<PrescribeItem> getPrescribeItems() {
		return prescribeItems;
	}

	public void setPrescribeItems(Set<PrescribeItem> prescribeItems) {
		this.prescribeItems = prescribeItems;
	}



}