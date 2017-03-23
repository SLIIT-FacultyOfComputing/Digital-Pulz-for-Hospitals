package lib.driver.inward.driver_class.admin;


import java.util.List;
import lib.SessionFactoryUtil;
import lib.classes.CasttingMethods.CastList;
import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;
import core.classes.inward.admin.Ward;


public class WardDBDriver {
	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public boolean insertWard(Ward ward) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			session.save(ward);
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
		
	public List<Ward> getWardList() {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select w from Ward as w");
			@SuppressWarnings("unchecked")
			List<Ward> wardlist = query.list();
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
	
	
	public boolean deleteWard(Ward ward)
	{
		Transaction tx=null;
		
	try {
			
			tx=session.beginTransaction();
			session.delete(ward);
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
		else
		{
			return false;
		}
	}
		
	}
	
	
	public List<Ward> getWardDetailsByWardNo(String wardNo){
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select u from Ward as u where u.wardNo=:wardNo");
			query.setParameter("wardNo", wardNo);
			List<Ward> wardList =CastList.castList(Ward.class, query.list()); 
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
	
	public boolean updateUserDetails(Ward wardObj){
			Transaction tx=null;
			
			try{
				tx=session.beginTransaction();
			
				session.update(wardObj);
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
				else
				{
					return false;
				}
			}
			
		}
	

}
