/**
 * 
 */
package core.classes.finance;

import java.util.Date;

/**
 * @author Vishwa
 *
 */


public class HisFinPayment {

	private int payId;
	private int payVoucherNo;
	private Date payDateOfTranx;
	private String payDescription;
	private double payCrossEntry;
	private double payAmount;
	private double payTotal;
	private String PayPaidFor;
	/**
	 * @return the payId
	 */
	public int getPayId() {
		return payId;
	}
	/**
	 * @param payId the payId to set
	 */
	public void setPayId(int payId) {
		this.payId = payId;
	}
	/**
	 * @return the payVoucherNo
	 */
	public int getPayVoucherNo() {
		return payVoucherNo;
	}
	/**
	 * @param payVoucherNo the payVoucherNo to set
	 */
	public void setPayVoucherNo(int payVoucherNo) {
		this.payVoucherNo = payVoucherNo;
	}
	/**
	 * @return the payDateOfTranx
	 */
	public Date getPayDateOfTranx() {
		return payDateOfTranx;
	}
	/**
	 * @param payDateOfTranx the payDateOfTranx to set
	 */
	public void setPayDateOfTranx(Date payDateOfTranx) {
		this.payDateOfTranx = payDateOfTranx;
	}
	/**
	 * @return the payDescription
	 */
	public String getPayDescription() {
		return payDescription;
	}
	/**
	 * @param payDescription the payDescription to set
	 */
	public void setPayDescription(String payDescription) {
		this.payDescription = payDescription;
	}
	/**
	 * @return the payCrossEntry
	 */
	public double getPayCrossEntry() {
		return payCrossEntry;
	}
	/**
	 * @param payCrossEntry the payCrossEntry to set
	 */
	public void setPayCrossEntry(double payCrossEntry) {
		this.payCrossEntry = payCrossEntry;
	}
	/**
	 * @return the payAmount
	 */
	public double getPayAmount() {
		return payAmount;
	}
	/**
	 * @param payAmount the payAmount to set
	 */
	public void setPayAmount(double payAmount) {
		this.payAmount = payAmount;
	}
	/**
	 * @return the payTotal
	 */
	public double getPayTotal() {
		return payTotal;
	}
	/**
	 * @param payTotal the payTotal to set
	 */
	public void setPayTotal(double payTotal) {
		this.payTotal = payTotal;
	}
	/**
	 * @return the payPaidFor
	 */
	public String getPayPaidFor() {
		return PayPaidFor;
	}
	/**
	 * @param payPaidFor the payPaidFor to set
	 */
	public void setPayPaidFor(String payPaidFor) {
		PayPaidFor = payPaidFor;
	}
	
}
