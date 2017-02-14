package lib.driver.lims.driver_class;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import java.util.Collection;
import java.util.List;

import core.classes.lims.Category;
import core.classes.lims.LabTestRequest;
import core.classes.lims.LabTypes;
import core.classes.lims.Laboratories;
import core.classes.lims.SampleCenterTypes;

public class LabTypeDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public boolean insertNewLabType(LabTypes labtype) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			session.save(labtype);
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
	public List<LabTypes> getLabTypeList() {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select l from LabTypes l");
			List<LabTypes> labTypeList = query.list();
			tx.commit();
			return labTypeList;
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
	
	public boolean updateLabSampleTypes(int typeID, LabTypes labType) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			LabTypes labtype = (LabTypes) session.get(LabTypes.class,typeID);
			
			labtype.setLab_Type_Name(labType.getLab_Type_Name());
		
			

		
			session.update(labtype);
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
	public boolean DeleteLabType(int typeID) {
		// TODO Auto-generated method stub
		Transaction tx = null;
		//boolean status=false;
		
		try{
			LabTypes type=new LabTypes();
			
			type.setLabType_ID(typeID);
			
			Object object = session.load(LabTypes.class, typeID);
			LabTypes deleteType = (LabTypes) object;			
			
			System.out.println("Deleting Item ");
			tx = session.beginTransaction();			
			session.delete(deleteType);
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
