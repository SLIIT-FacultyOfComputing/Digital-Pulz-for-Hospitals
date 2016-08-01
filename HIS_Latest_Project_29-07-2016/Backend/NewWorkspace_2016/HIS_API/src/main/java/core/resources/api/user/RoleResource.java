package core.resources.api.user;

import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.DELETE;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.PUT;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import lib.driver.api.driver_class.user.RoleDBDriver;

import org.codehaus.jettison.json.JSONArray;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.classes.api.user.AdminUserroles;
import flexjson.JSONSerializer;


/**
 * RoleService class contains all the rest-full web methods regarding User Roles 
 * @author MIYURU
 *
 */

@Path("UserRoleService")
public class RoleResource {

	RoleDBDriver roleDBDriver= new RoleDBDriver();
	
	/***
	 * Register a new user role into the system.
	 * @param jsnObj is a JSON object that contains about new user role details
	 * @return returns a string value.True if the user role registration successful else it returns false
	 */
	
	@POST
	@Path("/userRoleRegistration")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String userRole_Registration(JSONObject jsnObj){
		String result="false";
		boolean r=false;
		AdminUserroles usrRlObj=new AdminUserroles();
		
		try{
			usrRlObj.setRoleName(jsnObj.getString("userRoleName"));
			usrRlObj.setIsActive(true);
			
//			JSONArray permissions=(JSONArray)jsnObj.get("permissions");
//			int[] permissionArray = new int[permissions.length()];
//			
//			for(int i=0;i<permissions.length();i++){
//				permissionArray[i]=permissions.getInt(i);
//			}
		
			
			//r=roleDBDriver.insertUserRole(usrRlObj,permissionArray);
			r=roleDBDriver.insertUserRole(usrRlObj);
			result=String.valueOf(r);
			return result;
			
		}
		
		catch(JSONException ex){
			ex.printStackTrace();	
			return result;
		}		
		
	}
	
	
	/***
	 * Update User Role Details.
	 * @param jsnObj is a JSON object that contains new user role details.
	 * @return returns a string value.True if the user role updated successfully else it returns false
	 */
	
	@PUT
	@Path("/updateUserRole")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String userRole_Updation(JSONObject jsnObj){
		String result="false";
		boolean r=false;
		AdminUserroles usrRlObj=new AdminUserroles();
		
		try{
			usrRlObj.setRoleId(jsnObj.getInt("roleId"));			
			usrRlObj.setRoleName(jsnObj.getString("roleName"));		
			usrRlObj.setIsActive(jsnObj.getBoolean("isActive"));
			r=roleDBDriver.updateUserRole(usrRlObj);
			result=String.valueOf(r);
			return result;
		}
		catch(JSONException ex){
			ex.printStackTrace();	
			return result;
		}		
		
	}
	
	
	/***
	 * Add new permissions for a specific user role
	 * @param jsnObj contains the new permissions(IDs) that need to be add and the user role(ID)
	 * @return returns a string value.True if new permissions added successfully else it returns false
	 */
	
	
	@PUT
	@Path("/addNewPermissionsToRole")
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces(MediaType.TEXT_PLAIN)
	public String addPermissionsToRole(JSONObject jsnObj){
		String result="";
		boolean r=false;
		try{
			int userRoleID = jsnObj.getInt("roleID");			
			JSONArray permissions=(JSONArray)jsnObj.get("permissions");
			int[] permissionArray = new int[permissions.length()];
			
			for(int i=0;i<permissions.length();i++){
				permissionArray[i]=permissions.getInt(i);
			}
			r=roleDBDriver.addPermissionsForUserRoles(userRoleID,permissionArray);
			result=String.valueOf(r);
			return result;
		}
		catch(JSONException ex){
			ex.printStackTrace();	
			return result;
		}
	}
	
	
	
	/***
	 * Remove permissions from a specific user role 
	 * @param jsnObj contains the permissions(IDs) that need to be removed and the  user role(ID)
	 * @return returns a string value.True if permissions removed successfully else it returns false
	 */
	
	
	@POST
	@Path("/removePermissionsFromRole")
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces(MediaType.TEXT_PLAIN)
	public String removePermissionsFromRole(JSONObject jsnObj){
		String result="";
		boolean r=false;
		try{
			int userRoleID = jsnObj.getInt("userRoleID");			
			JSONArray permissions=(JSONArray)jsnObj.get("permissions");
			int[] permissionArray = new int[permissions.length()];
			
			for(int i=0;i<permissions.length();i++){
				permissionArray[i]=permissions.getInt(i);
			}
			r=roleDBDriver.removePermissionsFromUserRoles(userRoleID,permissionArray);
			result=String.valueOf(r);
			return result;
		}
		catch(JSONException ex){
			ex.printStackTrace();	
			return result;
		}
	}
	
	
	/***
	 * Delete a particular user role from the system 
	 * @param jsnObj is JSON object that contains data about user role that going to delete
	 * @return returns a string value.True if the user role deleted successfully else it returns false
	 */
	
	@DELETE
	@Path("/deleteUserRole")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String deleteUserRoles(JSONObject jsnObj){
		String result="false";
		boolean r=false;
		AdminUserroles usrRlObj=new AdminUserroles();
		
		try{
			usrRlObj.setRoleId(jsnObj.getInt("roleId"));
			r=roleDBDriver.deleteUserRole(usrRlObj);
			result=String.valueOf(r);
			return result;
		}
		catch(JSONException ex){
			ex.printStackTrace();	
			return result;
		}
		
	}
	
	
	/***
	 * Get all the user roles that registered in the system
	 * @return returns a JSON object that contains all the registered user role
	 */
	
	@GET
	@Path("/getActiveUserRoles")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllUserRoles(){
		String result="";
		List<AdminUserroles> usrRoleList =roleDBDriver.getUserRoleDetails();

		JSONSerializer serializor=new JSONSerializer();
		result = serializor.include("roleId","roleName","adminPermissions").exclude("*.class").serialize(usrRoleList);
		return result;
	}
	
	
	
	/***
	 * Get all the user roles that registered in the system
	 * @return returns a JSON object that contains all the registered user role
	 */
	
	@GET
	@Path("/getSingleUserRole/{roleId}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllUserRole(@PathParam("roleId")  int roleId){
		String result="";
		List<AdminUserroles> usrRoleList =roleDBDriver.getUserRoleById(roleId);

		JSONSerializer serializor=new JSONSerializer();
		result = serializor.include("roleId","roleName","adminPermissions").exclude("*.class").serialize(usrRoleList);
		return result;
	}
	
	/***
	 * Get all the user roles Details
	 * @return returns a JSON object that contains user details
	 */
	@GET
	@Path("/getUserRoleNames")
	@Produces(MediaType.APPLICATION_JSON)
	public String getUserRoleNames(){
		String result="";
		List<AdminUserroles> usrRoleList =roleDBDriver.getUserRoleDetails();

		JSONSerializer serializor=new JSONSerializer();
		result = serializor.exclude("*.class","permissions").serialize(usrRoleList);
		return result;
	}

}
