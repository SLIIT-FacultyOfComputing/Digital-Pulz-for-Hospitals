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
import core.classes.lims.SampleCenterTypes;
import flexjson.JSONSerializer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.SampleCenterTypeDBDriver;

@Path("SampleCenterType")
public class SampleCenterTypeResource {

SampleCenterTypeDBDriver scDBDriver= new SampleCenterTypeDBDriver();
	
	@POST
	@Path("/addSampleCenterType")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addSampleCenterType(JSONObject pJson)
	{
		
		try {
			SampleCenterTypes scType  =  new SampleCenterTypes();
			
			scType.setSample_Center_TypeName(pJson.getString("sample_Center_TypeName").toString());
			scDBDriver.insertNewSampleCenterType(scType);
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("sampleCenterType_ID").serialize(scType);
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			return null; 
		}

	}
	
	@GET
	@Path("/getAllSampleCenterTypes")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSampleCenterTypes()
	{
		List<SampleCenterTypes> sampleCenterTypeList =   scDBDriver.getSampleCenterTypeList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.exclude("*.class").serialize(sampleCenterTypeList);
	}
	
	@POST
	@Path("/updateSampleCenterTypes")
	@Produces(MediaType.TEXT_PLAIN)
	//@Consumes(MediaType.APPLICATION_JSON)
	public String updateSampleCenterTypes(JSONObject pJson)
	{
		
		
		try {
			
			
			int sampleCentrTypeid = pJson.getInt("sampleCenterType_ID");
			SampleCenterTypes scType  =  new SampleCenterTypes();
			
			scType.setSample_Center_TypeName(pJson.getString("sample_Center_TypeName").toString());
			
			scDBDriver.updateSampleTypes(sampleCentrTypeid, scType);
			
			return "True";	
			
		} catch (Exception e) {
			 
			return "False";
		}
	}
	

	@GET
	@Path("/deleteSampleCenterTypes/{SampleCenterTypeids}")
	@Produces(MediaType.APPLICATION_JSON)
	public String deleteSampleCenterTypeid(@PathParam("SampleCenterTypeids") int SampleCenterTypeids) {
		//String status="";
		try {
			
			scDBDriver.DeleteSampleCenterTypes(SampleCenterTypeids);
		
			
			return "True";	
		} catch (Exception e) {
			return "False";
		}
	}
}