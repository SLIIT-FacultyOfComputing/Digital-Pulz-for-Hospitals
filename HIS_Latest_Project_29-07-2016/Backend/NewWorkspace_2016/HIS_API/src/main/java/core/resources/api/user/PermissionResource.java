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

import lib.driver.api.driver_class.user.PermissionDBDriver;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.classes.api.user.AdminPermission;
import flexjson.JSONSerializer;



/**
 * AdminPermission Service class contains all the rest-full web methods regarding User Permissions
 * @author MIYURU
 *
 */

@Path("UserPermissionService")
public class PermissionResource {

	
	PermissionDBDriver permissionDBDriver=new PermissionDBDriver();
	/***
	 * Register a new permission into the system.
	 * @param jsnObj is a JSON object that contains about new permission details
	 * @return returns a string value.True if the permission registration successful else it returns false
	 */
	
	@POST
	@Path("/addNewPermission")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String permissionRegistration(JSONObject jsnObj){
		String result="false";
		boolean r=false;
		AdminPermission rpObj=new AdminPermission();
		
		try{
			rpObj.setPermissionDiscription(jsnObj.getString("permissionName"));
			r=permissionDBDriver.inserPermissions(rpObj);
			result=String.valueOf(r);
			return result;
			
		}
		
		catch(JSONException ex){
			ex.printStackTrace();	
			return result;
		}		
		
	}
	
	
	
	
	/***
	 * Update permission details.
	 * @param jsnObj is a JSON object that contains new permission details.
	 * @return returns a string value.True if the permissions updated successfully else it returns false
	 */
		
	@PUT
	@Path("/updatePermission")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String permissionUpdation(JSONObject jsnObj){
		String result="false";
		boolean r=false;
		AdminPermission rpObj=new AdminPermission();
		
		try{
			rpObj.setPermissionId(jsnObj.getInt("permissionID"));
			rpObj.setPermissionDiscription(jsnObj.getString("permissionName"));
			r=permissionDBDriver.updatePermissions(rpObj);
			result=String.valueOf(r);
			return result;
		}
		catch(JSONException ex){
			ex.printStackTrace();	
			return result;
		}		
		
	}
	
	
	

	/***
	 * Delete a particular permission from the system 
	 * @param jsnObj is JSON object that contains data about permission that going to delete
	 * @return returns a string value.True if the permission deleted successfully else it returns false
	 */	
	
	@DELETE
	@Path("/deletePermission")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String deletePermission(JSONObject jsnObj){
		String result="false";
		boolean r=false;
		AdminPermission rpObj=new AdminPermission();
		
		try{
			rpObj.setPermissionId(jsnObj.getInt("permissionID"));
			r=permissionDBDriver.deletePermissions(rpObj);
			result=String.valueOf(r);
			return result;
		}
		catch(JSONException ex){
			ex.printStackTrace();	
			return result;
		}
		
	}
	
	
	
	/***
	 * Get all the permissions that registered in the system
	 * @return returns a JSON object that contains all the registered permissions
	 */
	
	@GET
	@Path("/getAllPermission")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllPermissions(){
		String result="";
		List<AdminPermission> permissionList =permissionDBDriver.getAllPermissions();

		JSONSerializer serializor=new JSONSerializer();
		result = serializor.exclude("*.class").serialize(permissionList);
		 
		return result;
	}
	
	
}
