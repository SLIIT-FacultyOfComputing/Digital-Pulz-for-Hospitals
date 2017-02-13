package lib.driver.lims.driver_class;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import java.util.Collection;
import java.util.List;

import core.classes.api.user.AdminUser;

import core.classes.lims.Category;
import core.classes.lims.SpecimenRetentionType;
import core.classes.lims.SpecimenType;
import core.classes.lims.SubCategory;
import core.classes.lims.TestFieldsRange;
import core.classes.lims.TestNames;
import core.classes.opd.OutPatient;

public class TestNamesDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public boolean insertNewTest(TestNames testnames, int categoryID, int subcategoryID, int userid) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			
			Category sctype = (Category) session.get(Category.class, categoryID);
			SubCategory sstype = (SubCategory ) session.get(SubCategory.class, subcategoryID);
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid);
			
			testnames.setfTest_CreateUserID(user);
			testnames.setfTest_LastUpdateUserID(user);
			testnames.setfTest_CategoryID(sctype);
			testnames.setfTest_Sub_CategoryID(sstype);
			
			session.save(testnames);
			
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
			else if(tx==null)
			{
				throw ex;
			}
			else
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
	public List<TestNames> getTestNamesList() {
		Transaction tx = null;
		try {
			//catID = 2;
			tx = session.beginTransaction();
			Query query = session.createQuery("select t from TestNames t" );
			//query.setParameter("catID", catID);
			List<TestNames> testnamesList = query.list();
			tx.commit();
			return testnamesList;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if(tx==null)
			{
				throw ex;
			}
			else
			return null;
		}
	}

	
	public TestNames getTestNameByID(int id) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select t from TestNames t where t.test_ID="+id);
			List<TestNames> testNameList = query.list();
			if (testNameList.size() == 0)
				return null;
			tx.commit();
			return (TestNames)testNameList.get(0);
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if (tx==null) {
				throw ex;
			}
			else
			return null;
		}
	}
	
	public String getMaxTestID() {
		Transaction tx = null;
		try {
			
			tx = session.beginTransaction();
			Query query1 = session.createQuery("select max(test_ID) from TestNames" );
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
			else if (tx==null) {
				throw ex;
			}
			else
			return null;
		}
	}
	
	public boolean updateTestNames(int testID, TestNames test,String categoryID, String subCategoryID, int userid) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			TestNames tests = (TestNames) session.get(TestNames.class,testID);
		//	Category sctype = (Category) session.get(Category.class, categoryID);
		//	SubCategory sstype = (SubCategory ) session.get(SubCategory.class, subCategoryID);
					
			tests.setTest_Name(test.getTest_Name());
		//	tests.setfTest_CategoryID(sctype);
		//	tests.setfTest_Sub_CategoryID(sstype);
		
			tests.setfTest_CreateUserID(test.getfTest_CreateUserID());
			tests.setTest_CreatedDate(test.getTest_CreatedDate());
			
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid);
			tests.setfTest_LastUpdateUserID(user);
			tests.setTest_LastUpdate(test.getTest_LastUpdate());
	
			session.update(tests);
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
			if(tx==null)
			{
				throw ex;
			}
			else
			return false;
		}

	}
	
	public boolean DeleteTest(int testID) {
		// TODO Auto-generated method stub
		Transaction tx = null;
		//boolean status=false;
		
		try{
			TestNames test=new TestNames();
			test.setTest_ID(testID);
			
		
			
			Object object = session.load(TestNames.class, testID);
			TestNames deletetest = (TestNames) object;			
			
			System.out.println("Deleting Item ");
			tx = session.beginTransaction();			
			session.delete(deletetest);
			tx.commit();
			
		}
		catch(Exception e)
		{
			e.printStackTrace();
			throw e;
		}
		return true;
	}
	
	
}