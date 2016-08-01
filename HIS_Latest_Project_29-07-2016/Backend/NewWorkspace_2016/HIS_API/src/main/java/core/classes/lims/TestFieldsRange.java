package core.classes.lims;

import java.util.HashSet;
import java.util.Set;

public class TestFieldsRange {

	private int range_ID;
	private String gender;
	private int minage;
	private int maxage;
	private String unit;
	private double minVal;
	private double maxVal;
	private ParentTestFields fparentfield_ID;
	private SubTestFields fsubfield_ID;
	
	
	


	public SubTestFields getFsubfield_ID() {
		return fsubfield_ID;
	}

	public void setFsubfield_ID(SubTestFields fsubfield_ID) {
		this.fsubfield_ID = fsubfield_ID;
	}

	public int getMinage() {
		return minage;
	}

	public void setMinage(int minage) {
		this.minage = minage;
	}

	public int getMaxage() {
		return maxage;
	}

	public void setMaxage(int maxage) {
		this.maxage = maxage;
	}

	
	public int getRange_ID() {
		return range_ID;
	}

	public void setRange_ID(int range_ID) {
		this.range_ID = range_ID;
	}

	public String getGender() {
		return gender;
	}

	public void setGender(String gender) {
		this.gender = gender;
	}

	

	public String getUnit() {
		return unit;
	}

	public void setUnit(String unit) {
		this.unit = unit;
	}

	public double getMinVal() {
		return minVal;
	}

	public void setMinVal(double minVal) {
		this.minVal = minVal;
	}

	public double getMaxVal() {
		return maxVal;
	}

	public void setMaxVal(double maxVal) {
		this.maxVal = maxVal;
	}

	public ParentTestFields getFparentfield_ID() {
		return fparentfield_ID;
	}

	public void setFparentfield_ID(ParentTestFields fparentfield_ID) {
		this.fparentfield_ID = fparentfield_ID;
	}



	

	
}
