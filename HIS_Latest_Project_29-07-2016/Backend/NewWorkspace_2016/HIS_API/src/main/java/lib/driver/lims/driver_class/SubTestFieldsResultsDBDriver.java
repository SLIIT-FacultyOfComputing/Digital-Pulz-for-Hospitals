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
import core.classes.lims.SubFieldResults;
import core.classes.lims.SubTestFields;
import core.classes.lims.TestFieldsRange;
import core.classes.lims.TestNames;
import core.classes.opd.OutPatient;

public class SubTestFieldsResultsDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public boolean addNewSubTestFieldResults(SubFieldResults subfieldresults) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			session.save(subfieldresults);
			
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
	public List<SubFieldResults> getSubTestFieldsResultsList() {
		Transaction tx = null;
		try {
			//catID = 2;
			tx = session.beginTransaction();
			Query query = session.createQuery("select s from SubFieldResults s" );
			//query.setParameter("catID", catID);
			List<SubFieldResults> subTestFieldsResultsList = query.list();
			tx.commit();
			return subTestFieldsResultsList;
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
