package lib.driver.opd.driver_class;

import java.util.ArrayList;
import java.util.Collection;
import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.api.user.AdminUser;
import core.classes.opd.Attachments;
import core.classes.opd.OutPatient;



public class AttachmentDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().getCurrentSession();
	
	public boolean saveAttachment(Attachments attachment,int userid, int pID){
		Transaction tx=null;
		
		try {
			tx = session.beginTransaction();
			OutPatient patient = (OutPatient) session.get(OutPatient.class, pID);
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid);
			attachment.setAttachedBy(user);
			attachment.setAttachCreateUser(user);
			attachment.setAttachLastUpdateUser(user);
			attachment.setPatient(patient);
			session.save(attachment);
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
	
	
	
	public boolean updateAttachments(int attachId, int userid,  Attachments att,int pID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			OutPatient patient = (OutPatient) session.get(OutPatient.class, pID);
			Attachments attachment=(Attachments) session.get(Attachments.class, attachId);
			attachment.setAttachName(att.getAttachName());
			attachment.setAttachType(att.getAttachType());
			
			if (att.getAttachLink() == null | att.getAttachLink().isEmpty()
					| att.getAttachLink() == "null")
				attachment.setAttachLink(attachment.getAttachLink());
			else {

				attachment.setAttachLink(att.getAttachLink());
 
			}
			  
			attachment.setAttachedBy(attachment.getAttachedBy());
			attachment.setAttachDescription(att.getAttachDescription());
			//attachment.setAttachComment(att.getAttachComment());
			attachment.setAttachActive(att.getAttachActive());
			attachment.setAttachLastUpdate(att.getAttachLastUpdate());
			
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid);
			attachment.setAttachLastUpdateUser(user);
			attachment.setPatient(patient);
			session.update(attachment);
			tx.commit();
			return true;			
		}catch (RuntimeException ex) {
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
	
	
	
	
	
	public List<Attachments> retriveAttachmentByAttachID(int attchID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			String hql="select a from Attachments as a where a.attachID=:atID";
			Query query = session.createQuery(hql);
			query.setParameter("atID",attchID);
			List<Attachments> attachmentRecord= castList(Attachments.class, query.list());
			tx.commit();
			return attachmentRecord;
			
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
	
	
	public List<Attachments> retriveAttachmentByPatientID(int pID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			OutPatient patient = (OutPatient) session.get(OutPatient.class, pID);
			String hql="select a from Attachments as a where a.patient=:patient";
			Query query = session.createQuery(hql);
			query.setParameter("patient",patient);
			List<Attachments> attachmentRecord= castList(Attachments.class, query.list());
			tx.commit();
			return attachmentRecord;
			
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
