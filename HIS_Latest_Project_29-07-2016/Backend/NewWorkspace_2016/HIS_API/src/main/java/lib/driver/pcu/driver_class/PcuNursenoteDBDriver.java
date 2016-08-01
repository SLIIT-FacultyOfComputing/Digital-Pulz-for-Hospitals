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

public class PcuNursenoteDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();

	public List<PcuNursenote> SelectAll() {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("From PcuNursenote as pn where pn.pcuPatientId.status = 'active'");
			List<PcuNursenote> result = query.list();
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

	public PcuNursenote SelectSingle(int Id) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("from PcuNursenote as pa where pa.noteId ="+Id);
			PcuNursenote result = (PcuNursenote) query.list().get(0);
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
	
	public List<PcuNursenote> SelectByPatientId(int patientId) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("FROM PcuNursenote as p "
					+ "where p.pcuPatientId =" + patientId);
			List<PcuNursenote> result = query.list();
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

	public boolean Save(PcuNursenote newPcuNursenote) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			session.save(newPcuNursenote);
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

	public boolean Update(int NoteId, String NoteDetails, AdminUser ModifiedBy,
			Date ModifiedTime) {
		Transaction tx = null;

		try {
			PcuNursenote updatePcunursenote = (PcuNursenote) session.load(PcuNursenote.class, NoteId);
			tx = session.beginTransaction();
			updatePcunursenote.setNoteDetails(NoteDetails);
			updatePcunursenote.setModifiedBy(ModifiedBy);
			updatePcunursenote.setModifiedTime(ModifiedTime);
			session.update(updatePcunursenote);
			tx.commit();
			return true;
		} catch (Exception e) {
			e.printStackTrace();
			return false;

		}
	}
}
