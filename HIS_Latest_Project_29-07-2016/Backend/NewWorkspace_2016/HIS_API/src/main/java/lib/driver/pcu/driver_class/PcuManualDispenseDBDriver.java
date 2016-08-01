package lib.driver.pcu.driver_class;

import java.sql.Date;
import java.util.List;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.pcu.PcuManualdispense;
import core.classes.pcu.PcuPrescriptiondispense;
import core.classes.pcu.PcuPrescriptiondispenseId;
import flexjson.JSONSerializer;

public class PcuManualDispenseDBDriver {
	
	Session session=SessionFactoryUtil.getSessionFactory().openSession();
	
	public boolean DispenseDrugsManual(int AID,int SNO,float QTY,int userID) {
		
		boolean status = false;
		
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
				           
                Query query = session.createSQLQuery(
                        "CALL PCU_ManualItemDispenseSp(:aid,:qty,:sno,:userid)");
                query.setParameter("aid", AID);
                query.setParameter("sno", SNO);
                query.setParameter("qty", QTY);
                query.setParameter("userid", userID);
                query.executeUpdate();
                       
                //session.flush();
            
            tx.commit();
           
            
            status = true;

		} catch (HibernateException e) {
			status = false;
			e.printStackTrace();
			if (session.getTransaction() != null) {
				session.getTransaction().rollback();
				
			}
		} finally {
			// session.close();
		}
		return status;
	}
	
	public List<PcuManualdispense> GetManuallyDispensedItems() {
		
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("FROM PcuManualdispense as p");
			List<PcuManualdispense> ItemList = query.list();
			tx.commit();
			return ItemList;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return null;
		}
	}
	public boolean UpdateManuallyDispensedItems(int ID,int DISBY,float QTY,Date disDate)
	{
		Transaction tx = null;
		boolean status=false;
		
		try{
			
			Object object = session.load(PcuManualdispense.class, ID);
			PcuManualdispense item = (PcuManualdispense) object;			
			System.out.println("Name: " +item.getDispensedDate());
			
			System.out.println("Updating Item details ");
			tx = session.beginTransaction();
			
							
			item.setQuanity(QTY);
			item.setDispensedDate(disDate);
			item.setDispensedBy(DISBY);
			session.update(item);
			
			tx.commit();
			status = true;
		}
		catch(Exception e)
		{
			e.printStackTrace();
			
		}
		return status;
	}
	public boolean DeleteItems(int ID)
	{
		Transaction tx = null;
		boolean status=false;
		
		try{
			
			
			Object object = session.load(PcuManualdispense.class, ID);
			PcuManualdispense item = (PcuManualdispense) object;			
			
			System.out.println("Deleting Item ");
			tx = session.beginTransaction();			
			session.delete(item);
			tx.commit();
			status = true;
		}
		catch(Exception e)
		{
			e.printStackTrace();
			
		}
		return status;
	}

}
