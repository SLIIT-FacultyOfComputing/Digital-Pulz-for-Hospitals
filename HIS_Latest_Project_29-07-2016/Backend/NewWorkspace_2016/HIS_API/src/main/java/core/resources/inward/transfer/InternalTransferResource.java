package core.resources.inward.transfer;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.PUT;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.apache.log4j.Logger;
import org.codehaus.jettison.json.JSONObject;

import javax.ws.rs.PathParam;

import core.ErrorConstants;
import core.classes.inward.transfer.InternalTransfer;
import flexjson.JSONException;
import flexjson.JSONSerializer;
import lib.driver.inward.driver_class.transfer.InternalTransferDBDriver;

@Path("InternalTransfer")
public class InternalTransferResource {
	
	final static Logger log = Logger.getLogger(InternalTransferResource.class);
	
	InternalTransferDBDriver internaltransferdbdriver = new InternalTransferDBDriver();
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");
	
/*	@GET
	@Path("/getAllInternalTransfers")
	@Produces(MediaType.APPLICATION_JSON)
	
	public String TransferDetails(){
		
		List<InternalTransfer> transfer = internaltransferdbdriver.getAllInternalTransfers();
		JSONSerializer serializer = new JSONSerializer();
		return serializer.transform(new DateTransformer("yyyy-MM-dd HH:mm"),
				"transferCreatedDate").serialize(transfer);
	}*/
	
	@POST
	@Path("/addInternalTransfer")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String CreateInternalTransfer(JSONObject wJson) throws org.codehaus.jettison.json.JSONException 
	{
		
		log.info("Entering the Create Internal Transfer method");
		
		try {
			InternalTransfer transfer = new InternalTransfer();
			String bhtno=wJson.getString("bhtNo");
			String toward=wJson.getString("transferWard");
			String fromword=wJson.getString("transferFromWard");
			transfer.setResonForTrasnsfer(wJson.getString("resonForTrasnsfer"));
			transfer.setReportOfSpacialExamination(wJson.getString("reportOfSpacialExamination"));
			transfer.setTreatmentSuggested(wJson.getString("treatmentSuggested"));	
			transfer.setTransferCreatedDate(dateformat.parse(wJson.getString("transferCreatedDate").toString()));
			int userId=wJson.getInt("transferCreatedUser");
			
			internaltransferdbdriver.insertTransfer(transfer,bhtno,toward,fromword,userId);			
			
			JSONSerializer serializor=new JSONSerializer();
			String result= serializor.exclude("*.class").serialize(transfer);
			
			log.info("Create Internal Transfer Successful, reson For Trasnsfer = "+transfer.getResonForTrasnsfer());
			
			return result;//"true"; 
			
			}
		
			catch (JSONException e) {
				log.error("JSON exception in Create Internal Transfer, message:" + e.getMessage());
				
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
				
				return jsonErrorObject.toString(); 
			}
		
			catch(RuntimeException e)
			{
				log.error("Runtime Exception in Create Internal Transfer, message:" + e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				
				jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
				jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
	
				return jsonErrorObject.toString(); 
			}
		
			catch (Exception e) {
				System.out.println(e.getMessage());
				 log.error("Error while creating Internal Transfer, message: " + e.getMessage());
				 JSONObject jsonErrorObject = new JSONObject();
					
				jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
				jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
					
				return jsonErrorObject.toString();
			}

	}
	
	@GET
	@Path("/getSelectInternalTransfer/{transferId}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getSelectInternalTransfer(@PathParam("transferId")  String transferID) throws org.codehaus.jettison.json.JSONException
	{
		
		log.info("Entering the get Select Internal Transfer method");
		try{
		 String result="";
		 List<InternalTransfer> transfer =internaltransferdbdriver.getInternalTransferByID(transferID);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(transfer);
		 
		 log.info("Get Select Internal Transfer successful, list count = " + transfer.size());
		 
		 return result;
		}
		
		 catch(RuntimeException e)
			{
				log.error("Runtime Exception in getting Select Internal Transfer, message:" + e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				
				jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
				jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
				
				
				return jsonErrorObject.toString(); 
			}
			catch (Exception e) {
				 System.out.println(e.getMessage());
				 log.error("Error while getting Select Internal Transfer, message: " + e.getMessage());
				 JSONObject jsonErrorObject = new JSONObject();
					
				jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
				jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
					
				return jsonErrorObject.toString();
			}
		 
	}

	
	// Update exceptions are not done hasthi.d
	
	@PUT
	@Path("/updateInternalTransfer")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String updateInternalTransfer(JSONObject wJson){
		
		log.info("Entering the update Internal Transfer method");		
		
		String result="false";
		boolean r=false;
		 //InternalTransfer transfer =new InternalTransfer();
		try{
			int id=wJson.getInt("transferId");
			String bht=wJson.getString("NewbhtNo");
			//transfer.setTransferId(wJson.getInt("transferId"));
			//transfer.setRead(1);
			//transfer.setBhtNo(wJson.getString("bhtNo"));
			//transfer.setTransferFromWard(wJson.getString("transferFromWard"));
			//transfer.setBhtNo(wJson.getString("transferWard"));
			//transfer.setResonForTrasnsfer("resonForTrasnsfer");
			//transfer.setReportOfSpacialExamination(wJson.getString("reportOfSpacialExamination"));
			//transfer.setTreatmentSuggested(wJson.getString("treatmentSuggested"));
			//transfer.setTransferCreatedDate(dateformat.parse(wJson.getString("transferCreatedDate").toString()));
			//transfer.setTransferCreatedUser(wJson.getString("transferCreatedUser"));
		
			
			r=internaltransferdbdriver.updateInternalTransferDetails(id,bht);
			result=String.valueOf(r);
			
			log.info("Get Select Internal Transfer successful");
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
	@Path("/getNotReadInternalTransferByWard/{wardNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getNotReadInternalTransferByWard(@PathParam("wardNo")  String wardNo) throws org.codehaus.jettison.json.JSONException
	{
		
		log.info("Entering the get not read Internal Transfer by ward method");
		
		 try{
		 String result="";
		 List<InternalTransfer> transfer =internaltransferdbdriver.getNotReadInternalTransferByWard(wardNo);
		 JSONSerializer serializor=new JSONSerializer();
		 
		 log.info("Get not read Internal Transfer by ward successful, list count = " + transfer.size());
		 
		 result= serializor.include("Admission.bhtNo","Ward.wardNo").exclude("*.class","Admission.*","Ward.*","User.*").serialize(transfer);
		 return result;
		 }
		 
		 catch(RuntimeException e)
			{
				log.error("Runtime Exception in getting not read Internal Transfer by ward, message:" + e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				
				jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
				jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
				
				
				return jsonErrorObject.toString(); 
			}
			catch (Exception e) {
				 System.out.println(e.getMessage());
				 log.error("Error while getting not read Internal Transfer by ward, message: " + e.getMessage());
				 JSONObject jsonErrorObject = new JSONObject();
					
				jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
				jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
					
				return jsonErrorObject.toString();
			}
	}
	
	@GET
	@Path("/getInternalTransferByID/{tranferId}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getInternalTransferByID(@PathParam("tranferId")  int tranferId) throws org.codehaus.jettison.json.JSONException
	{
		
		log.info("Entering the get Internal Transfer by ID method");
		
		try{
		 String result="";
		 List<InternalTransfer> transfer =internaltransferdbdriver.getInternalTransferByID(tranferId);
		 JSONSerializer serializor=new JSONSerializer();
		 
		 log.info("get Internal Transfer by ID successful, list count = " + transfer.size());
		 
		 result= serializor.include("Admission.bhtNo","Ward.wardNo").exclude("*.class","Admission.*","Ward.*","User.*").serialize(transfer);
		 return result;
		}
		
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in getting Internal Transfer by ID, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while getting not read Internal Transfer by ID, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}
	}
	
	

	@GET
	@Path("/getInternalTransferByBHTNo/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getInternalTransferByBHTNo(@PathParam("bhtNo")  String bhtNo) throws org.codehaus.jettison.json.JSONException
	{
		log.info("Entering the get Internal Transfer By BHTNo method");
		
		try{
		 String result="";
		 List<InternalTransfer> transfer =internaltransferdbdriver.getInternalTransferByBHTNo(bhtNo);
		 JSONSerializer serializor=new JSONSerializer();
		 
		 log.info("get Internal Transfer By BHTNo successful, list count = " + transfer.size());
		 
		 result= serializor.include("Admission.bhtNo","Ward.wardNo").exclude("*.class","Admission.*","Ward.*","User.*").serialize(transfer);
		 return result;
		}
		
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in getting Internal Transfer By BHTNo, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while getting Internal Transfer By BHTNo, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}
		
	}
	

}
