package core.classes.pharmacy;

public class PharmacyMainStock implements java.io.Serializable {
	
	private static final long serialVersionUID = 1L;

	
	private String drug_name;
	private Integer drug_srno;

	public Integer getDrug_srno() {
		return drug_srno;
	}

	public void setDrug_srno(Integer drug_srno) {
		this.drug_srno = drug_srno;
	}

	public PharmacyMainStock(Integer drug_srno, String drug_name
			) {
		
		this.drug_srno = drug_srno;
		this.drug_name = drug_name;
		
	}
	
	public String getDrug_name() {
		return drug_name;
	}


	public void setDrug_name(String drug_name) {
		this.drug_name = drug_name;
	}
}
