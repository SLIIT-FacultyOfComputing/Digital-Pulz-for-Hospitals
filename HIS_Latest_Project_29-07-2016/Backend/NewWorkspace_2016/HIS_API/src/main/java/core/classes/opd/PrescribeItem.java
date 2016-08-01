package core.classes.opd;

import org.hibernate.annotations.NotFound;
import org.hibernate.annotations.NotFoundAction;

import core.classes.pharmacy.MstDrugsNew;

/***
 * Prescribe Item class contains all the attributes and there getters and setters.
 * @author MIYURU
 *
 */
public class PrescribeItem {

	private int prescriptionItemID;
	@NotFound(action = NotFoundAction.IGNORE)
	private MstDrugsNew drugID;
	private Prescription prescription;
	private String prescribeItemsDosage;
	private String prescribeItemsPeriod;
	private String prescribeItemsRemarks;
	private int prescribeItemsQuantity;
	private String prescribeItemsFrequency;
	 
	
	public int getPrescriptionItemID() {
		return prescriptionItemID;
	}
	public void setPrescriptionItemID(int prescriptionItemID) {
		this.prescriptionItemID = prescriptionItemID;
	}
	public MstDrugsNew getDrugID() {
		return drugID;
	}
	public void setDrugID(MstDrugsNew drugID) {
		this.drugID = drugID;
	}
	public Prescription getPrescription() {
		return prescription;
	}
	public void setPrescription(Prescription prescription) {
		this.prescription = prescription;
	}
	public String getPrescribeItemsDosage() {
		return prescribeItemsDosage;
	}
	public void setPrescribeItemsDosage(String prescribeItemsDosage) {
		this.prescribeItemsDosage = prescribeItemsDosage;
	}
	public String getPrescribeItemsPeriod() {
		return prescribeItemsPeriod;
	}
	public void setPrescribeItemsPeriod(String prescribeItemsPeriod) {
		this.prescribeItemsPeriod = prescribeItemsPeriod;
	}
	public String getPrescribeItemsRemarks() {
		return prescribeItemsRemarks;
	}
	public void setPrescribeItemsRemarks(String prescribeItemsRemarks) {
		this.prescribeItemsRemarks = prescribeItemsRemarks;
	}
	public int getPrescribeItemsQuantity() {
		return prescribeItemsQuantity;
	}
	public void setPrescribeItemsQuantity(int prescribeItemsQuantity) {
		this.prescribeItemsQuantity = prescribeItemsQuantity;
	}
	public String getPrescribeItemsFrequency() {
		return prescribeItemsFrequency;
	}
	public void setPrescribeItemsFrequency(String prescribeItemsFrequency) {
		this.prescribeItemsFrequency = prescribeItemsFrequency;
	}

	
	 
}