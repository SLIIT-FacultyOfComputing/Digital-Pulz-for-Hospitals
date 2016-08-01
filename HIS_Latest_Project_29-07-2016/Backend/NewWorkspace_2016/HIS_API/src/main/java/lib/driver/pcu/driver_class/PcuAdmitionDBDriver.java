package lib.driver.pcu.driver_class;

import java.util.Date;
import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.api.user.AdminUser;
import core.classes.pcu.PcuAdmition;
import core.classes.pcu.PcuNursenote;

public class PcuAdmitionDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();

	public List<PcuAdmition> SelectAll() {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("from PcuAdmition as pa where pa.status = 'active'");
			List<PcuAdmition> result = query.list();
			tx.commit();
			return result;
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
	
	public PcuAdmition SelectSingle(int pcuPatientId) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("from PcuAdmition as pa where pa.admitionId ="+pcuPatientId);
			PcuAdmition result = (PcuAdmition) query.list().get(0);
			tx.commit();
			return result;
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
	
	public List<PcuAdmition> SelectByPatientId(int patientId) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select pa from PcuAdmition as pa "
					+ "where pa.patientId =" + patientId);
			List<PcuAdmition> result = query.list();
			tx.commit();
			return result;
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
	
	public boolean Save(PcuAdmition newAdmition) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			session.save(newAdmition);
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
	
	public boolean Update(int admition_id, String status, AdminUser modified_by, Date modified_time) {
		Transaction tx = null;

		try {
			PcuAdmition updatePcuAdmition = (PcuAdmition) session.load(PcuAdmition.class, admition_id);
			tx = session.beginTransaction();
			updatePcuAdmition.setStatus(status);
			updatePcuAdmition.setModifiedBy(modified_by);
			updatePcuAdmition.setModifiedTime(modified_time);
			session.update(updatePcuAdmition);
			session.update(updatePcuAdmition);
			tx.commit();
			return true;
		} catch (Exception e) {
			e.printStackTrace();
			return false;

		}
	}
}
