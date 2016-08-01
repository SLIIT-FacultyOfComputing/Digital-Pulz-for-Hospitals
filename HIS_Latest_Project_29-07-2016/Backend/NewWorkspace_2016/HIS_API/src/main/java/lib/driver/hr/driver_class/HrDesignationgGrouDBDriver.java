package lib.driver.hr.driver_class;

import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.hr.HrDesignation;
import core.classes.hr.HrDesignationgroup;

public class HrDesignationgGrouDBDriver {

	Session session=SessionFactoryUtil.getSessionFactory().openSession();
	
	public List<HrDesignationgroup> GetAllDesigsignationGroup() {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("from HrDesignationgroup d");
			List<HrDesignationgroup> destList = query.list();
			tx.commit();
			return destList;
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
