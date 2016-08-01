package lib.driver.api.driver_class.user;

import java.util.HashSet;
import java.util.List;
import java.util.Set;

import lib.SessionFactoryUtil;
import lib.classes.CasttingMethods.CastList;
import lib.classes.DBDriverBase.DBDriverBase;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.api.user.AdminPermission;
import core.classes.api.user.AdminUserroles;



/**
 * RoleDBDriver class contains all the CRUD operation methods that required by RoleResource class(web service)
 * @author MIYURU
 *
 */


public class RoleDBDriver{

	Session session = SessionFactoryUtil.getSessionFactory().openSession();

	/***
	 * Insert a new user role into the database
	 * @param usRl is a AdminUserroles type object that contains data about new user
	 * @return a boolean value. Returns true if data inserted successfully else returns false
	 */
	
	//public boolean insertUserRole(AdminUserroles usRl,int[] permissionArray){
	  public boolean insertUserRole(AdminUserroles usRl){
		Transaction tx = null;
		HashSet<AdminPermission> permissionSet=new HashSet<>();
		
		try{	
			tx = session.beginTransaction();			
//			for(int i=0;i<permissionArray.length;i++){
//				AdminPermission permissionObj=(AdminPermission) session.get(AdminPermission.class, permissionArray[i]);
//				permissionSet.add(permissionObj);
//			}
//			usRl.setPermissions(permissionSet);
			session.save(usRl);
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
	 * Update data of a particular user role into the database.
	 * @param usRlObj is a AdminUserroles type object that contains data about updating user
	 * @return a boolean value. Returns true if user role details updated Successfully else returns false
	 */
	
	public boolean updateUserRole(AdminUserroles usRlObj){
		
		Transaction tx=null;
		AdminUserroles updateUserObj=new AdminUserroles();
		
		try{
			tx=session.beginTransaction();
			updateUserObj=(AdminUserroles) session.get(AdminUserroles.class, usRlObj.getRoleId());
			updateUserObj.setRoleName(usRlObj.getRoleName());			
			session.update(updateUserObj);
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
	 * Add new permissions for a specific user role into the database
	 * @param userRoleID is the ID of the selected user role that need to add new permissions
	 * @param permissionArray is an integer array that contains the permissions(IDs) that need to add
	 * @return a boolean value. Returns true if permissions added Successfully else returns false
	 */	
	
	public boolean addPermissionsForUserRoles(int userRoleID,int[] permissionArray){
		
		Transaction tx=null;
		AdminUserroles updateUserObj=new AdminUserroles();
		
		try{
			tx=session.beginTransaction();
			updateUserObj=(AdminUserroles) session.get(AdminUserroles.class, userRoleID);
			Set <AdminPermission> permissionSet =(Set<AdminPermission>)updateUserObj.getAdminPermissions(); 
			for(int i=0;i<permissionArray.length;i++){
				AdminPermission permissionObj=(AdminPermission) session.get(AdminPermission.class, permissionArray[i]);
				permissionSet.add(permissionObj);
			}
			
			session.update(updateUserObj);
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
	 * Remove permissions from a specific user role in the database 
	 * @param userRoleID is the ID of the selected user role that need remove permissions
	 * @param permissionArray is an integer array that contains the permissions(IDs) that need to remove
	 * @return a boolean value. Returns true if permissions removed Successfully else returns false
	 */
	
	public boolean removePermissionsFromUserRoles(int userRoleID,int[] permissionArray){
		
		Transaction tx=null;
		AdminUserroles updateUserObj=new AdminUserroles();
		
		try{
			tx=session.beginTransaction();
			updateUserObj=(AdminUserroles) session.get(AdminUserroles.class, userRoleID);
			Set <AdminPermission> permissionSet =(Set <AdminPermission>)updateUserObj.getAdminPermissions(); 
			for(int i=0;i<permissionArray.length;i++){
				AdminPermission permissionObj=(AdminPermission) session.get(AdminPermission.class, permissionArray[i]);
				permissionSet.remove(permissionObj);
			}
			
			session.update(updateUserObj);
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
	 * Delete a user role from the database.
	 * @param usRlobj is a AdminUserroles type object that contains data about deleting user role's details
	 * @return a boolean value. Returns true if user role deleted Successfully else returns false
	 */
	
	public boolean deleteUserRole(AdminUserroles usRlobj){
		Transaction tx=null;
		AdminUserroles updateUserObj=new AdminUserroles();
		
		try{
			tx=session.beginTransaction();
			updateUserObj=(AdminUserroles) session.get(AdminUserroles.class, usRlobj.getRoleId());
			updateUserObj.setIsActive(false);			
			session.update(updateUserObj);
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
	 * Select all registered user roles from the database
	 * @return returns a AdminUserroles type java List for the calling method
	 */

	public List<AdminUserroles> getUserRoleDetails(){
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select uRl from AdminUserroles as uRl where uRl.isActive = true");			
			List<AdminUserroles> userRoleList =CastList.castList(AdminUserroles.class, query.list()); 
			tx.commit();
			return userRoleList;
			
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
	
	
	public List<AdminUserroles> getUserRoleById(int roleId){
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select uRl from AdminUserroles as uRl where uRl.isActive = true AND uRl.roleId=:roleId");
			query.setParameter("roleId", roleId);			
			List<AdminUserroles> userRoleList =CastList.castList(AdminUserroles.class, query.list()); 
			tx.commit();
			return userRoleList;
			
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
