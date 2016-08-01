package core.classes.inward.charts;

import java.util.Date;

import core.classes.inward.WardAdmission.Admission;

public class Temperaturechart {
	public int rowNo;
	public Admission bhtNo;
	public double temperature;
	public Date dateTime;
	
	public Temperaturechart(){
		
		
	}
	
	public Date getDateTime() {
		return dateTime;
	}

	public void setDateTime(Date dateTime) {
		this.dateTime = dateTime;
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

	public double getTemperature() {
		return temperature;
	}

	public void setTemperature(double temperature) {
		this.temperature = temperature;
	}

	

}
