package core.classes.lims;

import java.util.HashSet;
import java.util.Set;

public class SubTestFields {

	private int sub_TestFieldID;
	private String subField_IDName;
	private String subtest_FieldName;
	private ParentTestFields fPar_Test_FieldID;

	
	private Set<SubFieldResults> labSubfieldresultses = new HashSet<SubFieldResults>();
	private Set<TestFieldsRange> labestFieldsranges = new HashSet<TestFieldsRange>();
	
	public Set<SubFieldResults> getLabSubfieldresultses() {
		return labSubfieldresultses;
	}
	public void setLabSubfieldresultses(Set<SubFieldResults> labSubfieldresultses) {
		this.labSubfieldresultses = labSubfieldresultses;
	}
	public int getSub_TestFieldID() {
		return sub_TestFieldID;
	}
	public void setSub_TestFieldID(int sub_TestFieldID) {
		this.sub_TestFieldID = sub_TestFieldID;
	}
	public String getSubField_IDName() {
		return subField_IDName;
	}
	public void setSubField_IDName(String subField_IDName) {
		this.subField_IDName = subField_IDName;
	}
	public String getSubtest_FieldName() {
		return subtest_FieldName;
	}
	public void setSubtest_FieldName(String subtest_FieldName) {
		this.subtest_FieldName = subtest_FieldName;
	}
	public ParentTestFields getfPar_Test_FieldID() {
		return fPar_Test_FieldID;
	}
	public void setfPar_Test_FieldID(ParentTestFields fPar_Test_FieldID) {
		this.fPar_Test_FieldID = fPar_Test_FieldID;
	}
	public Set<TestFieldsRange> getLabestFieldsranges() {
		return labestFieldsranges;
	}
	public void setLabestFieldsranges(Set<TestFieldsRange> labestFieldsranges) {
		this.labestFieldsranges = labestFieldsranges;
	}
	
	
	
	
	
	
}
