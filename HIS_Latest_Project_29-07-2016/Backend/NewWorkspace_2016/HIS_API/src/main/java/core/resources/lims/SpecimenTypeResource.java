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
import core.classes.lims.SpecimenType;
import core.classes.lims.SubCategory;
import flexjson.JSONSerializer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.SpecimenTypeDBDriver;

@Path("SpecimenType")
public class SpecimenTypeResource {

SpecimenTypeDBDriver stDBDriver= new SpecimenTypeDBDriver();
	
	final static Logger log = Logger.getLogger(SpecimenTypeResource.class);

	public String addSpecimenType(JSONObject pJson,String catid,String subid) throws JSONException
	{
		log.info("Entering the add SpecimenType method");
		try {
			SpecimenType stype  =  new SpecimenType();
			
			int categoryID = Integer.parseInt(catid);
			int subcategoryID = Integer.parseInt(subid);
			
			stype.setSpecimen_TypeName(pJson.getString("specimen").toString());
			
			stDBDriver.insertSpecimenType(stype, categoryID, subcategoryID);		 
			JSONSerializer jsonSerializer = new JSONSerializer();
			jsonSerializer.include("specimenType_ID").serialize(stype);
			 
			log.info("Insert specimenType Successful, SpecimenTypeID = "+stype.getSpecimenType_ID());
			 
			return stype.getSpecimenType_ID()+"";
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in inserting specimenType, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while inserting specimenType, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}

	}
	
	@GET
	@Path("/getAllSpecimenTypes")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSpecimenType() throws JSONException
	{
		try{
			
			log.info("Entering the get all SpecimenTypes method");
			
			List<SpecimenType> specimentypeList =   stDBDriver.getSpecimenTypeList();
			JSONSerializer serializer = new JSONSerializer();
			
			return  serializer.include("fCategry_ID.category_Name","fSub_CategoryID.sub_CategoryName").exclude("*.class","fCategry_ID.*","fSub_CategoryID.*").serialize(specimentypeList);
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in getting all specimenTypes, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while getting all specimenTypes, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}

	}
	
	@GET
	@Path("/getAllSpecimenTypesByCIDSID/{catID}/{subID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSpecimenType(@PathParam("catID")int catID,@PathParam("subID")int subID) throws JSONException
	{
		log.info("Entering the get all SpecimenTypes by catID & subID method");
		try{
			List<SpecimenType> specimentypeList =   stDBDriver.getSpecimenTypeListByCIDSID(catID,subID);
			JSONSerializer serializer = new JSONSerializer();
			return  serializer.exclude("*.class").serialize(specimentypeList);
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in getting all specimenTypes by catID & subID, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while getting all specimenTypes by catID & subID, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}

	}
	
}