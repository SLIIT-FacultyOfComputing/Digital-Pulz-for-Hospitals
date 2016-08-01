package lib.driver.clinic.driver_class;

import java.sql.Date;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Collection;
import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.api.user.AdminUser;
import core.classes.clinic.clinic_patient_attachment;
import core.classes.clinic.clinic_patient_queue;
import core.classes.clinic.clinic_visit;
import core.classes.opd.Allergy;
import core.classes.opd.OutPatient;



public class clinic_patient_queueDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().getCurrentSession();
	
	public boolean saveclinic_patient_queue(clinic_patient_queue objclinic_patient_queue,int userid, int pID){
		Transaction tx=null;
		
		try {
			Calendar currentDate = Calendar.getInstance();
			tx = session.beginTransaction();
			clinic_visit objclinic_visit = (clinic_visit) session.get(clinic_visit.class, pID);
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid); 
			objclinic_patient_queue.setClinic_queue_assign_by(user);
			objclinic_patient_queue.setClinic_visit_id(objclinic_visit);
			session.save(objclinic_patient_queue);
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
	
	
	public boolean updateclinic_patient_queue(clinic_patient_queue objclinic_patient_queue,int userid){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			clinic_patient_queue obj2clinic_patient_queue=(clinic_patient_queue) session.get(clinic_patient_queue.class, objclinic_patient_queue.getClinic_queue_token_no());
			obj2clinic_patient_queue.setClinic_visit_type(objclinic_patient_queue.getClinic_visit_type());
			obj2clinic_patient_queue.setClinic_queue_status(objclinic_patient_queue.getClinic_queue_status());	
			obj2clinic_patient_queue.setClinic_queue_assign_date(objclinic_patient_queue.getClinic_queue_assign_date());
			clinic_visit objclinic_visit = (clinic_visit) session.get(clinic_visit.class, userid); 
			obj2clinic_patient_queue.setClinic_visit_id(objclinic_visit);
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid); 
			obj2clinic_patient_queue.setClinic_queue_assign_by(user);
			session.update(obj2clinic_patient_queue);
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
	
	
	public List<clinic_patient_queue> retrieveclinic_patient_queueclinic_queue_token_no(int pID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("Select a from clinic_patient_queue as a where a.clinic_queue_token_no=:clinic_queue_token_no ");
			query.setParameter("clinic_queue_token_no", pID);
			List<clinic_patient_queue> aList = castList(clinic_patient_queue.class,query.list());
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
	
	
	public List<clinic_patient_queue> retrieveclinic_patient_queue(){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();			
			Query query = session.createQuery("Select a from clinic_patient_queue as a ");
			List<clinic_patient_queue> aList = castList(clinic_patient_queue.class,query.list());
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
	
	
	public static <T> List<T> castList(Class<? extends T> clazz, Collection<?> c) {
	    List<T> r = new ArrayList<T>(c.size());
	    for(Object o: c)
	      r.add(clazz.cast(o));
	    return r;
	}
	
	
}
