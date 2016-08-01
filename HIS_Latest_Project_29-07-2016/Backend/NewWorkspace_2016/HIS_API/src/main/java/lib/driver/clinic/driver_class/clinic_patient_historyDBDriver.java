package lib.driver.clinic.driver_class;

import java.util.ArrayList;
import java.util.Collection;
import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.api.user.AdminUser;
import core.classes.clinic.clinic_patient_history;
import core.classes.clinic.clinic_patient_treatment;
import core.classes.clinic.clinic_visit;
import core.classes.opd.Allergy;
import core.classes.opd.OutPatient;



public class clinic_patient_historyDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().getCurrentSession();
	
	public boolean saveclinic_patient_history(clinic_patient_history objclinic_patient_history,int userid, int pID){
		Transaction tx=null;
		
		try {
			tx = session.beginTransaction();
			clinic_visit objclinic_visit = (clinic_visit) session.get(clinic_visit.class, pID);
			clinic_patient_treatment objclinic_patient_treatment = (clinic_patient_treatment) session.get(clinic_patient_treatment.class, pID);
						
			objclinic_patient_history.setClinic_visit_id(objclinic_visit);			
			objclinic_patient_history.setTreatment(objclinic_patient_treatment);
			
			session.save(objclinic_patient_history);
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
	
	
	public boolean updateclinic_patient_history(clinic_patient_history objclinic_patient_history,int userid){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			clinic_patient_history obj2clinic_patient_history=(clinic_patient_history) session.get(clinic_patient_history.class, objclinic_patient_history.getClinic_history_ID());

			obj2clinic_patient_history.setClinic_visit_id(objclinic_patient_history.getClinic_visit_id());
			obj2clinic_patient_history.setTreatment(objclinic_patient_history.getTreatment());					
			
			session.update(obj2clinic_patient_history);
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
	
	
	public List<clinic_patient_history> retrieveclinic_patient_historysBytreatment(int pID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			clinic_patient_treatment objclinic_patient_treatment = (clinic_patient_treatment) session.get(clinic_patient_treatment.class, pID);
			Query query = session.createQuery("Select a from clinic_patient_history as a where a.treatment=:treatment ");
			query.setParameter("treatment", objclinic_patient_treatment);
			List<clinic_patient_history> aList = castList(clinic_patient_history.class,query.list());
			tx.commit();
			return aList;
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
	
	
	public List<clinic_patient_history> retrieveclinic_patient_historybyclinic_history_ID(int aID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			String hql="select a from clinic_patient_history as a where a.clinic_history_ID=:aID";
			Query query = session.createQuery(hql);
			query.setParameter("aID", aID);
			List<clinic_patient_history> clinic_patient_historyList=castList(clinic_patient_history.class, query.list());
			tx.commit();
			return clinic_patient_historyList;
			
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
	
	 
	
	
	public static <T> List<T> castList(Class<? extends T> clazz, Collection<?> c) {
	    List<T> r = new ArrayList<T>(c.size());
	    for(Object o: c)
	      r.add(clazz.cast(o));
	    return r;
	}
	
	
}
