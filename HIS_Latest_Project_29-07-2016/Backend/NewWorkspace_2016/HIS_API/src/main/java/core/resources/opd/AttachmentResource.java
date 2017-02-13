package core.resources.opd;

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
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.ErrorConstants;
import core.classes.opd.Attachments;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
import lib.driver.opd.driver_class.AttachmentDBDriver;

/**
 * This class define all the generic REST Services necessary for handling patient's attached documents.
 * @author 
 * @version 1.0
 */
@Path("Attachments")
public class AttachmentResource {
	
	final static Logger logger = Logger.getLogger(AttachmentResource.class);

	AttachmentDBDriver attachmentDBDriver=new AttachmentDBDriver();
	
	
	/**
	 * Add New Attachment Details
	 * @param atJson A Json Object that contains New Attachment Details
	 * @return  Is A String and If Data Inserted Successfully return is True else False
	 * @throws JSONException 
	 */
	@POST
	@Path("/addAttachment")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addAttachment(JSONObject atJson) throws JSONException {
		logger.info("add attachment");
		Attachments attachment=new Attachments();
		try{
			attachment.setAttachName(atJson.getString("attachname"));
			attachment.setAttachType(atJson.getString("filetype"));
		  
			attachment.setAttachLink(atJson.getString("filepath"));
			attachment.setAttachDescription(atJson.getString("Remarks"));
			attachment.setAttachComment(atJson.getString("comment"));
			attachment.setAttachActive(1);
			attachment.setAttachCreateDate(new Date());
 			attachment.setAttachLastUpdate(new Date());
			 
			
			int patientID=atJson.getInt("pid");
			int useriD=atJson.getInt("userid");
			
			attachmentDBDriver.saveAttachment(attachment,useriD, patientID);
			logger.info("successfully attachment added");
			JSONSerializer jsonSerializer = new JSONSerializer();
			
			return jsonSerializer.include("pid").exclude("*.class","patient.*").serialize(attachment);
			
		}catch (JSONException e) {
			e.printStackTrace();
			logger.info("attachment not added");

			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());		
			
			return jsonErrorObject.toString(); 

		}catch (RuntimeException e)
			{
				logger.error("error adding attachment: "+e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());				
				
				return jsonErrorObject.toString();
		
		}catch (Exception e) {
			logger.error("error adding attachment: "+ e.getMessage());
			return null;
		}	
		
	}
	
	
	/**Update Attachment Details
	 * @param atJson A Json Object that contains New Attachment Details
	 * @return Is A String and If Data Updated Successfully return is True else False
	 * @throws JSONException 
	 */
	@POST
	@Path("/updateAttachments")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateAttachment(JSONObject atJson) throws JSONException {
		logger.info("update attachment");
		Attachments attachment=new Attachments();
		try{
			  
			attachment.setAttachName(atJson.getString("attachname"));
			attachment.setAttachLink(atJson.getString("filepath"));
			attachment.setAttachType(atJson.getString("filetype"));
		
			attachment.setAttachDescription(atJson.getString("Remarks")); 
			attachment.setAttachActive(atJson.getInt("active"));
			attachment.setAttachLastUpdate(new Date()); 
			int patientID=atJson.getInt("pid");
			int useriD=atJson.getInt("userid");
			int attachid=atJson.getInt("attchid");
			attachmentDBDriver.updateAttachments(attachid,useriD,attachment, patientID);
			logger.info("successfully attachment updated");
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("attachname").serialize(attachment);			
		}catch (JSONException e) {
			logger.error("error updating attachment: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());		
			
			return jsonErrorObject.toString(); 
		}catch (RuntimeException e)
			{
				logger.error("error updating attachment: "+e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());				
				
				return jsonErrorObject.toString();
		
		}catch (Exception e) {
			logger.error("error updating attachment: "+e.getMessage());
			return null;
		}
	}
	
	

	/**
	 * Get Attachment Details By Attachment ID
	 * @param attchID Is an Integer Value
	 * @return A JSON String that contains all the Attachment Details
	 */
	@GET
	@Path("/getAttachmentByAttachID/{ATTCHID}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getAttachmentByAttachID(@PathParam("ATTCHID")int attchID) {
		logger.info("get attachment by attach id");

			List<Attachments> attachmentRecord = attachmentDBDriver.retriveAttachmentByAttachID(attchID);
			JSONSerializer serializer = new JSONSerializer();
			logger.info("successfully getting attachment");
			return  serializer.exclude("*.class","patient.*",
					"attachLastUpDateUser.specialPermissions","attachLastUpDateUser.userRoles","attachLastUpDateUser.employees.department","attachLastUpDateUser.employees.leaves",
					"attachCreateUser.specialPermissions", "attachCreateUser.userRoles","attachCreateUser.employees.department","attachCreateUser.employees.leaves",
					"attachedBy.specialPermissions","attachedBy.userRoles","attachedBy.employees.department","attachedBy.employees.leaves"					
					).include("patient.patientID").transform(new DateTransformer("yyyy-MM-dd"),"attachLastUpdate","attachCreateDate").serialize(attachmentRecord);

		
	}

	/**
	 * Get Attachment Details By Patient ID
	 * @param pID Is a Integer Value
	 * @returnA JSON String that contains all the Allergy Details
	 */
	@GET
	@Path("/getAttachmentByPID/{PID}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getAttachmentsByPatientID(@PathParam("PID")int pID) {
		logger.info("get attachments by patient id");

			List<Attachments> attachmentRecord = attachmentDBDriver.retriveAttachmentByPatientID(pID);
			JSONSerializer serializer = new JSONSerializer();
			logger.info("successfully getting attachment");
			return  serializer.include("patient.patientID").exclude("*.class","patient.*").transform(new DateTransformer("yyyy-MM-dd"),"attachLastUpdate","attachCreateDate").serialize(attachmentRecord);
		 
	}
	
	
}
