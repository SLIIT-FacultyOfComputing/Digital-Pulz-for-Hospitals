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
import core.classes.lims.LabTypes;
import core.classes.lims.Laboratories;

import core.classes.lims.SampleCenterTypes;
import core.classes.lims.SampleCenters;
import core.classes.lims.SubCategory;
import core.classes.lims.TestFieldsRange;
import core.classes.opd.OutPatient;

public class SampleCentersDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public boolean insertNewSampleCenter(SampleCenters samplecenter, int sampleCenterTypeID, int userid) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			
			SampleCenterTypes sCenterType = (SampleCenterTypes)session.get(SampleCenterTypes.class, sampleCenterTypeID);
	
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid);
			
			samplecenter.setfSampleCenterType_ID(sCenterType);
		
			samplecenter.setfSampleCenter_AddedUserID(user);
			samplecenter.setfSampleCenterLast_UpdatedUserID(user);
		
			session.save(samplecenter);
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
	public List<SampleCenters> getNewSampleCenterList() {
		Transaction tx = null;
		try {
			//catID = 2;
			tx = session.beginTransaction();
			Query query = session.createQuery("select s from SampleCenters s" );
			//query.setParameter("catID", catID);
			List<SampleCenters> sampleCenterList = query.list();
			tx.commit();
			return sampleCenterList;
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
	
	public SampleCenters getSampleCenterID(int id) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select s from SampleCenters s where s.sampleCenter_ID="+id);
			List<SampleCenters> sampleCenterList = query.list();
			if (sampleCenterList.size() == 0)
				return null;
			tx.commit();
			return (SampleCenters)sampleCenterList.get(0);
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if(tx== null)
			{
				throw ex;
			}
			else
			return null;
		}
	}

	public List<SampleCenters> getSamplecentersByLabType(int typeID) {
		Transaction tx = null;
		try {

			tx = session.beginTransaction();
			Query query = session.createQuery("select t from SampleCenterTypes as t where t.sampleCenterType_ID=:typeID");
			query.setParameter("typeID", typeID);
			List<SampleCenterTypes> testList = query.list();
			SampleCenterTypes catObject=testList.get(0);
			tx.commit();

			tx = session.beginTransaction();
			Query query1 = session.createQuery("select s from SampleCenters as s where s.fSampleCenterType_ID=:catObj");
			query1.setParameter("catObj", catObject);
			List<SampleCenters> testList1 = query1.list();
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
			else if(tx==null)
			{
				throw ex;
			}
			else
			return null;
		}
	}
	
	public boolean updateSampleCenters( SampleCenters sampleCentr, int sampleCenterID,int sampleCenterTypeID, int userid) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			SampleCenters sampCent = (SampleCenters) session.get(SampleCenters.class,sampleCenterID);
			SampleCenterTypes sCenterType = (SampleCenterTypes)session.get(SampleCenterTypes.class, sampleCenterTypeID);
			
			sampCent.setSampleCenter_Name(sampleCentr.getSampleCenter_Name());
			sampCent.setfSampleCenterType_ID(sCenterType);
			sampCent.setSampleCenter_Incharge(sampleCentr.getSampleCenter_Incharge());
			sampCent.setLocation(sampleCentr.getLocation());
			sampCent.setEmail(sampleCentr.getEmail());
			sampCent.setContactNumber1(sampleCentr.getContactNumber1());
			sampCent.setContactNumber2(sampleCentr.getContactNumber2());
			sampCent.setfSampleCenter_AddedUserID(sampleCentr.getfSampleCenter_AddedUserID());
			sampCent.setSampleCenter_AddedDate(sampleCentr.getSampleCenter_AddedDate());
			
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid);
			sampCent.setfSampleCenterLast_UpdatedUserID(user);
			sampCent.setSampleCenter_LastUpdatedDate(sampleCentr.getSampleCenter_LastUpdatedDate());
	
			session.update(sampCent);
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
			else if(tx==null)
			{
				throw ex;
			}
			else
			return false;
		}

	}
	
	public boolean DeleteSampleCenter(int sampleCenterID) {
		// TODO Auto-generated method stub
		Transaction tx = null;
		//boolean status=false;
		
		try{
			SampleCenters sampleCenter=new SampleCenters();
			sampleCenter.setSampleCenter_ID(sampleCenterID);
	
			
			Object object = session.load(SampleCenters.class, sampleCenterID);
			SampleCenters deletesampleCenter = (SampleCenters) object;			
			
			System.out.println("Deleting Item ");
			tx = session.beginTransaction();			
			session.delete(deletesampleCenter);
			tx.commit();
			
		}
		catch(Exception e)
		{
			throw e;
			
		}
		return true;
	}
}
