package lib.driver.inward.driver_class.admin;

import java.util.List;

import lib.SessionFactoryUtil;
import lib.classes.CasttingMethods.CastList;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;



import core.classes.inward.WardAdmission.Inpatient;
import core.classes.inward.admin.Bed;
import core.classes.inward.admin.Ward;





public class BedDBDriver {
	
	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public boolean insertBed(Bed bed,String wardno) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Ward ward = (Ward) session.get(Ward.class, wardno);
			bed.setWardNo(ward);
			session.save(bed);
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
	
	public List<Bed> getAllBedByWardNo(String wardNo){
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select u from Bed as u where u.wardNo.wardNo=:wardNo");
			query.setParameter("wardNo", wardNo);
			List<Bed> bedList =CastList.castList(Bed.class, query.list()); 
			tx.commit();
			return bedList;
			
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
			return null;
		}
	}
	
	
	public boolean deleteBed(Bed bed)
	{
		Transaction tx=null;
		
	try {
			
			tx=session.beginTransaction();
			session.delete(bed);
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
		return false;
	}
		
	}
	
	
	public boolean updateBed(Bed bedObj,String wardNo,int pid){
		Transaction tx=null;
		
		try{
			tx=session.beginTransaction();
			Ward ward = (Ward) session.get(Ward.class, wardNo);
			bedObj.setWardNo(ward);
			
			if(pid==0){
				
				bedObj.setPatientID(null);
			}else{
				Inpatient p = (Inpatient) session.get(Inpatient.class, pid);
				bedObj.setPatientID(p);
			}
			
			
			session.update(bedObj);
			
			
		
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
			return false;
		}
		
	}
	
	
	public List<Bed> geBedByWardNoAndBedNo(String wardNo,int bedNo){
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select u from Bed as u where u.wardNo.wardNo=:wardNo and u.bedNo=:bedNo");
			query.setParameter("wardNo", wardNo);
			query.setParameter("bedNo", bedNo);
			List<Bed> bedList =CastList.castList(Bed.class, query.list()); 
			tx.commit();
			return bedList;
			
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
			return null;
		}
	}
	
	public List<Bed> getFreeBedByWardNo(String wardNo){
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select u from Bed as u where u.wardNo.wardNo=:wardNo and u.availability=:free");
			query.setParameter("wardNo", wardNo);
			query.setParameter("free", "free");
			List<Bed> bedList =CastList.castList(Bed.class, query.list()); 
			tx.commit();
			return bedList;
			
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
			return null;
		}
	}
	
}
