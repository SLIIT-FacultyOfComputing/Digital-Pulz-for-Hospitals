package lib.driver.pcu.driver_class;

import java.sql.Date;
import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;


import core.classes.pcu.PcuItembatch;
import core.classes.pcu.PcuItems;


public class PcuItemBatchDBDriver {
	
	Session session=SessionFactoryUtil.getSessionFactory().openSession();
	
	public List<PcuItembatch> GetAllItems() {
		
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("from PcuItembatch as p");
			List<PcuItembatch> ItemList = query.list();
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
	public boolean UpdateItems(int BNO,Date rcvdDate)
	{
		Transaction tx = null;
		boolean status=false;
		
		try{
			Object object = session.load(PcuItembatch.class, BNO);
			PcuItembatch item = (PcuItembatch) object;			
			
			System.out.println("Updating Item details ");
			tx = session.beginTransaction();
			item.setRecievedDate(rcvdDate);
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
	public boolean DeleteItems(int BNO)
	{
		Transaction tx = null;
		boolean status=false;
		
		try{
			Object object = session.load(PcuItembatch.class, BNO);
			PcuItembatch item = (PcuItembatch) object;			
			
			System.out.println("Updating Item details ");
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
