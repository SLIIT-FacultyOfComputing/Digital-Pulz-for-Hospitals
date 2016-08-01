package core.classes.inward.transfer;

import java.util.Date;

public class ExternalTransfer {

	public String bhtNo;
	public String transferFrom;
	public String transferTo;
	public String resonForTrasnsfer;
	public String reportOfSpacialExamination;
	public String treatmentSuggested;
	public Date transferCreatedDate;
	public int transferCreatedUser;
	public String nameOfGuardian;
	public String addressOfGuardian;
	
	public ExternalTransfer(){
		
	
	}

	public String getNameOfGuardian() {
		return nameOfGuardian;
	}

	public void setNameOfGuardian(String nameOfGuardian) {
		this.nameOfGuardian = nameOfGuardian;
	}

	public String getAddressOfGuardian() {
		return addressOfGuardian;
	}

	public void setAddressOfGuardian(String addressOfGuardian) {
		this.addressOfGuardian = addressOfGuardian;
	}

	public String getBhtNo() {
		return bhtNo;
	}

	public void setBhtNo(String bhtNo) {
		this.bhtNo = bhtNo;
	}

	public String getTransferFrom() {
		return transferFrom;
	}

	public void setTransferFrom(String transferFrom) {
		this.transferFrom = transferFrom;
	}

	public String getTransferTo() {
		return transferTo;
	}

	public void setTransferTo(String transferTo) {
		this.transferTo = transferTo;
	}

	
	public String getResonForTrasnsfer() {
		return resonForTrasnsfer;
	}

	public void setResonForTrasnsfer(String resonForTrasnsfer) {
		this.resonForTrasnsfer = resonForTrasnsfer;
	}

	public String getReportOfSpacialExamination() {
		return reportOfSpacialExamination;
	}

	public void setReportOfSpacialExamination(String reportOfSpacialExamination) {
		this.reportOfSpacialExamination = reportOfSpacialExamination;
	}

	public String getTreatmentSuggested() {
		return treatmentSuggested;
	}

	public void setTreatmentSuggested(String treatmentSuggested) {
		this.treatmentSuggested = treatmentSuggested;
	}

	public Date getTransferCreatedDate() {
		return transferCreatedDate;
	}

	public void setTransferCreatedDate(Date transferCreatedDate) {
		this.transferCreatedDate = transferCreatedDate;
	}

	public int getTransferCreatedUser() {
		return transferCreatedUser;
	}

	public void setTransferCreatedUser(int transferCreatedUser) {
		this.transferCreatedUser = transferCreatedUser;
	}
	
	
}
