package core.resources.lims;

import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.apache.log4j.Logger;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.ErrorConstants;
import core.classes.lims.Category;
import core.classes.lims.SpecimenRetentionType;
import core.classes.lims.SpecimenType;
import core.classes.lims.SubCategory;
import flexjson.JSONSerializer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.SpecimenRetentionTypeDBDriver;
import lib.driver.lims.driver_class.SpecimenTypeDBDriver;

@Path("SpecimenRetentionType")
public class SpecimenRetentionTypeResource {

	SpecimenRetentionTypeDBDriver srtDBDriver= new SpecimenRetentionTypeDBDriver();
	
	final static Logger log = Logger.getLogger(SpecimenRetentionTypeResource.class);

	public String addSpecimenType(JSONObject pJson,String catid,String subid,String specid) throws JSONException
	{
		log.info("Entering the add SpecimenRetention method");
		try {
			SpecimenRetentionType srtype  =  new SpecimenRetentionType();
			
			int categoryID = Integer.parseInt(catid);
			int subcategoryID = Integer.parseInt(subid);
			
			srtype.setRetention_TypeName(pJson.getString("retention").toString());
			srtype.setDuration(pJson.getString("duration").toString());
			
			srtDBDriver.insertSpecimenRetentionType(srtype, categoryID, subcategoryID);
		
			log.info("Insert SpecimenRetention Successful, rententionID = "+srtype.getRetention_TypeID());
			
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("retention_TypeID").serialize(srtype);
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in inserting specimenRetention, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while inserting specimenRetention, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}

	}
	
	@GET
	@Path("/getAllSpecimenRetentionTypes")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSpecimenType() throws JSONException
	{
		log.info("Entering the get all SpecimenRetention method");
		try{
			List<SpecimenRetentionType> specimenretentiontypeList =   srtDBDriver.getSpecimenRetentionTypeList();
			JSONSerializer serializer = new JSONSerializer();
			return  serializer.include("fCategory_ID.category_Name","fSub_CategryID.sub_CategoryName").exclude("*.class","fCategory_ID.*","fSub_CategryID.*").serialize(specimenretentiontypeList);
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in get all specimenRetention, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while get all specimenRetention, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}

	}
	
	@GET
	@Path("/getAllSpecimenRetentionTypesByCIDSID/{catID}/{subID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSpecimenType(@PathParam("catID")int catID,@PathParam("subID")int subID) throws JSONException
	{
		log.info("Entering the get all SpecimenRetention by catID & subID method");
		try{
		List<SpecimenRetentionType> specimenretentiontypeList =   srtDBDriver.getSpecimenRetentionTypeBYCIDSIDList(catID,subID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("fSub_CategryID.sub_CategoryID","fSub_CategryID.subCategory_IDName","fSub_CategryID.sub_CategoryName").exclude("*.class","fSub_CategryID.*").serialize(specimenretentiontypeList);
	
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in get all specimenRetention by catID & subID, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while get all specimenRetention by catID & subID, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}
		
	}
	
}