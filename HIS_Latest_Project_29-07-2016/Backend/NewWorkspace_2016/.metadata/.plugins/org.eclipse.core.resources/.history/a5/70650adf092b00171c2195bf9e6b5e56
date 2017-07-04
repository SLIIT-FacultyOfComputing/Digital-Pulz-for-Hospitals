/**
 * 
 */
package lib.driver.opd.driver_class;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Collection;
import java.util.Date;
import java.util.List;

import javax.swing.text.DateFormatter;





import lib.SessionFactoryUtil;

import org.hibernate.Criteria;
import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.api.user.AdminUser;
import core.classes.hr.HrWorkin;
import core.classes.opd.*;

/**
 * @author Vishwa
 * 
 */
public class VisitDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().getCurrentSession();

	public boolean saveVisit(Visit visit, int doctorid , int pID) {
		Transaction tx = null;

		try {
			tx = session.beginTransaction();
			OutPatient patient = (OutPatient) session.get(OutPatient.class, pID);
			AdminUser doctor = (AdminUser) session.get(AdminUser.class, doctorid);
			visit.setVisitDoctor(doctor);
			visit.setVisitCreateUser(doctor);
			visit.setVisitLastUpDateUser(doctor);
			visit.setPatient(patient); 
			session.save(visit);
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
			}else if(tx == null)
			{
				throw ex;
			}
			else{
			return false;
			}
		}

	}

	public boolean updateVisit(Visit vst,int doctorid) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Visit visit = (Visit) session.get(Visit.class, vst.getVisitID());
			AdminUser doctor = (AdminUser) session.get(AdminUser.class, doctorid);
			
			visit.setVisitLastUpDateUser(doctor);
			visit.setVisitType(vst.getVisitType());
			visit.setVisitComplaint(vst.getVisitComplaint());
			visit.setVisitRemarks(vst.getVisitRemarks());
			visit.setVisitLastUpdate(vst.getVisitLastUpdate()); 
			session.update(visit);
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
			}else if(tx == null)
			{
				throw ex;
			}
			else{
			return false;
			}
		}

	}

	public Visit retrieveVisistByVisitID(int vID) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			String hql="select v from Visit as v where v.visitID=:VID";
			Query query = session.createQuery(hql);
			query.setParameter("VID", vID);
			Visit  visitRecord = (Visit) query.list().get(0);
			tx.commit();
			return visitRecord;
			
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}else if(tx == null)
			{
				throw ex;
			}
			else{
			return null;
			}
		}
	}

	public List<Visit> retrieveVisitsByPatientID(int pID) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			OutPatient patient = (OutPatient) session.get(OutPatient.class, pID);
			Query query = session.createQuery("Select v from Visit as v where v.patient=:patient order by visitID desc");
			query.setParameter("patient", patient);
			List<Visit> vList = castList(Visit.class,query.list());
			tx.commit();
			return vList;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}else if(tx == null)
			{
				throw ex;
			}
			else{
			return null;
			}
		}
	}

	

	public List<Visit> retrieveRecent(int pID) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			OutPatient patient = (OutPatient) session.get(OutPatient.class, pID);
			Query query = session.createQuery("select max(v) from Visit as v where v.patient=:patient order by visitID desc");
			query.setParameter("patient", patient);
			List<Visit> vList = castList(Visit.class,query.list());
			tx.commit();
			return vList;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}else if(tx == null)
			{
				throw ex;
			}
			else{
			return null;
			}
		}
		
	}
	
	
	public List<Visit> getVisitsByVisitDate(Date visitDate) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("from Visit where cast(visitDate as date)=:visitDate");		 
			query.setDate("visitDate",visitDate);
			List<Visit>  visitRecords =  castList(Visit.class, query.list());
			tx.commit();
			return visitRecords;
			
		} catch (Exception ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
			 throw ex;
			}else if(tx == null)
			{
				throw ex;
			}
			else{
			return null;
			}
		}
	}
	 
	public List<Visit> getVisitsForReport(Date fromDate, Date toDate, int doctor) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			
		
			String hql;
			Query query;	 
			 
			if(doctor == 0)
			{	
				hql = "from Visit where( cast(visitDate as date) between :fromDate AND :toDate)";
				query = session.createQuery(hql);
				query.setDate("fromDate",fromDate);
				query.setDate("toDate",toDate);
			}else
			{
				hql = "from Visit where( cast(visitDate as date) between :fromDate AND :toDate AND visitDoctor=:doctor)";
				query = session.createQuery(hql);
				query.setDate("fromDate",fromDate);
				query.setDate("toDate",toDate);
				query.setParameter("doctor",doctor);
			}
		
			List<Visit>  visitRecords =  castList(Visit.class, query.list());
			
			tx.commit();
			return visitRecords;
			
		} catch (Exception ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
			 throw ex;
			}else if(tx == null)
			{
				throw ex;
			}
			else{
			return null;
			}
		}
	}
	
	public static <T> List<T> castList(Class<? extends T> clazz, Collection<?> c) {
	    List<T> r = new ArrayList<T>(c.size());
	    for(Object o: c)
	      r.add(clazz.cast(o));
	    return r;
	}

	public List<Visit> getVisitsByPatietVisit(int visitID) {
		Transaction tx = null;
		tx = session.beginTransaction();
			Query query = session.createQuery("from Visit Where visitID= '"+visitID+"'");
			
			@SuppressWarnings("unchecked")
			List<Visit> empList = query.list();
			tx.commit();
			return empList;
		}



	
	
	
}
