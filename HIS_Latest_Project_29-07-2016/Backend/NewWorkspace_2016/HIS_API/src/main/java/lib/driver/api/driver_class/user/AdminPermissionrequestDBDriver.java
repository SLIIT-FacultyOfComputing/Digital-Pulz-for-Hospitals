package lib.driver.api.driver_class.user;

import java.util.List;

import lib.SessionFactoryUtil;
import lib.classes.CasttingMethods.CastList;
import lib.classes.DBDriverBase.DBDriverBase;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.api.user.AdminPermission;
import core.classes.api.user.AdminPermissionrequest;
import core.classes.api.user.AdminUserroles;

public class AdminPermissionrequestDBDriver extends DBDriverBase<AdminPermissionrequest>  {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	
	/***
	 * Add new Permissions to the Database
	 * @param rpObj is a RolePermission type object that contains data about new permission
	 * @return a boolean value. Returns true if new permission inserted successfully else returns false
	 * 
	 */
	public boolean inserPermissionRequest(AdminPermissionrequest rpObj){
		Transaction tx = null;
		try{	
			tx = session.beginTransaction();
			session.save(rpObj);
			tx.commit();
			return true;
		}catch(RuntimeException ex){
			if(tx != null && tx.isActive())
			{
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
	
	
	/***
	 * Update permissions in the database
	 * @param rpObj is a RolePermission type object that contains data about new updated data
	 * @return a boolean value. Returns true if permission updated successfully else returns false
	 */
	
	
	public boolean updatePermissionRequest(AdminPermissionrequest rpObj){
		Transaction tx=null;
		
		try{
			tx=session.beginTransaction();
			session.update(rpObj);
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
	
	
	
	/***
	 * Delete a permission from the database
	 * @param rpObj is a RolePermission type object that contains data about deleteing permission
	 * @return  a boolean value. Returns true if permission deleted successfully else returns false
	 */
	
	
	public boolean deletePermissionRequest(AdminPermissionrequest rpObj){
		Transaction tx=null;
		
		try {
			
			tx=session.beginTransaction();
			session.delete(rpObj);
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
	
	/***
	 * Select all registered permissions from the database
	 * @return returns a RolePermission type java List for the calling method
	 */
	
	public List<AdminPermissionrequest> getAllPermissionRequests(){
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select pr from AdminPermissionrequest as pr where pr.isActive = true");		
			List<AdminPermissionrequest> permissionRequestList =CastList.castList(AdminPermissionrequest.class, query.list()); 
			tx.commit();
			return permissionRequestList;
			
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
	
	public List<AdminPermissionrequest> getPermissionRequest(int requestId){
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select pr from AdminPermissionrequest as pr where pr.requestId =:requestId");		
			query.setParameter("requestId",requestId);
			List<AdminPermissionrequest> permissionRequestList =CastList.castList(AdminPermissionrequest.class, query.list()); 
			tx.commit();
			return permissionRequestList;
			
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
