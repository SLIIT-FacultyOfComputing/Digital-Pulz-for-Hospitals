package lib.driver.lims.driver_class;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import java.util.HashSet;
import java.util.List;
import java.util.Set;


import core.classes.lims.Category;
import core.classes.lims.LabTestRequest;
import core.classes.lims.Laboratories;
import core.classes.lims.MainResults;
import core.classes.lims.Reports;
import core.classes.lims.SampleCenters;
import core.classes.lims.Specimen;
import core.classes.lims.SubCategory;
import core.classes.lims.TestNames;
import core.classes.opd.OutPatient;
import core.classes.opd.Patient;

public class LabTestRequestFiltersDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	MainResultsDBDriver mDriver = new MainResultsDBDriver();
	
	public List<OutPatient> getPatientList() {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select o from OutPatient as o");
			List<OutPatient> patientList = query.list();
			tx.commit();
			return patientList;
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
			return null;
		}
	}
	
	
	public List<LabTestRequest> getLabTestRequestsByLabLocationid(int locationID) {
		Transaction tx = null;
		try {

			tx = session.beginTransaction();
			Query query = session.createQuery("select l from Laboratories as l where l.lab_ID=:locationID");
			query.setParameter("locationID", locationID);
			List<Laboratories> testList = query.list();
			Laboratories catObject=testList.get(0);
			tx.commit();

			tx = session.beginTransaction();
			Query query1 = session.createQuery("select m from LabTestRequest as m where m.flab_ID=:catObj");
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
			return null;
		}
	}
	public List<LabTestRequest> getLabTestRequestsBySampleCenterLocationid(int locationID) {
		Transaction tx = null;
		try {

			tx = session.beginTransaction();
			Query query = session.createQuery("select s from SampleCenters as s where s.sampleCenter_ID=:locationID");
			query.setParameter("locationID", locationID);
			List<SampleCenters> testList = query.list();
			SampleCenters catObject=testList.get(0);
			tx.commit();

			tx = session.beginTransaction();
			Query query1 = session.createQuery("select m from LabTestRequest as m where m.fsample_CenterID=:catObj");
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
			return null;
		}
	}
}
