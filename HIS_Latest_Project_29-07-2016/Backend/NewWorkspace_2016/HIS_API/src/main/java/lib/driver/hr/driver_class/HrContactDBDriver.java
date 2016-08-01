package lib.driver.hr.driver_class;

import lib.SessionFactoryUtil;

import org.hibernate.Criteria;
import org.hibernate.HibernateException;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.hr.HrContact;
import core.classes.hr.HrContactId;
import core.classes.hr.HrContacttype;
import core.classes.hr.HrEmployee;

public class HrContactDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	Transaction tx = null;

	public Boolean InsertContact(int contcatType, int empId, String contact) {

		try {
			HrContactId hrContactID = new HrContactId();
			HrContact hrContact = new HrContact();

			tx = session.beginTransaction();

			hrContactID.setContactTypeId(contcatType);
			hrContactID.setEmpId(empId);

			hrContact.setId(hrContactID);
			hrContact.setContact(contact);

			System.out.println(hrContact.getId());

			session.save(hrContact);

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

	public Boolean UpdateContact(int contactTypeID, int empID, String contact) {
		Transaction tx = null;
		
		
		try {

			
			tx = session.beginTransaction();

			HrContactId contactId = new HrContactId(contactTypeID, empID);

			HrContact hrContact = (HrContact) session.get(HrContact.class,contactId);
			
			
			if (hrContact == null) {
				
				
				HrContactId hrNewContactID = new HrContactId();
				HrContact hrNewContact = new HrContact();

				

				hrNewContactID.setContactTypeId(contactTypeID);
				hrNewContactID.setEmpId(empID);

				hrNewContact.setId(hrNewContactID);
				hrNewContact.setContact(contact);

				session.save(hrNewContact);
			}else{
				hrContact.setContact(contact);
				session.update(hrContact);
			}

			tx.commit();
			return true;

		}catch (NullPointerException e) {
			e.printStackTrace();
			return false;
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
