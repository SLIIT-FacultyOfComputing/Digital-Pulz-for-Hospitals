package core.classes.opd;

import java.util.Date;

import core.classes.BaseEntity;

public class OpdInjection extends BaseEntity implements java.io.Serializable  {

	private int opdInjectionId;
	private Visit visitId;
	private Injection injectionId;
	private int orderById;
	private int completeById;
	private String status;
	private String episodeType;
	private Date completeDate;
	private String remarks;
	private Boolean active;
	

	public int getOpdInjectionId() {
		return opdInjectionId;
	}
	public void setOpdInjectionId(int opdInjectionId) {
		this.opdInjectionId = opdInjectionId;
	}
	public Visit getVisitId() {
		return visitId;
	}
	public void setVisitId(Visit visitId) {
		this.visitId = visitId;
	}
	public Injection getInjectionId() {
		return injectionId;
	}
	public void setInjectionId(Injection injectionId) {
		this.injectionId = injectionId;
	}
	public int getOrderById() {
		return orderById;
	}
	public void setOrderById(int orderById) {
		this.orderById = orderById;
	}
	public int getCompleteById() {
		return completeById;
	}
	public void setCompleteById(int completeById) {
		this.completeById = completeById;
	}
	public String getStatus() {
		return status;
	}
	public void setStatus(String status) {
		this.status = status;
	}
	public String getEpisodeType() {
		return episodeType;
	}
	public void setEpisodeType(String episodeType) {
		this.episodeType = episodeType;
	}
	public Date getCompleteDate() {
		return completeDate;
	}
	public void setCompleteDate(Date completeDate) {
		this.completeDate = completeDate;
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
