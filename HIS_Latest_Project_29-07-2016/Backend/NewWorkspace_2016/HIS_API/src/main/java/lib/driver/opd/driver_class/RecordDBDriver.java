package lib.driver.opd.driver_class;

import java.util.ArrayList;
import java.util.Collection;
import java.util.Date;
import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;



import core.classes.api.user.AdminUser;
import core.classes.opd.Record;
import core.classes.opd.OutPatient;

public class RecordDBDriver {
	
	Session session = SessionFactoryUtil.getSessionFactory().getCurrentSession();
	
	public boolean saveRecord(Record record,int createuserid, int pID){
		Transaction tx=null;
		
		try {
			tx = session.beginTransaction();
			OutPatient patient = (OutPatient) session.get(OutPatient.class, pID);
			AdminUser user = (AdminUser) session.get(AdminUser.class, createuserid);
			
			record.setPatient(patient);
			record.setRecordCreateUser(user);
			record.setRecordLastUpdateUser(user);
			
			session.save(record);
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
	
	public boolean updateRecord(int hisid, Record hist,int udateuser){
		
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Record record=(Record) session.get(Record.class, hisid);
			AdminUser user=(AdminUser) session.get(AdminUser.class, udateuser);
			
			record.setRecordType( hist.getRecordType());
			record.setRecordText( hist.getRecordText());
			record.setRecordVisibility( hist.getRecordVisibility());
			record.setRecordCompleted( hist.getRecordCompleted());
			record.setRecordLastUpdate(new Date()); 
			record.setRecordLastUpdateUser(user);
			 
		
			session.update(record);
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
	
	public List<Record> getRecordRecordByRecordID(int recid){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			String hql="from Record where patientRecordID=:recid";
			Query query = session.createQuery(hql);
			query.setParameter("recid", recid);
			List<Record> recordList=castList(Record.class, query.list());
			tx.commit();
			return recordList;
			
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
	
	 
	

	public List<Record> getNotesByPatientID(int pID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			OutPatient patient = (OutPatient) session.get(OutPatient.class, pID);
			Query query = session.createQuery("from Record where (patient=:p AND recordType=0)");
			query.setParameter("p", patient);
			List<Record> notes=castList(Record.class, query.list());
			tx.commit();
			return notes;
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
