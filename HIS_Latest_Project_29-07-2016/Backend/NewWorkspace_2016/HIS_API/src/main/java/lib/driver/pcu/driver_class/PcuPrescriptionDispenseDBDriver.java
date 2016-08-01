package lib.driver.pcu.driver_class;

import java.sql.Date;
import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;
import org.hibernate.engine.jdbc.spi.SqlExceptionHelper;
import org.hibernate.exception.ConstraintViolationException;

import com.mysql.jdbc.exceptions.jdbc4.MySQLIntegrityConstraintViolationException;

import core.classes.pcu.PcuItembatchrelation;
import core.classes.pcu.PcuItembatchrelationId;
import core.classes.pcu.PcuPrescription;
import core.classes.pcu.PcuPrescriptiondispense;
import core.classes.pcu.PcuPrescriptiondispenseId;
import core.classes.pcu.PcuPrescriptionitems;


public class PcuPrescriptionDispenseDBDriver {
	
	Session session=SessionFactoryUtil.getSessionFactory().openSession();
	
		public List<PcuPrescription> GetPrescriptionByAdmition(int ID) {
				
				Transaction tx = null;
				try {
					tx = session.beginTransaction();
					Query query = session.createQuery("FROM PcuPrescription as p where pcuPatientId="+ID);
					List<PcuPrescription> ItemList = query.list();
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
		
		public List<PcuPrescriptionitems> GetPrescriptionItemsByPrescription(int ID) {
						
			
			Transaction tx = null;
			try {
				tx = session.beginTransaction();
				Query query = session.createQuery("FROM PcuPrescriptionitems as p where p.id.prescriptionId="+ID);
				List<PcuPrescriptionitems> ItemList = query.list();
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
		
		public String DispenseDrugsPrescriptions(int ID,int userID) {
			
			String status = "";
			
			Transaction tx = null;
			try {
				tx = session.beginTransaction();
					           
	                Query query = session.createSQLQuery(
	                        "CALL PCU_PrescribedItemDispenseSp(:id,:userid)");
	                query.setParameter("id", ID);
	                query.setParameter("userid", userID);
	                query.executeUpdate();
	              
	                //session.flush();
	            
	            tx.commit();
	           
	            
	            status = "Successfully Dispensed!!!";

			} catch (ConstraintViolationException e){
				status = "Prescription has already dispensed";
			
			}catch (HibernateException e) {
				status = e.toString();
				System.out.print(e.toString());      
				e.printStackTrace();
				if (session.getTransaction() != null) {
					session.getTransaction().rollback();
					
				}
			} finally {
				// session.close();
				
			}
			return status;
		}
		
		public List<PcuPrescriptiondispense> GetPrescriptionDispensedItems() {
			
			Transaction tx = null;
			try {
				tx = session.beginTransaction();
				Query query = session.createQuery("FROM PcuPrescriptiondispense as p");
				List<PcuPrescriptiondispense> ItemList = query.list();
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
		public boolean UpdatePrescrriptionDispensedItems(int SNO,int PID,int DISBY,float QTY,Date disDate)
		{
			Transaction tx = null;
			boolean status=false;
			
			try{
				PcuPrescriptiondispenseId itemID = new PcuPrescriptiondispenseId();
				itemID.setPrescriptionId(PID);
				itemID.setSNumber(SNO);
				Object object = session.load(PcuPrescriptiondispense.class, itemID);
				PcuPrescriptiondispense item = (PcuPrescriptiondispense) object;			
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
		
		public boolean DeleteItems(int SNO,int PID)
		{
			Transaction tx = null;
			boolean status=false;
			
			try{
				PcuPrescriptiondispenseId itemID = new PcuPrescriptiondispenseId();
				itemID.setPrescriptionId(PID);
				itemID.setSNumber(SNO);
				
				Object object = session.load(PcuPrescriptiondispense.class, itemID);
				PcuPrescriptiondispense item = (PcuPrescriptiondispense) object;			
				
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
