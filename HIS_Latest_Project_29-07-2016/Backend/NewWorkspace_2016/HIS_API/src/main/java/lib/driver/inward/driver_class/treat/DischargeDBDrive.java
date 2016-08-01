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

import core.classes.inward.treat.Discharge;


public class DischargeDBDrive {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();	

	public boolean addDischarge(Discharge term,String bht_no, int user) {

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
	
	public List<Discharge> getDischargeByBHTNo(String bhtNo) {
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select i from Discharge as i where i.bht_no.bhtNo=:bhtNo");
			query.setParameter("bhtNo", bhtNo);
			List<Discharge> list =query.list();/*
					CastList.castList(Discharge.class, query.list()); */
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
