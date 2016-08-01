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
import core.classes.clinic.clinic_schedule;
import core.classes.clinic.clinic_visit;
import core.classes.opd.Allergy;
import core.classes.opd.OutPatient;



public class clinic_scheduleDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().getCurrentSession();
	
	public boolean saveclinic_schedule(clinic_schedule objclinic_schedule,int userid, int pID){
		Transaction tx=null;
		
		try {
			Calendar currentDate = Calendar.getInstance();
			tx = session.beginTransaction();
			clinic_visit objclinic_visit = (clinic_visit) session.get(clinic_visit.class, pID);			
			//objclinic_patient_attachment.setCreate_date(currentDate.getTime());
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid); 
			objclinic_schedule.setCreate_user(user);
			objclinic_schedule.setClinic_visit_id(objclinic_visit);
			session.save(objclinic_schedule);
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
	
	
	public boolean updateclinic_schedule(clinic_schedule objclinic_schedule,int userid){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			clinic_schedule obj2clinic_patient_attachment=(clinic_schedule) session.get(clinic_schedule.class, objclinic_schedule.getSchedule_id());
			obj2clinic_patient_attachment.setMobile_no(objclinic_schedule.getMobile_no());
			obj2clinic_patient_attachment.setClinic_datetime(objclinic_schedule.getClinic_datetime()  );
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid); 
			obj2clinic_patient_attachment.setCreate_user(user);
			
			session.update(obj2clinic_patient_attachment);
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
	
	
	public List<clinic_schedule> retrieveclinic_scheduleschedule_id(int pID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("Select a from clinic_schedule as a where a.schedule_id=:schedule_id ");
			query.setParameter("schedule_id", pID);
			List<clinic_schedule> aList = castList(clinic_schedule.class,query.list());
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
	
	
	public List<clinic_schedule> retrieveclinic_scheduleclinic_visit_id(int pID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			clinic_visit objclinic_visit = (clinic_visit) session.get(clinic_visit.class, pID);
			Query query = session.createQuery("Select a from clinic_schedule as a where a.clinic_visit_id=:clinic_visit_id ");
			query.setParameter("clinic_visit_id", objclinic_visit);
			List<clinic_schedule> aList = castList(clinic_schedule.class,query.list());
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
