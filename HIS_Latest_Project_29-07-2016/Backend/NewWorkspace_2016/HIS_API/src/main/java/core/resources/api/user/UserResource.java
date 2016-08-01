/*
--------------------------------------------------------------------------------------------------------
HIS – Health Information System - RESTful  API
--------------------------------------------------------------------------------------------------------
This is a free and open source API which can be used to develop and
distributed in the hope that it will be useful to develop EMR systems.
You can utilize the services provides by the API to speed up the 
development process. You can modify the API to cater your requirements at your own risk.  
--------------------------------------------------------------------------------------------------------
Authors: H.L.M.M De Silva, K.V.M Jayadewa, G.A.R Perera, S.I Kodithuwakku
Supevisor: Dr. Koliya Pulasinghe | Dean /Faculty of Graduate Studies |SLIIT
Co-Supervisor: Mr.Indraka Udayakumara | Senior Lecturer | SLIIT
URL: https://sites.google.com/a/my.sliit.lk/his
--------------------------------------------------------------------------------------------------------
*/

package core.resources.api.user;

import lib.driver.api.driver_class.user.UserDBDriver;
import core.classes.api.user.AdminUser;
import lib.classes.securitymodel.encryption.DataHashing;

import javax.annotation.PostConstruct;
import javax.ws.rs.Consumes;
import javax.ws.rs.DELETE;
import javax.ws.rs.GET;
import javax.ws.rs.PUT;
import javax.ws.rs.Path;
import javax.ws.rs.POST;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.codehaus.jettison.json.JSONArray;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import flexjson.JSONSerializer;

import java.security.NoSuchAlgorithmException;
import java.security.spec.InvalidKeySpecException;
import java.util.List;



/**
 * UserService class contains all the rest-full web methods regarding AdminUser
 * @author MIYURU
 *
 */

@Path("UserService")
public class UserResource {
	
	UserDBDriver userDBDriver=new UserDBDriver();
	DataHashing dataHashing = new DataHashing();
	
	
	/**
	 * Register a new user to the system
	 * @param uJson the JSON object that contains details about newly creating user
	 * @return a string value.True if the registration is successful else it returns false
	 */	
	
	@POST
	@Path("/registerUser")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String registerUser( JSONObject uJson){
		System.out.println(uJson.toString());
		String result="false";
		boolean r=false;
		 AdminUser usr=new AdminUser();

		
		try{
			
			
			 int userRoleID=uJson.getInt("roleId");
			 int employeeID=uJson.getInt("employeeId");
			 usr.setUserName(uJson.getString("userName"));	
			 usr.setIsActive(true);	
			 usr.setPassword(dataHashing.createHash(uJson.getString("password")));
/*			 JSONArray permissions=(JSONArray)uJson.get("userPermissions");
			 int[] permissionArray = new int[permissions.length()];
			
			for(int i=0;i<permissions.length();i++){
				permissionArray[i]=permissions.getInt(i);
			}*/
		
						
			//r=userDBDriver.insertUser(usr,userRoleID,employeeID,permissionArray);
			r=userDBDriver.insertUser(usr,userRoleID,employeeID);
			result=String.valueOf(r);
			
			return result;
			 
		}
		
		catch( JSONException ex){
			ex.printStackTrace();	
			return result;
		}
		
		catch( NoSuchAlgorithmException ex){
			ex.printStackTrace();
			return result;
		}
		
		catch( InvalidKeySpecException ex){
			ex.printStackTrace();
			return result;
		}
		
		catch( Exception ex){
			ex.printStackTrace();
			return ex.getMessage();
		}
		
		
	}
	
	
	/**
	 * Get all the users that registered in the system	
	 * @return returns a JSON object that contains all the registered users
	 */
	
	@GET
	@Path("/getActiveUsers")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllActiveUserDetails(){
		String result="";
		List<AdminUser> usrList =userDBDriver.getUserDetails();

		JSONSerializer serializor=new JSONSerializer();
		result = serializor.include("adminUserroles.roleId","adminUserroles.roleName","adminUserroles.adminPermissions.permissionDiscription",
									"employees.empId","employees.firstName","employees.lastName")
									.exclude("*.class","employees.*","password").serialize(usrList);
		 
		return result;
		
	}
	
	
	/***
	 * Get the user by AdminUser ID
	 * @param uID is a integer parameter that contains requesting user's ID
	 * @return  JSON object that contains  the registered user's details
	 */
	
	
	@GET
	@Path("/getUserByUsrID/{uID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getUserDetailsByUserID(@PathParam("uID")  int uID){
		String result="";
		 List<AdminUser> usrList =userDBDriver.getUserDetailsByUserID(uID);

		 JSONSerializer serializor=new JSONSerializer();
		result = serializor.include("userId","userName","hrEmployee.empId","password","adminUserroles.roleId","adminUserroles.roleName",
									"adminUserroles.adminPermissions.permissionDiscription","adminUserroles.adminPermissions.permissionId")
									.exclude("*").serialize(usrList);
		 
		return result;
		
	}
	
	
	
	/***
	 * 
	 * Delete a particular user from the system with that users credential data
	 * @param jsnObj is JSON object that contains data about user that going to delete
	 * @return returns a string value.True if the user deleted successfully else it returns false
	 */	
	
	@DELETE
	@Path("/deleteUser")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String deleteUser(JSONObject jsnObj){
		String result="false";
		boolean r=false;
		 AdminUser usrObj=new AdminUser();
		
		
		try{
			
			usrObj.setUserId(jsnObj.getInt("userId"));
						
						
			r=userDBDriver.deleteUser(usrObj);
			result=String.valueOf(r);
			
			return result;
			
			
		}
		
		catch( JSONException ex){
			ex.printStackTrace();	
			return result;
		}
		
		
	}
	
	
	
	/***
	 * Update AdminUser details 
	 * @param jsnUser is a JSON object which contains new details about the user that need to be updated
	 * @return returns a string value.True if the user updated successfully else it returns false
	 */
	
	@PUT
	@Path("/updateUser")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String updateUserDetails(JSONObject jsnUser){
		
		String result="false";
		boolean r=false;
		 AdminUser usrObj=new AdminUser();
		 System.out.println(jsnUser.toString());
		try{
			
			int userRoleID=jsnUser.getInt("roleId");
			int employeeID=jsnUser.getInt("employeeId");
			
			//int usrID=jsnUser.getInt("uID");
			usrObj.setUserId(jsnUser.getInt("userId"));
			usrObj.setUserName(jsnUser.getString("userName"));		
			//usrObj.setPassword(dataHashing.createHash(jsnUser.getString("password")));
			
			r=userDBDriver.updateUserDetails(usrObj,userRoleID,employeeID);
//			r=userDBDriver.updateUserDetails(usrObj,userRoleID);
			result=String.valueOf(r);
			return result;
			
		}
		catch( JSONException ex){
			ex.printStackTrace();	
			return result;
		}
//		catch( NoSuchAlgorithmException ex){
//			ex.printStackTrace();
//			return result;
//		}
//		
//		catch( InvalidKeySpecException ex){
//			ex.printStackTrace();
//			return result;
//		}
		
		catch( Exception ex){
			ex.printStackTrace();
			return ex.getMessage();
		}

	}
	
	

	
	/***
	 * Validate AdminUser Name and Password in the system.
	 * @param jsnObj is a JSON object that contains data about user's user name and user password.
	 * @return returns a string value.True if the user credentials are valid else it returns false.
	 */
	
	@POST
	@Path("/userValidation")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String userValidation( JSONObject jsnObj){
		String result="false";
		//boolean r=false;
		 AdminUser usr=new AdminUser();
		
		try{
			usr.setUserName(jsnObj.getString("user_name"));
			usr.setPassword(jsnObj.getString("password"));
			if(userDBDriver.validateUserLoginDetails(usr)){
				 List<AdminUser> validUser  = userDBDriver.getValidUserDetails(usr);
				 JSONSerializer serializor=new JSONSerializer();
				result = serializor.include("userId","hrEmployee.empId","adminUserroles.roleId","userName","adminUserroles.adminPermissions.permissionDiscription").exclude("*").serialize(validUser);
				return result;
			}
			else{
				return result;
			}			
		}
		catch( JSONException ex){
			ex.printStackTrace();
			return result;
		}
		
	}
	
	
	/***
	 * Get the available doctors that to generate the OPD queue for a particular date.
	 * @param empType is a String parameter that contains the employee's type
	 * @return JSON object that contains the available doctors in OPD
	 */
	
	@GET
	@Path("/getAvailableDoctorsForOPD/{empType}")
	@Produces(MediaType.APPLICATION_JSON)
	public   String getAvailabeDoctorsForOPD(@PathParam("empType")   String empType){
		String result="";
		  List<AdminUser> usrList =userDBDriver.getAvailableEmployees(empType);
		  JSONSerializer serializor=new JSONSerializer();
		result = serializor.include("employees.empName","employees.empType","employees.empID",
				"userId","userName").exclude("*").serialize(usrList);
		 
		return result;
	}
	
	
	
	/***
	 * Add new special permissions for a specific user
	 * @param jsnObj contains the special permissions(IDs) that need to be add and the user(ID)
	 * @return returns a string value.True if special permissions added successfully else it returns false
	 */
	
	@PUT
	@Path("/addSpecialUserPermissions")
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces(MediaType.TEXT_PLAIN)
	public   String addSpecialPermission(  JSONObject jsnObj){
		String result="";
		boolean r=false;
		try{
			  int userId=jsnObj.getInt("userId");
			  JSONArray permissions=(JSONArray)jsnObj.get("permissions");
			  int[] permissionArray = new int[permissions.length()];
			
			for(int i=0;i<permissions.length();i++){
				permissionArray[i]=permissions.getInt(i);
			}
			r=userDBDriver.addSpecialUserPermission(userId, permissionArray);
			result=String.valueOf(r);
			return result;
		}
		catch(  JSONException ex){
			ex.printStackTrace();	
			return result;
		}
	}
	
	
	
	/***
	 * Remove special permissions from a specific user
	 * @param jsnObj contains the permissions(IDs) that need to be removed and the  user(ID)
	 * @return returns a string value.True if special permissions removed successfully else it returns false
	 */
	
	@PUT
	@Path("/removeSpecialUserPermissions")
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces(MediaType.TEXT_PLAIN)
	public   String removeSpecialPermission(  JSONObject jsnObj){
		String result="";
		boolean r=false;
		try{
			  int userId=jsnObj.getInt("userId");
			  JSONArray permissions=(JSONArray)jsnObj.get("permissions");
			  int[] permissionArray = new int[permissions.length()];
			
			for(int i=0;i<permissions.length();i++){
				permissionArray[i]=permissions.getInt(i);
			}
			r=userDBDriver.removeSpecialUserPermission(userId, permissionArray);
			result=String.valueOf(r);
			return result;
		}
		catch( JSONException ex){
			ex.printStackTrace();	
			return result;
		}
	}
	
	/***
	 * Check Old Password when password Changing
	 * @param jsnObj contains the user credential data
	 * @return returns a string value.True if Old Password is correct else it returns false
	 */
	@POST
	@Path("/checkOldPassword")
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces(MediaType.TEXT_PLAIN)
	public String checkOldPassword(JSONObject jsnObj){
		String result="";
		boolean r=false;
		AdminUser usr=new AdminUser();
		try{
			usr.setUserId(jsnObj.getInt("userId"));
			usr.setUserName(jsnObj.getString("userName"));
			usr.setPassword(jsnObj.getString("password"));
			r=userDBDriver.validateUserLoginDetails(usr);
			result=String.valueOf(r);
			return result;
		}
		catch(JSONException ex){
			ex.printStackTrace();	
			return result;
		}
	}
	
	
	/***
	 * Update The Password Details
	 * @param jsnObj contains user new credential data
	 * @return returns true if data updated else it returns false
	 */
	@POST
	@Path("/updateOldPassword")
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces(MediaType.TEXT_PLAIN)
	public String updateOldPassword(JSONObject jsnObj){
		String result="";
		boolean r=false;
		AdminUser usr=new AdminUser();
		try{
			usr.setUserId(jsnObj.getInt("userId"));
			usr.setUserName(jsnObj.getString("userName"));
			usr.setPassword(dataHashing.createHash(jsnObj.getString("newPassword")));			
			r=userDBDriver.updateUserPassword(usr);
			result=String.valueOf(r);
			return result;
		}
		
		catch(NoSuchAlgorithmException ex){
			ex.printStackTrace();
			return result;
		}
		
		catch(InvalidKeySpecException ex){
			ex.printStackTrace();
			return result;
		}
		
		catch(JSONException ex){
			ex.printStackTrace();	
			return result;
		}
	}
	
	
	
	

	
	
	
}
