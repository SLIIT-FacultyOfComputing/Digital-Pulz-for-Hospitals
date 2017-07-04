package core.classes.standards;

import core.classes.BaseEntity;

public class Icd10 extends BaseEntity implements java.io.Serializable {

	private int icdId;
	private String code;
	private String name;
	private int isNotify;
	private String remarks;
	private Boolean active;
	
	public int getIcdId() {
		return icdId;
	}
	public void setIcdId(int icdId) {
		this.icdId = icdId;
	}
	public String getCode() {
		return code;
	}
	public void setCode(String code) {
		this.code = code;
	}
	public String getName() {
		return name;
	}
	public void setName(String name) {
		this.name = name;
	}
	public int getIsNotify() {
		return isNotify;
	}
	public void setIsNotify(int isNotify) {
		this.isNotify = isNotify;
	}
	public String getRemarks() {
		return remarks;
	}
	public void setRemarks(String remarks) {
		this.remarks = remarks;
	}
	public Boolean getActive() {
		return active;
	}
	public void setActive(Boolean active) {
		this.active = active;
	}
	
	
}
