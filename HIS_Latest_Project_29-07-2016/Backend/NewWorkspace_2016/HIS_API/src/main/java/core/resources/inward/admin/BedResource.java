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
import core.classes.inward.admin.Bed;
import flexjson.JSONSerializer;
import lib.driver.inward.driver_class.admin.BedDBDriver;

@Path("Bed")
public class BedResource {
	
	BedDBDriver beddriver=new BedDBDriver();
	
	@POST
	@Path("/addBed")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addBed(JSONObject wJson)
	{
		
		try {
			Bed bed  =  new Bed();
			bed.setBedNo(wJson.getInt("bedNo"));
			bed.setBedType(wJson.getString("bedType"));
			//bed.setWardNo(wJson.getString("wardNo"));
			String wardno=wJson.getString("wardNo").toString();
			bed.setAvailability(wJson.getString("availability"));
			bed.setPatientID(null);
						
			beddriver.insertBed(bed,wardno);
			 			
			return "true";
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return e.getMessage().toString(); 
		}

	}
	
	
	@GET
	@Path("/getAllBedByWardNo/{wardNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllBedByWardNo(@PathParam("wardNo")  String wardNo){
		//String result="";
		try{
		 List<Bed> bedlist =beddriver.getAllBedByWardNo(wardNo);
		 JSONSerializer serializor=new JSONSerializer();
		 //result= serializor.serialize(bedlist);
		 return serializor.include("Ward.wardNo").exclude("*.class","Ward.*").serialize(bedlist);
		}catch(Exception e)
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
		
		
		try{
			
			
			bed.setBedID(jsnObj.getInt("bedID"));			
						
			r=beddriver.deleteBed(bed);
			result=String.valueOf(r);
			
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
	public  String updateBed(JSONObject wJson){
		
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
			return result;
			
		}
		catch( JSONException ex){
			ex.printStackTrace();	
			//return result;
			return ex.getMessage();
		}
		
		catch( Exception ex){
			ex.printStackTrace();
			return ex.getMessage();
		}

	}
	
	
	@GET
	@Path("/geBedByWardNoAndBedNo/{wardNo}/{bedNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String geBedByWardNoAndBedNo(@PathParam("wardNo")  String wardNo,@PathParam("bedNo")  int bedNo){
		//String result="";
				
		try{
				
			
		 List<Bed> bedlist =beddriver.geBedByWardNoAndBedNo(wardNo,bedNo);
		 JSONSerializer serializor=new JSONSerializer();
		// result= serializor.serialize(bedlist);
		 return serializor.include("Ward.wardNo").exclude("*.class","Ward.*").serialize(bedlist);
		}catch(Exception e)
		{
			return e.getMessage().toString(); 
		}
	
		
	}
	
	
	@GET
	@Path("/getFreeBedByWardNo/{wardNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getFreeBedByWardNo(@PathParam("wardNo")  String wardNo){
		//String result="";
				
		try{
				
			
		 List<Bed> bedlist =beddriver.getFreeBedByWardNo(wardNo);
		 JSONSerializer serializor=new JSONSerializer();
		 return serializor.include("Ward.wardNo").exclude("*.class","Ward.*").serialize(bedlist);
		}catch(Exception e)
		{
			return e.getMessage().toString(); 
		}
	
		
	}

}
