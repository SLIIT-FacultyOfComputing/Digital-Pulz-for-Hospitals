package core.classes.lims;

import java.util.HashSet;
import java.util.Set;


public class SubCategory {
	
	private int sub_CategoryID;
	private String subCategory_IDName;
	private String sub_CategoryName;
	private Category fCategory_ID;
	
	private Set<SpecimenType> Specimentypes = new HashSet<SpecimenType>();
	private Set<TestNames> labTestnameses = new HashSet<TestNames> ();
	private Set<SpecimenRetentionType> Specimenretentiontypes = new HashSet<SpecimenRetentionType>();
		
	
	public Set<SpecimenType> getSpecimentypes() {
		return Specimentypes;
	}
	public void setSpecimentypes(Set<SpecimenType> specimentypes) {
		Specimentypes = specimentypes;
	}
	public Set<TestNames> getLabTestnameses() {
		return labTestnameses;
	}
	public void setLabTestnameses(Set<TestNames> labTestnameses) {
		this.labTestnameses = labTestnameses;
	}
	public Set<SpecimenRetentionType> getSpecimenretentiontypes() {
		return Specimenretentiontypes;
	}
	public void setSpecimenretentiontypes(
			Set<SpecimenRetentionType> specimenretentiontypes) {
		Specimenretentiontypes = specimenretentiontypes;
	}
	
	public int getSub_CategoryID() {
		return sub_CategoryID;
	}
	public void setSub_CategoryID(int sub_CategoryID) {
		this.sub_CategoryID = sub_CategoryID;
	}
	public String getSubCategory_IDName() {
		return subCategory_IDName;
	}
	public void setSubCategory_IDName(String subCategory_IDName) {
		this.subCategory_IDName = subCategory_IDName;
	}
	public String getSub_CategoryName() {
		return sub_CategoryName;
	}
	public void setSub_CategoryName(String sub_CategoryName) {
		this.sub_CategoryName = sub_CategoryName;
	}
	public Category getfCategory_ID() {
		return fCategory_ID;
	}
	public void setfCategory_ID(Category fCategory_ID) {
		this.fCategory_ID = fCategory_ID;
	} 

	
}
