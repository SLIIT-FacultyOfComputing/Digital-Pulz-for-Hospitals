package lib.driver.inward.driver_class.WardAdmission;

import java.util.List;
import lib.SessionFactoryUtil;
import lib.classes.CasttingMethods.CastList;
import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;
import core.classes.inward.WardAdmission.WardAdmission;




public class WardAdmissionDBDriver {
	
	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public boolean insertWardAdmission(WardAdmission admission) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			session.save(admission);
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
	
	
	public List<WardAdmission> getWardAdmissionList() {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select w from WardAdmission as w");
			@SuppressWarnings("unchecked")
			List<WardAdmission> wardlist = query.list();
			tx.commit();
			return wardlist;
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
	
	
	public List<WardAdmission> getWardAdmissionDetails(String bhtNo){
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select u from WardAdmission as u where u.bhtNo=:bhtNo");
			query.setParameter("bhtNo", bhtNo);
			List<WardAdmission> wardList =CastList.castList(WardAdmission.class, query.list()); 
			tx.commit();
			return wardList;
			
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
	
	
	public List<WardAdmission> getWardAdmissionByPatientID(int patientID){
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select u from WardAdmission as u where u.patientID=:patientID");
			query.setParameter("patientID", patientID);
			List<WardAdmission> wardList =CastList.castList(WardAdmission.class, query.list()); 
			tx.commit();
			return wardList;
			
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
