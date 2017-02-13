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
import core.classes.lims.LabTypes;
import core.classes.lims.SampleCenterTypes;
import flexjson.JSONSerializer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.LabTypeDBDriver;
import lib.driver.lims.driver_class.SampleCenterTypeDBDriver;

@Path("LabType")
public class LabTypeResource {

LabTypeDBDriver ltDBDriver= new LabTypeDBDriver();
	
	final static Logger logger=Logger.getLogger(LabTypeResource.class);
	@POST
	@Path("/addLabType")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addLabType(JSONObject pJson) throws JSONException
	{
		logger.info("Entering addLabType method ");
			
		try {
			LabTypes lType  =  new LabTypes();
			
			lType.setLab_Type_Name(pJson.getString("lab_Type_Name").toString());
			ltDBDriver.insertNewLabType(lType);
		
			logger.info("Adding new Laboratory type : "+lType);
			
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("labType_ID").serialize(lType);
		} 
		catch(JSONException e)
		{
			logger.error("Error in adding new Lab type : "+e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
						
			return jsonErrorObject.toString();			
		}
		catch (RuntimeException e) {
			
			logger.error("Error in adding new Lab type : "+e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			return jsonErrorObject.toString();
		}
		catch (Exception e) {
			
			 logger.error("Error in adding new Lab type : "+e.getMessage());
			 System.out.println(e.getMessage());
			 
			 return e.getMessage(); 
		}

	}
	
	@GET
	@Path("/getAllLabTypes")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllLabTypes() throws JSONException
	{
		logger.info("Entering getAllLabTypes method ");
		try {
			
			List<LabTypes> labTypeList =   ltDBDriver.getLabTypeList();
			logger.info("Getting all lab type details: "+labTypeList);
			
			JSONSerializer serializer = new JSONSerializer();
			return  serializer.exclude("*.class").serialize(labTypeList);
			
		} 
		catch (RuntimeException e) {
			
			logger.error("Error in adding new Lab type : "+e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			return jsonErrorObject.toString();
		}
		catch (Exception e) {
			logger.error("Error in getAllLabTypes method: "+e.getMessage());
			return e.getMessage();
			
		}
		
	}
	
	@POST
	@Path("/updateLabTypes")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateLabTypesDetailst(JSONObject pJson) throws JSONException
	{
		logger.info("Entering updateLabTypesDetailst method ");
		
		try {
						
			int labDeptid = pJson.getInt("labType_ID");
			LabTypes lType  =  new LabTypes();
			
			lType.setLab_Type_Name(pJson.getString("lab_Type_Name").toString());
			
			ltDBDriver.updateLabSampleTypes(labDeptid, lType);
			logger.info("Updating lab Type resources ");
			//return "True";
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("labType_ID").serialize(lType);
			
		} 
		catch(JSONException e)
		{
			logger.error("Error in updating lab type : " +e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
						
			return jsonErrorObject.toString();			
		}
		catch(NullPointerException e)
		{
			logger.error("Error in updating lab type :" +e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.INVALID_ID.getCode());
			jsonErrorObject.put("message", ErrorConstants.INVALID_ID.getMessage());
					
			return jsonErrorObject.toString();
		}
		catch (RuntimeException e) {
			
			logger.error("Error in updating lab type :" +e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			return jsonErrorObject.toString();
		}
		catch (Exception e) {
			 
			logger.error("Error in updating lab type :" +e.getMessage());
			//return e.toString();
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/deleteLabType/{typeid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String deleteLabType(@PathParam("typeid") int typeid) throws JSONException {
		//String status="";
		
		logger.info("Entering deleteLabType method ");
		
		try {
						
			ltDBDriver.DeleteLabType(typeid);
			logger.info("Deleting lab type  with type Id: "+typeid);
			return String.valueOf(typeid);	
			
		} 
		catch(org.hibernate.ObjectNotFoundException ex)
		{
			logger.error("Error in deleting lab type : "+ex.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.INVALID_ID.getCode());
			jsonErrorObject.put("message", ErrorConstants.INVALID_ID.getMessage());
					
			return jsonErrorObject.toString(); 
			
		}
		catch (RuntimeException e) {
			
			logger.error("Error in deleting lab type : "+e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			return jsonErrorObject.toString();
		}
		catch (Exception e) {
			logger.error("Error in deleting lab type : "+e.getMessage());
			//return e.toString();
			return e.getMessage();
		}
	}
	
}
