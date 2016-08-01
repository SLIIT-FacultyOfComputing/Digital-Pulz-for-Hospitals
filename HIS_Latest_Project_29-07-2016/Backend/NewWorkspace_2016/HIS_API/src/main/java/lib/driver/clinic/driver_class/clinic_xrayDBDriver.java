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
import core.classes.clinic.clinic_visit;
import core.classes.clinic.clinic_xray;
import core.classes.opd.Allergy;
import core.classes.opd.OutPatient;



public class clinic_xrayDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().getCurrentSession();
	
	public boolean saveclinic_xray(clinic_xray objclinic_xray,int userid, int pID){
		Transaction tx=null;
		
		try {
			Calendar currentDate = Calendar.getInstance();
			tx = session.beginTransaction();
			clinic_visit objclinic_visit = (clinic_visit) session.get(clinic_visit.class, pID);
			
			//objclinic_patient_attachment.setCreate_date(currentDate.getTime());
			
			objclinic_xray.setClinic_visit_id(objclinic_visit);
			session.save(objclinic_xray);
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
	
	
	public boolean updateclinic_xray(clinic_xray objclinic_xray,int userid){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			clinic_xray obj2clinic_xray=(clinic_xray) session.get(clinic_xray.class, objclinic_xray.getXray_id());
			obj2clinic_xray.setClinic_patient_name(objclinic_xray.getClinic_patient_name());
			obj2clinic_xray.setClinic_problem(objclinic_xray.getClinic_problem());
			obj2clinic_xray.setClinic_image(objclinic_xray.getClinic_image());//clinic_remarks			
			obj2clinic_xray.setClinic_remarks(objclinic_xray.getClinic_remarks()  );
			session.update(obj2clinic_xray);
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
	
	
	public List<clinic_xray> retrieveclinic_xraybyxray_id(int pID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("Select a from clinic_xray as a where a.xray_id=:xray_id ");
			query.setParameter("xray_id", pID);
			List<clinic_xray> aList = castList(clinic_xray.class,query.list());
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
	
	
	public List<clinic_xray> retrieveclinic_xraybyclinic_visit_id(int pID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			clinic_visit objclinic_visit = (clinic_visit) session.get(clinic_visit.class, pID);
			Query query = session.createQuery("Select a from clinic_xray as a where a.clinic_visit_id=:clinic_visit_id ");
			query.setParameter("clinic_visit_id", objclinic_visit);
			List<clinic_xray> aList = castList(clinic_xray.class,query.list());
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
