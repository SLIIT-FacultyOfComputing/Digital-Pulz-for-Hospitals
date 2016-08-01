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

import core.classes.lims.Category;
import core.classes.lims.LabTypes;
import core.classes.lims.SampleCenterTypes;
import flexjson.JSONSerializer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.LabTypeDBDriver;
import lib.driver.lims.driver_class.SampleCenterTypeDBDriver;

@Path("LabType")
public class LabTypeResource {

LabTypeDBDriver ltDBDriver= new LabTypeDBDriver();
	
	@POST
	@Path("/addLabType")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addLabType(JSONObject pJson)
	{
			
		try {
			LabTypes lType  =  new LabTypes();
			
			lType.setLab_Type_Name(pJson.getString("lab_Type_Name").toString());
			ltDBDriver.insertNewLabType(lType);
		
			
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("labType_ID").serialize(lType);
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			return null; 
		}

	}
	
	@GET
	@Path("/getAllLabTypes")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllLabTypes()
	{
		List<LabTypes> labTypeList =   ltDBDriver.getLabTypeList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.exclude("*.class").serialize(labTypeList);
	}
	
	@POST
	@Path("/updateLabTypes")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateLabTypesDetailst(JSONObject pJson)
	{
		
		
		try {
			
			
			int labDeptid = pJson.getInt("labType_ID");
			LabTypes lType  =  new LabTypes();
			
			lType.setLab_Type_Name(pJson.getString("lab_Type_Name").toString());
			
			ltDBDriver.updateLabSampleTypes(labDeptid, lType);
			
			return "True";	
			
		} catch (Exception e) {
			 
			return "False";
		}
	}
	
	@GET
	@Path("/deleteLabType/{typeid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String deleteLabType(@PathParam("typeid") int typeid) {
		//String status="";
		try {
			
			
			ltDBDriver.DeleteLabType(typeid);
			
			return "True";	
		} catch (Exception e) {
			return "False";
		}
	}
	
}
