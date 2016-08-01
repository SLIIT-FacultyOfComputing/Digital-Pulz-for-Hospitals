package core.classes.pharmacy;

import java.util.Date;

public class MstMailHistory {

	private int mailHistory_ID;
	private MstDrugsNew mailHistory_Drug;
	private String mailHistory_Content;
	private Date mailHistory_SendDate;
	
	public MstMailHistory(){
		
		
	}

	public int getMailHistory_ID() {
		return mailHistory_ID;
	}

	public void setMailHistory_ID(int mailHistory_ID) {
		this.mailHistory_ID = mailHistory_ID;
	}



	public MstDrugsNew getMailHistory_Drug() {
		return mailHistory_Drug;
	}

	public void setMailHistory_Drug(MstDrugsNew mailHistory_Drug) {
		this.mailHistory_Drug = mailHistory_Drug;
	}

	public String getMailHistory_Content() {
		return mailHistory_Content;
	}

	public void setMailHistory_Content(String mailHistory_Content) {
		this.mailHistory_Content = mailHistory_Content;
	}

	public Date getMailHistory_SendDate() {
		return mailHistory_SendDate;
	}

	public void setMailHistory_SendDate(Date mailHistory_SendDate) {
		this.mailHistory_SendDate = mailHistory_SendDate;
	}
	
	
	
}
