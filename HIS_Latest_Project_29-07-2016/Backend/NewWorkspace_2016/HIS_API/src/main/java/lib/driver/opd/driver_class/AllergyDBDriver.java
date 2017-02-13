package lib.driver.opd.driver_class;

import java.util.ArrayList;
import java.util.Collection;
import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.api.user.AdminUser;
import core.classes.api.user.AdminUser;
import core.classes.opd.Allergy;
import core.classes.opd.LiveAllergy;
import core.classes.opd.LiveInjury;
import core.classes.opd.OutPatient;



public class AllergyDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().getCurrentSession();
	
	public boolean saveAllergy(Allergy allergy,int userid, int pID){
		Transaction tx=null;
		
		try {
			tx = session.beginTransaction();
			OutPatient patient = (OutPatient) session.get(OutPatient.class, pID);
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid);
			allergy.setAllergyCreateUser(user);
			allergy.setAllergyLastUpdateUser(user);
			
			allergy.setPatient(patient);
			session.save(allergy);
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
			else
			{
				return false;
			}
		}		
		
	}
	
	
	public boolean updateAllergy(Allergy alrgy,int userid){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Allergy allergy=(Allergy) session.get(Allergy.class, alrgy.getAllergyID());
			allergy.setAllergyName(alrgy.getAllergyName());
			allergy.setAllergyRemarks(alrgy.getAllergyRemarks());
			allergy.setAllergyStatus(alrgy.getAllergyStatus());
			allergy.setAllergyLastUpdate(allergy.getAllergyLastUpdate());
			
			AdminUser user = (AdminUser) session.get(AdminUser.class, userid); 
			allergy.setAllergyLastUpdateUser(user);
			
			allergy.setAllergyActive(alrgy.getAllergyActive()  );
			session.update(allergy);
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
			else
			{
				return false;
			}
		}

	}
	
	
	public List<Allergy> retrieveAllergiesByPatientID(int pID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			OutPatient patient = (OutPatient) session.get(OutPatient.class, pID);
			Query query = session.createQuery("Select a from Allergy as a where a.patient=:patient ");
			query.setParameter("patient", patient);
			List<Allergy> aList = castList(Allergy.class,query.list());
			System.out.println("shermin"+aList.toString() );
			tx.commit();
			return aList;
		} catch (RuntimeException ex) {
			
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.out.println("Error rolling back transaction");
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
	
	
	public List<Allergy> retrieveAllergy(int aID){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			String hql="select a from Allergy as a where a.allergyID=:aID";
			Query query = session.createQuery(hql);
			query.setParameter("aID", aID);
			List<Allergy> allergyRecord=castList(Allergy.class, query.list());
			tx.commit();
			return allergyRecord;
			
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
	
	 
	
	
	public static <T> List<T> castList(Class<? extends T> clazz, Collection<?> c) {
	    List<T> r = new ArrayList<T>(c.size());
	    for(Object o: c)
	      r.add(clazz.cast(o));
	    return r;
	}
	
	public List<LiveAllergy> liveSearchAllergy(){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery(" FROM LiveAllergy");
			//List<LiveAllergy> aList = castList(LiveAllergy.class,query.list());
			List<LiveAllergy> aList=query.list();
			System.out.println("Ashan : "+aList.toString() );
			tx.commit();
			return aList;
		} catch (RuntimeException ex) {
			
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.out.println("Error rolling back transaction");
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
	
	public List<LiveInjury> liveSearchInjury(){
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery(" FROM LiveInjury");
			List<LiveInjury> aList=query.list();
			System.out.println("Ashan : "+aList.toString() );
			tx.commit();
			return aList;
		} catch (RuntimeException ex) {
			
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.out.println("Error rolling back transaction");
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
	
}
