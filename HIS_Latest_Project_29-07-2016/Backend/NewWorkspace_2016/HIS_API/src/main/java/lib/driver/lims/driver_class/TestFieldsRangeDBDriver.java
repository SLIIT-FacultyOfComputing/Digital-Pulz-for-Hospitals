package lib.driver.lims.driver_class;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import java.util.Collection;
import java.util.List;

import core.classes.lims.Category;
import core.classes.lims.TestFieldsRange;

public class TestFieldsRangeDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public boolean addNewRange(TestFieldsRange range ) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			session.save(range);
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
			else if(tx == null)
			{
				throw ex;
			}
			else{
				return false;
			}
		}
	}
	
	/**
	 * This method retrieve a list of laboratory tests currently available in the system
	 * 
	 * @return lab test list List<TestNames>
	 * @throws Method
	 *             throws a {@link RuntimeException} in failing the return,
	 *             throws a {@link HibernateException} on error rolling back
	 *             transaction.
	 */
	public List<TestFieldsRange> getRangeList() {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select r from TestFieldsRange r" );
			
			List<TestFieldsRange> rangeList = query.list();
			tx.commit();
			return rangeList;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if(tx == null)
			{
				throw ex;
			}
			else{
			return null;
			}
		}
	}

	
	
	public TestFieldsRange getTestFieldRangeByID(int id) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select t from TestFieldsRange t where t.range_ID="+id);
			List<TestFieldsRange> rangeList = query.list();
			if (rangeList.size() == 0)
				return null;
			tx.commit();
			return (TestFieldsRange)rangeList.get(0);
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if(tx == null)
			{
				throw ex;
			}
			else{
			return null;
			}
		}
	}
	
	/*public List<TestFieldsRange> getRangeListtt(int id) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select t from ParentTestFields t where t.fTest_NameID=:ID");;
			query.setParameter("ID", id);
			List<TestFieldsRange> rangeList = query.list();
			tx.commit();
			return rangeList;
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
	}*/
}