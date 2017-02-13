package lib.driver.lims.driver_class;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import java.util.Collection;
import java.util.List;

import core.classes.lims.Category;
import core.classes.lims.SpecimenRetentionType;
import core.classes.lims.SpecimenType;
import core.classes.lims.SubCategory;
import core.classes.opd.OutPatient;

public class SpecimenRetentionTypeDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public boolean insertSpecimenRetentionType(SpecimenRetentionType specimenretentiontype, int categoryID, int subcategoryID) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			
			Category sctype = (Category) session.get(Category.class, categoryID);
			SubCategory sstype = (SubCategory ) session.get(SubCategory.class, subcategoryID);
			
			specimenretentiontype.setfCategory_ID(sctype);
			specimenretentiontype.setfSub_CategryID(sstype);
			
			session.save(specimenretentiontype);
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
	public List<SpecimenRetentionType> getSpecimenRetentionTypeList() {
		Transaction tx = null;
		try {
			//catID = 2;
			tx = session.beginTransaction();
			Query query = session.createQuery("select r from SpecimenRetentionType r" );
			//query.setParameter("catID", catID);
			List<SpecimenRetentionType> specimenretentiontypeList = query.list();
			tx.commit();
			return specimenretentiontypeList;
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
			else
			{
				return null;
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
	public List<SpecimenRetentionType> getSpecimenRetentionTypeBYCIDSIDList(int catID, int subID) {
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
			Query query = session.createQuery("select r from SpecimenRetentionType as r where r.fCategory_ID=:catObject AND r.fSub_CategryID=:SubcatObject" );
			query.setParameter("catObject", catObject);
			query.setParameter("SubcatObject", SubcatObject);
			List<SpecimenRetentionType> specimenretentiontypeList = query.list();
			tx.commit();
			return specimenretentiontypeList;
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
