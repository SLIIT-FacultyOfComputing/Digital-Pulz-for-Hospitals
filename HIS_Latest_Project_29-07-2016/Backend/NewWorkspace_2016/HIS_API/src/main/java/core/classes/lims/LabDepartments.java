package core.classes.lims;

import java.util.HashSet;
import java.util.Set;

public class LabDepartments {

	private Integer labDept_ID;
	private String labDept_Name;
	
	private Set<Laboratories> labLaboratorieses = new HashSet<Laboratories>();
	
	public Integer getLabDept_ID() {
		return labDept_ID;
	}

	public void setLabDept_ID(Integer labDept_ID) {
		this.labDept_ID = labDept_ID;
	}

	public String getLabDept_Name() {
		return labDept_Name;
	}

	public void setLabDept_Name(String labDept_Name) {
		this.labDept_Name = labDept_Name;
	}

	public Set<Laboratories> getLabLaboratorieses() {
		return labLaboratorieses;
	}

	public void setLabLaboratorieses(Set<Laboratories> labLaboratorieses) {
		this.labLaboratorieses = labLaboratorieses;
	}

	
}
