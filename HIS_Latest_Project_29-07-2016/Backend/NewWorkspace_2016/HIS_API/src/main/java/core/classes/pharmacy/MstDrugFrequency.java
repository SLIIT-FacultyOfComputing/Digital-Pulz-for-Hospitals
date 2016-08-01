package core.classes.pharmacy;

import java.util.HashSet;
import java.util.Set;

public class MstDrugFrequency implements java.io.Serializable {

	private int freqId;
	private String frequency;
	private Set<MstDrugsNew> drug = new HashSet<MstDrugsNew>(0);
	
	public Set<MstDrugsNew> getDrug() {
		return drug;
	}



	public void setDrug(Set<MstDrugsNew> drug) {
		this.drug = drug;
	}



	public MstDrugFrequency()
	{
		
	}
	


	public MstDrugFrequency(int freqId, String frequency) {
		super();
		this.freqId = freqId;
		this.frequency = frequency;
	}



	public int getFreqId() {
		return freqId;
	}



	public void setFreqId(int freqId) {
		this.freqId = freqId;
	}



	public String getFrequency() {
		return frequency;
	}

	public void setFrequency(String frequency) {
		this.frequency = frequency;
	}
	
	
	
	
}
