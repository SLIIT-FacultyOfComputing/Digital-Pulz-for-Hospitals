package core.classes.lims;

import java.util.HashSet;
import java.util.Set;

public class LabTypes {

	private int labType_ID;
	private String lab_Type_Name;
	
	private Set<Laboratories> labLaboratorieses = new HashSet<Laboratories>();
	
	public int getLabType_ID() {
		return labType_ID;
	}

	public void setLabType_ID(int labType_ID) {
		this.labType_ID = labType_ID;
	}

	public String getLab_Type_Name() {
		return lab_Type_Name;
	}

	public void setLab_Type_Name(String lab_Type_Name) {
		this.lab_Type_Name = lab_Type_Name;
	}

	public Set<Laboratories> getLabLaboratorieses() {
		return labLaboratorieses;
	}

	public void setLabLaboratorieses(Set<Laboratories> labLaboratorieses) {
		this.labLaboratorieses = labLaboratorieses;
	}

	
}
