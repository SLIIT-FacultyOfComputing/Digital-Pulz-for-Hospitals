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


import core.classes.lims.PcuLabTestRequest;
import core.classes.lims.Specimen;
import core.classes.lims.TestNames;
import core.classes.opd.OutPatient;
import core.classes.pcu.PcuAdmition;



public class PcuLabTestRequestDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	MainResultsDBDriver mDriver = new MainResultsDBDriver();
	
	public boolean addNewLabTestRequest(PcuLabTestRequest request, int testID , int pcuadmmision, int labID,int patientID, int userid) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
		
			
			TestNames tstype = (TestNames) session.get(TestNames.class, testID);
			OutPatient ptype = (OutPatient) session.get(OutPatient.class, patientID);
			Laboratories ltype = (Laboratories) session.get(Laboratories.class, labID); 
			PcuAdmition atype = (PcuAdmition) session.get(PcuAdmition.class, pcuadmmision); 
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid);
			
			request.setFtest_ID(tstype);
			request.setFpatient_ID(ptype);
			
			request.setFlab_ID(ltype);
			request.setAdmintionID(atype);
			request.setFtest_RequestPerson(user);
		
			session.save(request);
			
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
	public List<PcuLabTestRequest> getTestRequestsList() {
		Transaction tx = null;
		try {
			//catID = 2;
			tx = session.beginTransaction();
			Query query = session.createQuery("from PcuLabTestRequest as plr where plr.admintionID.status = 'active'" );
			//query.setParameter("catID", catID);
			List<PcuLabTestRequest> testrequestsList = query.list();
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

	
	public PcuLabTestRequest getTestRequestByID(int id) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select r from PcuLabTestRequest r where r.labTestRequest_ID="+id);
			List<PcuLabTestRequest> testrequestsList = query.list();
			if (testrequestsList.size() == 0)
				return null;
			tx.commit();
			return (PcuLabTestRequest)testrequestsList.get(0);
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
	public List<PcuLabTestRequest> getLabTestRequestsByPid(int patientID) {
		Transaction tx = null;
		try {

			tx = session.beginTransaction();
			Query query = session.createQuery("select i from OutPatient as i where i.patientID=:patientID");
			query.setParameter("patientID", patientID);
			List<OutPatient> testList = query.list();
			OutPatient catObject=testList.get(0);
			tx.commit();

			tx = session.beginTransaction();
			Query query1 = session.createQuery("select m from PcuLabTestRequest as m where m.admintionID.patientId=:catObj");
			query1.setParameter("catObj", catObject);
			List<PcuLabTestRequest> testList1 = query1.list();
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
	public List<PcuLabTestRequest> getLabTestRequestsByAdmissionID(int pcuadminid) {
		Transaction tx = null;
		try {

			tx = session.beginTransaction();
			Query query = session.createQuery("select a from PcuAdmition as a where a.admitionId=:pcuadminid");
			query.setParameter("pcuadminid", pcuadminid);
			List<PcuAdmition> testList = query.list();
			PcuAdmition catObject=testList.get(0);
			tx.commit();

			tx = session.beginTransaction();
			Query query1 = session.createQuery("select m from PcuLabTestRequest as m where m.admintionID=:catObj");
			query1.setParameter("catObj", catObject);
			List<PcuLabTestRequest> testList1 = query1.list();
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
	
	public boolean updateInwardTestRequest(int requestID, PcuLabTestRequest testRequest1) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			PcuLabTestRequest request	= (PcuLabTestRequest) session.get(PcuLabTestRequest.class, requestID); 
			request.setTest_DueDate(testRequest1.getTest_DueDate());
			request.setTest_RequestDate(testRequest1.getTest_DueDate());
			request.setComment(testRequest1.getComment());
			request.setPriority(testRequest1.getPriority());
	
			session.update(request);
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
	
	public boolean DeletePCUTestRequest(int reqID) {
		// TODO Auto-generated method stub
		Transaction tx = null;
		//boolean status=false;
		
		try{
			PcuLabTestRequest req=new PcuLabTestRequest();
			req.setPcu_lab_test_request_id(reqID);
			
			Object object = session.load(PcuLabTestRequest.class, reqID);
			PcuLabTestRequest deletereq = (PcuLabTestRequest) object;			
			
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
