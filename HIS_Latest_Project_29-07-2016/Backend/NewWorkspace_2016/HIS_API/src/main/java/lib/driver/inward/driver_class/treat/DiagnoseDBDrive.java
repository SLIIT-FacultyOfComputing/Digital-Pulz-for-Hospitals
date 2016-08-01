package lib.driver.inward.driver_class.treat;

import java.util.List;

import lib.SessionFactoryUtil;
import lib.classes.CasttingMethods.CastList;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.api.user.AdminUser;
import core.classes.inward.WardAdmission.Admission;
import core.classes.inward.treat.Diagnose;


public class DiagnoseDBDrive {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();	

	public boolean addDiagnose(Diagnose term,String bht_no, int user) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			
			
			
			AdminUser userobj = (AdminUser) session.get(AdminUser.class, user);
			term.setCreate_user(userobj);
									
			Admission ad=(Admission) session.get(Admission.class, bht_no);
			term.setBht_no(ad);
						
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
	
	public List<Diagnose> getDiagnoseByBHTNo(String bhtNo) {
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select i from Diagnose as i where i.bht_no.bhtNo=:bhtNo");
			query.setParameter("bhtNo", bhtNo);
			List<Diagnose> list =CastList.castList(Diagnose.class, query.list()); 
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
