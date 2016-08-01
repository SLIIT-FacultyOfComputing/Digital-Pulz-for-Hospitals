package lib.driver.pcu.driver_class;

import java.sql.Date;
import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;




import core.classes.pcu.PcuManualdispense;
import core.classes.pcu.PcuRequesteditems;

public class PcuItemRequestDBDriver {
	
	Session session=SessionFactoryUtil.getSessionFactory().openSession();

	
public boolean RequestDrug(int SNO,float QTY,int user) {
		
		boolean status = false;
		
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
				           
                Query query = session.createSQLQuery(
                        "CALL PCU_ItemRequestSp(:qty,:SNo,:userid)");                
                query.setParameter("SNo", SNO);
                query.setParameter("qty", QTY);
                query.setParameter("userid", user);
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

public List<PcuRequesteditems> GetRequestedItems() {
		
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("FROM PcuRequesteditems as p");
			List<PcuRequesteditems> ItemList = query.list();
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

public boolean UpdateRequestedItems(int ID,int REQBY,Date reqDate,String stat)
{
	Transaction tx = null;
	boolean status=false;
	
	try{
		
		Object object = session.load(PcuRequesteditems.class, ID);
		PcuRequesteditems item = (PcuRequesteditems) object;			
		System.out.println("Name: " +item.getId());
		
		System.out.println("Updating Item details ");
		System.out.println(reqDate);
		tx = session.beginTransaction();
		
		System.out.println(stat);				
		item.setRequestedBy(REQBY);
		item.setRequestedDate(reqDate);
		item.setStatus(stat);
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
		
		
		Object object = session.load(PcuRequesteditems.class, ID);
		PcuRequesteditems item = (PcuRequesteditems) object;			
		
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
