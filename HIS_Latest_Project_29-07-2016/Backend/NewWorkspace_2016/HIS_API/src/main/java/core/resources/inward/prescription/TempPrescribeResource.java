package core.resources.inward.prescription;

import java.util.List;

import org.hibernate.ObjectNotFoundException;

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

import com.sun.jersey.json.impl.reader.JsonFormatException;

import core.ErrorConstants;
import core.classes.inward.prescription.TempPrescribe;
import flexjson.JSONSerializer;
import lib.driver.inward.driver_class.prescription.TempPrescribeDBDrive;

@Path("TempPrescribe")
public class TempPrescribeResource {
	
	final static Logger log = Logger.getLogger(TempPrescribeResource.class);
	
	TempPrescribeDBDrive requestdbDriver = new TempPrescribeDBDrive();
	
	@POST
	@Path("/addNewPrescrptionItem")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addNewPrescrptionItem(JSONObject wJson) throws JSONException
	{
		log.info("Entering the add New prescription Item method");
				
		try {
			TempPrescribe newterm  =  new TempPrescribe();
										
			int drug_id=wJson.getInt("drug_id");					
			int term_id=wJson.getInt("term_id");
			newterm.setDose(wJson.getInt("dose"));
			newterm.setFrequency(wJson.getString("frequency"));
			
			
			requestdbDriver.addNewPrescrptionItem(newterm,drug_id,term_id);
			
			JSONSerializer serializor=new JSONSerializer();
			String result= serializor.exclude("*class").serialize(newterm);
			log.info("Insert MainResults Successful");
			return result;
			 			
			//return "true";
		}catch(JSONException e){
			log.error("JSON exception in adding NewTempchartDetails, message: " + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString();
		}
		catch (RuntimeException e) {
			log.error("Runtime Exception in adding NewTempchartDetails, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 return e.getMessage().toString(); 
		}

	}
	
	
	@POST
	@Path("/UpdatePrescrptionItem")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String UpdatePrescrptionItem(JSONObject wJson) throws JSONException{
		
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
		catch( JSONException e){

			log.error("JSON exception in adding NewTempchartDetails, message: " + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString();
			
		}
		catch(RuntimeException e){
			log.error("Runtime Exception in adding New DiagnoseDetail, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			
			log.error("Exception in adding NewTempchartDetails, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			 
			 return e.getMessage().toString(); 
		}
		
		
	}
	
	@GET
	@Path("/getPrescrptionItemsByTermID/{term_id}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getPrescrptionItemsByTermID(@PathParam("term_id")  int term_id) throws JSONException
	{
		log.info("Entering the get priscription items by Term Id method");
		try{
		 String result="";
		 List<TempPrescribe> req =requestdbDriver.getPrescrptionItemsByTermID(term_id);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(req);
		 return result;
		}
		catch(RuntimeException e){
			log.error("Runtime Exception in get all MainResults by ReqID, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
	}
	
	@DELETE
	@Path("/deleteTempPrescription")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String deleteWard(JSONObject jsnObj) throws org.codehaus.jettison.json.JSONException{
		log.info("Entering the delete Ward method");
		String result="false";
		boolean r=false;
		
		
		try{
			TempPrescribe temp=new TempPrescribe();		
			temp.setAuto_id(jsnObj.getInt("auto_id"));			
						
			r=requestdbDriver.deleteTempPrescription(temp);
			result=String.valueOf(r);
			if(r)
			{
				JSONSerializer serializor=new JSONSerializer();
				 result= serializor.serialize(temp);
				 return result;
			}
			return result;
			
			
		}
		catch(ObjectNotFoundException e){
			log.error("Object Not Found Exception in Deleting Ward, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.INVALID_ID.getCode());
			jsonErrorObject.put("message", ErrorConstants.INVALID_ID.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch( RuntimeException e){
			log.error("Runtime Exception in Deleting Ward, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		
		catch(Exception e){
			 System.out.println(e.getMessage());
			 log.error("Error while Deleting Ward, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}
		
		
	}
	
	
}


