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
import core.classes.clinic.diabetic_graph;
import core.classes.opd.Allergy;
import core.classes.opd.OutPatient;



public class diabetic_graphDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().getCurrentSession();
	
	public boolean savediabetic_graph(diabetic_graph objdiabetic_graph,int userid, int pID){
		Transaction tx=null;
		
		try {
			Calendar currentDate = Calendar.getInstance();
			tx = session.beginTransaction();
			clinic_visit objclinic_visit = (clinic_visit) session.get(clinic_visit.class, pID);
			
			//objclinic_patient_attachment.setCreate_date(currentDate.getTime());			
			objdiabetic_graph.setClinic_visit_id(objclinic_visit);
			session.save(objdiabetic_graph);
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
	
	
	public boolean updatediabetic_graph(diabetic_graph objdiabetic_graph,int userid){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			diabetic_graph obj2diabetic_graph=(diabetic_graph) session.get(clinic_patient_attachment.class, objdiabetic_graph.getGraph_id());
			obj2diabetic_graph.setBlood_glucose_level(objdiabetic_graph.getBlood_glucose_level());
			obj2diabetic_graph.setDate(objdiabetic_graph.getDate());
			
			clinic_visit objclinic_visit = (clinic_visit) session.get(clinic_visit.class, userid);			
			obj2diabetic_graph.setClinic_visit_id(objclinic_visit);
			
			session.update(obj2diabetic_graph);
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
	
	
	public List<diabetic_graph> retrievediabetic_graphgraph_id(int pID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("Select a from diabetic_graph as a where a.graph_id=:graph_id ");
			query.setParameter("graph_id", pID);
			List<diabetic_graph> aList = castList(diabetic_graph.class,query.list());
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
	
	
	public List<diabetic_graph> retrievediabetic_graphbyclinic_visit_id(int pID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			clinic_visit objclinic_visit = (clinic_visit) session.get(clinic_visit.class, pID);
			Query query = session.createQuery("Select a from diabetic_graph as a where a.clinic_visit_id=:clinic_visit_id ");
			query.setParameter("clinic_visit_id", objclinic_visit);
			List<diabetic_graph> aList = castList(diabetic_graph.class,query.list());
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
