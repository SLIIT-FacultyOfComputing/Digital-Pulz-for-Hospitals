package core.classes.lims;

import java.util.Date;
import java.util.HashSet;
import java.util.Set;

import core.classes.api.user.AdminUser;

public class Laboratories {
	
	private int lab_ID;
	private String lab_Name;
	private LabTypes flabType_ID;
	private String lab_Incharge;
	private String location;
	private LabDepartments flabDept_ID;
	private Integer lab_Dept_Count;
	private String email;
	private String contactNumber1;
	private String contactNumber2;
	private AdminUser flab_AddedUserID;
	private AdminUser flabLast_UpdatedUserID;
	private Date lab_AddedDate;
	private Date lab_LastUpdatedDate;
	
	
	private Set<LabTestRequest>  labtestrequests = new HashSet<LabTestRequest>();
	
	public int getLab_ID() {
		return lab_ID;
	}
	public void setLab_ID(int lab_ID) {
		this.lab_ID = lab_ID;
	}
	public String getLab_Name() {
		return lab_Name;
	}
	public void setLab_Name(String lab_Name) {
		this.lab_Name = lab_Name;
	}
	public LabTypes getFlabType_ID() {
		return flabType_ID;
	}
	public void setFlabType_ID(LabTypes flabType_ID) {
		this.flabType_ID = flabType_ID;
	}
	public String getLab_Incharge() {
		return lab_Incharge;
	}
	public void setLab_Incharge(String lab_Incharge) {
		this.lab_Incharge = lab_Incharge;
	}
	public String getLocation() {
		return location;
	}
	public void setLocation(String location) {
		this.location = location;
	}
	public LabDepartments getFlabDept_ID() {
		return flabDept_ID;
	}
	public void setFlabDept_ID(LabDepartments flabDept_ID) {
		this.flabDept_ID = flabDept_ID;
	}
	public Integer getLab_Dept_Count() {
		return lab_Dept_Count;
	}
	public void setLab_Dept_Count(Integer lab_Dept_Count) {
		this.lab_Dept_Count = lab_Dept_Count;
	}
	
	public String getEmail() {
		return email;
	}
	public void setEmail(String email) {
		this.email = email;
	}
	public AdminUser getFlab_AddedUserID() {
		return flab_AddedUserID;
	}
	public void setFlab_AddedUserID(AdminUser flab_AddedUserID) {
		this.flab_AddedUserID = flab_AddedUserID;
	}
	public AdminUser getFlabLast_UpdatedUserID() {
		return flabLast_UpdatedUserID;
	}
	public void setFlabLast_UpdatedUserID(AdminUser flabLast_UpdatedUserID) {
		this.flabLast_UpdatedUserID = flabLast_UpdatedUserID;
	}
	public Date getLab_AddedDate() {
		return lab_AddedDate;
	}
	public void setLab_AddedDate(Date lab_AddedDate) {
		this.lab_AddedDate = lab_AddedDate;
	}
	public Date getLab_LastUpdatedDate() {
		return lab_LastUpdatedDate;
	}
	public void setLab_LastUpdatedDate(Date lab_LastUpdatedDate) {
		this.lab_LastUpdatedDate = lab_LastUpdatedDate;
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
	public Set<LabTestRequest> getLabtestrequests() {
		return labtestrequests;
	}
	public void setLabtestrequests(Set<LabTestRequest> labtestrequests) {
		this.labtestrequests = labtestrequests;
	}
	

}
