package core.classes.opd;

import java.util.Date;

import core.classes.api.user.AdminUser;

/***
 * Record class contains all the attributes and there getters and setters.
 * @author MIYURU
 *
 */
public class Record {

	private int patientRecordID;
	private OutPatient patient;
	private int recordType;
	private String recordText;
	private String recordVisibility;
	private int recordCompleted;
	private Date recordCreateDate;
	private AdminUser recordCreateUser;
	private Date recordLastUpdate;
	private AdminUser recordLastUpdateUser;
  
	
	public int getPatientRecordID() {
		return patientRecordID;
	}
	public void setPatientRecordID(int patientRecordID) {
		this.patientRecordID = patientRecordID;
	}
	public OutPatient getPatient() {
		return patient;
	}
	public void setPatient(OutPatient patient) {
		this.patient = patient;
	}
	public int getRecordType() {
		return recordType;
	}
	public void setRecordType(int recordType) {
		this.recordType = recordType;
	}
	public String getRecordText() {
		return recordText;
	}
	public void setRecordText(String recordText) {
		this.recordText = recordText;
	}
	public String getRecordVisibility() {
		return recordVisibility;
	}
	public void setRecordVisibility(String recordVisibility) {
		this.recordVisibility = recordVisibility;
	}
	public int getRecordCompleted() {
		return recordCompleted;
	}
	public void setRecordCompleted(int recordCompleted) {
		this.recordCompleted = recordCompleted;
	}
	public Date getRecordCreateDate() {
		return recordCreateDate;
	}
	public void setRecordCreateDate(Date recordCreateDate) {
		this.recordCreateDate = recordCreateDate;
	}
	public AdminUser getRecordCreateUser() {
		return recordCreateUser;
	}
	public void setRecordCreateUser(AdminUser recordCreateUser) {
		this.recordCreateUser = recordCreateUser;
	}
	public Date getRecordLastUpdate() {
		return recordLastUpdate;
	}
	public void setRecordLastUpdate(Date recordLastUpdate) {
		this.recordLastUpdate = recordLastUpdate;
	}
	public AdminUser getRecordLastUpdateUser() {
		return recordLastUpdateUser;
	}
	public void setRecordLastUpdateUser(AdminUser recordLastUpdateUser) {
		this.recordLastUpdateUser = recordLastUpdateUser;
	}
	
}
