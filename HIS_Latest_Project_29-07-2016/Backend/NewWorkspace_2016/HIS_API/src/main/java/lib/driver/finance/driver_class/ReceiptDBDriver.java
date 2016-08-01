package lib.driver.finance.driver_class;

import java.sql.Date;
import java.util.Iterator;
import java.util.List;


import lib.classes.DBDriverBase.*;
import lib.SessionFactoryUtil;

import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.finance.*;

public class ReceiptDBDriver extends DBDriverBase<HisFinReceipt> {

	Session session = SessionFactoryUtil.getSessionFactory().getCurrentSession(); //this is a tempory session 

	public boolean addReceipt(HisFinReceipt receipt){

		if(save(receipt))
			return true;
		else
			return false;
	}
	
	public boolean updateReceipt(HisFinReceipt receipt){
		if(update(receipt))
			return true;
		else
			return false;
	}
	
	public boolean deleteReceipt(HisFinReceipt receipt){
		if(delete(receipt))
			return true;
		else
			return false;
	}
	
	public boolean deleteReceipt(int receipt_Id){
		Transaction tx = null;
		tx = session.beginTransaction();
		Query query = session.createQuery("delete r from HisFinReceipt as r where r.recId = :PAC_ID");
		query.setParameter("PAC_ID",receipt_Id);
		tx.commit();
		return true;
	}
	
	public List<HisFinReceipt> getReceipts(){
		Transaction tx = null;
		tx = session.beginTransaction();
		Query query =  session.createQuery("select r from HisFinReceipt as r ");
		List<HisFinReceipt> receipttList = query.list();
		tx.commit();
		return receipttList;
	}
	
	public HisFinReceipt getReceipt(String voucher)
	{
		Transaction tx = null;
		tx = session.beginTransaction();
		Query query = session.createQuery("select r from HisFinReceipt as r where r.recVoucherNo = :VOUCHER");
		query.setParameter("VOUCHER", voucher);
		List receiptList = query.list();
		HisFinReceipt receipt = new HisFinReceipt();
		for(Iterator iter = receiptList.iterator(); iter.hasNext();)
		{
			receipt = (HisFinReceipt)iter.next();
		}
		tx.commit();
		return receipt;
	}
	
	public List<HisFinReceipt> getReceipt(Date from, Date to){
		Transaction tx = null;
		tx = session.beginTransaction();
		
		Query query = session.createQuery("select r from HisFinReceipt as r where r.recDateOfTranx > :FROM and p.recDateOfTranx < :TO");
		query.setParameter("FROM", from);
		query.setParameter("TO", to);
		List<HisFinReceipt> receiptList = query.list();
		
		tx.commit();
		return receiptList;
	}
	
	public double getTotalReceipt(){
		Transaction tx = null;
		tx = session.beginTransaction();
		Query query = session.createQuery("select sum(r.recTotal) from HisFinPayment as r");
		double totalAmt = Double.parseDouble(query.toString());
		tx.commit();
		return totalAmt;
	}
	
	public double getTotalReceipt(Date from, Date to){
		Transaction tx = null;
		tx = session.beginTransaction();
		Query query = session.createQuery("select r from HisFinReceipt as r where r.recDateOfTranx between :FROM and :TO");
		query.setParameter("FROM", from);
		query.setParameter("TO", to);
		double totalAmt = Double.parseDouble(query.toString());
		tx.commit();
		return totalAmt;
	}
}
