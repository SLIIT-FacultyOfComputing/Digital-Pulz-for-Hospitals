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
import core.classes.lims.LabDepartments;
import core.classes.lims.LabTypes;
import core.classes.lims.Laboratories;
import core.classes.lims.OPDLabTestRequest;
import core.classes.inward.WardAdmission.Inpatient;


import core.classes.lims.Specimen;
import core.classes.lims.TestNames;
import core.classes.opd.OutPatient;
import core.classes.opd.Visit;



public class OpdLabTestRequestDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	MainResultsDBDriver mDriver = new MainResultsDBDriver();
	
	public boolean addNewLabTestRequest(OPDLabTestRequest testRequest, int testID , int visitid, int labID, int userid, int patientID ) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
		
			
			TestNames tstype = (TestNames) session.get(TestNames.class, testID);
			OutPatient ptype = (OutPatient) session.get(OutPatient.class, patientID);
			//Specimen stype = (Specimen) session.get(Specimen.class, specimenID);
			Laboratories ltype = (Laboratories) session.get(Laboratories.class, labID); 
			Visit atype = (Visit) session.get(Visit.class, visitid); 
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid);
			
			
			testRequest.setFtest_ID(tstype);
			//testRequest.setFpatient_ID(ptype);
			//testRequest.setFspecimen_ID(stype);
			testRequest.setFpatient_ID(ptype);
			testRequest.setFlab_ID(ltype);
			testRequest.setVisitID(atype);
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
	public List<OPDLabTestRequest> getTestRequestsList() {
		Transaction tx = null;
		try {
			//catID = 2;
			tx = session.beginTransaction();
			Query query = session.createQuery("select r from OPDLabTestRequest as r" );
			//query.setParameter("catID", catID);
			List<OPDLabTestRequest> testrequestsList = query.list();
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

	
	public OPDLabTestRequest getTestRequestByID(int id) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select r from OPDLabTestRequest as r where r.opdLabtestrequest_ID="+id);
			List<OPDLabTestRequest> testrequestsList = query.list();
			if (testrequestsList.size() == 0)
				return null;
			tx.commit();
			return (OPDLabTestRequest)testrequestsList.get(0);
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
	public List<OPDLabTestRequest> getLabTestRequestsByPid(int patientID) {
		Transaction tx = null;
		try {

			tx = session.beginTransaction();
			Query query = session.createQuery("select i from OutPatient as i where i.patientID=:patientID");
			query.setParameter("patientID", patientID);
			List<OutPatient> testList = query.list();
			OutPatient catObject=testList.get(0);
			tx.commit();

			tx = session.beginTransaction();
			Query query1 = session.createQuery("select m from OPDLabTestRequest as m where m.visitID.patient=:catObj");
			query1.setParameter("catObj", catObject);
			List<OPDLabTestRequest> testList1 = query1.list();
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
	public List<OPDLabTestRequest> getLabTestRequestsByVisitID(int visitid) {
		Transaction tx = null;
		try {

			tx = session.beginTransaction();
			Query query = session.createQuery("select a from Visit as a where a.visitID=:visitid");
			query.setParameter("visitid", visitid);
			List<Visit> testList = query.list();
			Visit catObject=testList.get(0);
			tx.commit();

			tx = session.beginTransaction();
			Query query1 = session.createQuery("select m from OPDLabTestRequest as m where m.visitID=:catObj");
			query1.setParameter("catObj", catObject);
			List<OPDLabTestRequest> testList1 = query1.list();
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
	
	public boolean updateTestRequest(int requestID, OPDLabTestRequest testRequest1, int testID , int visitid, int labID, int userid, int patientID) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			TestNames tstype = (TestNames) session.get(TestNames.class, testID);
			OutPatient ptype = (OutPatient) session.get(OutPatient.class, patientID);		
			Laboratories ltype = (Laboratories) session.get(Laboratories.class, labID); 
			Visit atype = (Visit) session.get(Visit.class, visitid); 
			OPDLabTestRequest testRequest	= (OPDLabTestRequest) session.get(OPDLabTestRequest.class, requestID); 
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid);
			
			testRequest.setFtest_ID(tstype);
			testRequest.setFpatient_ID(ptype);
			testRequest.setFlab_ID(ltype);
			testRequest.setVisitID(atype);
			testRequest.setFtest_RequestPerson(user);
			testRequest.setTest_DueDate(testRequest1.getTest_DueDate());
			testRequest.setTest_RequestDate(testRequest1.getTest_RequestDate());
			testRequest.setComment(testRequest1.getComment());
			testRequest.setPriority(testRequest1.getPriority());
			testRequest.setStatus(testRequest1.getStatus());
	
			session.update(testRequest);
			tx.commit();
			return true;
		} catch (Exception ex) {
			System.out.println(ex.getMessage());
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
	
	public boolean DeleteOpdTestRequest(int reqID) {
		// TODO Auto-generated method stub
		Transaction tx = null;
		//boolean status=false;
		
		try{
			OPDLabTestRequest req=new OPDLabTestRequest();
			req.setOpdLabtestrequest_ID(reqID);
			
			Object object = session.load(OPDLabTestRequest.class, reqID);
			OPDLabTestRequest deletereq = (OPDLabTestRequest) object;			
			
			System.out.println("Deleting Item ");
			tx = session.beginTransaction();			
			session.delete(deletereq);
			tx.commit();
			
		}
		catch(Exception e)
		{
			e.printStackTrace();
			
		}
		return true;
	}


	
}
