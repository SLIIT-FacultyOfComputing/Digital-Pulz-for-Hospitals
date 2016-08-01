package core.classes.opd;

import java.util.Date;

import core.classes.api.user.AdminUser;

/***
 * Exams class contains all the attributes and there getters and setters.
 * @author MIYURU
 *
 */
public class Exams {

	private int examID;
	private Date examDate;
	private double examWeight;
	private double examHeight;
	private double exambmi;
	private double examSysBP;
	private double examDisatBP;
	private double examTemp;
	private Date examCreateDate;
	private AdminUser examCreateUser;
	private Date examLastUpdate;
	private AdminUser examLastUpdateUser;
	private int examActive;
	private Visit visit;
	
	
	public double getExambmi() {
		return exambmi;
	}
	public void setExambmi(double exambmi) {
		this.exambmi = exambmi;
	}
	public int getExamID() {
		return examID;
	}
	public void setExamID(int examID) {
		this.examID = examID;
	}
	public Date getExamDate() {
		return examDate;
	}
	public void setExamDate(Date examDate) {
		this.examDate = examDate;
	}
	public double getExamWeight() {
		return examWeight;
	}
	public void setExamWeight(double examWeight) {
		this.examWeight = examWeight;
	}
	public double getExamHeight() {
		return examHeight;
	}
	public void setExamHeight(double examHeight) {
		this.examHeight = examHeight;
	}
	public double getExamSysBP() {
		return examSysBP;
	}
	public void setExamSysBP(double examSysBP) {
		this.examSysBP = examSysBP;
	}
	public double getExamDisatBP() {
		return examDisatBP;
	}
	public void setExamDisatBP(double examDisatBP) {
		this.examDisatBP = examDisatBP;
	}
	public double getExamTemp() {
		return examTemp;
	}
	public void setExamTemp(double examTemp) {
		this.examTemp = examTemp;
	}
	public Date getExamCreateDate() {
		return examCreateDate;
	}
	public void setExamCreateDate(Date examCreateDate) {
		this.examCreateDate = examCreateDate;
	}
	public AdminUser getExamCreateUser() {
		return examCreateUser;
	}
	public void setExamCreateUser(AdminUser examCreateUser) {
		this.examCreateUser = examCreateUser;
	}
	public Date getExamLastUpdate() {
		return examLastUpdate;
	}
	public void setExamLastUpdate(Date examLastUpdate) {
		this.examLastUpdate = examLastUpdate;
	}
	public AdminUser getExamLastUpdateUser() {
		return examLastUpdateUser;
	}
	public void setExamLastUpdateUser(AdminUser examLastUpdateUser) {
		this.examLastUpdateUser = examLastUpdateUser;
	}
	public int getExamActive() {
		return examActive;
	}
	public void setExamActive(int examActive) {
		this.examActive = examActive;
	}
	public Visit getVisit() {
		return visit;
	}
	public void setVisit(Visit visit) {
		this.visit = visit;
	}
	
 
}
