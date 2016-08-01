package core.classes.inward.admin;

import java.util.HashSet;
import java.util.Set;

import core.classes.inward.transfer.InternalTransfer;


public class Ward {
	private String wardNo;
	private String category;
	private String wardGender;
	
	private Set<Bed> bedsSet = new HashSet<Bed>();
	private Set<InternalTransfer> internalTransferSet = new HashSet<InternalTransfer>();
	
	public Ward() {
		
		
	}
	
	
	public Set<InternalTransfer> getInternalTransferSet() {
		return internalTransferSet;
	}

	public void setInternalTransferSet(Set<InternalTransfer> internalTransferSet) {
		this.internalTransferSet = internalTransferSet;
	}

	/**
	 * @return the bedsSet
	 */
	public Set<Bed> getBedsSet() {
		return bedsSet;
	}

	/**
	 * @param bedsSet the bedsSet to set
	 */
	public void setBedsSet(Set<Bed> bedsSet) {
		this.bedsSet = bedsSet;
	}

	/**
	 * @return the wardNo
	 */
	public String getWardNo() {
		return wardNo;
	}
	/**
	 * @param wardNo the wardNo to set
	 */
	public void setWardNo(String wardNo) {
		this.wardNo = wardNo;
	}
	/**
	 * @return the category
	 */
	public String getCategory() {
		return category;
	}
	/**
	 * @param category the category to set
	 */
	public void setCategory(String category) {
		this.category = category;
	}
	/**
	 * @return the wardGender
	 */
	public String getWardGender() {
		return wardGender;
	}
	/**
	 * @param wardGender the wardGender to set
	 */
	public void setWardGender(String wardGender) {
		this.wardGender = wardGender;
	}

	

	
}
