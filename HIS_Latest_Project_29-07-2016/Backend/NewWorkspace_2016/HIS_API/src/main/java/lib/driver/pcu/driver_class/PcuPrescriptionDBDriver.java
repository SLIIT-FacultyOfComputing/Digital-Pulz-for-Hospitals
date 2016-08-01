package lib.driver.pcu.driver_class;

import java.util.Date;
import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.api.user.AdminUser;
import core.classes.pcu.PcuNursenote;
import core.classes.pcu.PcuPrescription;

public class PcuPrescriptionDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();

	public List<PcuPrescription> SelectAll() {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("From PcuPrescription as pp where pp.pcuPatientId.status = 'active'");
			List<PcuPrescription> result = query.list();
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
	
	public PcuPrescription SelectSingle(int Id) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("From PcuPrescription as pp "
					+ "where pp.prescriptionId =" + Id);
			PcuPrescription result = (PcuPrescription) query.list().get(0);
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
	
	public List<PcuPrescription> SelectByPatientId(int patientId) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("From PcuPrescription as pp "
					+ "where pp.pcuPatientId =" + patientId);
			List<PcuPrescription> result = query.list();
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
	
	public boolean Save(PcuPrescription newPrescription) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			session.save(newPrescription);
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
	
	public boolean Update(int PcuPrescriptionId, String PrescriptionDetails , AdminUser modified_by, Date modified_time ) {
		Transaction tx = null;

		try {
			PcuPrescription updatePcuPrescription = (PcuPrescription) session.load(PcuPrescription.class, PcuPrescriptionId);
			tx = session.beginTransaction();
			updatePcuPrescription.setPrescriptionDetails(PrescriptionDetails);
			updatePcuPrescription.setModifiedBy(modified_by);
			updatePcuPrescription.setModifiedTime(modified_time);
			session.update(updatePcuPrescription);
			tx.commit();
			return true;
		} catch (Exception e) {
			e.printStackTrace();
			return false;

		}
	}
}
