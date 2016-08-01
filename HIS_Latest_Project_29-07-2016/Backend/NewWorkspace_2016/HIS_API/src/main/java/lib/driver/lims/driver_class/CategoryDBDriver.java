package lib.driver.lims.driver_class;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import java.util.Collection;
import java.util.List;

import core.classes.lims.Category;

public class CategoryDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public boolean insertCategory(Category category) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			session.save(category);
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
	public List<Category> getCategoryList() {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select c from Category as c");
			List<Category> testList = query.list();
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
	
	public boolean updateCategories(int categoryID, Category cat) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Category categories = (Category) session.get(Category.class,categoryID);
			
			categories.setCategory_Name(cat.getCategory_Name());
			

		
			session.update(categories);
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
	
	public boolean DeleteCategory(int catID) {
		// TODO Auto-generated method stub
		Transaction tx = null;
		//boolean status=false;
		
		try{
			Category cat=new Category();
			cat.setCategory_ID(catID);
			
			Object object = session.load(Category.class, catID);
			Category deleteCat = (Category) object;			
			
			System.out.println("Deleting Item ");
			tx = session.beginTransaction();			
			session.delete(deleteCat);
			tx.commit();
			
		}
		catch(Exception e)
		{
			e.printStackTrace();
			
		}
		return true;
	}

}
