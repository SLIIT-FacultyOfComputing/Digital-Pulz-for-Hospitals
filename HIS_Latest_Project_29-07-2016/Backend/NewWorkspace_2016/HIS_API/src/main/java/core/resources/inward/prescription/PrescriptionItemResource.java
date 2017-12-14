package core.resources.inward.prescription;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
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
import org.hibernate.Criteria;
import org.hibernate.Session;
import org.hibernate.criterion.Order;
import org.hibernate.criterion.Restrictions;

import core.ErrorConstants;
import core.classes.inward.prescription.PrescriptionItem;
import core.classes.inward.prescription.PrescriptionTerms;
import core.resources.lims.SubCategoryResource;
import flexjson.JSONException;
import flexjson.JSONSerializer;
import lib.SessionFactoryUtil;
import lib.driver.inward.driver_class.prescription.PrescriptionItemDBDrive;

@Path("PrescriptionItem")
public class PrescriptionItemResource {
	
	final static Logger log = Logger.getLogger(PrescriptionItemResource.class);
	
	PrescriptionItemDBDrive requestdbDriver = new PrescriptionItemDBDrive();
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");

	@POST
	@Path("/addNewPrescrptionItem")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addNewPrescrptionItem(JSONObject wJson) throws org.codehaus.jettison.json.JSONException {
		log.info("Entering the add NewPrescription method");
		
		try {
			PrescriptionItem newterm = new PrescriptionItem();

			int drug_id = wJson.getInt("drug_id");
			int term_id = wJson.getInt("term_id");
			newterm.setDose(wJson.getInt("dose"));
			newterm.setFrequency(wJson.getString("frequency"));
			newterm.setStatus(wJson.getString("status"));

			requestdbDriver.addNewPrescrptionItem(newterm, drug_id, term_id);
			log.info("Insert prescription item Successful, drugId = "+drug_id);
			JSONSerializer serializer=new JSONSerializer();
			String Result=serializer.exclude("*.class").serialize(newterm);
			return Result;
		} catch (JSONException e) {
			log.error("JSON exception in Add prescription item, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			
			
			return jsonErrorObject.toString(); 
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in Add prescription item, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while adding prescription item, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}
	}

	@POST
	@Path("/UpdatePrescrptionItem")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String UpdatePrescrptionItem(JSONObject wJson) throws org.codehaus.jettison.json.JSONException {
		log.info("Entering the update prescriptionItem method");
		String result = "false";
		boolean r = false;

		try {
			int auto_id = wJson.getInt("auto_id");
			int Dose = wJson.getInt("dose");
			String Frequnecy = wJson.getString("frequency");
			String status = wJson.getString("status");
			r = requestdbDriver.UpdatePrescrptionItem(auto_id,Dose,Frequnecy,status);
			log.info("Update Prescription Item Successful, autoID = "+auto_id);
			result = String.valueOf(r);

			return ""+auto_id;

		}	catch(RuntimeException e)
		{
			log.error("Runtime Exception in updating Prescription Item, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while updating Prescription Item, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}

	}

	@GET
	@Path("/getPrescrptionItemsByBHTNo/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getPrescrptionItemsByBHTNo(@PathParam("bhtNo") String bhtNo) throws org.codehaus.jettison.json.JSONException {
		try{
			log.info("Entering the get all prescriptionItems by BhtNo method");
		
		String result = "";
		List<PrescriptionItem> req = requestdbDriver.getPrescrptionItemsByBHTNo(bhtNo);
		JSONSerializer serializor = new JSONSerializer();
		
		result = serializor.serialize(req);
		return result;}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in getting prescriptionItems by BHT_NO, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while getting prescriptionItems by BHT_NO, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}
	}

	@GET
	@Path("/getPrescrptionItemsByTermID/{term_id}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getPrescrptionItemsByTermID(@PathParam("term_id") int term_id) throws org.codehaus.jettison.json.JSONException {
		try{
			log.info("Entering the get all prescriptionItems by term_id method");
		
		String result = "";
		List<PrescriptionItem> req = requestdbDriver.getPrescrptionItemsByTermID(term_id);
		JSONSerializer serializor = new JSONSerializer();
		result = serializor.serialize(req);
		return result;}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in getting prescriptionItems by term_id, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while getting prescriptionItems by term_id, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}
	}

	@GET
	@Path("/getMaxTermID")

	public String getMaxTermIDByUserID() throws org.codehaus.jettison.json.JSONException {
		try{
			log.info("Entering the get max_term_id method");
		
		return requestdbDriver.GetMaxTermID();
		}catch(RuntimeException e)
		{
			log.error("Runtime Exception in getting MaxTermId, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while getting  MaxTermId, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}
	}

}
