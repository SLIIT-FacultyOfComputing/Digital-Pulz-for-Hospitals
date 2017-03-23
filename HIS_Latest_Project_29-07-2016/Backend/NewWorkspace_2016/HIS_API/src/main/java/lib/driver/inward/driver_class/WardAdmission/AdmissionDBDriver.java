package lib.driver.inward.driver_class.WardAdmission;

import java.util.Date;
import java.util.List;

import lib.SessionFactoryUtil;
import lib.classes.CasttingMethods.CastList;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.api.user.AdminUser;
import core.classes.hr.HrEmployee;
import core.classes.inward.WardAdmission.Admission;
import core.classes.inward.WardAdmission.Inpatient;


public class AdmissionDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();	
	
	public boolean insertWardAdmission(Admission admission,int pid,int docID,int createUser,int UpdateUser) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			
			AdminUser creuser = (AdminUser) session.get(AdminUser.class, createUser);
			admission.setCreatedUser(creuser);
			
			AdminUser Upuser = (AdminUser) session.get(AdminUser.class, UpdateUser);
			admission.setLastUpdatedUser(Upuser);
			
			HrEmployee doc=(HrEmployee) session.get(HrEmployee.class, docID);
			admission.setDoctorID(doc);
			
			Inpatient patient=(Inpatient) session.get(Inpatient.class, pid);
			admission.setpatientID(patient);
			
			session.save(admission);
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
			else if (tx==null)
			{
				return false;
			}
			else
			{
			return false;
			}
		}

	}
	
	
	public List<Admission> getWardAdmissionList() {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select w from Admission as w");
			@SuppressWarnings("unchecked")
			List<Admission> wardlist = query.list();
			tx.commit();
			return wardlist;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if (tx==null)
			{
				return null;
			}
			else
			{
			return null;
			}
		}
	}
	
	
	public List<Admission> getWardAdmissionByPatientID(int patientID){
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Inpatient patient = (Inpatient) session.get(Inpatient.class, patientID);
			Query query =  session.createQuery("select u from Admission as u where u.patientID=:patientID");
			query.setParameter("patientID", patient);
			List<Admission> wardList =CastList.castList(Admission.class, query.list()); 
			tx.commit();
			return wardList;
			
		}
		catch(RuntimeException ex){
			if(tx != null && tx.isActive())
			{
				try{
					tx.rollback();
				}catch(HibernateException he){
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if (tx==null)
			{
				return null;
			}
			else
			{
			return null;
			}
		}
	}
	
	
	public List<Admission> getWardAdmissionDetails(String bhtNo){
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select u from Admission as u where u.bhtNo=:bhtNo");
			query.setParameter("bhtNo", bhtNo);
			List<Admission> wardList =CastList.castList(Admission.class, query.list()); 
			tx.commit();
			return wardList;
			
		}
		catch(RuntimeException ex){
			if(tx != null && tx.isActive())
			{
				try{
					tx.rollback();
				}catch(HibernateException he){
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if (tx==null)
			{
				return null;
			}
			else
			{
			return null;
			}
		}
	}
	
	
	public boolean updateDischarge(String BhtNo, String discharjType,String remark,int LastUpdatedUser,Date LastUpdatedDateTime,String outcomes,String dischargediagnosis,String referredto){
	//public boolean updateDischarge(String BhtNo, String discharjType,String remark,int LastUpdatedUser,Date LastUpdatedDateTime,String status,String sign){
	Transaction tx=null;
		
		try{
			
			tx=session.beginTransaction();
			
			Admission adm=new Admission();
			adm=(Admission) session.get(Admission.class,BhtNo);
			adm.setDischargeType(discharjType);
			adm.setRemark(remark);
			adm.setLastUpdatedDateTime(LastUpdatedDateTime);
			//adm.setSign(sign);
			//adm.setStatus(status);
			adm.setOutcomes(outcomes);
			adm.setDischargediagnosis(dischargediagnosis);
			adm.setReferredto(referredto);
			
			
			AdminUser lastuser = (AdminUser) session.get(AdminUser.class, LastUpdatedUser);
			
			adm.setLastUpdatedUser(lastuser);
			
			
			session.update(adm);
			
			tx.commit();
			return true;
		}
		
		catch (RuntimeException ex) {
			if(tx != null && tx.isActive()){
				try{
					tx.rollback();
				}catch(HibernateException he){
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if (tx==null)
			{
				return false;
			}
			else
			{
			return false;
			}
		}
		
	}
	
	public boolean updateDischargeSign(String BhtNo, String status,String sign,int LastUpdatedUser){
		Transaction tx=null;
			
			try{
				
				tx=session.beginTransaction();
				
				Admission adm=new Admission();
				adm=(Admission) session.get(Admission.class,BhtNo);
								
				adm.setSign(sign);
				adm.setStatus(status);
				AdminUser lastuser = (AdminUser) session.get(AdminUser.class, LastUpdatedUser);
				adm.setLastUpdatedUser(lastuser);
				
				session.update(adm);
				
				tx.commit();
				return true;
			}
			
			catch (RuntimeException ex) {
				if(tx != null && tx.isActive()){
					try{
						tx.rollback();
					}catch(HibernateException he){
						System.err.println("Error rolling back transaction");
					}
					throw ex;
				}
				else if (tx==null)
				{
					return false;
				}
				else
				{
				return false;
				}
			}
			
		}
	
	public List<Admission> getWardAdmissionByWardNo(String wardNo){
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			
			Query query =  session.createQuery("select u from Admission as u where u.wardNo=:wardNo and u.dischargeType='none' and u.bedNo=-99");
			query.setParameter("wardNo", wardNo);
			List<Admission> wardList =CastList.castList(Admission.class, query.list()); 
			tx.commit();
			return wardList;
			
		}
		catch(RuntimeException ex){
			if(tx != null && tx.isActive())
			{
				try{
					tx.rollback();
				}catch(HibernateException he){
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if (tx==null)
			{
				return null;
			}
			else
			{
			return null;
			}
		}
	}
	
	public boolean updateAdmissionBedNo(String BhtNo, int newBed,int LastUpdatedUser,Date LastUpdatedDateTime){
		Transaction tx=null;
		
		try{
			
			tx=session.beginTransaction();
			
			Admission adm=new Admission();
			adm=(Admission) session.get(Admission.class,BhtNo);
			adm.setBedNo(newBed);
			adm.setLastUpdatedDateTime(LastUpdatedDateTime);
			
			AdminUser lastuser = (AdminUser) session.get(AdminUser.class, LastUpdatedUser);
			
			adm.setLastUpdatedUser(lastuser);
			
			
			session.update(adm);
			
			tx.commit();
			return true;
		}
		
		catch (RuntimeException ex) {
			if(tx != null && tx.isActive()){
				try{
					tx.rollback();
				}catch(HibernateException he){
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if (tx==null)
			{
				return false;
			}
			else
			{
			return false;
			}
		}
		
	}
	
	public List<Admission> getOnlyPatientDetails(String bhtNo){
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select u from Admission as u where u.bhtNo=:bhtNo");
			query.setParameter("bhtNo", bhtNo);
			List<Admission> wardList =CastList.castList(Admission.class, query.list()); 
			tx.commit();
			return wardList;
			
		}
		catch(RuntimeException ex){
			if(tx != null && tx.isActive())
			{
				try{
					tx.rollback();
				}catch(HibernateException he){
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			else if (tx==null)
			{
				return null;
			}
			else
			{
			return null;
			}
		}
	}
}