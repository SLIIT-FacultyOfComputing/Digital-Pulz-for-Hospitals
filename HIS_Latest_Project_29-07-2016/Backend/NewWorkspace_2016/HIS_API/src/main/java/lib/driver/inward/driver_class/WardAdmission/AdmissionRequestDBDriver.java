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
import core.classes.inward.WardAdmission.Admission;
import core.classes.inward.WardAdmission.AdmissionRequest;
import core.classes.inward.WardAdmission.Inpatient;
import core.classes.inward.admin.Ward;



public class AdmissionRequestDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();	
	
	public boolean insertAdmissionRequest(AdmissionRequest wardadmission, int pid,int createUser, int updateUser, String ward) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			
			AdminUser creuser = (AdminUser) session.get(AdminUser.class, createUser);
			wardadmission.setCreate_user(creuser);
			
			AdminUser Upuser = (AdminUser) session.get(AdminUser.class, updateUser);
			wardadmission.setLast_update_user(Upuser);
			
			Ward ward_no=(Ward) session.get(Ward.class, ward);
			wardadmission.setTransfer_ward(ward_no);
			
			Inpatient patient=(Inpatient) session.get(Inpatient.class, pid);
			wardadmission.setPatient_id(patient);
			
			session.save(wardadmission);
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
			else if(tx == null)
			{
				 throw ex;
				}
			else{
				return false;
			}
		

		}
		
		
	}

	public boolean updateAdmisiionRequest(String bhtNo, int lastUpdatedUser,Date lastUpdatedDateTime,int autoid) {
Transaction tx=null;
		
		try{
			
			tx=session.beginTransaction();
			
			AdmissionRequest adm=new AdmissionRequest();
			adm=(AdmissionRequest) session.get(AdmissionRequest.class,autoid);
						
			AdminUser lastuser = (AdminUser) session.get(AdminUser.class, lastUpdatedUser);
			Admission bht=(Admission) session.get(Admission.class, bhtNo);
			adm.setLast_update_user(lastuser);
			adm.setLast_update_date_time(lastUpdatedDateTime);
			adm.setBht_no(bht);
			adm.setIs_read(1);
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
			else if(tx == null)
			{
				 throw ex;
				}
			else{
				return false;
			}
		}
	}

	public List<AdmissionRequest> getSelectAdmissionReq(int auto_id) {
Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select i from AdmissionRequest as i where i.auto_id=:auto_id");
			query.setParameter("auto_id", auto_id);
			List<AdmissionRequest> transferList =CastList.castList(AdmissionRequest.class, query.list()); 
			tx.commit();
			return transferList;
			
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
			else if(tx == null)
			{
				 throw ex;
				}
			else{
				return null;
			}
		}
	}

	public List<AdmissionRequest> getNotReadAdmissionRequestByWard(String transfer_ward) {
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select i from AdmissionRequest as i where i.transfer_ward.wardNo=:transfer_ward and i.is_read = 0");
			query.setParameter("transfer_ward", transfer_ward);
			List<AdmissionRequest> transferList =CastList.castList(AdmissionRequest.class, query.list()); 
			tx.commit();
			return transferList;
			
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
			else if(tx == null)
			{
			 throw ex;
			}
			else{
				return null;
			}
		}
	}


}
