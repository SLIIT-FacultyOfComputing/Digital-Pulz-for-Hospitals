package core.resources.hr;

import java.util.List;

import javax.persistence.Id;
import javax.print.attribute.standard.SheetCollate;
import javax.ws.rs.Consumes;
import javax.ws.rs.DELETE;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;





import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;



//import core.classes.hr.AdminAssignschedule;
//import core.classes.hr.AdminAssignscheduleId;



import core.classes.hr.HrAssignschedule;
import core.classes.hr.HrAssignscheduleId;
import lib.driver.hr.driver_class.HrAssignscheduleDBDriver;
import flexjson.JSONSerializer;

@Path("HrAssignSchedule")
public class HrAssignscheduleResource {
	
	HrAssignscheduleDBDriver hrAssignscheduleDBDriver= new HrAssignscheduleDBDriver();
	
	@GET
	@Path("/getEmployeeAllocactions/{empID}/{shiftID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetEmployeesByDept(@PathParam("empID")  int empID,@PathParam("shiftID")  int shiftID) {
		String result="";
		try {
			List<HrAssignschedule> empList=hrAssignscheduleDBDriver.GetEmployeeAllocactions(empID,shiftID);
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(empList);
			
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@POST
	@Path("/insertEmployeeAllocation")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String InsertEmployeeAllocation(JSONObject wJson) 
	{
		
		try {
			HrAssignscheduleId scheduleID=new HrAssignscheduleId();
			HrAssignschedule schedule=new HrAssignschedule();
			
			System.out.println(wJson);
			scheduleID.setEmpId(wJson.getInt("empID"));
			scheduleID.setShiftId(wJson.getInt("shifID"));
			
			schedule.setId(scheduleID);
			hrAssignscheduleDBDriver.InsertEmployeeAllocation(schedule);
		
			return "True";
		} catch (Exception e) {
			e.printStackTrace();
			return e.getMessage().toString();
		}				
	}
	
	@DELETE
	@Path("/updateEmployeeAllocations")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String deleteBed(JSONObject jsnObj){
		String result="false";
		boolean r=false;
		
		HrAssignscheduleId scheduleID=new HrAssignscheduleId();
		HrAssignschedule schedule=new HrAssignschedule();
		
		
		try{
			scheduleID.setEmpId(jsnObj.getInt("empID"));
			scheduleID.setShiftId(jsnObj.getInt("shifID"));
			schedule.setId(scheduleID);
			int empID=jsnObj.getInt("empID");
			
			
			r=hrAssignscheduleDBDriver.DeleteEmployeeAllocation(schedule);
			result=String.valueOf(r);
			
			return result;
			
			
		}
		
		catch( JSONException ex){
			ex.printStackTrace();	
			return result;
		}
		
	}
	
	@GET
	@Path("/getEmployeeSchedule/{empID}/{fromDate}/{toDate}")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetEmployeeSchedule(@PathParam("empID")  int empID,@PathParam("fromDate")  String fromDate,@PathParam("toDate")  String toDate) {
		String result="";
		try {
			List<HrAssignschedule> empList=hrAssignscheduleDBDriver.GetEmployeeSchedule(empID,fromDate,toDate);
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(empList);
			
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/getEmployeeSchedule/{empID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetEmployeeSchedule(@PathParam("empID")  int empID) {
		String result="";
		try {
			List<HrAssignschedule> empList=hrAssignscheduleDBDriver.GetEmployeeSchedule(empID);
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(empList);
			
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
}
