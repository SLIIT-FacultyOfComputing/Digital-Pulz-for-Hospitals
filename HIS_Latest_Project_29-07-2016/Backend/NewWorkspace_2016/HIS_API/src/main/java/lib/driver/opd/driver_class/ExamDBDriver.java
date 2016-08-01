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
import core.classes.opd.Exams;
import core.classes.opd.Visit;


public class ExamDBDriver {
	
	Session session = SessionFactoryUtil.getSessionFactory().getCurrentSession();
	
	public boolean saveExam(Exams exam,int userid, int visitID){
		Transaction tx=null;
		
		try {
			tx = session.beginTransaction();
			Visit vst=(Visit) session.get(Visit.class, visitID);
			AdminUser user=(AdminUser) session.get(AdminUser.class, userid);
			
			exam.setExamCreateUser(user);
			exam.setExamLastUpdateUser(user);
		 	exam.setVisit(vst);
			session.save(exam);
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
	
	
	public boolean updateExam(int examID,int userid, Exams exm){
		Transaction tx=null;
		try{
			tx=session.beginTransaction();
			Exams exam=(Exams) session.get(Exams.class, examID);
			
			exam.setExamDisatBP(exm.getExamDisatBP());
			exam.setExamHeight(exm.getExamHeight());
			exam.setExambmi(exm.getExambmi());
			exam.setExamSysBP(exm.getExamSysBP());
			exam.setExamTemp(exm.getExamTemp());
			exam.setExamWeight(exm.getExamWeight());
			exam.setExamLastUpdate(exm.getExamLastUpdate());
			
			AdminUser user=(AdminUser) session.get(AdminUser.class, userid);
			exam.setExamLastUpdateUser(user);
			
			exam.setExamActive(exm.getExamActive());
			session.update(exam);
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
	
	public List<Exams> retriveExamsByVisit(int vID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Visit vst=(Visit) session.get(Visit.class, vID);
			String hql="select e from Exams as e where e.visit=:vst";
			Query query = session.createQuery(hql);
			query.setParameter("vst",vst);
			List<Exams>	examRecord= castList(Exams.class, query.list());
			tx.commit();
			return examRecord;
			
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
	
	
	
	public List<Exams> retriveExamsByExamID(int exmID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			String hql="select e from Exams as e where e.examID=:exID";
			Query query = session.createQuery(hql);
			query.setParameter("exID",exmID);
			List<Exams>	examRecord= castList(Exams.class, query.list());
			tx.commit();
			return examRecord;
			
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
