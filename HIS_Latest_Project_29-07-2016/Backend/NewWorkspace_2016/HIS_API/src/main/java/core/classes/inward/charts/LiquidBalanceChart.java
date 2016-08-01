package core.classes.inward.charts;

import java.util.Date;

import core.classes.inward.WardAdmission.Admission;



public class LiquidBalanceChart {
	public int rowNo;
	public Admission bhtNo;
	public Date dateTime;
	public Double oral ;
	public Double saline ;	
	public Double output ;
	
	
public LiquidBalanceChart(){
		
		
	}
	public LiquidBalanceChart(int rowNo, Admission bhtNo, Date dateTime, Double oral, Double saline, Double output){
		this.rowNo=rowNo;
		this.bhtNo=bhtNo;
		this.dateTime=dateTime;
		this.oral=oral;
		this.saline=saline;
		this.output=output;

		
		
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

	public Double oral() {
		return oral;
	}
	
	public Double getoral() {
		return oral;
	}

	public void setoral(Double oral) {
		this.oral = oral;
	}
	
	public Double saline() {
		return saline;
	}

	public Double getsaline() {
		return saline;
	}
	
	public void setsaline(Double saline) {
		this.saline = saline;
	}
	
	public Double output() {
		return oral;
	}
	
	public Double getoutput() {
		return output;
	}

	public void setoutput(Double output) {
		this.output = output;
	}

}
