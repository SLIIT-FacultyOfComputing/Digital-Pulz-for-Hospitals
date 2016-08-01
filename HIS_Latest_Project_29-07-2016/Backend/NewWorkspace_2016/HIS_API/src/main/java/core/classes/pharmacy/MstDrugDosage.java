package core.classes.pharmacy;

import java.util.HashSet;
import java.util.Set;

public class MstDrugDosage implements java.io.Serializable{
	
	private int dosId;
	private String dosage;
	private int recordStatus;
	private Set<MstDrugsNew> drug = new HashSet<MstDrugsNew>(0);
	
	public MstDrugDosage()
	{
		
	}
	


	public MstDrugDosage(int dosId, String dosage) {
		super();
		this.dosId = dosId;
		this.dosage = dosage;
	}



	public int getDosId() {
		return dosId;
	}



	public void setDosId(int dosId) {
		this.dosId = dosId;
	}



	public String getDosage() {
		return dosage;
	}

	public void setDosage(String dosage) {
		this.dosage = dosage;
	}



	public Set<MstDrugsNew> getDrug() {
		return drug;
	}



	public int getRecordStatus() {
		return recordStatus;
	}



	public void setRecordStatus(int recordStatus) {
		this.recordStatus = recordStatus;
	}



	public void setDrug(Set<MstDrugsNew> drug) {
		this.drug = drug;
	}




	
	
	

}
