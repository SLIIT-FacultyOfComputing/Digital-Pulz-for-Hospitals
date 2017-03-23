package lib.driver.inward.driver_class.prescription;

import java.util.List;

import lib.SessionFactoryUtil;
import lib.classes.CasttingMethods.CastList;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;
import core.classes.inward.prescription.PrescriptionTerms;
import core.classes.inward.prescription.TempPrescribe;
import core.classes.pharmacy.MstDrugsNew;

public class TempPrescribeDBDrive {
	Session session = SessionFactoryUtil.getSessionFactory().openSession();	
	
	public boolean addNewPrescrptionItem(TempPrescribe term,int drug_id, int term_id) {

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
			else if(tx == null)
			{
				throw ex;
				
			}
			else{
				return false;
			}
		}
		
		
	}
	
	public boolean UpdatePrescrptionItem( int auto_id,int dose,String frequency) {
		Transaction tx=null;
				
				try{
					System.out.println("AGAIN "+auto_id+","+dose+","+frequency);
					tx=session.beginTransaction();
					
					TempPrescribe adm=new TempPrescribe();
					adm=(TempPrescribe) session.get(TempPrescribe.class,auto_id);
				
					adm.setDose(dose);
					adm.setFrequency(frequency);	
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
	
	public List<TempPrescribe> getPrescrptionItemsByTermID(int term_id) {
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select i from TempPrescribe as i where i.term_id.term_id=:term_id");
			query.setParameter("term_id", term_id);
			List<TempPrescribe> list =CastList.castList(TempPrescribe.class, query.list()); 
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
	
	public boolean deleteTempPrescription(TempPrescribe temp)
	{
		Transaction tx=null;
		
	try {
			
			tx=session.beginTransaction();
			session.delete(temp);
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
	
}
