/*
-----------------------------------------------------------------------------------------------------------------------------------
HIS – Health Information System - RESTful  API
-----------------------------------------------------------------------------------------------------------------------------------
This is a free and open source API which can be used to develop and distributed in the hope that it will be useful to develop
EMR systems. You can utilize the services provides by the API to speed up the development process. 
You can modify the API to cater your requirements at your own risk. 
 
-----------------------------------------------------------------------------------------------------------------------------------
Authors: H.L.M.M De Silva, K.V.M Jayadewa, G.A.R Perera, S.I Kodithuwakku
Supervisor: Dr. Koliya Pulasinghe | Dean /Faculty of Graduate Studies |SLIIT
Co-Supervisor: Mr.Indraka Udayakumara | Senior Lecturer | SLIIT
URL: https://sites.google.com/a/my.sliit.lk/his
----------------------------------------------------------------------------------------------------------------------------------
*/

package lib.driver.finance.driver_class;

import java.sql.Date;
import java.util.Iterator;
import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.finance.HisFinPayment;
import core.classes.finance.HisFinReceipt;
import lib.classes.DBDriverBase.*;

/**
 * The class provides all the relavent operations that is requied to handle cash out flows of a system 
 * Class is heherited from the base call DBDriver which is an abstract class
 * @author Vishwa Maduanka
 * @version 1.0
 */

public class PaymentDBDriver extends DBDriverBase<HisFinPayment> {
	
	Session session = SessionFactoryUtil.getSessionFactory().getCurrentSession();
	//this is a tempory session 
	
	/***
	 * Method is used to inset the payment details of particular transaction which accept the payment object as the param
	 * @param HisFinPayment object
	 * @return Boolean
	 */
	public Boolean addPayments(HisFinPayment payment) 
	{
		
		if(save(payment))
			return true;
		else
			return false;
	}
	
	/***
	 * Method gets the details of a particular payment as the param as updates the details in the data base.
	 * @param payment object
	 * @return Boolean  
	 */
	public Boolean updatePayment(HisFinPayment payment)
	{
		if(update(payment))
			return true;
		else
			return false;
	}
	
	/***
	 * Method gets the payment detils which is to be deleted as the param and delete it in the data base.
	 * @param payment object
	 * @return Boolean 
	 */
	public Boolean deletePayment(HisFinPayment payment)
	{
		if(delete(payment))
			return true;
		else
			return false;
	}
	
	/***
	 * Method gets the payment Id of a particular payment and delete
	 * @param pay_Id Integer
	 * @return Boolean
	 */
	public Boolean deletePayment(int pay_Id)
	{
		Transaction tx = null;
		tx = session.beginTransaction();
		Query query = session.createQuery("delete p from HisFinPayment as p where p.payId = :PAY_ID");
		query.setParameter("PAY_ID",pay_Id);
		tx.commit();
		return true;
	}
	
	/***
	 * Method returns the list of payment details 
	 * @return Boolean List<HisFinPayment>
	 */
	@SuppressWarnings("unchecked")
	public List<HisFinPayment> getPayments()
	{
		Transaction tx = null;
		tx = session.beginTransaction();
		Query query =  session.createQuery("select p from HisFinPayment as p ");
		List<HisFinPayment> paymentList = query.list();
		tx.commit();
		return paymentList;
	}
	
	
	/***
	 * Method retrieve the payment details of particular voucher NO
	 * @param voucher Number
	 * @return HisFinPayment
	 */
	@SuppressWarnings("rawtypes")
	public HisFinPayment getPayment(int voucher)
	{
		Transaction tx = null;
		tx = session.beginTransaction();
		Query query = session.createQuery("select p from HisFinPayment as p where p.payVoucherNo = :voucher");
		query.setParameter("voucher", voucher);
		List paymentList = query.list();
		HisFinPayment payment = new HisFinPayment();
		for(Iterator iter = paymentList.iterator(); iter.hasNext();)
		{
			payment = (HisFinPayment)iter.next();
		}
		tx.commit();
		return payment;
	
	}
	/***
	 * Method retrieve the payment details for the given time period
	 * @param voucher Number
	 * @return List<HisFinPayment>
	 */
	
	@SuppressWarnings("unchecked")
	public List<HisFinPayment> getPayment(Date from,Date to){
		Transaction tx = null;
		tx = session.beginTransaction();
		
		Query query = session.createQuery("select p from HisFinPayment as p where p.payDateOfTranx > :FROM and p.payDateOfTranx < :TO");
		query.setParameter("FROM", from);
		query.setParameter("TO", to);
		List<HisFinPayment> paymentList = query.list();
		tx.commit();
		return paymentList;
	}
	
	public String getTotalPayment(){
		
		Transaction tx = null;
		tx = session.beginTransaction();
		String totalAmt = String.valueOf(session.createQuery("select sum(p.payTotal) as Total from HisFinPayment as p").list().get(0));
		tx.commit();
		return totalAmt;
		
		
	}
	
	public double getTotalPayment(Date from,Date to){
		Transaction tx = null;
		tx = session.beginTransaction();
		Query query = session.createQuery("select p from HisFinPayment as p where p.payDateOfTranx between :FROM and :TO");
		query.setParameter("FROM", from);
		query.setParameter("TO", to);
		double totalAmt = Double.parseDouble(query.toString());
		tx.commit();
		return totalAmt;
	}
}
