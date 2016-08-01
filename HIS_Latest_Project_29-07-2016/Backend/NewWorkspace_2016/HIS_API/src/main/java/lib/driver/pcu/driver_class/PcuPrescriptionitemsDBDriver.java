package lib.driver.pcu.driver_class;

import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.pcu.PcuAdmition;
import core.classes.pcu.PcuPrescriptionitems;
import core.classes.pcu.PcuPrescriptionitemsId;

public class PcuPrescriptionitemsDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();

	public List<PcuPrescriptionitems> SelectAll() {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("from PcuPrescriptionitems as pa");
			List<PcuPrescriptionitems> result = query.list();
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
	
	public PcuPrescriptionitems SelectSingle(int prescptionId, int itemId) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("from PcuPrescriptionitems as pa where pa.id.prescriptionId ="+prescptionId+" AND pa.id.SNumber ="+itemId);
			PcuPrescriptionitems result = (PcuPrescriptionitems) query.list().get(0);
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
	
	public List<PcuPrescriptionitems> SelectByPrescptionId(int PrescptionId) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("from PcuPrescriptionitems as pa "
					+ "where pa.id.prescriptionId="+PrescptionId);
			List<PcuPrescriptionitems> result = query.list();
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
	
	public boolean Save(PcuPrescriptionitems newPrescriptionItems) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			session.save(newPrescriptionItems);
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
