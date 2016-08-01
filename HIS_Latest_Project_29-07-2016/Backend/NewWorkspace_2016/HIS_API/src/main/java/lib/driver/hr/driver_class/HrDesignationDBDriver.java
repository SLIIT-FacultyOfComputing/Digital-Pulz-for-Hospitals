package lib.driver.hr.driver_class;

import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.hr.HrDepartment;
import core.classes.hr.HrDesignation;
import core.classes.hr.HrDesignationgroup;
import core.classes.hr.HrEmployee;

public class HrDesignationDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();

	public List<HrDesignation> GetAllDesignations() {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session
					.createQuery("select d.designationId, d.designationName from HrDesignation d where  d.designationId!=1 Order by d.designationName");
			List<HrDesignation> destList = query.list();
			tx.commit();
			return destList;
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

	public List<HrDesignation> GetAllDesigs() {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("from HrDesignation d where  d.designationId!=1 Order by d.designationName");
			List<HrDesignation> destList = query.list();
			tx.commit();
			return destList;
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

	public void AddNewDesignation(String destName, int destGroupID) {
		Transaction tx = null;

		try {
			tx = session.beginTransaction();

			HrDesignation designation = new HrDesignation();

			HrDesignationgroup destGroup = (HrDesignationgroup) session.get(
					HrDesignationgroup.class, destGroupID);

			designation.setDesignationName(destName);
			designation.setHrDesignationgroup(destGroup);

			session.save(designation);

			tx.commit();

		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}

		}

	}

	public List<HrDesignation> GetDesignationByID(int destId) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session
					.createQuery("from HrDesignation d where d.designationId = '"
							+ destId + "'");
			List<HrDesignation> deptList = query.list();
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

	public Boolean UpdateDesignation(int destId, String destName, int destGroup) {
		Transaction tx = null;

		try {
			tx = session.beginTransaction();
			HrDesignation designation = (HrDesignation) session.get(
					HrDesignation.class, destId);

			HrDesignationgroup destGroupID = (HrDesignationgroup) session.get(
					HrDesignationgroup.class, destGroup);

			designation.setDesignationName(destName);
			designation.setHrDesignationgroup(destGroupID);

			session.update(designation);

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

	public boolean DeleteDesignation(int deptID) {
		// TODO Auto-generated method stub
		Transaction tx = null;
		boolean status = false;

		try {
			HrDesignation deleteDep = (HrDesignation) session.get(HrDesignation.class,deptID);
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

	public List<HrDesignation> getAllDesignationsByDoctorGroup() {

		/*
		 * Query query = session .createQuery("from AdminDesignation");
		 * 
		 * @SuppressWarnings("unchecked") List<AdminDesignation> deptList =
		 * query.list();
		 * 
		 * return deptList;
		 */

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session
					.createQuery("select d.designationId, d.designationName from HrDesignation d where d.hrDesignationgroup.groupId=1");
			List<HrDesignation> destList = query.list();
			tx.commit();
			return destList;
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

}
