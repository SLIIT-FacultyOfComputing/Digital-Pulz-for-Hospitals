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

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;
import org.jboss.logging.Logger;

import core.ErrorConstants;
import core.classes.inward.admin.Bed;
import core.resources.inward.WardAdmission.AdmissionResource;
import flexjson.JSONSerializer;
import lib.driver.inward.driver_class.admin.BedDBDriver;

@Path("Bed")
public class BedResource {
	
	BedDBDriver beddriver=new BedDBDriver();
	
	final static Logger log = Logger.getLogger(AdmissionResource.class);
	
	@POST
	@Path("/addBed")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addBed(JSONObject wJson) throws JSONException
	{
		log.info("Entering the add bed method");
		
		try {
			Bed bed  =  new Bed();
			bed.setBedNo(wJson.getInt("bedNo"));
			bed.setBedType(wJson.getString("bedType"));
			//bed.setWardNo(wJson.getString("wardNo"));
			String wardno=wJson.getString("wardNo").toString();
			bed.setAvailability(wJson.getString("availability"));
			bed.setPatientID(null);
						
			beddriver.insertBed(bed,wardno);
			
			log.info("Add Bed Successful : "+bed.getBedNo());
			
			JSONSerializer serializor=new JSONSerializer();
			return serializor.exclude("*.class").serialize(bed);
			
			//return "true";
		}
		catch(JSONException e){
			log.error("JSON exception in adding bed, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jSONError.put("Message",ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			return jSONError.toString();
		}
		catch (RuntimeException e)
		{
			log.error("Runtime exception in adding bed, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.NO_CONNECTION.getCode());
			jSONError.put("Message",ErrorConstants.NO_CONNECTION.getMessage());
			return jSONError.toString();
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return e.getMessage().toString(); 
		}

	}
	
	
	@GET
	@Path("/getAllBedByWardNo/{wardNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllBedByWardNo(@PathParam("wardNo")  String wardNo) throws JSONException{
		
		log.info("Entering the get all bed by ward no method");
		//String result="";
		try{
		 List<Bed> bedlist =beddriver.getAllBedByWardNo(wardNo);
		 log.info("Get all bed by ward no successful");
		 JSONSerializer serializor=new JSONSerializer();
		 //result= serializor.serialize(bedlist);
		 
		 return serializor.include("Ward.wardNo").exclude("*.class","Ward.*").serialize(bedlist);
		}
		catch (RuntimeException e)
		{
			log.error("Runtime exception in getting all bed by ward no, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.NO_CONNECTION.getCode());
			jSONError.put("Message",ErrorConstants.NO_CONNECTION.getMessage());
			return jSONError.toString();
		}
		catch(Exception e)
		{
			return e.getMessage().toString(); 
		}
	
		
	}
	
	@DELETE
	@Path("/deleteBed")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String deleteBed(JSONObject jsnObj){
		String result="false";
		boolean r=false;
		Bed bed=new Bed();
		log.info("Entering the delete bed method");
		
		
		try{
			
			
			bed.setBedID(jsnObj.getInt("bedID"));			
						
			r=beddriver.deleteBed(bed);
			result=String.valueOf(r);
			log.info("Delete bed method sucessfull");
			return result;
			
			
		}
		
		catch( JSONException ex){
			ex.printStackTrace();	
			return result;
		}
		
		
	}
	
	

	@PUT
	@Path("/updateBed")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String updateBed(JSONObject wJson) throws JSONException{
		
		log.info("Entering the update bed method");
		
		String result="false";
		boolean r=false;
		 Bed bed=new Bed();
		 System.out.println(bed.toString());
		try{
			bed.setBedID(wJson.getInt("bedID"));
			bed.setBedNo(wJson.getInt("bedNo"));
			//bed.setWardNo(wJson.getString("wardNo").toString());
			String wardno=wJson.getString("wardNo").toString();
			bed.setBedType(wJson.getString("bedType").toString());	
			bed.setAvailability(wJson.getString("availability"));
			
			int pid=wJson.getInt("patientID");
			
			
			r=beddriver.updateBed(bed,wardno,pid);
			result=String.valueOf(r);
			
			log.info("Update bed method successful");
			if(result.equals("true"))
			{
				JSONSerializer serializor=new JSONSerializer();
				return serializor.exclude("*.class").serialize(bed);
			}
			else
			{
				return "Not Updated";
			}
			//return result;
			
		}
		catch(JSONException e){
			log.error("JSON exception in updating bed, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jSONError.put("Message",ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			return jSONError.toString();
		}
		catch (RuntimeException e)
		{
			log.error("Runtime exception in updating bed, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.NO_CONNECTION.getCode());
			jSONError.put("Message",ErrorConstants.NO_CONNECTION.getMessage());
			return jSONError.toString();
		}
		
		catch( Exception ex){
			ex.printStackTrace();
			return ex.getMessage();
		}

	}
	
	
	@GET
	@Path("/geBedByWardNoAndBedNo/{wardNo}/{bedNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String geBedByWardNoAndBedNo(@PathParam("wardNo")  String wardNo,@PathParam("bedNo")  int bedNo) throws JSONException{
		//String result="";
		
		log.info("Entering the get bed by ward no and bed no method");
				
		try{
				
			
		 List<Bed> bedlist =beddriver.geBedByWardNoAndBedNo(wardNo,bedNo);
		 log.info("Get bed by ward no and bed no successful");
		 JSONSerializer serializor=new JSONSerializer();
		// result= serializor.serialize(bedlist);
		 
		 return serializor.include("Ward.wardNo").exclude("*.class","Ward.*").serialize(bedlist);
		}
		catch (RuntimeException e)
		{
			log.error("Runtime exception in getting bed by Ward No and bed no, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.NO_CONNECTION.getCode());
			jSONError.put("Message",ErrorConstants.NO_CONNECTION.getMessage());
			return jSONError.toString();
		}
		catch(Exception e)
		{
			return e.getMessage().toString(); 
		}
	
		
	}
	
	
	@GET
	@Path("/getFreeBedByWardNo/{wardNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getFreeBedByWardNo(@PathParam("wardNo")  String wardNo) throws JSONException{
		//String result="";
				
		try{
				
			
		 List<Bed> bedlist =beddriver.getFreeBedByWardNo(wardNo);
		 log.info("Get free bed by ward no successful");
		 JSONSerializer serializor=new JSONSerializer();
		 
		 return serializor.include("Ward.wardNo").exclude("*.class","Ward.*").serialize(bedlist);
		}
		catch (RuntimeException e)
		{
			log.error("Runtime exception in getting free bed by ward no, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.NO_CONNECTION.getCode());
			jSONError.put("Message",ErrorConstants.NO_CONNECTION.getMessage());
			return jSONError.toString();
		}
		catch(Exception e)
		{
			return e.getMessage().toString(); 
		}
	
		
	}

}
