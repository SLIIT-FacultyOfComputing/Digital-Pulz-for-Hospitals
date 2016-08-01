package lib.driver.hr.driver_class;

import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.hr.HrAssignschedule;
import core.classes.hr.HrLeavetype;

public class HrLeaveTypeDBDriver {

	Session session=SessionFactoryUtil.getSessionFactory().openSession();

	public List<HrLeavetype> GetAllLeaveType() {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select a from HrLeavetype a");
			
			List<HrLeavetype> shiftList = query.list();
			tx.commit();
			return shiftList;
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

	
}
