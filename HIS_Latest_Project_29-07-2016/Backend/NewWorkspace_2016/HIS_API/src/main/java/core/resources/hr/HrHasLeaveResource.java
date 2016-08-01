package core.resources.hr;

import java.security.NoSuchAlgorithmException;
import java.security.spec.InvalidKeySpecException;
import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import lib.driver.hr.driver_class.HrHasLeaveDBDriver;
import lib.driver.hr.driver_class.HrLeaveTypeDBDriver;
import core.classes.api.user.AdminUser;
import core.classes.hr.HrEmployee;
import core.classes.hr.HrHasleaves;
import core.classes.hr.HrLeavetype;
import flexjson.JSONSerializer;

@Path("HrHasLeave")
public class HrHasLeaveResource {

	HrHasLeaveDBDriver hrHasLeaveDBDriver= new HrHasLeaveDBDriver();

	@POST
	@Path("/AssignLeave")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String AssignLeave( JSONObject uJson){
		
		System.out.println(uJson.toString());
		
		String result="false";
		boolean r=false;
		 HrHasleaves hasLeaves=new HrHasleaves();

		
		try{
			
			 HrEmployee emp = new HrEmployee();
			 emp.setEmpId(uJson.getInt("empId"));
			 HrLeavetype leaveType = new HrLeavetype();
			 leaveType.setLeaveTypeId(uJson.getInt("LeaveTypeId"));
			 
			 
			 hasLeaves.setHrEmployee(emp);
			 hasLeaves.setHrLeavetype(leaveType);
			 hasLeaves.setRemain(0);
			 hasLeaves.setTotal(uJson.getInt("total"));
			 
			r=hrHasLeaveDBDriver.insertLeave(hasLeaves);
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
	
	
	@POST
	@Path("/UpdateRemainLeave")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String UpdateRemainLeave( int empId, int type, int remain){
		
		
		String result="false";
		boolean r=false;
		 HrHasleaves hasLeaves=new HrHasleaves();

		
		try{
			
			 HrEmployee emp = new HrEmployee();
			 emp.setEmpId(empId);
			 HrLeavetype leaveType = new HrLeavetype();
			 leaveType.setLeaveTypeId(type);
			 
			 
			 hasLeaves.setHrEmployee(emp);
			 hasLeaves.setHrLeavetype(leaveType);
			 hasLeaves.setRemain(remain);
			 
			//r=hrHasLeaveDBDriver.updateRemainLeave(hasLeaves);
			result=String.valueOf(r);
			
			return result;
			 
		}
		
		catch( Exception ex){
			ex.printStackTrace();
			return ex.getMessage();
		}
		
		
	}
	
	
}
