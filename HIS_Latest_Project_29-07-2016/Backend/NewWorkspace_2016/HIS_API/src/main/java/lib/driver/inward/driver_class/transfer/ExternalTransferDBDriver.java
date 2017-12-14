package lib.driver.inward.driver_class.transfer;

import java.util.List;

import lib.SessionFactoryUtil;
import lib.classes.CasttingMethods.CastList;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.inward.transfer.ExternalTransfer;

public class ExternalTransferDBDriver {
	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public List<ExternalTransfer> getAllExternalTransfers(){
		
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select e from ExternalTransfer as e");
			@SuppressWarnings("unchecked")
			List<ExternalTransfer> transfers = query.list();
			tx.commit();
			return transfers;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if(tx == null)
			{
				throw ex;
			}
			else{
				return null;
			}
		}
	}
	
	public boolean insertTransfer(ExternalTransfer transfer) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			session.save(transfer);
			tx.commit();
			return true;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if(tx == null)
			{
				throw ex;
			}
			else{
				return false;
			}
		}

	}
	
	public List<ExternalTransfer> getExternalTransferByBHT(String bhtNo){
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select e from ExternalTransfer as e where e.bhtNo=:bhtNo");
			query.setParameter("bhtNo", bhtNo);
			List<ExternalTransfer> transferList =CastList.castList(ExternalTransfer.class, query.list()); 
			tx.commit();
			return transferList;
			
		}
		catch(RuntimeException ex){
			if(tx != null && tx.isActive())
			{
				try{
					tx.rollback();
				}catch(HibernateException he){
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if(tx == null)
			{
				throw ex;
			}
			else{
				return null;
			}
		}
	}
	
	
		
	
	

}
