package core.classes.opd;

import java.util.Date;

import core.classes.api.user.AdminUser;

/***
 * Attachments class contains all the attributes and there getters and setters.
 * @author MIYURU
 *
 */
public class Attachments {


	private int attachID;
	private String attachType;
	private AdminUser attachedBy;
	private String attachDescription;
	private String attachComment;
	private String attachName;
	private String attachLink;
	private Date attachCreateDate;
	private AdminUser attachCreateUser;
	private AdminUser attachLastUpdateUser;
	private Date attachLastUpdate;
	private int attachActive;
	private OutPatient patient;
	
	
	public int getAttachID() {
		return attachID;
	}
	public void setAttachID(int attachID) {
		this.attachID = attachID;
	}
	public String getAttachType() {
		return attachType;
	}
	public void setAttachType(String attachType) {
		this.attachType = attachType;
	}
	public AdminUser getAttachedBy() {
		return attachedBy;
	}
	public void setAttachedBy(AdminUser attachedBy) {
		this.attachedBy = attachedBy;
	}
	public String getAttachDescription() {
		return attachDescription;
	}
	public void setAttachDescription(String attachDescription) {
		this.attachDescription = attachDescription;
	}
	public String getAttachComment() {
		return attachComment;
	}
	public void setAttachComment(String attachComment) {
		this.attachComment = attachComment;
	}
	public String getAttachName() {
		return attachName;
	}
	public void setAttachName(String attachName) {
		this.attachName = attachName;
	}
	public String getAttachLink() {
		return attachLink;
	}
	public void setAttachLink(String attachLink) {
		this.attachLink = attachLink;
	}
	public Date getAttachCreateDate() {
		return attachCreateDate;
	}
	public void setAttachCreateDate(Date attachCreateDate) {
		this.attachCreateDate = attachCreateDate;
	}
	public AdminUser getAttachCreateUser() {
		return attachCreateUser;
	}
	public void setAttachCreateUser(AdminUser attachCreateUser) {
		this.attachCreateUser = attachCreateUser;
	}
	public AdminUser getAttachLastUpdateUser() {
		return attachLastUpdateUser;
	}
	public void setAttachLastUpdateUser(AdminUser attachLastUpdateUser) {
		this.attachLastUpdateUser = attachLastUpdateUser;
	}
	public Date getAttachLastUpdate() {
		return attachLastUpdate;
	}
	public void setAttachLastUpdate(Date attachLastUpdate) {
		this.attachLastUpdate = attachLastUpdate;
	}
	public int getAttachActive() {
		return attachActive;
	}
	public void setAttachActive(int attachActive) {
		this.attachActive = attachActive;
	}
	public OutPatient getPatient() {
		return patient;
	}
	public void setPatient(OutPatient patient) {
		this.patient = patient;
	}

 

}
