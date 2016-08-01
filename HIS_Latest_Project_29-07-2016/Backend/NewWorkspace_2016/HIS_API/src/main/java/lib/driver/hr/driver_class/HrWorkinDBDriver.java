package lib.driver.hr.driver_class;

import java.text.DateFormat;
import java.util.Date;
import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.hr.HrDepartment;
import core.classes.hr.HrEmployee;
import core.classes.hr.HrWorkin;
import core.classes.hr.HrWorkinId;

public class HrWorkinDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	Transaction tx = null;

	public Boolean InsertEmployeeWorkin(int empID, int dept, int desi,
			String description, Date startDate) {
		try {
			HrWorkinId workinID = new HrWorkinId();
			HrWorkin workin = new HrWorkin();

			tx = session.beginTransaction();

			workinID.setEmpId(empID);
			workinID.setDeptId(dept);
			workinID.setDesignationId(desi);

			workin.setDescription(description);
			workin.setId(workinID);
			workin.setStartDate(startDate);
			workin.setIsActive(true);

			session.save(workin);
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

	public List<HrWorkin> GetEmployeeWorkingDepartments(int empID) {

		Query query = session.createQuery("from HrWorkin w where w.id.empId='"
				+ empID + "'");

		@SuppressWarnings("unchecked")
		List<HrWorkin> empList = query.list();

		return empList;
	}

	public List<HrWorkin> GetEmployeeByDept(int deptId) {
		Query query = session.createQuery("from HrWorkin w where w.id.deptId='"
				+ deptId + "' and w.id.empId !=1");

		@SuppressWarnings("unchecked")
		List<HrWorkin> empList = query.list();

		return empList;
	}

	public List<HrWorkin> GetEmployeeWorkin(int deptId, int desigId, int empId) {
		Query query = session.createQuery("from HrWorkin w where w.id.deptId='"+ deptId + "'and w.id.designationId= '"+desigId+"'and w.id.empId= '"+empId+"'");

		@SuppressWarnings("unchecked")
		List<HrWorkin> empList = query.list();

		return empList;
	}

	public Boolean UpdateEmployeeWorkin(int empID, int dept, int desi,
			String description, Date startDate, Date endDate) {
		// TODO Auto-generated method stub
		Transaction tx = null;
		
		try {
			tx = session.beginTransaction();
			
			HrWorkinId workinId=new HrWorkinId(empID,dept,desi);
			
			HrWorkin workin=(HrWorkin) session.get(HrWorkin.class, workinId);
			
			
			workin.setDescription(description);
			workin.setStartDate(startDate);
			workin.setEndDate(endDate);
			workin.setIsActive(false);
			
			session.update(workin);

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

}
