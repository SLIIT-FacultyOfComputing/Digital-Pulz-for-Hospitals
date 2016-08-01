package lib.driver.lims.driver_class;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import java.util.Collection;
import java.util.List;

import core.classes.lims.Category;
import core.classes.lims.SpecimenType;
import core.classes.lims.SubCategory;
import core.classes.opd.OutPatient;

public class SpecimenTypeDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public boolean insertSpecimenType(SpecimenType specimentype, int categoryID, int subcategoryID) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			
			Category sctype = (Category) session.get(Category.class, categoryID);
			SubCategory sstype = (SubCategory ) session.get(SubCategory.class, subcategoryID);
			
			specimentype.setfCategry_ID(sctype);
			specimentype.setfSub_CategoryID(sstype);
			
			session.save(specimentype);
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
	
	/**
	 * This method retrieve a list of laboratory tests currently available in the system
	 * 
	 * @return lab test list List<TestNames>
	 * @throws Method
	 *             throws a {@link RuntimeException} in failing the return,
	 *             throws a {@link HibernateException} on error rolling back
	 *             transaction.
	 */
	public List<SpecimenType> getSpecimenTypeList() {
		Transaction tx = null;
		try {
			//catID = 2;
			tx = session.beginTransaction();
			Query query = session.createQuery("select st from SpecimenType as st" );
			//query.setParameter("catID", catID);
			List<SpecimenType> specimentypeList = query.list();
			tx.commit();
			return specimentypeList;
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
	
	/**
	 * This method retrieve a list of laboratory tests currently available in the system
	 * 
	 * @return lab test list List<TestNames>
	 * @throws Method
	 *             throws a {@link RuntimeException} in failing the return,
	 *             throws a {@link HibernateException} on error rolling back
	 *             transaction.
	 */
	public List<SpecimenType> getSpecimenTypeListByCIDSID(int catID,int subID) {
		Transaction tx = null;
		try {
			
			tx = session.beginTransaction();
			Query query1 = session.createQuery("select c from Category as c where c.category_ID=:catID");
			query1.setParameter("catID", catID);
			List<Category> testList = query1.list();
			Category catObject=testList.get(0);
			tx.commit();
			
			tx = session.beginTransaction();
			Query query2 = session.createQuery("select s from SubCategory as s where s.sub_CategoryID=:subID");
			query2.setParameter("subID", subID);
			List<SubCategory> testList1 = query2.list();
			SubCategory SubcatObject=testList1.get(0);
			tx.commit();
			

			tx = session.beginTransaction();
			Query query = session.createQuery("select s from SpecimenType as s where s.fCategry_ID=:catObject AND fSub_CategoryID=:SubcatObject" );
			query.setParameter("catObject", catObject);
			query.setParameter("SubcatObject", SubcatObject);
			List<SpecimenType> specimentypeList = query.list();
			tx.commit();
			return specimentypeList;
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
