package core.resources.hr;

import java.util.List;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import lib.driver.hr.driver_class.HrAssignscheduleDBDriver;
import lib.driver.hr.driver_class.HrLeaveTypeDBDriver;
import core.classes.hr.HrAssignschedule;
import core.classes.hr.HrLeavetype;
import flexjson.JSONSerializer;

@Path("HrLeaveType")
public class HrLeaveTypeResource {

HrLeaveTypeDBDriver hrLeaveTypeDBDriver= new HrLeaveTypeDBDriver();
	
	@GET
	@Path("/getAllLeaveTypes")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetAllLeaveTypes() {
		String result="";
		try {
			List<HrLeavetype> empList=hrLeaveTypeDBDriver.GetAllLeaveType();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(empList);
			
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
}
