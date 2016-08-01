/**
 * 
 */
package core.classes.finance;

import java.util.Date;

/**
 * HISFinReceipt class of the Finance module
 * @author Vishwa
 *
 */
public class HisFinReceipt {

	private int recId;
	private int recVoucherNo;
	private Date recDateOfTranx;
	private String recDescription;
	private double recCrossEntry;
	private double recAmount;
	private double recTotal;
	private String recReceivedForm;
	/**
	 * @return the recId
	 */
	public int getRecId() {
		return recId;
	}
	/**
	 * @param recId the recId to set
	 */
	public void setRecId(int recId) {
		this.recId = recId;
	}
	/**
	 * @return the recVoucherNo
	 */
	public int getRecVoucherNo() {
		return recVoucherNo;
	}
	/**
	 * @param recVoucherNo the recVoucherNo to set
	 */
	public void setRecVoucherNo(int recVoucherNo) {
		this.recVoucherNo = recVoucherNo;
	}
	/**
	 * @return the recDateOfTranx
	 */
	public Date getRecDateOfTranx() {
		return recDateOfTranx;
	}
	/**
	 * @param recDateOfTranx the recDateOfTranx to set
	 */
	public void setRecDateOfTranx(Date recDateOfTranx) {
		this.recDateOfTranx = recDateOfTranx;
	}
	/**
	 * @return the recDescription
	 */
	public String getRecDescription() {
		return recDescription;
	}
	/**
	 * @param recDescription the recDescription to set
	 */
	public void setRecDescription(String recDescription) {
		this.recDescription = recDescription;
	}
	/**
	 * @return the recCrossEntry
	 */
	public double getRecCrossEntry() {
		return recCrossEntry;
	}
	/**
	 * @param recCrossEntry the recCrossEntry to set
	 */
	public void setRecCrossEntry(double recCrossEntry) {
		this.recCrossEntry = recCrossEntry;
	}
	/**
	 * @return the recAmount
	 */
	public double getRecAmount() {
		return recAmount;
	}
	/**
	 * @param recAmount the recAmount to set
	 */
	public void setRecAmount(double recAmount) {
		this.recAmount = recAmount;
	}
	/**
	 * @return the recTotal
	 */
	public double getRecTotal() {
		return recTotal;
	}
	/**
	 * @param recTotal the recTotal to set
	 */
	public void setRecTotal(double recTotal) {
		this.recTotal = recTotal;
	}
	/**
	 * @return the recReceivedForm
	 */
	public String getRecReceivedForm() {
		return recReceivedForm;
	}
	/**
	 * @param recReceivedForm the recReceivedForm to set
	 */
	public void setRecReceivedForm(String recReceivedForm) {
		this.recReceivedForm = recReceivedForm;
	}
	
}
