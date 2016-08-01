package core.classes.lims;

import java.util.HashSet;
import java.util.Set;


public class SpecimenRetentionType {

	private int retention_TypeID;
	private String retention_TypeName;
	private String duration;
	private Category fCategory_ID;
	private SubCategory fSub_CategryID;
	
	private Set<Specimen> labSpecimens = new HashSet<Specimen>();
	
	public Set<Specimen> getLabSpecimens() {
		return labSpecimens;
	}

	public void setLabSpecimens(Set<Specimen> labSpecimens) {
		this.labSpecimens = labSpecimens;
	}

	public int getRetention_TypeID() {
		return retention_TypeID;
	}

	public void setRetention_TypeID(int retention_TypeID) {
		this.retention_TypeID = retention_TypeID;
	}

	public String getRetention_TypeName() {
		return retention_TypeName;
	}

	public void setRetention_TypeName(String retention_TypeName) {
		this.retention_TypeName = retention_TypeName;
	}

	public String getDuration() {
		return duration;
	}

	public void setDuration(String duration) {
		this.duration = duration;
	}

	public Category getfCategory_ID() {
		return fCategory_ID;
	}

	public void setfCategory_ID(Category fCategory_ID) {
		this.fCategory_ID = fCategory_ID;
	}

	public SubCategory getfSub_CategryID() {
		return fSub_CategryID;
	}

	public void setfSub_CategryID(SubCategory fSub_CategryID) {
		this.fSub_CategryID = fSub_CategryID;
	}

	
	
}
