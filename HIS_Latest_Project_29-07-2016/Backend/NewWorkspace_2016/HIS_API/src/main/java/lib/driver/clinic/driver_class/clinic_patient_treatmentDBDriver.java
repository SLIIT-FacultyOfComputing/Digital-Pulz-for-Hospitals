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
import core.classes.clinic.clinic_patient_treatment;
import core.classes.clinic.clinic_visit;
import core.classes.opd.Allergy;
import core.classes.opd.OutPatient;
import core.classes.opd.Prescription;



public class clinic_patient_treatmentDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().getCurrentSession();
	
	public boolean saveclinic_patient_treatment(clinic_patient_treatment objclinic_patient_treatment,int userid, int pID){
		Transaction tx=null;
		
		try {
			Calendar currentDate = Calendar.getInstance();
			tx = session.beginTransaction();
			clinic_visit objclinic_visit = (clinic_visit) session.get(clinic_visit.class, pID);
			Prescription objPrescription = (Prescription) session.get(Prescription.class, userid);
			objclinic_patient_treatment.setClinic_visit_id(objclinic_visit);
			//objclinic_patient_attachment.setCreate_date(currentDate.getTime());
			
			objclinic_patient_treatment.setPrescriptionItems_ID(objPrescription);
			session.save(objclinic_patient_treatment);
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
	
	
	public boolean updateclinic_patient_treatmentt(clinic_patient_treatment objclinic_patient_treatment,int userid,int PID ){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			clinic_patient_treatment obj2clinic_patient_treatment=(clinic_patient_treatment) session.get(clinic_patient_treatment.class, objclinic_patient_treatment.getTreatment_id());
			obj2clinic_patient_treatment.setClinic_doc(objclinic_patient_treatment.getClinic_doc());
			obj2clinic_patient_treatment.setClinic_diagnosis(objclinic_patient_treatment.getClinic_diagnosis());
			obj2clinic_patient_treatment.setClinic_remarks(objclinic_patient_treatment.getClinic_remarks());
			
			Prescription objPrescription = (Prescription) session.get(Prescription.class, PID); 
			clinic_visit objclinic_visit = (clinic_visit) session.get(clinic_visit.class, userid);
			obj2clinic_patient_treatment.setPrescriptionItems_ID(objPrescription);
			
			obj2clinic_patient_treatment.setClinic_date(objclinic_patient_treatment.getClinic_date() );
			session.update(obj2clinic_patient_treatment);
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
	
	
	public List<clinic_patient_treatment> retrieveclinic_patient_treatmenttreatment_id(int pID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("Select a from clinic_patient_treatment as a where a.treatment_id=:treatment_id ");
			query.setParameter("treatment_id", pID);
			List<clinic_patient_treatment> aList = castList(clinic_patient_treatment.class,query.list());
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
	
	
	public List<clinic_patient_treatment> retrieveclinic_patient_treatmentbyclinic_visit_id(int pID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			clinic_visit objclinic_visit = (clinic_visit) session.get(clinic_visit.class, pID);
			Query query = session.createQuery("Select a from clinic_patient_treatment as a where a.clinic_visit_id=:clinic_visit_id ");
			query.setParameter("clinic_visit_id", objclinic_visit);
			List<clinic_patient_treatment> aList = castList(clinic_patient_treatment.class,query.list());
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
