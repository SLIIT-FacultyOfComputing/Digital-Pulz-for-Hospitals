package core.resources.lims;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.HashSet;
import java.util.List;
import java.util.Set;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.codehaus.jettison.json.JSONArray;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;
import org.jboss.logging.Logger;

import core.ErrorConstants;
import core.classes.lims.Category;
import core.classes.lims.Laboratories;
import core.classes.lims.ParentTestFields;
import core.classes.lims.SampleCenters;
import core.classes.lims.SpecimenRetentionType;
import core.classes.lims.SpecimenType;
import core.classes.lims.SubCategory;
import core.classes.lims.TestNames;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.SampleCentersDBDriver;
import lib.driver.lims.driver_class.SpecimenRetentionTypeDBDriver;
import lib.driver.lims.driver_class.SpecimenTypeDBDriver;
import lib.driver.lims.driver_class.TestNamesDBDriver;

@Path("SampleCenters")
public class SampleCenterResource {

SampleCentersDBDriver samplecenterDBDriver= new SampleCentersDBDriver();
DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
DateFormat dateformat2 = new SimpleDateFormat("yyyy-MM-dd");

final static Logger log = Logger.getLogger(SampleCenterResource.class);

@POST
@Path("/addNewsampleCenter")
@Produces(MediaType.APPLICATION_JSON)
@Consumes(MediaType.APPLICATION_JSON)
public String addNewSampleCenter(JSONObject pJson) throws JSONException
{
	log.info("Entering add new sample center method.");

	try {
				
		SampleCenters samplecenter  =  new SampleCenters();
		
		int sampleCenterTypeID = pJson.getInt("fSampleCenterType_ID");
		
		int userid = pJson.getInt("fSampleCenter_AddedUserID");
		samplecenter.setSampleCenter_Name(pJson.getString("sampleCenter_Name").toString());
		samplecenter.setSampleCenter_Incharge(pJson.getString("sampleCenter_Incharge").toString());
		samplecenter.setLocation(pJson.getString("location").toString());
		samplecenter.setEmail(pJson.getString("email").toString());
		samplecenter.setContactNumber1(pJson.getString("contactNumber1").toString());
		samplecenter.setContactNumber2(pJson.getString("contactNumber2").toString());
		samplecenter.setSampleCenter_AddedDate(new Date());
		samplecenter.setSampleCenter_LastUpdatedDate(new Date());
		samplecenterDBDriver.insertNewSampleCenter(samplecenter, sampleCenterTypeID, userid);
			
		JSONSerializer jsonSerializer = new JSONSerializer();
		log.info("Adding new sample centre "+samplecenter);
		return jsonSerializer.include("sampleCenter_ID").serialize(samplecenter);
	} 
	catch(RuntimeException ex)
	{
		log.error("Exception in add new sample center. "+ex.getMessage().toString());
		JSONObject jsonErrorObject = new JSONObject();
		jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
		jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
		
		return jsonErrorObject.toString();
	}
	catch(JSONException ex){
		log.error("JSONException in add new sample center. "+ex.getMessage().toString());
		
		JSONObject jsonErrorObject = new JSONObject();
		jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
		jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
		
		return jsonErrorObject.toString();
		
		
	}
	catch (Exception e) {
		 System.out.println(e.getMessage());
		 log.error("Exception in add new sample center. "+e.getMessage().toString());
		 return e.getMessage();
	}

}
		

	@GET
	@Path("/getAllSampleCenters")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSampleCenters() throws JSONException
	{
		log.info("Entering get all sample centers method. ");
		
		try{
			List<SampleCenters> sampleCenterList =   samplecenterDBDriver.getNewSampleCenterList();
			JSONSerializer serializer = new JSONSerializer();
			log.info("Getting all sample centres : "+sampleCenterList);
			return  serializer.include("fSampleCenterType_ID.sample_Center_TypeName","fSampleCenterType_ID.sampleCenter_ID","fSampleCenter_AddedUserID.userName","fSampleCenterLast_UpdatedUserID.userName","fSampleCenter_Phone.id.phone","location").exclude("*.class","fSampleCenter_AddedUserID.*","fSampleCenterLast_UpdatedUserID.*","fSampleCenter_Phone.*").transform(new DateTransformer("yyyy-MM-dd"),"sampleCenter_AddedDate","sampleCenter_LastUpdatedDate").serialize(sampleCenterList);
		
		}
		catch(RuntimeException e)
		{
			log.error("Error in get all sample centers method. "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			return jsonErrorObject.toString();
		}
		catch(Exception ex)
		{
			log.error("Error in get all sample centers method. "+ex.getMessage());	
			return ex.getMessage();
		}
		
	}
	
	@GET
	@Path("/getSampleCentersByLabType/{typeID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSampleCentersByLabType(@PathParam("typeID")int typeID) throws JSONException
	{
		log.info("Entering get sample centers by lab type method. ");
		
		try {
			List<SampleCenters> sampleCenterList =   samplecenterDBDriver.getSamplecentersByLabType(typeID);
			JSONSerializer serializer = new JSONSerializer();
			log.info("Getting all sample centres with type id "+typeID+" : "+sampleCenterList);
			return  serializer.include("fSampleCenterType_ID.sample_Center_TypeName","fSampleCenter_AddedUserID.userName","fSampleCenterLast_UpdatedUserID.userName","fSampleCenter_Phone.id.phone","location").exclude("*.class","fSampleCenterType_ID.*","fSampleCenter_AddedUserID.*","fSampleCenterLast_UpdatedUserID.*","fSampleCenter_Phone.*").transform(new DateTransformer("yyyy-MM-dd"),"sampleCenter_AddedDate","sampleCenter_LastUpdatedDate").serialize(sampleCenterList);
		
		}
		
		catch(IndexOutOfBoundsException ex)
		{
			log.error("Exception in get all sample centers by lab type test case. "+ex.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.INVALID_ID.getCode());
			jsonErrorObject.put("message", ErrorConstants.INVALID_ID.getMessage());
			
			return jsonErrorObject.toString();
					
		}
		catch(RuntimeException ex)
		{
			log.error("Exception in add new sample center. "+ex.getMessage().toString());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			return jsonErrorObject.toString();
		}
		catch (Exception e) {
			
			log.error("Exception in get all sample centers by lab type test case. "+e.getMessage());
			return e.toString();
		}
	
	}
	
	@POST
	@Path("/updateSampleCenter")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateSampleCenterDetailsTest(JSONObject pJson) throws JSONException
	{
		log.info("Entering update sample center details test method.");
		
		try {
			
			
			SampleCenters samplecenter  =  new SampleCenters();
			
			int sampleCenterTypeID = pJson.getInt("fSampleCenterType_ID");
			
			int userid = pJson.getInt("fSampleCenter_AddedUserID");
		
			
			int samplecenterid = pJson.getInt("sampleCenter_ID");
			
			samplecenter.setSampleCenter_Name(pJson.getString("sampleCenter_Name").toString());
			samplecenter.setSampleCenter_Incharge(pJson.getString("sampleCenter_Incharge").toString());
			samplecenter.setLocation(pJson.getString("location").toString());
			samplecenter.setEmail(pJson.getString("email").toString());
			samplecenter.setContactNumber1(pJson.getString("contactNumber1").toString());
			samplecenter.setContactNumber2(pJson.getString("contactNumber2").toString());
			samplecenter.setSampleCenter_AddedDate(new Date());
			samplecenter.setSampleCenter_LastUpdatedDate(new Date());		
			
			samplecenterDBDriver.updateSampleCenters(samplecenter, samplecenterid, sampleCenterTypeID, userid);
			
			log.info("Updating sample centres with sample centre id"+samplecenterid);
			
			return String.valueOf(samplecenterid);	
			
		}
		catch (NullPointerException ex) {
			log.error("Exception in update sample center method. "+ex.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.INVALID_ID.getCode());
			jsonErrorObject.put("message", ErrorConstants.INVALID_ID.getMessage());
			
			return jsonErrorObject.toString();
		}
		catch(RuntimeException ex)
		{
			log.error("Exception in add new sample center. "+ex.getMessage().toString());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			return jsonErrorObject.toString();
		}
		
		catch(JSONException ex)
		{
			log.error("JSONException in update sample center method. "+ex.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString();
			
		}
		catch (Exception e) {
			
			log.error("Error in updating sample centre.message : "+e.getMessage());
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/deleteSampleCenter/{SampleCenterid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String deleteSampleCenter(@PathParam("SampleCenterid") int SampleCenterid) throws JSONException {
		
		log.info("Entering delete sample center method. ");
		
		try {
			
			log.info("Deleting sample centre with Id "+SampleCenterid);
			samplecenterDBDriver.DeleteSampleCenter(SampleCenterid);
			return String.valueOf(SampleCenterid);						
		} 
		
		catch(org.hibernate.ObjectNotFoundException ex)
		{
			log.error("Error in deleting sample centre. message: "+ex.getMessage());

			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.INVALID_ID.getCode());
			jsonErrorObject.put("message", ErrorConstants.INVALID_ID.getMessage());
					
			return jsonErrorObject.toString(); 
		}
		catch(RuntimeException ex)
		{
			log.error("Exception in add new sample center. "+ex.getMessage().toString());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			return jsonErrorObject.toString();
		}
		catch (Exception e) {
			log.error("Error in deleting sample centre with id "+SampleCenterid+": "+e.getMessage());
			return e.getMessage();
		}
		
	}
	
	
}