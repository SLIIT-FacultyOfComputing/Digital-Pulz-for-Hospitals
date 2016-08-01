package core.classes.lims;

import java.util.HashSet;
import java.util.Set;


public class Category {

	private int category_ID;
	private String category_IDName;
	private String category_Name;
	
	private Set<SubCategory> subcategories = new HashSet<SubCategory> ();
	private Set<SpecimenType> Specimentypes = new HashSet<SpecimenType>();
	private Set<SpecimenRetentionType> Specimenretentiontypes = new HashSet<SpecimenRetentionType>();
	private Set<TestNames>  labTestnameses = new HashSet<TestNames>();
	
	public int getCategory_ID() {
		return category_ID;
	}
	public void setCategory_ID(int category_ID) {
		this.category_ID = category_ID;
	}
	public String getCategory_IDName() {
		return category_IDName;
	}
	public void setCategory_IDName(String category_IDName) {
		this.category_IDName = category_IDName;
	}
	public String getCategory_Name() {
		return category_Name;
	}
	public void setCategory_Name(String category_Name) {
		this.category_Name = category_Name;
	}
	public Set<SubCategory> getSubcategories() {
		return subcategories;
	}
	public void setSubcategories(Set<SubCategory> subcategories) {
		this.subcategories = subcategories;
	}
	public Set<SpecimenType> getSpecimentypes() {
		return Specimentypes;
	}
	public void setSpecimentypes(Set<SpecimenType> specimentypes) {
		Specimentypes = specimentypes;
	}
	public Set<SpecimenRetentionType> getSpecimenretentiontypes() {
		return Specimenretentiontypes;
	}
	public void setSpecimenretentiontypes(
			Set<SpecimenRetentionType> specimenretentiontypes) {
		Specimenretentiontypes = specimenretentiontypes;
	}
	public Set<TestNames> getLabTestnameses() {
		return labTestnameses;
	}
	public void setLabTestnameses(Set<TestNames> labTestnameses) {
		this.labTestnameses = labTestnameses;
	}
	
	
		
}
