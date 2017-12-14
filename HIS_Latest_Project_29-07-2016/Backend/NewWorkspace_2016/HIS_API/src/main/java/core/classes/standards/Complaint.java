package core.classes.standards;

public class Complaint implements java.io.Serializable  {

	private int compId;
	private String icpcCode;
	private String name;
	private String icdCode;
	private String remarks;
	private Boolean isNotify;
	private Boolean active;
	
	public int getCompId() {
		return compId;
	}
	public void setCompId(int compId) {
		this.compId = compId;
	}
	public String getIcpcCode() {
		return icpcCode;
	}
	public void setIcpcCode(String icpcCode) {
		this.icpcCode = icpcCode;
	}
	public String getName() {
		return name;
	}
	public void setName(String name) {
		this.name = name;
	}
	public String getIcdCode() {
		return icdCode;
	}
	public void setIcdCode(String icdCode) {
		this.icdCode = icdCode;
	}
	public String getRemarks() {
		return remarks;
	}
	public void setRemarks(String remarks) {
		this.remarks = remarks;
	}
	public Boolean getIsNotify() {
		return isNotify;
	}
	public void setIsNotify(Boolean isNotify) {
		this.isNotify = isNotify;
	}
	public Boolean getActive() {
		return active;
	}
	public void setActive(Boolean active) {
		this.active = active;
	}
	
	
}
