package core.resources.hr;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.codehaus.jettison.json.JSONObject;

import lib.driver.hr.driver_class.HrWorkinDBDriver;
import core.classes.hr.HrDepartment;
import core.classes.hr.HrEmployee;
import core.classes.hr.HrWorkin;
import flexjson.JSONSerializer;


@Path("HrWorkin")
public class HrWorkinResource {
	HrWorkinDBDriver hrWorkinDBDriver=new HrWorkinDBDriver();
	DateFormat dateformat2 = new SimpleDateFormat("yyyy-MM-dd");
	@GET
	@Path("/employeeWorkingDepartments/{data}")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetEmployeeWorkingDepartments(@PathParam("data")  int empId) {
		
		HrWorkinDBDriver hrWorkinDBDriver=new HrWorkinDBDriver();
		//DateFormat dateformat2 = new SimpleDateFormat("yyyy-MM-dd");
		try {
			List<HrWorkin> empList=hrWorkinDBDriver.GetEmployeeWorkingDepartments(empId);
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(empList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@POST
	@Path("/assignToDept")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String AssignToDept(JSONObject wJson) 
	{
		
		//System.out.println(dateformat2.parse(wJson.getString("endDate").toString());
		
		try {
			System.out.println(wJson.getString("startDate"));
			int empID=Integer.parseInt(wJson.getString("empId"));
			int dept=Integer.parseInt(wJson.getString("deptId"));
			int desi=Integer.parseInt(wJson.getString("designationId"));
			String description=wJson.getString("description");
			Date startDate=dateformat2.parse(wJson.getString("startDate"));
			//Date endDate=dateformat2.parse(wJson.getString("endDate"));
						
			hrWorkinDBDriver.InsertEmployeeWorkin(empID,dept,desi,description,startDate);
			
			return "true";
			
		} catch (Exception e) {
			e.printStackTrace();
			return e.getMessage().toString();
		}					
	}
	
	
	@POST
	@Path("/EditWorkinDept")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String EditWorkinDept(JSONObject wJson) 
	{
		
		//System.out.println(dateformat2.parse(wJson.getString("endDate").toString());
		
		try {
			System.out.println(wJson.getString("startDate"));
			int empID=Integer.parseInt(wJson.getString("empId"));
			int dept=Integer.parseInt(wJson.getString("deptId"));
			int desi=Integer.parseInt(wJson.getString("designationId"));
			String description=wJson.getString("description");
			Date startDate=dateformat2.parse(wJson.getString("startDate"));
			Date endDate=dateformat2.parse(wJson.getString("endDate"));
						
			hrWorkinDBDriver.UpdateEmployeeWorkin(empID,dept,desi,description,startDate,endDate);
			
			return "true";
			
		} catch (Exception e) {
			e.printStackTrace();
			return e.getMessage().toString();
		}					
	}
	
	@GET
	@Path("/getEmployeeByDept/{data}")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetEmployeeByDept(@PathParam("data")  int deptId) {
		
		HrWorkinDBDriver hrWorkinDBDriver=new HrWorkinDBDriver();
		//DateFormat dateformat2 = new SimpleDateFormat("yyyy-MM-dd");
		try {
			List<HrWorkin> empList=hrWorkinDBDriver.GetEmployeeByDept(deptId);
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(empList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	
	@GET
	@Path("/getEmployeeWorkin/{dept}/{desig}/{empId}")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetEmployeeWorkin(@PathParam("dept")  int deptId,@PathParam("desig")  int desigId,@PathParam("empId")  int empId) {
		
		
		try {
			List<HrWorkin> empList=hrWorkinDBDriver.GetEmployeeWorkin(deptId,desigId,empId);
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(empList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
}
