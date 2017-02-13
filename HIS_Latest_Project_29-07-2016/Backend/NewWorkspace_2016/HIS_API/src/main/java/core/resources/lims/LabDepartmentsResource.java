package core.resources.lims;

import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;
import org.hibernate.ObjectNotFoundException;
import org.jboss.logging.Logger;

import core.ErrorConstants;
import core.classes.lims.Category;
import core.classes.lims.LabDepartments;
import core.classes.lims.LabTypes;
import core.classes.lims.SampleCenterTypes;
import flexjson.JSONSerializer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.LabDepartmentDBDriver;
import lib.driver.lims.driver_class.LabTypeDBDriver;
import lib.driver.lims.driver_class.SampleCenterTypeDBDriver;

@Path("LabDepartments")
public class LabDepartmentsResource {
	
	final static Logger log = Logger.getLogger(LabDepartmentsResource.class);
	
LabDepartmentDBDriver ldDBDriver= new LabDepartmentDBDriver();
	
	@POST
	@Path("/addLabDepartment")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addLabDepartment(JSONObject pJson) throws JSONException
	{
		
		try {
			LabDepartments dType  =  new LabDepartments();
			
			
			dType.setLabDept_Name(pJson.getString("labDept_Name").toString());
			ldDBDriver.insertNewLabDepartment(dType);
			
			
			
			
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("labDept_ID").serialize(dType);
		} 
		catch(JSONException e){
			log.error("JSON exception in adding Lab Department, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jSONError.put("Message",ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			return jSONError.toString();
		}
		catch(RuntimeException e)
		{
			log.error("JSON exception in adding Lab department, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.NO_CONNECTION.getCode());
			jSONError.put("Message",ErrorConstants.NO_CONNECTION.getMessage());
			return jSONError.toString();
		}
		catch (Exception e) {
			log.error("Add lab department error : "+ e.getMessage());
			System.out.println(e.getMessage());
			return null; 
			
		}


	}
	
	@GET
	@Path("/getAllLabDepartments")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllLabDepartments() throws JSONException
	{
		try{
		List<LabDepartments> labDepartmentsList =  ldDBDriver.getLabDepartmentsList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.exclude("*.class").serialize(labDepartmentsList);
		
	}
	catch (RuntimeException e)
	{
		log.error("JSON exception in getting lab departments, message:"+ e.getMessage());
		JSONObject jSONError = new JSONObject();
		jSONError.put("Error Code",ErrorConstants.NO_CONNECTION.getCode());
		jSONError.put("Message",ErrorConstants.NO_CONNECTION.getMessage());
		return jSONError.toString();
	}
	catch (Exception e)
	{
		log.error("get lab department error : "+ e.getMessage());
		System.out.println(e.getMessage());
		return null; 
	}
	}
	
	@POST
	@Path("/updateLabDepts")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateLabDeptsDetails(JSONObject pJson) throws JSONException
	{
		
		try {
			
			LabDepartments dType  =  new LabDepartments();
			int labDeptid = pJson.getInt("labDept_ID");
			
			dType.setLabDept_Name(pJson.getString("labDept_Name").toString());
			ldDBDriver.updateDepartments(labDeptid, dType);
			
			JSONSerializer jsonSerializer = new JSONSerializer();
			
			return jsonSerializer.include(String.valueOf(labDeptid)).serialize(dType);
			//return "True";	
			
		}
		catch(RuntimeException e)
		{
			log.error("JSON exception in updating Lab department, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.NO_CONNECTION.getCode());
			jSONError.put("Message",ErrorConstants.NO_CONNECTION.getMessage());
			return jSONError.toString();
		}
		catch(JSONException e){
			log.error("JSON exception in updating Lab department, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jSONError.put("Message",ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			return jSONError.toString();
		}
		catch (Exception e) {
			 
			log.error(e.getMessage());
			return e.getMessage();
		}
		
	}
	
	@GET
	@Path("/deleteDepartment/{deptid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String deleteDepartment(@PathParam("deptid") int deptid) throws JSONException {
		//String status="";
		try {
			
			System.out.println(deptid);
			ldDBDriver.DeleteDepartment(deptid);
			
			JSONSerializer jsonSerializer = new JSONSerializer();
			System.out.println(jsonSerializer.include("labDept_ID").serialize(String.valueOf(deptid)));
			return jsonSerializer.include("labDept_ID").serialize(deptid);
		} catch (ObjectNotFoundException e)
		{
			log.error("JSON exception in deleting Lab department, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.INVALID_ID.getCode());
			jSONError.put("Message",ErrorConstants.INVALID_ID.getMessage());
			return jSONError.toString();
		}
		
		catch (Exception e) {
			log.error(e.getMessage());
			return e.getMessage();
		}
	}
	
}
