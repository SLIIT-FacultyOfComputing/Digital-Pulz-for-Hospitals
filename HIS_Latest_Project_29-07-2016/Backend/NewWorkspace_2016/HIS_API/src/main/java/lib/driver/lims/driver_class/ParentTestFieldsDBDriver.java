package lib.driver.lims.driver_class;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import java.util.Collection;
import java.util.List;

import core.classes.lims.Category;
import core.classes.lims.ParentTestFields;
import core.classes.lims.SpecimenRetentionType;
import core.classes.lims.SpecimenType;
import core.classes.lims.SubCategory;
import core.classes.lims.TestFieldsRange;
import core.classes.lims.TestNames;
import core.classes.opd.OutPatient;

public class ParentTestFieldsDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public boolean addNewParentTestField(ParentTestFields parenttestfields) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			session.save(parenttestfields);
			
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
	public List<ParentTestFields> getParentTeatFieldsList() {
		Transaction tx = null;
		try {
			//catID = 2;
			tx = session.beginTransaction();
			Query query = session.createQuery("select p from ParentTestFields as p" );
			//query.setParameter("catID", catID);
			List<ParentTestFields> parentTestFieldsList = query.list();
			tx.commit();
			return parentTestFieldsList;
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
	
	public ParentTestFields getParentFieldByID(int id) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select p from ParentTestFields p where p.parent_FieldID="+id);
			List<ParentTestFields> parentfieldList = query.list();
			if (parentfieldList.size() == 0)
				return null;
			tx.commit();
			return (ParentTestFields)parentfieldList.get(0);
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
	
	
	public List<ParentTestFields>getParentField(int id) {
		Transaction tx = null;
		try {
			
			tx = session.beginTransaction();
			Query query = session.createQuery("select c from TestNames as c where c.test_ID=:testID");
			query.setParameter("testID", id);
			List<TestNames> testList = query.list();
			TestNames testObj=testList.get(0);
			tx.commit();
			

			tx = session.beginTransaction();
			Query query1 = session.createQuery("select p from ParentTestFields as p where p.fTest_NameID=:testID" );
			query1.setParameter("testID", testObj);
			List<ParentTestFields> parentTestFieldsList = query1.list();
			tx.commit();
			return parentTestFieldsList;
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
	
	
	
	public String getMaxParentID() {
		Transaction tx = null;
		try {
			
			tx = session.beginTransaction();
			Query query1 = session.createQuery("select max(parent_FieldID) from ParentTestFields" );
			//query1.setParameter("testID", testObj);
			List list = query1.list();
			tx.commit();
			return list.get(0).toString();
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
	
	
	
	
	
	

}
