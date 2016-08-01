package core.resources.api.user;

import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.DELETE;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.PUT;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import lib.driver.api.driver_class.user.AdminPermissionrequestDBDriver;
import lib.driver.api.driver_class.user.PermissionDBDriver;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.classes.api.user.AdminPermission;
import core.classes.api.user.AdminPermissionrequest;
import flexjson.JSONSerializer;


@Path("AdminPermissionRequestService")
public class AdminPermissionRequestResource {

	
	AdminPermissionrequestDBDriver permissionRequestDBDriver=new AdminPermissionrequestDBDriver();
	/***
	 * Register a new permission into the system.
	 * @param jsnObj is a JSON object that contains about new permission details
	 * @return returns a string value.True if the permission registration successful else it returns false
	 */
	
	@POST
	@Path("/addNewPermissionRequest")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addNewPermissionRequest(JSONObject jsnObj){
		String result="false";
		boolean r=false;
		AdminPermissionrequest rpObj=new AdminPermissionrequest();
		
		try{
			rpObj.setReqestPermission(jsnObj.getString("permissionName"));
			r=permissionRequestDBDriver.inserPermissionRequest(rpObj);
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
	@Path("/updatePermissionRequest")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String permissionRequestUpdation(JSONObject jsnObj){
		String result="false";
		boolean r=false;
		AdminPermissionrequest rpObj=new AdminPermissionrequest();
		
		try{
			rpObj.setRequestId(jsnObj.getInt("requestId"));
			rpObj.setReqestPermission(jsnObj.getString("permissionRequest"));
			r=permissionRequestDBDriver.updatePermissionRequest(rpObj);
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
	@Path("/deletePermissionRequest")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String deletePermissionRequest(JSONObject jsnObj){
		String result="false";
		boolean r=false;
		AdminPermissionrequest rpObj=new AdminPermissionrequest();
		
		try{
			rpObj.setRequestId(jsnObj.getInt("requestId"));
			r=permissionRequestDBDriver.delete(rpObj);
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
	@Path("/getAllPermissionRequests")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllPermissionRequests(){
		String result="";
		List<AdminPermissionrequest> permissionRequestList =permissionRequestDBDriver.getAllPermissionRequests();

		JSONSerializer serializor=new JSONSerializer();
		result = serializor.exclude("*.class").serialize(permissionRequestList);
		 
		return result;
	}
	
	
}
