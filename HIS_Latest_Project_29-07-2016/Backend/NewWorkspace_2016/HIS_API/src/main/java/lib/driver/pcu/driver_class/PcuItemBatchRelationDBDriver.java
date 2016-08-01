package lib.driver.pcu.driver_class;

import java.sql.Date;
import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.pcu.PcuItembatchrelation;
import core.classes.pcu.PcuItembatchrelationId;
import core.classes.pcu.PcuItems;


public class PcuItemBatchRelationDBDriver {
	
	Session session=SessionFactoryUtil.getSessionFactory().openSession();
	
	public List<PcuItembatchrelation> GetAllItems() {
		
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("from PcuItembatchrelation as p");
			List<PcuItembatchrelation> ItemList = query.list();
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
	public boolean UpdateItems(int SNO,int newBNO,int BNO,float QTY,Date expiryDate)
	{
		Transaction tx = null;
		boolean status=false;
		
		try{
			PcuItembatchrelationId itemID = new PcuItembatchrelationId();
			itemID.setBatchNo(BNO);
			itemID.setSNumber(SNO);
			Object object = session.load(PcuItembatchrelation.class, itemID);
			PcuItembatchrelation item = (PcuItembatchrelation) object;			
			System.out.println("Name: " +item.getExpiryDate());
			
			System.out.println("Updating Item details ");
			tx = session.beginTransaction();
			
			PcuItembatchrelationId newitemID = item.getId();
			System.out.println(newitemID.getBatchNo());
			newitemID.setBatchNo(newBNO);
			
			item.setQuantity(QTY);
			item.setExpiryDate(expiryDate);			
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
	public boolean DeleteItems(int SNO,int BNO)
	{
		Transaction tx = null;
		boolean status=false;
		
		try{
			PcuItembatchrelationId itemID = new PcuItembatchrelationId();
			itemID.setBatchNo(BNO);
			itemID.setSNumber(SNO);
			
			Object object = session.load(PcuItembatchrelation.class, itemID);
			PcuItembatchrelation item = (PcuItembatchrelation) object;			
			
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
