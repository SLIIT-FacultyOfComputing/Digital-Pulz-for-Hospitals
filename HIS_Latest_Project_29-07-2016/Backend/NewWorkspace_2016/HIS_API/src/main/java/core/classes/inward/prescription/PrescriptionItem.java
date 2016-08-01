package core.classes.inward.prescription;

import core.classes.pharmacy.MstDrugsNew;

public class PrescriptionItem {
	private int auto_id;
	private PrescriptionTerms term_id;
	private MstDrugsNew drug_id;
	private int dose;
	private String frequency;
	private String status;
	public int getAuto_id() {
		return auto_id;
	}
	public void setAuto_id(int auto_id) {
		this.auto_id = auto_id;
	}
	public PrescriptionTerms getTerm_id() {
		return term_id;
	}
	public void setTerm_id(PrescriptionTerms term_id) {
		this.term_id = term_id;
	}
	public MstDrugsNew getDrug_id() {
		return drug_id;
	}
	public void setDrug_id(MstDrugsNew drug_id) {
		this.drug_id = drug_id;
	}
	public int getDose() {
		return dose;
	}
	public void setDose(int dose) {
		this.dose = dose;
	}
	public String getFrequency() {
		return frequency;
	}
	public void setFrequency(String frequency) {
		this.frequency = frequency;
	}
	public String getStatus() {
		return status;
	}
	public void setStatus(String status) {
		this.status = status;
	}
	
	
}
