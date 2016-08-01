package lib.driver.lims.driver_class;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import java.util.Collection;
import java.util.List;

import core.classes.lims.Category;
import core.classes.lims.SubCategory;
import core.classes.opd.OutPatient;

public class SubCategoryDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public boolean insertSubCategory(SubCategory subcategory, int categoryID) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			
			Category cat = (Category) session.get(Category.class, categoryID);
			subcategory.setfCategory_ID(cat);
			session.save(subcategory);
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
	public List<SubCategory> getSubCategoryList() {
		Transaction tx = null;
		try {
			//catID = 2;
			tx = session.beginTransaction();
			Query query = session.createQuery("select s from SubCategory as s" );
			//query.setParameter("catID", catID);
			List<SubCategory> testList = query.list();
			tx.commit();
			return testList;
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
	public List<SubCategory> getSubCategoryListByCatID(int catID) {
		Transaction tx = null;
		try {

			tx = session.beginTransaction();
			Query query = session.createQuery("select c from Category as c where c.category_ID=:catID");
			query.setParameter("catID", catID);
			List<Category> testList = query.list();
			Category catObject=testList.get(0);
			tx.commit();

			tx = session.beginTransaction();
			Query query1 = session.createQuery("select s from SubCategory  as s where s.fCategory_ID=:catObj");
			query1.setParameter("catObj", catObject);
			List<SubCategory> testList1 = query1.list();
			tx.commit();
			return testList1;
			
			
			
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
	
	public boolean DeleteSubCategory(int sucatID) {
		// TODO Auto-generated method stub
		Transaction tx = null;
		//boolean status=false;
		
		try{
			SubCategory subcat=new SubCategory();
			subcat.setSub_CategoryID(sucatID);
			
			Object object = session.load(SubCategory.class, sucatID);
			SubCategory deleteSubCat = (SubCategory) object;			
			
			System.out.println("Deleting Item ");
			tx = session.beginTransaction();			
			session.delete(deleteSubCat);
			tx.commit();
			
		}
		catch(Exception e)
		{
			e.printStackTrace();
			
		}
		return true;
	}
	
	public boolean updateSubCategories(int SubcategoryID, SubCategory Subcat) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			//Category sctype = (Category) session.get(Category.class, categoryID);
			SubCategory Subcategories = (SubCategory) session.get(SubCategory.class,SubcategoryID);
			
			//Subcategories.setfCategory_ID(sctype);
			Subcategories.setSub_CategoryName(Subcat.getSub_CategoryName());

		
			session.update(Subcategories);
			tx.commit();
			return true;
		} catch (Exception ex) {
			System.out.println(ex.getMessage());
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
	
}