package lib.driver.lims.driver_class;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import java.util.Collection;
import java.util.List;

import core.classes.lims.Category;
import core.classes.lims.LabDepartments;
import core.classes.lims.LabTypes;
import core.classes.lims.SampleCenterTypes;

public class  LabDepartmentDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public boolean insertNewLabDepartment(LabDepartments labdepartments) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			session.save(labdepartments);
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
			else if (tx==null)
			{
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
	public List<LabDepartments> getLabDepartmentsList() {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select d from LabDepartments d");
			List<LabDepartments> labDepartmentsList = query.list();
			tx.commit();
			return labDepartmentsList;
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
	
	public boolean updateDepartments(int departmentID, LabDepartments labDept) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			LabDepartments labDep = (LabDepartments) session.get(LabDepartments.class,departmentID);
			
			labDep.setLabDept_Name(labDept.getLabDept_Name());
			

		
			session.update(labDep);
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
	
	public boolean DeleteDepartment(int deptID) {
		// TODO Auto-generated method stub
		Transaction tx = null;
		//boolean status=false;
		
		try{
			LabDepartments dep=new LabDepartments();
			dep.setLabDept_ID(deptID);
		
			
			Object object = session.load(LabDepartments.class, deptID);
			LabDepartments deletedept = (LabDepartments) object;			
			
			System.out.println("Deleting Item ");
			tx = session.beginTransaction();			
			session.delete(deletedept);
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
