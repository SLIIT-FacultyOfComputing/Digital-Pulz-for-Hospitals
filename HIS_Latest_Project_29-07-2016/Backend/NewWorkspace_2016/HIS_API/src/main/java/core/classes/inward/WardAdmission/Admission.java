package core.classes.inward.WardAdmission;

import java.util.Date;
import java.util.HashSet;
import java.util.Set;

import core.classes.api.user.AdminUser;
import core.classes.hr.HrEmployee;
import core.classes.inward.transfer.InternalTransfer;



public class Admission {
	
	private String bhtNo;
	private Inpatient patientID;
	private int bedNo;
	private String wardNo;
	private int dailyNo;
	private int monthlyNo;
	private int yearlyNo;
	private HrEmployee DoctorID;
	private Date admitDateTime;
	private String patientComplain;
	private String previousHistory;	
	private String dischargeType;
	
	private String status;
	private String outcomes;
	
	private String dischargediagnosis;
	private String referredto;
	private String sign;
	
	
	//L=Lama
	//ND=Normal Discharj
	//IT=Internal Transfer
	//ET=External Transfer
	//M=Missing
	//D=Death
	
	private String remark;
	private String admissionUnit;	
	private AdminUser createdUser;
	private Date createdDateTime;
	private AdminUser LastUpdatedUser;
	private Date LastUpdatedDateTime;
	
	private Set<InternalTransfer> internalTransferSet = new HashSet<InternalTransfer>();
	
	
	
	
	public String getDischargeType() {
		return dischargeType;
	}
	public void setDischargeType(String dischargeType) {
		this.dischargeType = dischargeType;
	}
	public String getRemark() {
		return remark;
	}
	public void setRemark(String remark) {
		this.remark = remark;
	}
	public String getAdmissionUnit() {
		return admissionUnit;
	}
	public void setAdmissionUnit(String admissionUnit) {
		this.admissionUnit = admissionUnit;
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
	/**
	 * @return the internalTransferSet
	 */
	public Set<InternalTransfer> getInternalTransferSet() {
		return internalTransferSet;
	}
	/**
	 * @param internalTransferSet the internalTransferSet to set
	 */
	public void setInternalTransferSet(Set<InternalTransfer> internalTransferSet) {
		this.internalTransferSet = internalTransferSet;
	}
	/**
	 * @return the bhtNo
	 */
	public String getBhtNo() {
		return bhtNo;
	}
	/**
	 * @param bhtNo the bhtNo to set
	 */
	public void setBhtNo(String bhtNo) {
		this.bhtNo = bhtNo;
	}
	/**
	 * @return the pID
	 */
	public Inpatient getpatientID() {
		return patientID;
	}
	/**
	 * @param pID the pID to set
	 */
	public void setpatientID(Inpatient patientID) {
		this.patientID = patientID;
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
	 * @return the wardNo
	 */
	public String getWardNo() {
		return wardNo;
	}
	/**
	 * @param wardNo the wardNo to set
	 */
	public void setWardNo(String wardNo) {
		this.wardNo = wardNo;
	}
	/**
	 * @return the dailyNo
	 */
	public int getDailyNo() {
		return dailyNo;
	}
	/**
	 * @param dailyNo the dailyNo to set
	 */
	public void setDailyNo(int dailyNo) {
		this.dailyNo = dailyNo;
	}
	/**
	 * @return the monthlyNo
	 */
	public int getMonthlyNo() {
		return monthlyNo;
	}
	/**
	 * @param monthlyNo the monthlyNo to set
	 */
	public void setMonthlyNo(int monthlyNo) {
		this.monthlyNo = monthlyNo;
	}
	/**
	 * @return the yearlyNo
	 */
	public int getYearlyNo() {
		return yearlyNo;
	}
	/**
	 * @param yearlyNo the yearlyNo to set
	 */
	public void setYearlyNo(int yearlyNo) {
		this.yearlyNo = yearlyNo;
	}
	/**
	 * @return the doctorID
	 */
	public HrEmployee getDoctorID() {
		return DoctorID;
	}
	/**
	 * @param doctorID the doctorID to set
	 */
	public void setDoctorID(HrEmployee doctorID) {
		DoctorID = doctorID;
	}
	/**
	 * @return the admitDateTime
	 */
	public Date getAdmitDateTime() {
		return admitDateTime;
	}
	/**
	 * @param admitDateTime the admitDateTime to set
	 */
	public void setAdmitDateTime(Date admitDateTime) {
		this.admitDateTime = admitDateTime;
	}
	/**
	 * @return the patientComplain
	 */
	public String getPatientComplain() {
		return patientComplain;
	}
	/**
	 * @param patientComplain the patientComplain to set
	 */
	public void setPatientComplain(String patientComplain) {
		this.patientComplain = patientComplain;
	}
	/**
	 * @return the previousHistory
	 */
	public String getPreviousHistory() {
		return previousHistory;
	}
	/**
	 * @param previousHistory the previousHistory to set
	 */
	public void setPreviousHistory(String previousHistory) {
		this.previousHistory = previousHistory;
	}
	/**
	 * @return the createdUser
	 */
	public AdminUser getCreatedUser() {
		return createdUser;
	}
	/**
	 * @param createdUser the createdUser to set
	 */
	public void setCreatedUser(AdminUser createdUser) {
		this.createdUser = createdUser;
	}
	/**
	 * @return the createdDateTime
	 */
	public Date getCreatedDateTime() {
		return createdDateTime;
	}
	/**
	 * @param createdDateTime the createdDateTime to set
	 */
	public void setCreatedDateTime(Date createdDateTime) {
		this.createdDateTime = createdDateTime;
	}
	/**
	 * @return the lastUpdatedUser
	 */
	public AdminUser getLastUpdatedUser() {
		return LastUpdatedUser;
	}
	/**
	 * @param lastUpdatedUser the lastUpdatedUser to set
	 */
	public void setLastUpdatedUser(AdminUser lastUpdatedUser) {
		LastUpdatedUser = lastUpdatedUser;
	}
	/**
	 * @return the lastUpdatedDateTime
	 */
	public Date getLastUpdatedDateTime() {
		return LastUpdatedDateTime;
	}
	/**
	 * @param lastUpdatedDateTime the lastUpdatedDateTime to set
	 */
	public void setLastUpdatedDateTime(Date lastUpdatedDateTime) {
		LastUpdatedDateTime = lastUpdatedDateTime;
	}
	public String getStatus() {
		return status;
	}
	public void setStatus(String status) {
		this.status = status;
	}
	
	
	public String getSign() {
		return sign;
	}
	public void setSign(String sign) {
		this.sign = sign;
	}
	public String getOutcomes() {
		return outcomes;
	}
	public void setOutcomes(String outcomes) {
		this.outcomes = outcomes;
	}
	public String getDischargediagnosis() {
		return dischargediagnosis;
	}
	public void setDischargediagnosis(String dischargediagnosis) {
		this.dischargediagnosis = dischargediagnosis;
	}
	public String getReferredto() {
		return referredto;
	}
	public void setReferredto(String referredto) {
		this.referredto = referredto;
	}

}