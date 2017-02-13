package core.resources.lims;

import java.util.List;

import javassist.tools.rmi.ObjectNotFoundException;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;
import org.jboss.logging.Logger;

import core.ErrorConstants;
import core.classes.lims.Category;
import core.classes.lims.SampleCenterTypes;
import flexjson.JSONSerializer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.SampleCenterTypeDBDriver;

@Path("SampleCenterType")
public class SampleCenterTypeResource {

SampleCenterTypeDBDriver scDBDriver= new SampleCenterTypeDBDriver();

final static Logger logger = Logger.getLogger(SampleCenterTypeResource.class);

	@POST
	@Path("/addSampleCenterType")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addSampleCenterType(JSONObject pJson) throws JSONException
	{
		
		logger.info("Entering add sample center type method. ");
		
		try {
			SampleCenterTypes scType  =  new SampleCenterTypes();
			
			scType.setSample_Center_TypeName(pJson.getString("sample_Center_TypeName").toString());
			scDBDriver.insertNewSampleCenterType(scType);
			logger.info("Inserting new sample centre type "+scType);
			JSONSerializer jsonSerializer = new JSONSerializer();
			
			return jsonSerializer.include("sampleCenterType_ID").serialize(scType);
		} 
		catch(RuntimeException ex)
		{
			logger.error("JSON exception in adding sample center type, message:" + ex.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
								
			return jsonErrorObject.toString();
		}
		catch(JSONException e)
		{
			logger.error("JSON exception in adding sample center type, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
								
			return jsonErrorObject.toString(); 
			
		}
		catch (Exception e) {
			 logger.error("Exception in adding sample center type, message:" + e.getMessage());
			 System.out.println(e.getMessage());
			 return e.toString();
		}

	}
	
	@GET
	@Path("/getAllSampleCenterTypes")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSampleCenterTypes() throws JSONException, ObjectNotFoundException
	{
		logger.info("Entering get all sample center types method.");
		
		try {
			List<SampleCenterTypes> sampleCenterTypeList =   scDBDriver.getSampleCenterTypeList();
			JSONSerializer serializer = new JSONSerializer();
			logger.info("Getting all sample centre types "+sampleCenterTypeList);
			return  serializer.exclude("*.class").serialize(sampleCenterTypeList);
			
		}
		catch(RuntimeException e)
		{
			logger.error("JSON exception in adding sample center type, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
								
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			
			logger.error("Error in get all sample center types method, message:" + e.getMessage());			
			return e.getMessage();
			
		}
	}
	
	@POST
	@Path("/updateSampleCenterTypes")
	@Produces(MediaType.TEXT_PLAIN)
	//@Consumes(MediaType.APPLICATION_JSON)
	public String updateSampleCenterTypes(JSONObject pJson) throws JSONException
	{
		logger.info("Entering update sample center type method. ");		
		try {
					
			int sampleCentrTypeid = pJson.getInt("sampleCenterType_ID");
			SampleCenterTypes scType  =  new SampleCenterTypes();
			
			scType.setSample_Center_TypeName(pJson.getString("sample_Center_TypeName").toString());			
			scDBDriver.updateSampleTypes(sampleCentrTypeid, scType);
			logger.info("Updating Sample centre type with id "+sampleCentrTypeid);
			return String.valueOf(sampleCentrTypeid);	
			
		} 
		catch(NullPointerException ex)
		{
			logger.error("Exception in update sample center type, message:" + ex.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.INVALID_ID.getCode());
			jsonErrorObject.put("message", ErrorConstants.INVALID_ID.getMessage());
			
			return jsonErrorObject.toString();
			
		}
		catch(RuntimeException e)
		{
			logger.error("JSON exception in update sample center type, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
								
			return jsonErrorObject.toString();
		}
		catch(JSONException e)
		{
			logger.error("JSONException in updating sample centre type, message : "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
					
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			logger.error("Error in updating sample centre type, message : "+e.getMessage());
			return e.getMessage();
		}
	}
	

	@GET
	@Path("/deleteSampleCenterTypes/{SampleCenterTypeids}")
	@Produces(MediaType.APPLICATION_JSON)
	public String deleteSampleCenterTypeid(@PathParam("SampleCenterTypeids") int SampleCenterTypeids) throws JSONException {
		
		logger.info("Entering delete sample center type method. ");		
		
		try {
			
			scDBDriver.DeleteSampleCenterTypes(SampleCenterTypeids);
			logger.info("Sample centre type with id "+SampleCenterTypeids+": "+"deleted ");		
			return String.valueOf(SampleCenterTypeids);	
			
		}
		catch(org.hibernate.ObjectNotFoundException ex)
		{
			logger.error("Error in deleting sample centre type. message: "+ex.getMessage());

			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.INVALID_ID.getCode());
			jsonErrorObject.put("message", ErrorConstants.INVALID_ID.getMessage());
					
			return jsonErrorObject.toString(); 
			
		}
		catch(RuntimeException e)
		{
			logger.error("JSON exception in adding sample center type, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
								
			return jsonErrorObject.toString();
		}
		
		catch (Exception e) {
			
			logger.error("Error in deleting sample centre type. message: "+e.getMessage());
			return e.getMessage();
			
		}
	}
}