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
import core.classes.opd.Allergy;
import core.classes.opd.OutPatient;
import core.classes.opd.Patient;



public class clinic_visitDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().getCurrentSession();
	
	public boolean saveclinic_visit(clinic_visit objclinic_visit,int userid, int pID){
		Transaction tx=null;
		
		try {
			Calendar currentDate = Calendar.getInstance();
			tx = session.beginTransaction();
			Patient objPatientt = (Patient) session.get(Patient.class, pID);
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid);
			objclinic_visit.setClinic_visit_createuser(user);
			//objclinic_patient_attachment.setClinic_visit_date(currentDate.getTime());
			
			objclinic_visit.setPatient(objPatientt);
			session.save(objclinic_visit);
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
	
	
	public boolean updateclinic_visit(clinic_visit objclinic_visit,int userid){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			clinic_visit obj2clinic_visit=(clinic_visit) session.get(clinic_visit.class, objclinic_visit.getClinic_visit_id());

			obj2clinic_visit.setClinic_visit_type(objclinic_visit.getClinic_visit_type());			
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid); 
			obj2clinic_visit.setClinic_visit_createuser(user);
			Patient objPatientt = (Patient) session.get(Patient.class, userid);
			obj2clinic_visit.setPatient((objclinic_visit.getPatient()));
			obj2clinic_visit.setClinic_visit_date((objclinic_visit.getClinic_visit_date()));
			session.update(obj2clinic_visit);
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
	
	
	public List<clinic_visit> retrieveclinic_visitclinic_visit_id(int pID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("Select a from clinic_visit as a where a.clinic_visit_id=:clinic_visit_id ");
			query.setParameter("clinic_visit_id", pID);
			List<clinic_visit> aList = castList(clinic_visit.class,query.list());
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
	//patient
	
	public List<clinic_visit> retrieveclinic_visitbypatient(int pID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Patient objclinic_visit = (Patient) session.get(Patient.class, pID);
			Query query = session.createQuery("Select a from clinic_visit as a where a.patient=:patient ");
			query.setParameter("patient", objclinic_visit);
			List<clinic_visit> aList = castList(clinic_visit.class,query.list());
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
