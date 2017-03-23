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
import core.classes.inward.prescription.InwardNurseNote;
import core.classes.inward.prescription.PrescriptionTerms;


public class InwardNurseNoteDBDrive {
Session session = SessionFactoryUtil.getSessionFactory().openSession();	
	
	public boolean addNewInwardNurseNote(InwardNurseNote term,int createUser, String bhtNo) {

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
			else if(tx == null)
			{
				throw ex;
			}
			else
			{
				return false;
			}
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
					else if(tx == null)
					{
						throw ex;
					}
					else
					{
						return false;
					}
				}
			}
	
	public List<InwardNurseNote> getInwardNurseNoteByBHTNo(String bhtNo) {
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select i from InwardNurseNote as i where i.bht_no.bhtNo=:bhtNo");
			query.setParameter("bhtNo", bhtNo);
			List<InwardNurseNote> list =CastList.castList(InwardNurseNote.class, query.list()); 
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
			else if(tx == null)
			{
				throw ex;
			}
			else
			{
				return null;
			}
		}
	}
	
	public List<InwardNurseNote> getNurseNote() {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select w from InwardNurseNote as w");
			@SuppressWarnings("unchecked")
			List<InwardNurseNote> notelist = query.list();
			tx.commit();
			return notelist;
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
			else
			{
				return null;
			}
		}
	}
	
	
}
