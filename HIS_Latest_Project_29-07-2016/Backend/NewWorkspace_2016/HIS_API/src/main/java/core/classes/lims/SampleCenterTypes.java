package core.classes.lims;

import java.util.HashSet;
import java.util.Set;

public class SampleCenterTypes {

	private int sampleCenterType_ID;
	private String sample_Center_TypeName;

	
	private Set<SampleCenters> Samplecenterses = new HashSet<SampleCenters>();

	
	public int getSampleCenterType_ID() {
		return sampleCenterType_ID;
	}


	public void setSampleCenterType_ID(int sampleCenterType_ID) {
		this.sampleCenterType_ID = sampleCenterType_ID;
	}


	public String getSample_Center_TypeName() {
		return sample_Center_TypeName;
	}


	public void setSample_Center_TypeName(String sample_Center_TypeName) {
		this.sample_Center_TypeName = sample_Center_TypeName;
	}


	public Set<SampleCenters> getSamplecenterses() {
		return Samplecenterses;
	}


	public void setSamplecenterses(Set<SampleCenters> samplecenterses) {
		Samplecenterses = samplecenterses;
	}


	
}
