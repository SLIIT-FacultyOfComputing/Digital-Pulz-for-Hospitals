package lib.driver.hr.driver_class;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.hr.HrContact;
import core.classes.hr.HrContactId;
import core.classes.hr.HrIdentity;
import core.classes.hr.HrIdentityId;

public class HrIdentityDBDriver {
	
	Session session=SessionFactoryUtil.getSessionFactory().openSession();
	Transaction tx = null;
	

	public Boolean InsertIdentity(int idType, int empId, String identity) {
		
		try {
			HrIdentityId hrIdentityID=new HrIdentityId();
			HrIdentity hrIdentity=new HrIdentity();
			
			tx= session.beginTransaction();
			
			
			hrIdentityID.setIdentityTypeId(idType);
			hrIdentityID.setEmpId(empId);
			
			hrIdentity.setId(hrIdentityID);
			hrIdentity.setIdentity(identity);
			
			
			
			session.save(hrIdentity);
			
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


	public Boolean UpdateContact(int identityTypeID, int empID, String identity) {
		Transaction tx = null;
		
		
		try {

			
			tx = session.beginTransaction();

			HrIdentityId identityId = new HrIdentityId(identityTypeID, empID);

			HrIdentity hrIdentity = (HrIdentity) session.get(HrIdentity.class,identityId);
			
			
			if (hrIdentity == null) {
				
				HrIdentityId newIdentityID=new HrIdentityId();
				HrIdentity newIdentity=new HrIdentity();
				
				
				newIdentityID.setIdentityTypeId(identityTypeID);
				newIdentityID.setEmpId(empID);
				
				newIdentity.setId(newIdentityID);
				newIdentity.setIdentity(identity);
				
				session.save(newIdentity);
			}else{
				hrIdentity.setIdentity(identity);
				session.update(hrIdentity);
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
