package lib.driver.pcu.driver_class;

import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.pcu.PcuItems;


public class PcuItemsDBDriver {

	Session session=SessionFactoryUtil.getSessionFactory().openSession();
	
	public List<PcuItems> GetAllItemIDs() {
		
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select p.SNumber,p.name from PcuItems as p");
			List<PcuItems> ItemList = query.list();
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
	public List<PcuItems> GetAllItems() {
			
			Transaction tx = null;
			try {
				tx = session.beginTransaction();
				Query query = session.createQuery("from PcuItems as p");
				List<PcuItems> ItemList = query.list();
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
	
	public PcuItems SelectSingle(int itemId) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("FROM PcuItems as p "
					+ "where p.SNumber =" + itemId);
			PcuItems result = (PcuItems) query.list().get(0);
			tx.commit();
			return result;
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
	public boolean UpdateItems(int SNO,float ReOrder,String Measure)
	{
		Transaction tx = null;
		boolean status=false;
		
		try{
			Object object = session.load(PcuItems.class, SNO);
			PcuItems item = (PcuItems) object;			
			System.out.println("Name: " +item.getName());
			System.out.println("Remark: " + item.getRemark());
			//Update Student Details
			System.out.println("Updating Item details ");
			tx = session.beginTransaction();
			item.setReorderLevel(ReOrder);
			item.setMeasurement(Measure);
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
	public boolean DeleteItems(int SNO)
	{
		Transaction tx = null;
		boolean status=false;
		
		try{
			Object object = session.load(PcuItems.class, SNO);
			PcuItems item = (PcuItems) object;			
			
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
