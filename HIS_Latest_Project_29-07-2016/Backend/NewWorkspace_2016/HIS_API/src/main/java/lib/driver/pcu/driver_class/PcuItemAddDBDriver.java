package lib.driver.pcu.driver_class;

import java.nio.channels.SeekableByteChannel;
import java.sql.Date;
import java.util.Iterator;
import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.pcu.PcuItembatchrelation;
import core.classes.pharmacy.MstDrugsNew;


public class PcuItemAddDBDriver {
	
	Session session=SessionFactoryUtil.getSessionFactory().openSession();
	
	public List<MstDrugsNew> GetAllItemIDs() {
			
			Transaction tx = null;
			try {
				tx = session.beginTransaction();
				Query query = session.createQuery("select m.drugSrno,m.drugName from MstDrugsNew as m order by m.drugSrno asc");
				List<MstDrugsNew> ItemList = query.list();
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
	public int GetBatch() {
		
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select MAX(p.batchId) from PcuItembatch as p");
			int no=0;
			for(Iterator it=query.iterate();it.hasNext();)  
			{  
			   no = (int) it.next();  
			   System.out.print("MAX BATCH NUMBER: " + no);  
			 } 		
			tx.commit();
			return no+1;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return -1;
		}
	}
	public boolean AddItems(List<PcuItembatchrelation>  itemList) {
		
		boolean status = false;
		 
		Transaction tx = null;		
		tx = session.beginTransaction();     
		try {
			
            for (PcuItembatchrelation item : itemList) {                
            	
            	                      
                session.setDefaultReadOnly(false);
            	 Query query = session.createSQLQuery(
                         "CALL PCU_LocalItemAddSp(:sno,:qty,:bno,:expiry)");
                 query.setParameter("sno", item.getId().getSNumber());
                 query.setParameter("qty", item.getQuantity());
                 query.setParameter("bno", item.getId().getBatchNo());
                 query.setParameter("expiry", item.getExpiryDate());
                 query.executeUpdate();
                                   
                 session.flush();
                 
                                  
            }
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

}
