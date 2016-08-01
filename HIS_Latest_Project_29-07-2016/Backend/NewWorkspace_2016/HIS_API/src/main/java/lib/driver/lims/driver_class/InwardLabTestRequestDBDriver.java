package lib.driver.lims.driver_class;

import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;







import core.classes.api.user.AdminUser;
import core.classes.inward.WardAdmission.Admission;
import core.classes.lims.InwardLabTestRequest;
import core.classes.lims.Laboratories;
import core.classes.inward.WardAdmission.Inpatient;


import core.classes.lims.Specimen;
import core.classes.lims.TestNames;
import core.classes.opd.OutPatient;



public class InwardLabTestRequestDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	MainResultsDBDriver mDriver = new MainResultsDBDriver();
	
	public boolean addNewLabTestRequest(InwardLabTestRequest testRequest, int testID , String bht, int labID, int userid, int patientID ) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
		
			
			TestNames tstype = (TestNames) session.get(TestNames.class, testID);
			OutPatient ptype = (OutPatient) session.get(OutPatient.class, patientID);
			//Specimen stype = (Specimen) session.get(Specimen.class, specimenID);
			Laboratories ltype = (Laboratories) session.get(Laboratories.class, labID); 
			Admission atype = (Admission) session.get(Admission.class, bht); 
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid);
			
			
			testRequest.setFtest_ID(tstype);
			//testRequest.setFpatient_ID(ptype);
			//testRequest.setFspecimen_ID(stype);
			testRequest.setFpatient_ID(ptype);
			testRequest.setFlab_ID(ltype);
			testRequest.setBHT(atype);
			testRequest.setFtest_RequestPerson(user);
		
			session.save(testRequest);
			
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
	
	/**
	 * This method retrieve a list of laboratory tests currently available in the system
	 * 
	 * @return lab test list List<TestNames>
	 * @throws Method
	 *             throws a {@link RuntimeException} in failing the return,
	 *             throws a {@link HibernateException} on error rolling back
	 *             transaction.
	 */
	public List<InwardLabTestRequest> getTestRequestsList() {
		Transaction tx = null;
		try {
			//catID = 2;
			tx = session.beginTransaction();
			Query query = session.createQuery("select r from InwardLabTestRequest as r" );
			//query.setParameter("catID", catID);
			List<InwardLabTestRequest> testrequestsList = query.list();
			tx.commit();
			return testrequestsList;
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

	
	public InwardLabTestRequest getTestRequestByID(int id) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select r from InwardLabTestRequest as r where r.inwardlabtestrequest_ID="+id);
			List<InwardLabTestRequest> testrequestsList = query.list();
			if (testrequestsList.size() == 0)
				return null;
			tx.commit();
			return (InwardLabTestRequest)testrequestsList.get(0);
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
	public List<InwardLabTestRequest> getLabTestRequestsByPid(int patientID) {
		Transaction tx = null;
		try {

			tx = session.beginTransaction();
			Query query = session.createQuery("select i from Inpatient as i where i.patientID=:patientID");
			query.setParameter("patientID", patientID);
			List<Inpatient> testList = query.list();
			Inpatient catObject=testList.get(0);
			tx.commit();

			tx = session.beginTransaction();
			Query query1 = session.createQuery("select m from InwardLabTestRequest as m where m.BHT.patientID=:catObj");
			query1.setParameter("catObj", catObject);
			List<InwardLabTestRequest> testList1 = query1.list();
			tx.commit();
			return testList1;
			
			
			
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
	public List<InwardLabTestRequest> getLabTestRequestsByBHT(String bht) {
		Transaction tx = null;
		try {

			tx = session.beginTransaction();
			Query query = session.createQuery("select a from Admission as a where a.bhtNo=:bht");
			query.setParameter("bht", bht);
			List<Admission> testList = query.list();
			Admission catObject=testList.get(0);
			tx.commit();

			tx = session.beginTransaction();
			Query query1 = session.createQuery("select m from InwardLabTestRequest as m where m.BHT=:catObj");
			query1.setParameter("catObj", catObject);
			List<InwardLabTestRequest> testList1 = query1.list();
			tx.commit();
			return testList1;
			
			
			
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
