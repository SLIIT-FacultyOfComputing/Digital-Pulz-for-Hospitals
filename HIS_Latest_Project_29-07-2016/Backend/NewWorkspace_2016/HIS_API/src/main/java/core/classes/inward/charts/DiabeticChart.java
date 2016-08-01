package core.classes.inward.charts;

import java.util.Date;

import core.classes.inward.WardAdmission.Admission;

public class DiabeticChart {
	public int rowNo;
	public Admission bhtNo;
	public Date dateTime;
	public double bloodSuger;
	
	public DiabeticChart(){
		
		
	}

	public int getRowNo() {
		return rowNo;
	}

	public void setRowNo(int rowNo) {
		this.rowNo = rowNo;
	}

	public Admission getBhtNo() {
		return bhtNo;
	}

	public void setBhtNo(Admission bhtNo) {
		this.bhtNo = bhtNo;
	}

	public Date getDateTime() {
		return dateTime;
	}

	public void setDateTime(Date dateTime) {
		this.dateTime = dateTime;
	}

	public double getBloodSuger() {
		return bloodSuger;
	}

	public void setBloodSuger(double bloodSuger) {
		this.bloodSuger = bloodSuger;
	}
	
	

}
