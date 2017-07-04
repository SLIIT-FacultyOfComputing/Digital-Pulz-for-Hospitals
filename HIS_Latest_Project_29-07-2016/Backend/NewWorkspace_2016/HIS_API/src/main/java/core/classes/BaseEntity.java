package core.classes;

import java.util.Date;

public class BaseEntity {
	
	private Date createDate;
	private String createUser;
	private Date lastUpDate;
	private String lastUpDateUser;
	
	public Date getCreateDate() {
		return createDate;
	}
	public void setCreateDate(Date createDate) {
		this.createDate = createDate;
	}
	public String getCreateUser() {
		return createUser;
	}
	public void setCreateUser(String createUser) {
		this.createUser = createUser;
	}
	public Date getLastUpDate() {
		return lastUpDate;
	}
	public void setLastUpDate(Date lastUpDate) {
		this.lastUpDate = lastUpDate;
	}
	public String getLastUpDateUser() {
		return lastUpDateUser;
	}
	public void setLastUpDateUser(String lastUpDateUser) {
		this.lastUpDateUser = lastUpDateUser;
	}
	
}
