package core.classes.opd;

import java.util.Date;

import core.classes.api.user.AdminUser;
import core.classes.api.user.AdminUser;

/**
 * Allergy class contains all the attributes and there getters and setters.
 * @author Prabhath  
 *
 */
public class Allergy {

	private String allergyName;
	private String allergyStatus;
	private String allergyRemarks;
	private Date allergyCreateDate;
	private AdminUser allergyCreateUser;
	private Date allergyLastUpdate;
	private AdminUser allergyLastUpdateUser;
	private int allergyActive;
	private OutPatient patient;
	private int allergyID;
 
	/***
	 * Get Allergy Name
	 * @return A String Value
	 */
	public String getAllergyName() {
		return allergyName;
	}
	
	/***
	 * Set Allergy Name
	 * @param allergyName
	 */
	public void setAllergyName(String allergyName) {
		this.allergyName = allergyName;
	}
	
	/***
	 * Get Allergy Status
	 * @return A String Value
	 */
	public String getAllergyStatus() {
		return allergyStatus;
	}
	
	/***
	 * Set Allergy Status
	 * @param allergyStatus A String Value
	 */
	public void setAllergyStatus(String allergyStatus) {
		this.allergyStatus = allergyStatus;
	}
	
	/***
	 * Get Allergy Remarks
	 * @return A String Value
	 */
	public String getAllergyRemarks() {
		return allergyRemarks;
	}
	
	/***
	 * Set Allergy Remarks
	 * @param allergyRemarks a String Value
	 */
	public void setAllergyRemarks(String allergyRemarks) {
		this.allergyRemarks = allergyRemarks;
	}
	
	public Date getAllergyCreateDate() {
		return allergyCreateDate;
	}
	public void setAllergyCreateDate(Date allergyCreateDate) {
		this.allergyCreateDate = allergyCreateDate;
	}
	public AdminUser getAllergyCreateUser() {
		return allergyCreateUser;
	}
	public void setAllergyCreateUser(AdminUser allergyCreateUser) {
		this.allergyCreateUser = allergyCreateUser;
	}
	public Date getAllergyLastUpdate() {
		return allergyLastUpdate;
	}
	public void setAllergyLastUpdate(Date allergyLastUpdate) {
		this.allergyLastUpdate = allergyLastUpdate;
	}
	public AdminUser getAllergyLastUpdateUser() {
		return allergyLastUpdateUser;
	}
	public void setAllergyLastUpdateUser(AdminUser allergyLastUpdateUser) {
		this.allergyLastUpdateUser = allergyLastUpdateUser;
	}
	public int getAllergyActive() {
		return allergyActive;
	}
	public void setAllergyActive(int allergyActive) {
		this.allergyActive = allergyActive;
	}
	public OutPatient getPatient() {
		return patient;
	}
	public void setPatient(OutPatient patient) {
		this.patient = patient;
	}
	public int getAllergyID() {
		return allergyID;
	}
	public void setAllergyID(int allergyID) {
		this.allergyID = allergyID;
	}
	

}
