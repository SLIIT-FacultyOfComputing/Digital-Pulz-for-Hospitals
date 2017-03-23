package core.resources.inward.prescription;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.PUT;
import javax.ws.rs.Path;


import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.apache.log4j.Logger;
import org.codehaus.jettison.json.JSONObject;

import core.ErrorConstants;
import core.classes.inward.prescription.PrescriptionTerms;
import flexjson.JSONException;
import flexjson.JSONSerializer;
import lib.driver.inward.driver_class.prescription.PrescriptionTermsDBDrive;

@Path("PrescriptionTerms")
public class PrescriptionTermsResource {
	final static Logger log = Logger.getLogger(PrescriptionTermsResource.class);
	
	PrescriptionTermsDBDrive requestdbDriver = new PrescriptionTermsDBDrive();
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd");
	

	@POST
	@Path("/addNewTermPrescrption")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addNewTermPrescrption(JSONObject wJson) throws org.codehaus.jettison.json.JSONException
	{
		log.info("Entering the add NewTermPrescription method");		
		try {
			PrescriptionTerms newterm  =  new PrescriptionTerms();
			
			newterm.setNo_of_terms(wJson.getInt("no_of_terms"));				
			newterm.setStart_date(dateformat.parse(wJson.getString("start_date")));
			newterm.setEnd_date(dateformat.parse(wJson.getString("end_date").toString()));				
			
			int create_user=wJson.getInt("create_user");			
			String bht_no=wJson.getString("bht_no");				 
			requestdbDriver.addNewTermPrescrption(newterm,create_user,bht_no);
			log.info("Insert prescription term Successful, bhtNo = "+bht_no);
			 JSONSerializer serializor =new JSONSerializer();
			 String result =serializor.exclude("*.class").serialize(newterm);
			return result;
		}  catch (JSONException e) {
			log.error("JSON exception in Add prescriptionTerm, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			
			
			return jsonErrorObject.toString(); 
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in Add prescriptionTerm, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while adding prescriptionTerm, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}

	}
	
	@PUT
	@Path("/UpdateTermPrescrption")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String UpdateTermPrescrption(JSONObject wJson) throws org.codehaus.jettison.json.JSONException{
		log.info("Entering the update prescriptionTerm method");
		String result="false";
		boolean r=false;
		
		try{
			int term_id=wJson.getInt("term_id");
			Date end_date=dateformat.parse(wJson.getString("end_date"));
			r=requestdbDriver.UpdateTermPrescrption(term_id,end_date);
			result=String.valueOf(r);
			log.info("Update Prescription_Term Successful, termID = "+term_id);
			return ""+term_id;
			
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in updating PrescriptionTerm, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while updating PrescriptionTerm, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}

	}
	
	@GET
	@Path("/getPrescrptionTermsByBHTNo/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getPrescrptionTermsByBHTNo(@PathParam("bhtNo")  String bhtNo) throws org.codehaus.jettison.json.JSONException
	{	try{
		log.info("Entering the get all prescriptionTerm by BhtNo method");
				 String result="";
		 List<PrescriptionTerms> req =requestdbDriver.getPrescrptionTermsByBHTNo(bhtNo);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.exclude("create_user","*.class").serialize(req);
		 return result;}
	catch(RuntimeException e)
	{
		log.error("Runtime Exception in getting prescriptionTerm by BHT_NO, message:" + e.getMessage());
		JSONObject jsonErrorObject = new JSONObject();
		
		jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
		jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
		
		
		return jsonErrorObject.toString(); 
	}
	catch (Exception e) {
		 System.out.println(e.getMessage());
		 log.error("Error while getting prescriptionTerm by BHT_NO, message: " + e.getMessage());
		 JSONObject jsonErrorObject = new JSONObject();
			
		jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
		jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			
		return jsonErrorObject.toString();
	}

	}

}
