/**
 * 
 */
package lib.driver.opd.driver_class;

import java.util.ArrayList;
import java.util.Collection;
import java.util.HashSet;
import java.util.Iterator;
import java.util.List;
import java.util.Set;

import lib.SessionFactoryUtil;
import core.classes.api.user.AdminUser;
import core.classes.opd.*;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import flexjson.JSONSerializer;
import lib.driver.sync.driver_class.cpsDBDriver;
/**
 * This class control basic CRUD operations of the out patient. it uses the
 * hibernate session factory utility and support for CRUD operation of patient
 * class.
 * 
 * @author
 * @version 1.0
 */
public class PatientDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory()
			.openSession();
	cpsDBDriver cpsDBDriver= new cpsDBDriver();
	/**
	 * This method insert the OPD patient details to the patient table
	 * 
	 * @param patient
	 *            object of a OutPatient class
	 * @return boolean value true if success otherwise false
	 * @throws Method
	 *             throws a {@link RuntimeException} in failing the update,
	 *             throws a {@link HibernateException} on error rolling back
	 *             transaction.
	 */
	public boolean insertPatient(OutPatient patient, int userid,String dob) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid);
			patient.setPatientLastUpdateUser(user);
			patient.setPatientCreateUser(user);

			session.save(patient);
			tx.commit();
			return(cpsDBDriver.sendNewPatientObjToCPS(patient,dob));
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if(tx == null)
			{
				throw ex;
			}
			else
			{
				return false;
			}
		}

	}

	/**
	 * This method update the patient details of the OPD patient
	 * 
	 * @param patient
	 *            object of the OutPatient class
	 * @return boolean value. true on success
	 * @throws Method
	 *             throws a {@link RuntimeException} in failing the update,
	 *             throws a {@link HibernateException} on error rolling back
	 *             transaction.
	 */
	public boolean updatePatient(int patientID, OutPatient pat, int userid,String dob) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			OutPatient patient = (OutPatient) session.get(OutPatient.class,
					patientID);

			patient.setPatientTitle(pat.getPatientTitle());
			patient.setPatientFullName(pat.getPatientFullName());
			patient.setPatientPersonalUsedName(pat.getPatientPersonalUsedName());
			patient.setPatientNIC(pat.getPatientNIC());
			//patient.setPatientHIN(pat.getPatientHIN());

			if (pat.getPatientPhoto() == null | pat.getPatientPhoto().isEmpty()
					| pat.getPatientPhoto() == "null")
				patient.setPatientPhoto(patient.getPatientPhoto());
			else {

				String photo = pat.getPatientPhoto();
				photo = photo.substring(photo.lastIndexOf("/") + 1, photo.length());
				patient.setPatientPhoto(photo);
 
			}
			patient.setPatientPassport(pat.getPatientPassport());
			patient.setPatientDateOfBirth(pat.getPatientDateOfBirth());
			patient.setPatientContactPName(pat.getPatientContactPName());
			patient.setPatientContactPNo(pat.getPatientContactPNo());
			patient.setPatientGender(pat.getPatientGender());
			patient.setPatientCivilStatus(pat.getPatientCivilStatus());
			patient.setPatientAddress(pat.getPatientAddress());
			patient.setPatientTelephone(pat.getPatientTelephone());
			patient.setPatientPreferredLanguage(pat
					.getPatientPreferredLanguage());
			patient.setPatientCitizenship(pat.getPatientCitizenship());
			patient.setPatientblood(pat.getPatientblood());
			patient.setPatientRemarks(pat.getPatientRemarks());
			patient.setPatientActive(pat.getPatientActive());
			patient.setPatientCreateUser(patient.getPatientCreateUser());

			AdminUser user = (AdminUser) session.get(AdminUser.class, userid);
			patient.setPatientLastUpdateUser(user);

			patient.setPatientLastUpdate(pat.getPatientLastUpdate());

			session.update(patient);
			tx.commit();
			//cpsDBDriver.sendUpdatedPatientObjToCPS(patient,dob);
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
			else if(tx == null)
			{
				throw ex;
			}
			else
			{
				return false;
			}
		}

	}

	/**
	 * This method returns the all the details a given patient Id.
	 * 
	 * @param patientId
	 * @return patient object of the OutPatient class
	 * @throws Method
	 *             throws a {@link RuntimeException} in failing the update,
	 *             throws a {@link HibernateException} on error rolling back
	 *             transaction.
	 */

	public OutPatient getPatientDetails(int patientId) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session
					.createQuery("select p from OutPatient as p where p.patientID = :pid order by patientLastUpdate");
			query.setParameter("pid", patientId);

			List patientList = query.list();

			if (patientList.size() == 0)
				return null;

			
			 
			OutPatient patient = (OutPatient) patientList.get(0);
			Set<Exams> patientExams = new HashSet<Exams>();
			Set<AnswerSet> answerSet = new HashSet<AnswerSet>();

			for (Visit v : patient.getVisits()) {
				for (Exams exam : v.getExams()) {
					patientExams.add(exam);
				}
			}

			query = session
					.createQuery("from AnswerSet where visit.patient=:pid");
			query.setParameter("pid", patient);

			List<AnswerSet> answersetList = query.list();
			for (AnswerSet as : answersetList) {
				answerSet.add(as);
			}

			patient.setExams(patientExams);
			patient.setAnswerSets(answerSet);

			tx.commit();
			return patient;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if(tx == null)
			{
				throw ex;
			}
			else
			{
				return null;
			}
		}

	}

	/**
	 * This method retrieve a list of current OPD patient
	 * 
	 * @return OPD patient list List<OutPatient>
	 * @throws Method
	 *             throws a {@link RuntimeException} in failing the update,
	 *             throws a {@link HibernateException} on error rolling back
	 *             transaction.
	 */
	public List<OutPatient> getPatientList() {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select p from OutPatient as p");
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
			else if(tx == null)
			{
				throw ex;
			}
			else
			{
				return null;
			}
		}
	}

	/***
	 ***************** Need to Modify
	 * 
	 * @param userID
	 * @param visitType
	 * @return
	 */
	public OutPatient getPatient_By_VisitType(int userID, int visitType) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session
					.createQuery("Select pt from Patient as pt , Visit as visit where ( pt.patientID = visit.PID AND visit.Doctor = :uid AND visit.Type = '"
							+ ((visitType == 1) ? "OPD" : "Clinic")
							+ "') order by visit.DateOfVisit desc");
			query.setParameter("uid", userID);
			// query.setParameter("visitID", visitType);
			List patientList = query.list();
			OutPatient patient = new OutPatient();
			for (Iterator iter = patientList.iterator(); iter.hasNext();) {
				patient = (OutPatient) iter.next();
			}
			tx.commit();
			return patient;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if(tx == null)
			{
				throw ex;
			}
			else
			{
				return null;
			}
		}

	}

	/***
	 ***************** Need to Modify
	 * 
	 * @param userID
	 * @param visitType
	 * @return
	 */
	public List<Visit> getPatientsForDoctor(int userID, int visitType) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			

			Query query = session
					.createQuery("from Visit as v where v.visitDoctor = "+ userID + " AND v.visitType = '"+ ((visitType == 1) ? "OPD" : "Clinic")+ "') order by v.visitDate desc");
			System.out.print(userID);
			System.out.print(visitType);
			List<Visit> patientList = query.list();
			tx.commit();

			return patientList;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					System.out.println(ex.getMessage());
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if(tx == null)
			{
				throw ex;
			}
			else
			{
				return null;
			}
		}

	}

	public static <T> List<T> castList(Class<? extends T> clazz, Collection<?> c) {
		List<T> r = new ArrayList<T>(c.size());
		for (Object o : c)
			r.add(clazz.cast(o));
		return r;
	}
	
	/***
	 * 
	 * 
	 * @return patientID
	 */
	public String getMaxPatientID() {
		
		Transaction tx = null;
		String HIN = "";
		
		try {			
			tx = session.beginTransaction();
			Query query = session.createSQLQuery("select MAX(patient_id) from opd_patient");
//			Query query = session.createSQLQuery("Select MAX(p.patientID) from Patient as p");
			List<?> list = query.list();
			HIN = (String)list.get(0).toString();			
			tx.commit();
		} catch (Exception e) {
			System.out.println("555555555555555555555555");
		}
		return HIN;
		
	}
	

}
