package lib.driver.lims.driver_class;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import java.util.Collection;
import java.util.HashSet;
import java.util.List;
import java.util.Set;

import core.classes.lims.Category;
import core.classes.lims.LabTestRequest;
import core.classes.lims.MainResults;
import core.classes.lims.Reports;
import core.classes.lims.SubCategory;
import core.classes.lims.SubTestFields;

import core.classes.opd.OutPatient;

public class ReportsDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	MainResultsDBDriver mDriver = new MainResultsDBDriver();
	
	public boolean GenerateNewReport(Reports report, int patientid, int requestid) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			
			OutPatient patient = (OutPatient) session.get(OutPatient.class, patientid);
			LabTestRequest testrquest = (LabTestRequest) session.get(LabTestRequest.class, requestid);
			
			report.setfPatient_ID(patient);
			report.setfTestRequest_ID(testrquest);
			
			session.save(report);
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
	public List<Reports> getReportsList() {
		Transaction tx = null;
		try {
			//catID = 2;
			tx = session.beginTransaction();
			Query query = session.createQuery("select r from Reports as r" );
			//query.setParameter("catID", catID);
			List<Reports> reportList = query.list();
			tx.commit();
			return reportList;
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
	/*public Reports getReportsByRequestID(int id) {
	
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select r from Reports r where r.fTestRequest_ID="+id);
			List<Reports> testreportsList = query.list();
			if (testreportsList.size() == 0)
				return null;
			
			Reports rep = testreportsList.get(0);
			Set<MainResults> labMainresultset = new HashSet<MainResults>();
			List <MainResults> resultsList = mDriver.getMainResultsByReportID(rep.getReport_ID());
			
			for (MainResults as : resultsList) {
				labMainresultset.add(as);
			}
			
			rep.setLabMainresultses(labMainresultset);
			
			tx.commit();
			return rep;
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
	/**
	 * This method retrieve a list of laboratory tests currently available in the system
	 * 
	 * @return lab test list List<TestNames>
	 * @throws Method
	 *             throws a {@link RuntimeException} in failing the return,
	 *             throws a {@link HibernateException} on error rolling back
	 *             transaction.
	 */
	public Reports getReportsByPatientID(int id) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select r from Reports r where r.fPatient_ID="+id);
			List<Reports> reportsList = query.list();
			if (reportsList.size() == 0)
				return null;
			tx.commit();
			return (Reports)reportsList.get(0);
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