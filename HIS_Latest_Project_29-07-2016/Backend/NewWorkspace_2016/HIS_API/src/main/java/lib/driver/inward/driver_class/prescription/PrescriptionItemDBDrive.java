package lib.driver.inward.driver_class.prescription;

import java.util.List;

import lib.SessionFactoryUtil;
import lib.classes.CasttingMethods.CastList;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.inward.prescription.PrescriptionItem;
import core.classes.inward.prescription.PrescriptionTerms;
import core.classes.pharmacy.MstDrugsNew;

public class PrescriptionItemDBDrive {
	
	Session session = SessionFactoryUtil.getSessionFactory().openSession();	

	public boolean addNewPrescrptionItem(PrescriptionItem term,int drug_id, int term_id) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			
			
			
			MstDrugsNew Drug = (MstDrugsNew) session.get(MstDrugsNew.class, drug_id);
			term.setDrug_id(Drug);
									
			PrescriptionTerms ter=(PrescriptionTerms) session.get(PrescriptionTerms.class, term_id);
			term.setTerm_id(ter);
						
			session.save(term);
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
			return false;
		}
		
		
	}
	
	public boolean UpdatePrescrptionItem( int auto_id,int dose,String frequency,String status) {
		Transaction tx=null;
				
				try{
					PrescriptionItem adm=new PrescriptionItem();
					adm=(PrescriptionItem) session.get(PrescriptionItem.class,auto_id);
					tx=session.beginTransaction();
					if(!status.equals("omit")){
						adm.setDose(dose);
						adm.setFrequency(frequency);
						adm.setStatus(status);
					}else{
						adm.setStatus(status);
					}
					
					
					
				
					session.update(adm);
					
					tx.commit();
					return true;
				}
				
				catch (RuntimeException ex) {
					if(tx != null && tx.isActive()){
						try{
							tx.rollback();
						}catch(HibernateException he){
							System.err.println("Error rolling back transaction");
						}
						throw ex;
					}
					return false;
				}
			}
	
	public List<PrescriptionItem> getPrescrptionItemsByBHTNo(String bhtNo) {
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select i from PrescriptionItem as i where i.term_id.bht_no.bhtNo=:bhtNo");
			query.setParameter("bhtNo", bhtNo);
			List<PrescriptionItem> list =CastList.castList(PrescriptionItem.class, query.list()); 
			tx.commit();
			return list;
			
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
			return null;
		}
	}
	
	
	public List<PrescriptionItem> getPrescrptionItemsByTermID(int term_id) {
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select i from PrescriptionItem as i where i.term_id.term_id=:term_id");
			query.setParameter("term_id", term_id);
			List<PrescriptionItem> list =CastList.castList(PrescriptionItem.class, query.list()); 
			tx.commit();
			return list;
			
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
			return null;
		}
	}
	
}
