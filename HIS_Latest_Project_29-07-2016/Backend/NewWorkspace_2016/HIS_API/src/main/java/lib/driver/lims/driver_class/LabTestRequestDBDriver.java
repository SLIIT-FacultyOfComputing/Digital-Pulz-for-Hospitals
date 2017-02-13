package lib.driver.lims.driver_class;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import java.util.ArrayList;
import java.util.HashSet;
import java.util.List;
import java.util.Set;

import core.classes.api.user.AdminUser;
import core.classes.lims.Category;
import core.classes.lims.LabTestRequest;
import core.classes.lims.Laboratories;
import core.classes.lims.MainResults;
import core.classes.lims.Reports;
import core.classes.lims.SampleCenters;
import core.classes.lims.Specimen;
import core.classes.lims.SpecimenRetentionType;
import core.classes.lims.SpecimenType;
import core.classes.lims.SubCategory;
import core.classes.lims.TestNames;
import core.classes.opd.OutPatient;
import core.classes.opd.Patient;

public class LabTestRequestDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	MainResultsDBDriver mDriver = new MainResultsDBDriver();
	
	public boolean addNewLabTestRequest(LabTestRequest testRequest, int testID, int patientID, int labID, int userid) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			SampleCenters sctype ;
			Laboratories ltype;
			TestNames tstype = (TestNames) session.get(TestNames.class, testID);
			OutPatient ptype = (OutPatient) session.get(OutPatient.class, patientID);
			 ltype = (Laboratories) session.get(Laboratories.class, labID);
			
			
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid);
			
			testRequest.setFtest_ID(tstype);
			testRequest.setFpatient_ID(ptype);
		
			testRequest.setFlab_ID(ltype);
			
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
			else if(tx==null)
			{
				throw ex;
			}
			else
			return false;
		}

	}
	
	public boolean updateStatus(int reqID, String status){
		Transaction tx = null;
		
		try {
			tx = session.beginTransaction();
			LabTestRequest testRequest = (LabTestRequest) session.get(LabTestRequest.class, reqID);
			testRequest.setStatus(status);		
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
			else if(tx==null)
			{
				throw ex;
			}
			else
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
	public List<List> getTestRequestsList() {
		
		List<List> testreq = new ArrayList<>();
		Transaction tx = null;
		try {
			//catID = 2;
			tx = session.beginTransaction();
			Query query = session.createQuery("select r from LabTestRequest r order by test_DueDate" );
			//query.setParameter("catID", catID);
			List<LabTestRequest> testrequestsList = query.list();
			for (LabTestRequest labTestRequest : testrequestsList) {
				OutPatient patient = labTestRequest.getFpatient_ID(); 
				System.out.print(patient.getPatientHIN());

				List<String> test = new ArrayList();
				
				test.add(labTestRequest.getPriority());
				test.add(labTestRequest.getStatus());
				test.add(labTestRequest.getLabTestRequest_ID()+"");
				test.add(patient.getPatientHIN());
				test.add(labTestRequest.getFtest_ID().getTest_Name());
				test.add(labTestRequest.getTest_RequestDate()+"");
				test.add(labTestRequest.getTest_DueDate()+"");
				test.add(labTestRequest.getFtest_RequestPerson().getUserName());
				test.add(labTestRequest.getComment());
				test.add(labTestRequest.getFlab_ID().getLab_Name());
				test.add(labTestRequest.getFtest_ID().getTest_ID()+""
						+ ""
						+ ""
						+ ""
						+ "");
				test.add(patient.getPatientID()+"");
				testreq.add(test);
				
				
				
			}
			
			
			tx.commit();
			return testreq;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
					System.out.print(ex.getMessage());
					
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if(tx==null)
			{
				throw ex;
			}
			else
			return null;
		}
	}

	
	public LabTestRequest getTestRequestByID(int id) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select r from LabTestRequest r where r.labTestRequest_ID="+id);
			List<LabTestRequest> testrequestsList = query.list();
			if (testrequestsList.size() == 0)
				return null;
			tx.commit();
			return (LabTestRequest)testrequestsList.get(0);
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if(tx==null)
			{
				throw ex;
			}
			else
			return null;
		}
	}
	public List<LabTestRequest> getLabTestRequestsByPid(int patientID) {
		Transaction tx = null;
		try {

			
			tx = session.beginTransaction();
			Query query = session.createQuery("select c from OutPatient as c where c.patientID=:patientID");
			query.setParameter("patientID", patientID);
			List<OutPatient> testList = query.list();
			OutPatient catObject=testList.get(0);
			tx.commit();

			tx = session.beginTransaction();
			Query query1 = session.createQuery("select m from LabTestRequest as m where m.fpatient_ID=:catObj");
			query1.setParameter("catObj", catObject);
			List<LabTestRequest> testList1 = query1.list();
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
			else if(tx==null)
			{
				throw ex;
			}
			else
			return null;
		}
	}
		/*public List<LabTestRequest> getLabtestrequestListByPatientID(int pID) {
			Transaction tx = null;
			try {

				tx = session.beginTransaction();
				Query query = session.createQuery("select l from LabTestRequest as l where l.fpatient_ID=:pID");
				query.setParameter("pID", pID);
				List<LabTestRequest> testrequestsList = query.list();
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
		}*/
		
		/*public LabTestRequest getTestRequestByPID(int id) {
			Transaction tx = null;
			try {
				tx = session.beginTransaction();
				Query query = session.createQuery("select r from LabTestRequest r where r.fpatient_ID="+id);
				List<LabTestRequest> testrequestsList = query.list();
				if (testrequestsList.size() == 0)
					return null;
				tx.commit();
				return (LabTestRequest)testrequestsList.get(0);
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
		}*/
		
		/*public LabTestRequest getMainResultsByRequestID(int id) {
			
			Transaction tx = null;
			try {
				tx = session.beginTransaction();
				Query query = session.createQuery("select r from LabTestRequest r where r.labTestRequest_ID="+id);
				List<LabTestRequest> testreportsList = query.list();
				if (testreportsList.size() == 0)
					return null;
				
				LabTestRequest req = testreportsList.get(0);
				Set<MainResults> labMainresultset = new HashSet<MainResults>();
				List <MainResults> resultsList = mDriver.getMainResultsByRequestID(req.getLabTestRequest_ID());
				
				for (MainResults as : resultsList) {
					labMainresultset.add(as);
				}
				
				req.setLabMainresultses(labMainresultset);
				
				
				tx.commit();
				return req;
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
		}*/
	
	
	
	
	public LabTestRequest retrieveTestRequestByRequestID(int vID) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			String hql="select v from LabTestRequest as v where v.labTestRequest_ID=:VID";
			Query query = session.createQuery(hql);
			query.setParameter("VID", vID);
			LabTestRequest  requestRecord = (LabTestRequest) query.list().get(0);
			tx.commit();
			return requestRecord;
			
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if(tx==null)
			{
				throw ex;
			}
			else
			return null;
		}
	}
	
	
	public Specimen retrieveSpecimenIDByRequestID(int vID) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			String hql="select v from Specimen as v where v.flabtestrequest_ID=:VID";
			Query query = session.createQuery(hql);
			query.setParameter("VID", vID);
			Specimen  requestRec = (Specimen) query.list().get(0);
			tx.commit();
			return requestRec;
			
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if(tx==null)
			{
				throw ex;
			}
			else
			return null;
		}
	}
	
	public Specimen retrieveSpecimenByRequestID(int vID) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			String hql="select v from Specimen as v where v.flabtestrequest_ID.labTestRequest_ID=:VID";
			Query query = session.createQuery(hql);
			query.setParameter("VID", vID);
			Specimen  requestRec = (Specimen) query.list().get(0);
			tx.commit();
			return requestRec;
			
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if(tx==null)
			{
				throw ex;
			}
			else
			return null;
		}
	}
	public boolean addSpecimenInfo(Specimen speci, int useridC, int useridR, int useridD, int retID, int specID, int reqID) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			
			SpecimenRetentionType tstype = (SpecimenRetentionType) session.get(SpecimenRetentionType.class, retID);
			SpecimenType ptype = (SpecimenType) session.get(SpecimenType.class, specID);
			LabTestRequest rtype = (LabTestRequest) session.get(LabTestRequest.class, reqID);
		
		
			
			
			AdminUser userC = (AdminUser) session.get(AdminUser.class, useridC);
			AdminUser userR = (AdminUser) session.get(AdminUser.class, useridR);
			AdminUser userD = (AdminUser) session.get(AdminUser.class, useridD);
			
			speci.setfRetentionType_ID(tstype);
			speci.setfSpecimentType_ID(ptype);
			speci.setFlabtestrequest_ID(rtype);
			speci.setfSpecimen_CollectedBy(userC);
			speci.setfSpecimen_ReceivededBy(userR);
			speci.setfSpecimen_DeliveredBy(userD);
		
		
			session.save(speci);
			
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
			else if(tx==null)
			{
				throw ex;
			}
			else
			return false;
		}

	}
	
	
	public List<SpecimenType> getSpecimenTypeList() {
		Transaction tx = null;
		try {
			//catID = 2;
			tx = session.beginTransaction();
			Query query = session.createQuery("select st from SpecimenType as st" );
			//query.setParameter("catID", catID);
			List<SpecimenType> specimentypeList = query.list();
			tx.commit();
			return specimentypeList;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if(tx==null)
			{
				throw ex;
			}
			else
			return null;
		}
	}
	
	
	public List<SpecimenRetentionType> getSpecimenRetentionTypeList() {
		Transaction tx = null;
		try {
			//catID = 2;
			tx = session.beginTransaction();
			Query query = session.createQuery("select r from SpecimenRetentionType r" );
			//query.setParameter("catID", catID);
			List<SpecimenRetentionType> specimenretentiontypeList = query.list();
			tx.commit();
			return specimenretentiontypeList;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if(tx==null)
			{
				throw ex;
			}
			else
			return null;
		}
	}
	
}