package lib.driver.lims.driver_class;
import lib.SessionFactoryUtil;
import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;
import java.util.List;
import core.classes.lims.Category;
import core.classes.lims.LabTestRequest;
import core.classes.lims.MainResults;
import core.classes.lims.SubCategory;
import core.classes.lims.TestFieldsRange;


public class MainResultsDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public boolean addMainResults(MainResults mainresult) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			session.save(mainresult);
			
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
			else
			{
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
	public List<MainResults> getMainResultsList() {
		Transaction tx = null;
		try {
			//catID = 2;
			tx = session.beginTransaction();
			Query query = session.createQuery("select m from MainResults m" );
			//query.setParameter("catID", catID);
			List<MainResults> mresultsList = query.list();
			tx.commit();
			return mresultsList;
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

	public List<MainResults> getMainResultsByReqID(int reqID) {
		Transaction tx = null;
		try {

			tx = session.beginTransaction();
			Query query = session.createQuery("select m from MainResults as m where m.fTestRequest_ID=:reqID");
			query.setParameter("reqID", reqID);
			List<MainResults> mainResultsList = query.list();
			MainResults mRObject=mainResultsList.get(0);
			tx.commit();
			return mainResultsList;
		}
		catch (RuntimeException ex) {
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
	
	
	
	public List<MainResults> getMainResultsListTest(int reqID) {
		Transaction tx = null;
		try {

			tx = session.beginTransaction();
			Query query = session.createQuery("select c from LabTestRequest as c where c.labTestRequest_ID=:reqID");
			query.setParameter("reqID", reqID);
			List<LabTestRequest> testList = query.list();
			LabTestRequest catObject=testList.get(0);
			tx.commit();

			tx = session.beginTransaction();
			Query query1 = session.createQuery("select s from MainResults  as s where s.fTestRequest_ID=:catObj order by s.fParentF_ID");
			query1.setParameter("catObj", catObject);
			List<MainResults> testList1 = query1.list();
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
	
	public MainResults getMainResultsByID(int id) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select m from MainResults m where m.result_ID="+id);
			List<MainResults> mainResultsList = query.list();
			if (mainResultsList.size() == 0)
				return null;
			tx.commit();
			return (MainResults)mainResultsList.get(0);
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


	
}