package core.classes.pharmacy;


public class PhramacyAssitanceStock implements java.io.Serializable {
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	private Integer drug_srno;
	private String drug_name;
	private Integer requestedUserID;
	private Integer drugQty;
	public Integer getDrugQty() {
		return drugQty;
	}

	public void setDrugQty(Integer drugQty) {
		this.drugQty = drugQty;
	}

	// private Date updatedDate;
	public Integer getDrug_srno() {
		return drug_srno;
	}

	public PhramacyAssitanceStock() {
	  
	}

	public PhramacyAssitanceStock(Integer drug_srno, String drug_name,
			Integer requestedUserID) {
		
		this.drug_srno = drug_srno;
		this.drug_name = drug_name;
		this.requestedUserID = requestedUserID;
	}

	public void setDrug_srno(Integer drug_srno) {
		this.drug_srno = drug_srno;
	}

	public String getDrug_name() {
		return drug_name;
	}

	public void setDrug_name(String drug_name) {
		this.drug_name = drug_name;
	}

	public Integer getRequestedUserID() {
		return requestedUserID;
	}

	public void setRequestedUserID(Integer requestedUserID) {
		this.requestedUserID = requestedUserID;
	}

}
