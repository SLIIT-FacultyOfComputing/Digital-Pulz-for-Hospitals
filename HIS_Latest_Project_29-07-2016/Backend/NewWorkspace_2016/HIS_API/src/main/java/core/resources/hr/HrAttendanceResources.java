package core.resources.hr;

import java.sql.Date;
import java.sql.Timestamp;
import java.util.List;

import javax.print.attribute.DateTimeSyntax;
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
import lib.driver.hr.driver_class.HrAttendanceDBDriver;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.classes.api.user.AdminPermission;
import core.classes.hr.HrAttendance;
import core.classes.hr.HrEmployee;
import flexjson.JSONSerializer;


@Path("HrAttandanceService")
public class HrAttendanceResources {

	
	HrAttendanceDBDriver hrAttendanceDBDriver=new HrAttendanceDBDriver();
	/***
	 * Register a new permission into the system.
	 * @param jsnObj is a JSON object that contains about new permission details
	 * @return returns a string value.True if the permission registration successful else it returns false
	 */
	
	@POST
	@Path("/addNewAttendance")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String saveAttendance(JSONObject jsnObj){
		String result="false";
		boolean r=false;
		HrAttendance rpObj=new HrAttendance();
		
		try{
			String otHours = jsnObj.getString("otHours");
			
			if (otHours.isEmpty()) {
				otHours = "0";
			}
			
			System.out.println(jsnObj.getString("inTime"));
			System.out.println(jsnObj.getString("outTime"));
			rpObj.setInTime((jsnObj.getString("inTime")));
			rpObj.setOutTime((jsnObj.getString("outTime")));
			rpObj.setStatus(jsnObj.getInt("status"));
			rpObj.setOtHours(Integer.parseInt(otHours));
			rpObj.setIsActive(jsnObj.getBoolean("isActive"));
			
			HrEmployee employee = new HrEmployee();
			employee.setEmpId(jsnObj.getInt("employeeId"));
			rpObj.setHrEmployee(employee);
			
			r=hrAttendanceDBDriver.inserAttendance(rpObj);
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
		
	@POST
	@Path("/addNewAttendanceList")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String saveAttendanceList(List<JSONObject> jsnObjList){
		String result="false";
		boolean r=false;
		HrAttendance rpObj=new HrAttendance();
		
		try{
			
			for (JSONObject jsnObj : jsnObjList) {
				
				String otHours = jsnObj.getString("otHours");
				
				if (otHours.isEmpty()) {
					otHours = "0";
				}
				
				rpObj.setInTime((jsnObj.getString("inTime")));
				rpObj.setOutTime((jsnObj.getString("outTime")));
				rpObj.setStatus(jsnObj.getInt("status"));
				rpObj.setOtHours(Integer.parseInt(otHours));
				rpObj.setIsActive(jsnObj.getBoolean("isActive"));
				
				HrEmployee employee = new HrEmployee();
				employee.setEmpId(jsnObj.getInt("employeeId"));
				rpObj.setHrEmployee(employee);
				
				r=hrAttendanceDBDriver.inserAttendance(rpObj);
			}
			
			
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
			r=hrAttendanceDBDriver.deletePermissions(rpObj);
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
	@Path("/getAllAtendance/{today}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllAttendance(@PathParam("today")   String today){
		String result="";
		List<HrAttendance> permissionList =hrAttendanceDBDriver.getAllAttendance(today);

		JSONSerializer serializor=new JSONSerializer();
		result = serializor.exclude("*.class").serialize(permissionList);
		 
		return result;
	}
	
	@GET
	@Path("/getAllAttendanceByDept/{today}/{dept}/{designation}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllAttendanceByDept(@PathParam("today")   String today,@PathParam("dept")   int dept,@PathParam("designation")   int designation){
		String result="";
		List<HrAttendance> permissionList =hrAttendanceDBDriver.getAllAttendanceByDept(today,dept,designation);

		JSONSerializer serializor=new JSONSerializer();
		result = serializor.exclude("*.class").serialize(permissionList);
		 
		return result;
	}
	
	
	@GET
	@Path("/getAllAtendance/{startDay}/{endDay}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllAttendance(@PathParam("startDay")   String startDay,@PathParam("endDay")   String endDay){
		String result="";
		List<HrAttendance> permissionList =hrAttendanceDBDriver.getAllAttendance(startDay,endDay);

		JSONSerializer serializor=new JSONSerializer();
		result = serializor.exclude("*.class").serialize(permissionList);
		 
		return result;
	}
	
	
	@GET
	@Path("/getAllAtendance")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllAttendance(){
		String result="";
		List<HrAttendance> permissionList =hrAttendanceDBDriver.getAllAttendance();

		JSONSerializer serializor=new JSONSerializer();
		result = serializor.exclude("*.class").serialize(permissionList);
		 
		return result;
	}
	
	


}
