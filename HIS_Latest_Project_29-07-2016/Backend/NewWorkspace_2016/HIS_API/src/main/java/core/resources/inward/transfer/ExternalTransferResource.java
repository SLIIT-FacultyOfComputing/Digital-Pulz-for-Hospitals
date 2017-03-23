package core.resources.inward.transfer;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
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
import core.classes.inward.transfer.ExternalTransfer;
import core.resources.lims.CategoryResource;
import flexjson.JSONSerializer;
import lib.driver.inward.driver_class.transfer.ExternalTransferDBDriver;

@Path("ExternalTransfer")
public class ExternalTransferResource {
	
	final static Logger log = Logger.getLogger(ExternalTransferResource.class);
	
	ExternalTransferDBDriver externaltransferdbdriver = new ExternalTransferDBDriver();
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");
	
//	@GET
//	@Path("/getAllExternalTransfers")
//	@Produces(MediaType.APPLICATION_JSON)
//	
//	public String TransferDetails(){
//		
//		List<ExternalTransfer> transfer = externaltransferdbdriver.getAllExternalTransfers();
//		JSONSerializer serializer = new JSONSerializer();
//		return serializer.transform(new DateTransformer("yyyy-MM-dd HH:mm"),
//				"transferCreatedDate").serialize(transfer);
//	}
//	
	@POST
	@Path("/addExternalTransfer")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	
	public String CreateExternalTransfer(JSONObject wJson) throws JSONException
	{
		
		log.info("Entering the Create External Transfer method");
		
		try {
			ExternalTransfer transfer = new ExternalTransfer();
			transfer.setBhtNo(wJson.getString("bhtNo"));
			transfer.setTransferFrom(wJson.getString("transferFrom"));
			transfer.setTransferTo(wJson.getString("transferTo"));
			transfer.setResonForTrasnsfer(wJson.getString("resonForTrasnsfer"));
			transfer.setReportOfSpacialExamination(wJson.getString("reportOfSpacialExamination"));
			transfer.setTreatmentSuggested(wJson.getString("treatmentSuggested"));
			transfer.setTransferCreatedDate(dateformat.parse(wJson.getString("transferCreatedDate").toString()));
			transfer.setTransferCreatedUser(wJson.getInt("transferCreatedUser"));
			transfer.setNameOfGuardian(wJson.getString("nameOfGuardian"));
			transfer.setAddressOfGuardian(wJson.getString("addressOfGuardian"));
	
			externaltransferdbdriver.insertTransfer(transfer);		
			
			
			JSONSerializer serializor=new JSONSerializer();
			String result= serializor.exclude("*.class").serialize(transfer);
			
			log.info("Create External Transfer Successful, BhtNo = "+transfer.getBhtNo());
			
			return result; //"true";
		}
		
		catch (JSONException e) {
			log.error("JSON exception in Create External Transfer, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString(); 
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in Create External Transfer, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());

			return jsonErrorObject.toString(); 
		}
		
		
		catch (Exception e) {
			System.out.println(e.getMessage());
			 log.error("Error while creating External Transfer, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}

	}
	
	@GET
	@Path("/getSelectExternalTransfer/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getSelectInternalTransfer(@PathParam("bhtNo")  String bhtNo) throws JSONException
	{
		log.info("Entering the get Select External Transfer method");
		
	try{	
		String result="";
		 List<ExternalTransfer> transfer = externaltransferdbdriver.getExternalTransferByBHT(bhtNo);
		 JSONSerializer serializor=new JSONSerializer();
		 
		 log.info("Get Select External Transfer successful, list count = " + transfer.size());
		 
		 result= serializor.serialize(transfer);
		 return result;
	}
	
	catch(RuntimeException e)
	{
		log.error("Runtime Exception in getting Select External Transfer, message:" + e.getMessage());
		JSONObject jsonErrorObject = new JSONObject();
		
		jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
		jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
		
		
		return jsonErrorObject.toString(); 
	}
	catch (Exception e) {
		 System.out.println(e.getMessage());
		 log.error("Error while getting Select External Transfer, message: " + e.getMessage());
		 JSONObject jsonErrorObject = new JSONObject();
			
		jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
		jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			
		return jsonErrorObject.toString();
	}
		 
	}
	
	
	
}
