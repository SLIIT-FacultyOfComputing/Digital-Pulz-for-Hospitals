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



public class clinic_patient_attachmentDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().getCurrentSession();
	
	public boolean saveclinic_patient_attachment(clinic_patient_attachment objclinic_patient_attachment,int userid, int pID){
		Transaction tx=null;
		
		try {
			Calendar currentDate = Calendar.getInstance();
			tx = session.beginTransaction();
			clinic_visit objclinic_visit = (clinic_visit) session.get(clinic_visit.class, pID);
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid);
			objclinic_patient_attachment.setCreate_user(user);
			//objclinic_patient_attachment.setCreate_date(currentDate.getTime());
			
			objclinic_patient_attachment.setClinic_visit_ID(objclinic_visit);
			session.save(objclinic_patient_attachment);
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
	
	
	public boolean updateclinic_patient_attachment(clinic_patient_attachment objclinic_patient_attachment,int userid){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			clinic_patient_attachment obj2clinic_patient_attachment=(clinic_patient_attachment) session.get(clinic_patient_attachment.class, objclinic_patient_attachment.getAttachment_ID());
			obj2clinic_patient_attachment.setClinic_visit_ID(objclinic_patient_attachment.getClinic_visit_ID());
			obj2clinic_patient_attachment.setAttachment_type(objclinic_patient_attachment.getAttachment_type());
			obj2clinic_patient_attachment.setDescription(objclinic_patient_attachment.getDescription());
			
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid); 
			obj2clinic_patient_attachment.setCreate_user(user);
			
			obj2clinic_patient_attachment.setCreate_date(objclinic_patient_attachment.getCreate_date()  );
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
	
	
	public List<clinic_patient_attachment> retrieveclinic_patient_attachmentbyattachment_ID(int pID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("Select a from clinic_patient_attachment as a where a.attachment_ID=:attachment_ID ");
			query.setParameter("attachment_ID", pID);
			List<clinic_patient_attachment> aList = castList(clinic_patient_attachment.class,query.list());
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
	
	
	public List<clinic_patient_attachment> retrieveclinic_patient_attachmentbyclinic_visitid(int pID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			clinic_visit objclinic_visit = (clinic_visit) session.get(clinic_visit.class, pID);
			Query query = session.createQuery("Select a from clinic_patient_attachment as a where a.clinic_visit_ID=:clinic_visit_ID ");
			query.setParameter("clinic_visit_ID", objclinic_visit);
			List<clinic_patient_attachment> aList = castList(clinic_patient_attachment.class,query.list());
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
