package core.resources.hr;

import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import lib.driver.hr.driver_class.HrHasLeaveDBDriver;
import lib.driver.hr.driver_class.HrTakeLeaveDBDriver;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.classes.api.user.AdminUser;
import core.classes.hr.HrEmployee;
import core.classes.hr.HrHasleaves;
import core.classes.hr.HrLeavetype;
import core.classes.hr.HrTakeleaves;
import flexjson.JSONSerializer;

@Path("HrTakeLeave")
public class HrTakeLeaveResource {

	HrTakeLeaveDBDriver hrTakeLeaveDBDriver= new HrTakeLeaveDBDriver();

	@POST
	@Path("/RequestLeave")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String RequestLeave( JSONObject uJson){
		
		System.out.println(uJson.toString());
		
		String result="false";
		boolean r=false;
		 HrTakeleaves hasLeaves=new HrTakeleaves();

		
		try{
			
			
			 HrEmployee emp = new HrEmployee();
			 emp.setEmpId(uJson.getInt("userId"));
			 HrLeavetype leaveType = new HrLeavetype();
			 leaveType.setLeaveTypeId(uJson.getInt("LeaveTypeId"));
			 
			 
			 hasLeaves.setHrEmployee(emp);
			 hasLeaves.setHrLeavetype(leaveType);
			 hasLeaves.setStartDatetime(uJson.getString("startDate"));
			 hasLeaves.setEndDatetime(uJson.getString("endDate"));
			 hasLeaves.setApproveStatus("0");
			 hasLeaves.setReason(uJson.getString("reason"));
			 
			r=hrTakeLeaveDBDriver.requestLeave(hasLeaves);
			result=String.valueOf(r);
			
			return result;
			 
		}
		
		catch( JSONException ex){
			ex.printStackTrace();	
			return result;
		}
		
		catch( Exception ex){
			ex.printStackTrace();
			return ex.getMessage();
		}
		
		
	}
	
	
	@GET
	@Path("/getRequestDetails")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllActiveUserDetails(){
		String result="";
		List<HrTakeleaves> usrList =hrTakeLeaveDBDriver.getRequestLeaveDetails();

		JSONSerializer serializor=new JSONSerializer();
		result = serializor.include("hrEmployee.hrWorkins").exclude("*.class").serialize(usrList);
		 
		return result;
		
	}
	
	@GET
	@Path("/getTakenLeaveCount/{empId}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getPendingLeaveDetails(@PathParam("empId") int empId){
		String result="";
		List<Object> usrList =hrTakeLeaveDBDriver.getTakenLeaveCount(empId);

		JSONSerializer serializor=new JSONSerializer();
		result = serializor.include("hrEmployee.hrWorkins").exclude("*.class").serialize(usrList);
		 
		return result;
		
	}
	
	
	@GET
	@Path("/getLeaveDetails/{empId}/{status}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getPendingLeaveDetails(@PathParam("empId") int empId,@PathParam("status") int status){
		String result="";
		List<HrTakeleaves> usrList =hrTakeLeaveDBDriver.getRequestLeaveDetails(empId,status);

		JSONSerializer serializor=new JSONSerializer();
		result = serializor.include("hrEmployee.hrWorkins").exclude("*.class").serialize(usrList);
		 
		return result;
		
	}
	
	
	@POST
	@Path("/UpdateRequestLeave")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String UpdateRequestLeave( JSONObject uJson){
		
		
		String result="false";
		boolean r=false;
		HrTakeleaves hasLeaves=new HrTakeleaves();

		
		try{
			 hasLeaves.setId(uJson.getInt("rId"));
			 hasLeaves.setApproveStatus(uJson.getString("status"));
			 
			 HrEmployee emp = new HrEmployee();
			 emp.setEmpId(uJson.getInt("approver"));
			 
			 hasLeaves.setApprover(emp);			 
			r=hrTakeLeaveDBDriver.updateRequestLeave(hasLeaves);
			result=String.valueOf(r);
			
			return result;
			 
		}
		
		catch( JSONException ex){
			ex.printStackTrace();	
			return result;
		}
		
		catch( Exception ex){
			ex.printStackTrace();
			return ex.getMessage();
		}
		
		
	}
	
	
	
}
