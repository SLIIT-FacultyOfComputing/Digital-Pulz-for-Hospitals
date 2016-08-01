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
import core.classes.inward.admin.Ward;
import flexjson.JSONSerializer;
import lib.driver.inward.driver_class.admin.WardDBDriver;

@Path("Ward")
public class WardResource {
	
	WardDBDriver warddbdriver = new WardDBDriver();
	
	@POST
	@Path("/addWard")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addWard(JSONObject wJson)
	{
		
		try {
			Ward ward  =  new Ward();
			ward.setWardNo(wJson.getString("wardNo").toString());
			ward.setCategory(wJson.getString("category").toString());	
			ward.setWardGender(wJson.getString("wardGender"));
			//ward.setNoOfBed(wJson.getInt("noOfBed"));
						
			warddbdriver.insertWard(ward);
			 			
			return "true";
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return e.getMessage().toString(); 
		}

	}
	
	
	@GET
	@Path("/getWard")
	@Produces(MediaType.APPLICATION_JSON)
	public String getWard()
	{
		List<Ward> wardList =warddbdriver.getWardList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.serialize(wardList);

	}
	

	
	@DELETE
	@Path("/deleteWard")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String deleteWard(JSONObject jsnObj){
		String result="false";
		boolean r=false;
		Ward ward=new Ward();
		
		
		try{
			
			
			ward.setWardNo(jsnObj.getString("wardNo"));			
						
			r=warddbdriver.deleteWard(ward);
			result=String.valueOf(r);
			
			return result;
			
			
		}
		
		catch( JSONException ex){
			ex.printStackTrace();	
			return result;
		}
		
		
	}
	
	
	@GET
	@Path("/getWardByWardNo/{wardNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getWardByWardNo(@PathParam("wardNo")  String wardNo){
		String result="";
		 List<Ward> wardlist =warddbdriver.getWardDetailsByWardNo(wardNo);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(wardlist);
		 return result;
	
		
	}
	
	
	@PUT
	@Path("/updateWard")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String updateWardDetails(JSONObject wJson){
		
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
			result=String.valueOf(r);
			return result;
			
		}
		catch( JSONException ex){
			ex.printStackTrace();	
			return result;
		}
		
		catch( Exception ex){
			ex.printStackTrace();
			return ex.getMessage();
		}

	}
	
	
}
