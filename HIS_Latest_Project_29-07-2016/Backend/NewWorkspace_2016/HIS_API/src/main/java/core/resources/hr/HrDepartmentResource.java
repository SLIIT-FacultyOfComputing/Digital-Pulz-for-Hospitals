package core.resources.hr;

import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;







import org.codehaus.jettison.json.JSONObject;

import lib.driver.hr.driver_class.HrDepartmentDBDriver;
import core.classes.hr.HrDepartment;
import core.classes.hr.HrEmployee;
import core.classes.hr.HrEmployeeView;
import flexjson.JSONSerializer;

@Path("HrDepatment")
public class HrDepartmentResource {
	
	HrDepartmentDBDriver hrDepartmentDBDriver=new HrDepartmentDBDriver();

	
	@GET
	@Path("/getAllDepartments")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetAllDepartments() {
		String result="";
		try {
			List<HrDepartment> deptList=hrDepartmentDBDriver.GetAllDepatments();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(deptList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/getAllDepts")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetAllDepts() {
		String result="";
		try {
			List<HrDepartment> deptList=hrDepartmentDBDriver.GetAllDepts();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(deptList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@POST
	@Path("/addNewDepartment")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String AddNewDepartment(JSONObject wJson) 
	{
		
		//System.out.println(dateformat2.parse(wJson.getString("empBDay").toString()));

		try {
			
			String deptName = wJson.getString("deptName");
			int deptHead =wJson.getInt("deptHead");

			hrDepartmentDBDriver.InsertNewDepartment(deptName,deptHead);			
			
			
			return "True";
			
		} catch (Exception e) {
			e.printStackTrace();
			return e.getMessage().toString();
		}					
	}
	
	
	@POST
	@Path("/updateDepartment")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String UpdateDepartment(JSONObject wJson) 
	{
		
		try {
			int deptId =wJson.getInt("deptId");
			String deptName = wJson.getString("deptName");
			int deptHead =wJson.getInt("deptHead");
			

			
			hrDepartmentDBDriver.UpdateDepartment(deptId,deptName,deptHead);
			
			
			return "True";
		} catch (Exception e) {
			e.printStackTrace();
			return e.getMessage().toString();
		}					
	}
	
	@GET
	@Path("/getDepartmentByID/{data}")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetDepartmentByID(@PathParam("data")  int deptId) {
		
		
		try {
			List<HrDepartment> deptList=hrDepartmentDBDriver.getDepartmentByID(deptId);
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(deptList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/deleteDepartment/{deptid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String DeleteDepartment(@PathParam("deptid") int deptid) {
		String status="";
		try {
			if (hrDepartmentDBDriver.DeleteDepartment(deptid)) {
				status = "Item Deleted!!!";
			} else {
				status = "fail";
			}
			
			return status;
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
}
