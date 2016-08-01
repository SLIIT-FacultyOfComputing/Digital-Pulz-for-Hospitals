package lib.driver.inward.driver_class.prescription;

import java.util.Date;
import java.util.List;

import lib.SessionFactoryUtil;
import lib.classes.CasttingMethods.CastList;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.api.user.AdminUser;
import core.classes.inward.WardAdmission.Admission;
import core.classes.inward.prescription.PrescriptionTerms;

public class PrescriptionTermsDBDrive {
Session session = SessionFactoryUtil.getSessionFactory().openSession();	
	
	public boolean addNewTermPrescrption(PrescriptionTerms term,int createUser, String bhtNo) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			
			
			
			AdminUser creuser = (AdminUser) session.get(AdminUser.class, createUser);
			term.setCreate_user(creuser);
									
			Admission bht=(Admission) session.get(Admission.class, bhtNo);
			term.setBht_no(bht);
						
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
	
	public boolean UpdateTermPrescrption( int term_id,Date end_date) {
		Transaction tx=null;
				
				try{
					
					tx=session.beginTransaction();
					
					PrescriptionTerms adm=new PrescriptionTerms();
					adm=(PrescriptionTerms) session.get(PrescriptionTerms.class,term_id);
					
					adm.setEnd_date(end_date);
				
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
	
	public List<PrescriptionTerms> getPrescrptionTermsByBHTNo(String bhtNo) {
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select i from PrescriptionTerms as i where i.bht_no.bhtNo=:bhtNo ORDER BY i.no_of_terms DESC");
			query.setParameter("bhtNo", bhtNo);
			List<PrescriptionTerms> list =CastList.castList(PrescriptionTerms.class, query.list()); 
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
