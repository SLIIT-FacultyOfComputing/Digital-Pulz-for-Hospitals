package lib.driver.pcu.driver_class;

import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.pcu.PcuAdmition;
import core.classes.pcu.PcuPatientsymtoms;

public class PcuPatientsymtomsDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();

	public List<PcuPatientsymtoms> SelectAll() {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("from PcuPatientsymtoms as s where s.pcuPatientId.status = 'active'");
			List<PcuPatientsymtoms> result = query.list();
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
	
	public PcuPatientsymtoms SelectSingle(int Id) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("from PcuPatientsymtoms as pa where pa.symtomsId ="+Id);
			PcuPatientsymtoms result = (PcuPatientsymtoms) query.list().get(0);
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

	public List<PcuPatientsymtoms> SelectByPatientId(int patientId) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("from PcuPatientsymtoms as s "
					+ "where s.pcuPatientId =" + patientId);
			List<PcuPatientsymtoms> result = query.list();
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

	public boolean Save(PcuPatientsymtoms newPcuPatientsymtoms) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			session.save(newPcuPatientsymtoms);
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

	public boolean Update(int symtoms_id, String symtoms_details, String status) {
		Transaction tx = null;

		try {
			Object object = session.load(PcuPatientsymtoms.class, symtoms_id);
			PcuPatientsymtoms symtoms = (PcuPatientsymtoms) object;
			tx = session.beginTransaction();
			symtoms.setSymtomsDetails(symtoms_details);
			symtoms.setStatus(status);
			session.update(symtoms);
			tx.commit();
			return true;
		} catch (Exception e) {
			e.printStackTrace();
			return false;

		}
	}
}
