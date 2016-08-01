package core.classes.inward.admin;

import core.classes.inward.WardAdmission.Inpatient;



public class Bed {
	
	private int bedID;
	private int bedNo;
	private String bedType;
	private Ward wardNo;
	private String availability;
	private Inpatient patientID;
	
	public Bed(){}

	
	
	/**
	 * @return the bedID
	 */
	public int getBedID() {
		return bedID;
	}



	/**
	 * @param bedID the bedID to set
	 */
	public void setBedID(int bedID) {
		this.bedID = bedID;
	}



	/**
	 * @return the bedNo
	 */
	public int getBedNo() {
		return bedNo;
	}

	/**
	 * @param bedNo the bedNo to set
	 */
	public void setBedNo(int bedNo) {
		this.bedNo = bedNo;
	}

	/**
	 * @return the bedType
	 */
	public String getBedType() {
		return bedType;
	}

	/**
	 * @param bedType the bedType to set
	 */
	public void setBedType(String bedType) {
		this.bedType = bedType;
	}



	/**
	 * @return the wardNo
	 */
	public Ward getWardNo() {
		return wardNo;
	}



	/**
	 * @param wardNo the wardNo to set
	 */
	public void setWardNo(Ward wardNo) {
		this.wardNo = wardNo;
	}





	public String getAvailability() {
		return availability;
	}



	public void setAvailability(String availability) {
		this.availability = availability;
	}



	/**
	 * @return the patientID
	 */
	public Inpatient getPatientID() {
		return patientID;
	}



	/**
	 * @param patientID the patientID to set
	 */
	public void setPatientID(Inpatient patientID) {
		this.patientID = patientID;
	}

	
	
}
