package core.resources.inward.prescription;

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

import org.codehaus.jettison.json.JSONObject;
import core.classes.inward.prescription.TempPrescribe;
import flexjson.JSONException;
import flexjson.JSONSerializer;
import lib.driver.inward.driver_class.prescription.TempPrescribeDBDrive;

@Path("TempPrescribe")
public class TempPrescribeResource {
	
	TempPrescribeDBDrive requestdbDriver = new TempPrescribeDBDrive();
	
	@POST
	@Path("/addNewPrescrptionItem")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addNewPrescrptionItem(JSONObject wJson)
	{
				
		try {
			TempPrescribe newterm  =  new TempPrescribe();
										
			int drug_id=wJson.getInt("drug_id");					
			int term_id=wJson.getInt("term_id");
			newterm.setDose(wJson.getInt("dose"));
			newterm.setFrequency(wJson.getString("frequency"));
			
			
			requestdbDriver.addNewPrescrptionItem(newterm,drug_id,term_id);
			 			
			return "true";
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return e.getMessage().toString(); 
		}

	}
	
	
	@POST
	@Path("/UpdatePrescrptionItem")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String UpdatePrescrptionItem(JSONObject wJson){
		
		String result="false";
		boolean r=false;
		
		try{
			int auto_id=wJson.getInt("auto_id");
			int dose=wJson.getInt("dose");
			String frequency=wJson.getString("frequency");
			System.out.println(auto_id+","+dose+","+frequency);
			r=requestdbDriver.UpdatePrescrptionItem(auto_id,dose,frequency);
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
	
	@GET
	@Path("/getPrescrptionItemsByTermID/{term_id}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getPrescrptionItemsByTermID(@PathParam("term_id")  int term_id)
	{
				 String result="";
		 List<TempPrescribe> req =requestdbDriver.getPrescrptionItemsByTermID(term_id);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(req);
		 return result;
	}
	
	@DELETE
	@Path("/deleteTempPrescription")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String deleteWard(JSONObject jsnObj){
		String result="false";
		boolean r=false;
		
		
		try{
			TempPrescribe temp=new TempPrescribe();		
			
			temp.setAuto_id(jsnObj.getInt("auto_id"));			
						
			r=requestdbDriver.deleteTempPrescription(temp);
			result=String.valueOf(r);
			
			return result;
			
			
		}catch( JSONException ex){
			ex.printStackTrace();	
			return result;
		}
		
		catch( Exception ex){
			ex.printStackTrace();
			return ex.getMessage();
		}
		
		
	}
	
	
}


