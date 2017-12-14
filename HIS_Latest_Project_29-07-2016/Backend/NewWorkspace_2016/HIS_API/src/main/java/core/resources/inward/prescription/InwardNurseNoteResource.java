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











import com.google.gson.JsonSerializer;

import core.ErrorConstants;
import core.classes.inward.WardAdmission.WardAdmission;
import core.classes.inward.charts.DiabeticChart;
import core.classes.inward.prescription.InwardNurseNote;
import core.classes.pcu.PcuNursenote;
import flexjson.JSONException;
import flexjson.JSONSerializer;
import lib.driver.inward.driver_class.prescription.InwardNurseNoteDBDrive;


@Path("InwardNurseNote")
public class InwardNurseNoteResource {
	final static Logger log = Logger.getLogger(InwardNurseNoteResource .class);
	InwardNurseNoteDBDrive requestdbDriver = new InwardNurseNoteDBDrive();
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd");
	

	@POST
	@Path("/addNewInwardNurseNote")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addNewTermPrescrption(JSONObject wJson) throws org.codehaus.jettison.json.JSONException
	{	log.info("Entering the add NewInwardNurseNote method");		
			//note,create user,datetme	
		try {
			InwardNurseNote Nursenote  =  new InwardNurseNote();
			
					
			Nursenote.setP_note(wJson.getString("note"));			
			
			Nursenote.setDatetime(new Date());
			int create_user=wJson.getInt("create_user");			
			String bht_no=wJson.getString("bht_no");	
			
			requestdbDriver.addNewInwardNurseNote(Nursenote,create_user,bht_no);
			log.info("Insert New NurseNote Successful, bhtNo = "+bht_no);
			 JSONSerializer serializor=new JSONSerializer();
			 String result= serializor.exclude("*.class").serialize(Nursenote);
			return result;
		}  catch (JSONException e) {
			log.error("JSON exception in Add NewNurseNote, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			
			
			return jsonErrorObject.toString(); 
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in Add NewNurseNote, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while adding NewNurseNote, message: " + e.getMessage());
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
		log.info("Entering the update TermPrescriptionNurseNote method");
		String result="";
		boolean r=false;
		
		try{
			int term_id=wJson.getInt("term_id");
			Date end_date=dateformat.parse(wJson.getString("end_date"));
			r=requestdbDriver.UpdateTermPrescrption(term_id,end_date);
			log.info("Update PrescriptionTerm Successful, termID = "+term_id);
			result=String.valueOf(r);
		
			return result;
			
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
	@Path("/getInwardNurseNoteByBHTNo/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getDiabeticChartByBHTNo(@PathParam("bhtNo")  String bhtNo) throws org.codehaus.jettison.json.JSONException
	{
		try{
		log.info("Entering the get Inward NurseNote by BhtNo method");
				 String result="";
		 List<InwardNurseNote> list =requestdbDriver.getInwardNurseNoteByBHTNo(bhtNo);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(list);
		 return result;}
		 catch(RuntimeException e)
			{
				log.error("Runtime Exception in getting Inward NurseNote by BHT_NO, message:" + e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				
				jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
				jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
				
				
				return jsonErrorObject.toString(); 
			}
			catch (Exception e) {
				 System.out.println(e.getMessage());
				 log.error("Error while getting Inward NurseNote by BHT_NO, message: " + e.getMessage());
				 JSONObject jsonErrorObject = new JSONObject();
					
				jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
				jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
					
				return jsonErrorObject.toString();
			}
	}
	

	@GET
	@Path("/getNurseNote")
	@Produces(MediaType.APPLICATION_JSON)
	public String getNurseNote() throws org.codehaus.jettison.json.JSONException
	{try{
		
		log.info("Entering the get all NursrNote method");
		List<InwardNurseNote> notelist =requestdbDriver.getNurseNote();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.serialize(notelist);}
		 catch(RuntimeException e)
			{
				log.error("Runtime Exception in getting NursrNote, message:" + e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				
				jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
				jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
				
				
				return jsonErrorObject.toString(); 
			}
			catch (Exception e) {
				 System.out.println(e.getMessage());
				 log.error("Error while getting NursrNote, message: " + e.getMessage());
				 JSONObject jsonErrorObject = new JSONObject();
					
				jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
				jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
					
				return jsonErrorObject.toString();
			}
	}
	
	
}
