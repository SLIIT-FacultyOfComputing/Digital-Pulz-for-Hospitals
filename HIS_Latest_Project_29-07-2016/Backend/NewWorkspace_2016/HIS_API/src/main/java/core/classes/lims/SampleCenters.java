package core.classes.lims;

import java.util.Date;
import java.util.HashSet;
import java.util.Set;

import core.classes.api.user.AdminUser;

public class SampleCenters {
	private int sampleCenter_ID;
	private String sampleCenter_Name;
	private SampleCenterTypes fSampleCenterType_ID;
	private String sampleCenter_Incharge;
	private String location;
	private String email;
	private String contactNumber1;
	private String contactNumber2;
	private AdminUser fSampleCenter_AddedUserID;
	private AdminUser fSampleCenterLast_UpdatedUserID;
	private Date sampleCenter_AddedDate;
	private Date sampleCenter_LastUpdatedDate;
	

	//private Set<LabTestRequest> Labtestrequests = new HashSet<LabTestRequest>();
	
	public int getSampleCenter_ID() {
		return sampleCenter_ID;
	}
	public void setSampleCenter_ID(int sampleCenter_ID) {
		this.sampleCenter_ID = sampleCenter_ID;
	}
	public String getSampleCenter_Name() {
		return sampleCenter_Name;
	}
	public void setSampleCenter_Name(String sampleCenter_Name) {
		this.sampleCenter_Name = sampleCenter_Name;
	}
	public SampleCenterTypes getfSampleCenterType_ID() {
		return fSampleCenterType_ID;
	}
	public void setfSampleCenterType_ID(SampleCenterTypes fSampleCenterType_ID) {
		this.fSampleCenterType_ID = fSampleCenterType_ID;
	}
	public String getSampleCenter_Incharge() {
		return sampleCenter_Incharge;
	}
	public void setSampleCenter_Incharge(String sampleCenter_Incharge) {
		this.sampleCenter_Incharge = sampleCenter_Incharge;
	}
	public String getLocation() {
		return location;
	}
	public void setLocation(String location) {
		this.location = location;
	}
	public String getEmail() {
		return email;
	}
	public void setEmail(String email) {
		this.email = email;
	}
	
	
	public AdminUser getfSampleCenter_AddedUserID() {
		return fSampleCenter_AddedUserID;
	}
	public void setfSampleCenter_AddedUserID(AdminUser fSampleCenter_AddedUserID) {
		this.fSampleCenter_AddedUserID = fSampleCenter_AddedUserID;
	}
	public AdminUser getfSampleCenterLast_UpdatedUserID() {
		return fSampleCenterLast_UpdatedUserID;
	}
	public void setfSampleCenterLast_UpdatedUserID(
			AdminUser fSampleCenterLast_UpdatedUserID) {
		this.fSampleCenterLast_UpdatedUserID = fSampleCenterLast_UpdatedUserID;
	}
	public Date getSampleCenter_AddedDate() {
		return sampleCenter_AddedDate;
	}
	public void setSampleCenter_AddedDate(Date sampleCenter_AddedDate) {
		this.sampleCenter_AddedDate = sampleCenter_AddedDate;
	}
	public Date getSampleCenter_LastUpdatedDate() {
		return sampleCenter_LastUpdatedDate;
	}
	public void setSampleCenter_LastUpdatedDate(Date sampleCenter_LastUpdatedDate) {
		this.sampleCenter_LastUpdatedDate = sampleCenter_LastUpdatedDate;
	}
	public String getContactNumber1() {
		return contactNumber1;
	}
	public void setContactNumber1(String contactNumber1) {
		this.contactNumber1 = contactNumber1;
	}
	public String getContactNumber2() {
		return contactNumber2;
	}
	public void setContactNumber2(String contactNumber2) {
		this.contactNumber2 = contactNumber2;
	}

	



}
