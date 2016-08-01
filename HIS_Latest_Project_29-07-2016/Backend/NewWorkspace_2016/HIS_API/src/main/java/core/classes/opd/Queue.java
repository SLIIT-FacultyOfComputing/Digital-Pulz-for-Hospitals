package core.classes.opd;

import java.util.Date;

import core.classes.hr.HrEmployee;
import core.classes.api.user.AdminUser;

/***
 * Queue class contains all the attributes and there getters and setters.
 * @author MIYURU
 *
 */ 	
public class Queue {

	private int queueTokenNo;
	private Date queueTokenAssignTime;
	private AdminUser queueAssignedBy;
	private AdminUser queueAssignedTo;
	private String queueStatus;
	private String queueRemarks;
	private OutPatient patient;
	 
	 
	public int getQueueTokenNo() {
		return queueTokenNo;
	}
	public void setQueueTokenNo(int queueTokenNo) {
		this.queueTokenNo = queueTokenNo;
	}
	public Date getQueueTokenAssignTime() {
		return queueTokenAssignTime;
	}
	public void setQueueTokenAssignTime(Date queueTokenAssignTime) {
		this.queueTokenAssignTime = queueTokenAssignTime;
	}
	public AdminUser getQueueAssignedBy() {
		return queueAssignedBy;
	}
	public void setQueueAssignedBy(AdminUser queueAssignedBy) {
		this.queueAssignedBy = queueAssignedBy;
	}
	public AdminUser getQueueAssignedTo() {
		return queueAssignedTo;
	}
	public void setQueueAssignedTo(AdminUser queueAssignedTo) {
		this.queueAssignedTo = queueAssignedTo;
	}
	public String getQueueStatus() {
		return queueStatus;
	}
	public void setQueueStatus(String queueStatus) {
		this.queueStatus = queueStatus;
	}
	public String getQueueRemarks() {
		return queueRemarks;
	}
	public void setQueueRemarks(String queueRemarks) {
		this.queueRemarks = queueRemarks;
	}
	public OutPatient getPatient() {
		return patient;
	}
	public void setPatient(OutPatient patient) {
		this.patient = patient;
	}
	  

}
