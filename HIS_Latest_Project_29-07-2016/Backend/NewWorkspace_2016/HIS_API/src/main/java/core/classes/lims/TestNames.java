package core.classes.lims;

import java.util.Date;
import java.util.HashSet;
import java.util.Set;

import core.classes.api.user.AdminUser;

public class TestNames {

	private int test_ID;
	private String test_IDName;
	private String test_Name;
	private Date test_CreatedDate;
	private Date test_LastUpdate;
	private Category fTest_CategoryID;
	private SubCategory fTest_Sub_CategoryID;
	private AdminUser fTest_CreateUserID;
	private AdminUser fTest_LastUpdateUserID;
	
	private Set<ParentTestFields> Parenttestfieldses = new HashSet<ParentTestFields>();
	private Set<LabTestRequest> Labtestrequests = new HashSet<LabTestRequest>();
	
	public Set<ParentTestFields> getParenttestfieldses() {
		return Parenttestfieldses;
	}

	public void setParenttestfieldses(Set<ParentTestFields> parenttestfieldses) {
		Parenttestfieldses = parenttestfieldses;
	}

	public int getTest_ID() {
		return test_ID;
	}

	public void setTest_ID(int test_ID) {
		this.test_ID = test_ID;
	}

	public String getTest_IDName() {
		return test_IDName;
	}

	public void setTest_IDName(String test_IDName) {
		this.test_IDName = test_IDName;
	}

	public String getTest_Name() {
		return test_Name;
	}

	public void setTest_Name(String test_Name) {
		this.test_Name = test_Name;
	}

	public Date getTest_CreatedDate() {
		return test_CreatedDate;
	}

	public void setTest_CreatedDate(Date test_CreatedDate) {
		this.test_CreatedDate = test_CreatedDate;
	}

	public Date getTest_LastUpdate() {
		return test_LastUpdate;
	}

	public void setTest_LastUpdate(Date test_LastUpdate) {
		this.test_LastUpdate = test_LastUpdate;
	}

	public Category getfTest_CategoryID() {
		return fTest_CategoryID;
	}

	public void setfTest_CategoryID(Category fTest_CategoryID) {
		this.fTest_CategoryID = fTest_CategoryID;
	}

	public SubCategory getfTest_Sub_CategoryID() {
		return fTest_Sub_CategoryID;
	}

	public void setfTest_Sub_CategoryID(SubCategory fTest_Sub_CategoryID) {
		this.fTest_Sub_CategoryID = fTest_Sub_CategoryID;
	}

	public AdminUser getfTest_CreateUserID() {
		return fTest_CreateUserID;
	}

	public void setfTest_CreateUserID(AdminUser fTest_CreateUserID) {
		this.fTest_CreateUserID = fTest_CreateUserID;
	}

	public AdminUser getfTest_LastUpdateUserID() {
		return fTest_LastUpdateUserID;
	}

	public void setfTest_LastUpdateUserID(AdminUser fTest_LastUpdateUserID) {
		this.fTest_LastUpdateUserID = fTest_LastUpdateUserID;
	}

	public Set<LabTestRequest> getLabtestrequests() {
		return Labtestrequests;
	}

	public void setLabtestrequests(Set<LabTestRequest> labtestrequests) {
		Labtestrequests = labtestrequests;
	}
	
}
