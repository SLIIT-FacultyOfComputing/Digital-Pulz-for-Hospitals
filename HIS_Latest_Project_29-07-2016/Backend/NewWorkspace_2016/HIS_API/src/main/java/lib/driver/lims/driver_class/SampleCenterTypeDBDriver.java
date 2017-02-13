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
import core.classes.lims.SampleCenterTypes;
import core.classes.lims.SampleCenters;

public class SampleCenterTypeDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public boolean insertNewSampleCenterType(SampleCenterTypes samplecentertype) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			session.save(samplecentertype);
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
			else if (tx==null) {
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
	public List<SampleCenterTypes> getSampleCenterTypeList() {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select t from SampleCenterTypes t");
			List<SampleCenterTypes> samplecenterTypeList = query.list();
			tx.commit();
			return samplecenterTypeList;
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

	
	public boolean updateSampleTypes(int typeID, SampleCenterTypes SampleCentertype) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			SampleCenterTypes sampleCtype = (SampleCenterTypes) session.get(SampleCenterTypes.class,typeID);
			
			sampleCtype.setSample_Center_TypeName(SampleCentertype.getSample_Center_TypeName());
				
			session.update(sampleCtype);
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
			else if (tx==null) {
				throw ex;
			}
			else
			return false;
		}

	}
	
	public boolean DeleteSampleCenterTypes(int SampleCenterTypeID) {
		// TODO Auto-generated method stub
		Transaction tx = null;
		//boolean status=false;
		
		try{
			SampleCenterTypes CenterTypes=new SampleCenterTypes();
			CenterTypes.setSampleCenterType_ID(SampleCenterTypeID);
			
			
			Object object = session.load(SampleCenterTypes.class, SampleCenterTypeID);
			SampleCenterTypes deleteCenterTypes = (SampleCenterTypes) object;			
			
			System.out.println("Deleting Item ");
			tx = session.beginTransaction();			
			session.delete(deleteCenterTypes);
			tx.commit();
			
		}
		catch(Exception e)
		{
			throw e;
			
		}
		return true;
	}
	
	
}
