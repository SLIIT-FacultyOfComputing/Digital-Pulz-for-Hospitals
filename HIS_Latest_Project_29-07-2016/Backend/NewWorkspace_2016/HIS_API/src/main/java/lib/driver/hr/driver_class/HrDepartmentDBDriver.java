package lib.driver.hr.driver_class;

import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.hr.HrDepartment;
import core.classes.hr.HrDesignation;
import core.classes.hr.HrEmployee;

public class HrDepartmentDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();

	public List<HrDepartment> GetAllDepatments() {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session
					.createQuery("select d.deptId,d.deptName from HrDepartment as d");
			List<HrDepartment> deptList = query.list();
			tx.commit();
			return deptList;
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
		/*
		 * Query query = session .createQuery("from AdminDepartment");
		 * 
		 * @SuppressWarnings("unchecked") List<AdminDepartment> deptList =
		 * query.list();
		 * 
		 * return deptList;
		 */
	}

	public Boolean InsertNewDepartment(String deptName, int deptHead) {
		Transaction tx = null;

		try {
			tx = session.beginTransaction();
			HrDepartment dept = new HrDepartment();

			HrEmployee empO = (HrEmployee) session.get(HrEmployee.class,
					deptHead);

			dept.setDeptName(deptName);
			dept.setHrEmployee(empO);

			session.save(dept);

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

	public List<HrDepartment> GetAllDepts() {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("from HrDepartment");
			List<HrDepartment> deptList = query.list();
			tx.commit();
			return deptList;
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

	public Boolean UpdateDepartment(int deptId, String deptName, int deptHead) {
		Transaction tx = null;

		try {
			tx = session.beginTransaction();
			HrDepartment dept = (HrDepartment) session.get(HrDepartment.class,
					deptId);

			HrEmployee empO = (HrEmployee) session.get(HrEmployee.class,
					deptHead);

			dept.setDeptName(deptName);
			dept.setHrEmployee(empO);

			session.update(dept);

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

	public List<HrDepartment> getDepartmentByID(int deptId) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session
					.createQuery("from HrDepartment d where d.deptId = '"
							+ deptId + "'");
			List<HrDepartment> deptList = query.list();
			tx.commit();
			return deptList;
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

	public boolean DeleteDepartment(int deptID) {
		// TODO Auto-generated method stub
		Transaction tx = null;
		boolean status = false;

		try {
			//HrDepartment dep = new HrDepartment();
			//dep.setDeptId(deptID);

			//Object object = session.load(HrDepartment.class, dep);
			HrDepartment deleteDep = (HrDepartment) session.get(HrDepartment.class,deptID);


			System.out.println("Deleting Item ");
			tx = session.beginTransaction();
			session.delete(deleteDep);
			tx.commit();
			status = true;
		} catch (Exception e) {
			e.printStackTrace();

		}
		return status;
	}

}
