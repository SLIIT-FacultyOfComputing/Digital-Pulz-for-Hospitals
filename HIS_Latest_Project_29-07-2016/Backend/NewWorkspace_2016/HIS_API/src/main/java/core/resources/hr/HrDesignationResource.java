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

import core.classes.hr.HrDepartment;
import core.classes.hr.HrDesignation;
import flexjson.JSONSerializer;
import lib.driver.hr.driver_class.HrDesignationDBDriver;

@Path("HrDesignation")
public class HrDesignationResource {
	HrDesignationDBDriver hrDesignationDBDriver= new HrDesignationDBDriver();
	
	@GET
	@Path("/getAllDesignations")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetAllDesignations() {
		String result="";
		try {
			List<HrDesignation> designationList=hrDesignationDBDriver.GetAllDesignations();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(designationList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/getAllDesigs")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetAllDesigs() {
		String result="";
		try {
			List<HrDesignation> designationList=hrDesignationDBDriver.GetAllDesigs();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(designationList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@POST
	@Path("/addNewDesignation")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String AddNewDesignation(JSONObject wJson) 
	{
		
		//System.out.println(dateformat2.parse(wJson.getString("empBDay").toString()));

		try {
			
			String destName = wJson.getString("designationName");
			int destGroupID =wJson.getInt("designationGroup");

			hrDesignationDBDriver.AddNewDesignation(destName,destGroupID);			
			
			
			return "True";
			
		} catch (Exception e) {
			e.printStackTrace();
			return e.getMessage().toString();
		}					
	}
	
	@GET
	@Path("/getDesignationByID/{data}")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetDesignationByID(@PathParam("data")  int deptId) {
		
		
		try {
			List<HrDesignation> deptList=hrDesignationDBDriver.GetDesignationByID(deptId);
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(deptList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@POST
	@Path("/updateDesignation")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String UpdateDesignation(JSONObject wJson) 
	{
		
		try {
			int destId =wJson.getInt("designationID");
			String destName = wJson.getString("designationName");
			int destGroup =wJson.getInt("designationGroup");
			

			
			hrDesignationDBDriver.UpdateDesignation(destId,destName,destGroup);
			
			
			return "True";
		} catch (Exception e) {
			e.printStackTrace();
			return e.getMessage().toString();
		}					
	}
	
	@GET
	@Path("/deleteDesignation/{deptid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String DeleteDesignation(@PathParam("deptid") int deptid) {
		String status="";
		try {
			if (hrDesignationDBDriver.DeleteDesignation(deptid)) {
				status = "Item Deleted!!!";
			} else {
				status = "fail";
			}
			
			return status;
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/getAllDesignationsByDoctorGroup")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllDesignationsByDoctorGroup() {
		String result="";
		try {
			List<HrDesignation> designationList=hrDesignationDBDriver.getAllDesignationsByDoctorGroup();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(designationList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
}
