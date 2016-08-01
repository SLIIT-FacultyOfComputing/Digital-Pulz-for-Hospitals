package core.classes.lims;

import java.util.HashSet;
import java.util.Set;

public class ParentTestFields {

	private int parent_FieldID;
	private String parentField_IDName;
	private String parent_FieldName;
	private TestNames fTest_NameID;
	
	private Set<SubFieldResults>  labSubfieldresultses = new HashSet<SubFieldResults> ();
	private Set<MainResults> labMainresultses = new HashSet<MainResults>();
	private Set<SubTestFields> labSubtestfieldses = new HashSet<SubTestFields>();
	private Set<TestFieldsRange> labestFieldsranges = new HashSet<TestFieldsRange>();
	
	
	
	

	public Set<SubFieldResults> getLabSubfieldresultses() {
		return labSubfieldresultses;
	}

	public void setLabSubfieldresultses(Set<SubFieldResults> labSubfieldresultses) {
		this.labSubfieldresultses = labSubfieldresultses;
	}

	public Set<MainResults> getLabMainresultses() {
		return labMainresultses;
	}

	public void setLabMainresultses(Set<MainResults> labMainresultses) {
		this.labMainresultses = labMainresultses;
	}

	

	public int getParent_FieldID() {
		return parent_FieldID;
	}

	public void setParent_FieldID(int parent_FieldID) {
		this.parent_FieldID = parent_FieldID;
	}

	public String getParentField_IDName() {
		return parentField_IDName;
	}

	public void setParentField_IDName(String parentField_IDName) {
		this.parentField_IDName = parentField_IDName;
	}

	public String getParent_FieldName() {
		return parent_FieldName;
	}

	public void setParent_FieldName(String parent_FieldName) {
		this.parent_FieldName = parent_FieldName;
	}

	

	public TestNames getfTest_NameID() {
		return fTest_NameID;
	}

	public void setfTest_NameID(TestNames fTest_NameID) {
		this.fTest_NameID = fTest_NameID;
	}

	public Set<SubTestFields> getLabSubtestfieldses() {
		return labSubtestfieldses;
	}

	public void setLabSubtestfieldses(Set<SubTestFields> labSubtestfieldses) {
		this.labSubtestfieldses = labSubtestfieldses;
	}
	public Set<TestFieldsRange> getLabestFieldsranges() {
		return labestFieldsranges;
	}

	public void setLabestFieldsranges(Set<TestFieldsRange> labestFieldsranges) {
		this.labestFieldsranges = labestFieldsranges;
	}
}
