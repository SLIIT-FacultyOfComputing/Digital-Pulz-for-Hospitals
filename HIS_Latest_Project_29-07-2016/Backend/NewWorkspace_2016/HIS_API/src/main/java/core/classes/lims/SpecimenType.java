package core.classes.lims;

import java.util.HashSet;
import java.util.Set;


public class SpecimenType {
	private int specimenType_ID;
	private String specimen_TypeName;
	private Category fCategry_ID;
	private SubCategory fSub_CategoryID;
	
	private Set<Specimen> labSpecimens = new HashSet<Specimen>();
	
	public int getSpecimenType_ID() {
		return specimenType_ID;
	}

	public void setSpecimenType_ID(int specimenType_ID) {
		this.specimenType_ID = specimenType_ID;
	}

	public String getSpecimen_TypeName() {
		return specimen_TypeName;
	}

	public void setSpecimen_TypeName(String specimen_TypeName) {
		this.specimen_TypeName = specimen_TypeName;
	}

	public Category getfCategry_ID() {
		return fCategry_ID;
	}

	public void setfCategry_ID(Category fCategry_ID) {
		this.fCategry_ID = fCategry_ID;
	}

	public SubCategory getfSub_CategoryID() {
		return fSub_CategoryID;
	}

	public void setfSub_CategoryID(SubCategory fSub_CategoryID) {
		this.fSub_CategoryID = fSub_CategoryID;
	}

	public Set<Specimen> getLabSpecimens() {
		return labSpecimens;
	}

	public void setLabSpecimens(Set<Specimen> labSpecimens) {
		this.labSpecimens = labSpecimens;
	}

	
	

}
