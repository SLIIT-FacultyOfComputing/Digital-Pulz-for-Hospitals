package core.resources.inward.admin;


import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.DELETE;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.PUT;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.apache.log4j.Logger;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;
import org.hibernate.ObjectNotFoundException;

import core.ErrorConstants;
import core.classes.inward.admin.Ward;
import core.resources.lims.SubCategoryResource;
import flexjson.JSONSerializer;
import lib.driver.inward.driver_class.admin.WardDBDriver;

@Path("Ward")
public class WardResource {
	
	WardDBDriver warddbdriver = new WardDBDriver();
	final static Logger log = Logger.getLogger(WardResource.class);
	@POST
	@Path("/addWard")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addWard(JSONObject wJson) throws JSONException
	{
		log.info("Entering the add Ward method");
		try {
			Ward ward  =  new Ward();
			ward.setWardNo(wJson.getString("wardNo").toString());
			ward.setCategory(wJson.getString("category").toString());	
			ward.setWardGender(wJson.getString("wardGender"));
			//ward.setNoOfBed(wJson.getInt("noOfBed"));
						
			warddbdriver.insertWard(ward);
			log.info("Insert ward Successful, WardNo = "+ward.getWardNo());			
			JSONSerializer serializer = new JSONSerializer();
			return  serializer.exclude("*.class").serialize(ward);
		} catch(RuntimeException e)
		{
			log.error("Runtime Exception in inserting ward, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while inserting ward, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}


	}
	
	
	@GET
	@Path("/getWard")
	@Produces(MediaType.APPLICATION_JSON)
	public String getWard() throws JSONException
	{try{
		log.info("Entering the get all ward method");
		List<Ward> wardList =warddbdriver.getWardList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.serialize(wardList);
	}
	catch(RuntimeException e)
	{
		log.error("Runtime Exception in getting all wards, message:" + e.getMessage());
		JSONObject jsonErrorObject = new JSONObject();
		
		jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
		jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
		
		
		return jsonErrorObject.toString(); 
	}
	catch (Exception e) {
		 System.out.println(e.getMessage());
		 log.error("Error while getting all wards, message: " + e.getMessage());
		 JSONObject jsonErrorObject = new JSONObject();
			
		jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
		jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			
		return jsonErrorObject.toString();
	}
	
	
	}
	

	
	@DELETE
	@Path("/deleteWard")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String deleteWard(JSONObject jsnObj) throws JSONException{
		log.info("Entering the delete ward method");
		String result="";
		boolean r=false;
		Ward ward=new Ward();
		
		
		try{
			
			
			ward.setWardNo(jsnObj.getString("wardNo"));			
						
			r=warddbdriver.deleteWard(ward);
			log.info("Delete ward successful , WardNo = " + ward.getWardNo());
	if(r)
	{//result=String.valueOf(r);
			
			
			JSONSerializer serializor=new JSONSerializer();
			 result= serializor.exclude("*.class").serialize(ward);
	}

			return result;
			
			
		}
		
		catch(ObjectNotFoundException e)
		{
			log.error("Object Not Found Exception in Deleting Ward, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.INVALID_ID.getCode());
			jsonErrorObject.put("message", ErrorConstants.INVALID_ID.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in Deleting ward, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while Deleting ward, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}
		
		
	}
	
	
	@GET
	@Path("/getWardByWardNo/{wardNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getWardByWardNo(@PathParam("wardNo")  String wardNo) throws JSONException{
		try{
		log.info("Entering the get ward by Ward No method");
		String result="";
		 List<Ward> wardlist =warddbdriver.getWardDetailsByWardNo(wardNo);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(wardlist);
		 return result;}
		 catch(RuntimeException e)
			{
				log.error("Runtime Exception in getting ward by WardNo, message:" + e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				
				jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
				jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
				
				
				return jsonErrorObject.toString(); 
			}
			catch (Exception e) {
				 System.out.println(e.getMessage());
				 log.error("Error while getting ward by WardNo, message: " + e.getMessage());
				 JSONObject jsonErrorObject = new JSONObject();
					
				jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
				jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
					
				return jsonErrorObject.toString();
			}
		
	}
	
	
	@PUT
	@Path("/updateWard")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String updateWardDetails(JSONObject wJson) throws JSONException{
		log.info("Entering the updating ward method");
		String result="false";
		boolean r=false;
		 Ward ward=new Ward();
		 System.out.println(ward.toString());
		try{
			
			ward.setWardNo(wJson.getString("wardNo").toString());
			ward.setCategory(wJson.getString("category").toString());	
			ward.setWardGender(wJson.getString("wardGender"));
			//ward.setNoOfBed(wJson.getInt("noOfBed"));
			r=warddbdriver.updateUserDetails(ward);
			log.info("updating ward successful , ward = " + ward.getWardNo());
			if(r)
			{			JSONSerializer serializor=new JSONSerializer();
			 result= serializor.exclude("*.class").serialize(ward);}
			//result=String.valueOf(r);
			return result;
			
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in updating ward, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while updating ward, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}


	}
	
	
}
