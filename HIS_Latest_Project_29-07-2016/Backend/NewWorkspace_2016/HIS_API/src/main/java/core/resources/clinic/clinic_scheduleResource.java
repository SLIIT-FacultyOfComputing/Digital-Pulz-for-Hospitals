package core.resources.clinic;

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

import lib.driver.clinic.driver_class.clinic_scheduleDBDriver;
import lib.driver.clinic.driver_class.clinic_scheduleDBDriver;
import lib.driver.opd.driver_class.AllergyDBDriver;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.classes.clinic.clinic_patient_attachment;
import core.classes.clinic.clinic_schedule;
import core.classes.opd.Allergy;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
 

/**
* This class define all the generic REST Services necessary for handling patient's allergies
* @author 
* @version 1.0
*/
@Path("clinic_patient_attachment_4")
public class clinic_scheduleResource {

	clinic_scheduleDBDriver objclinic_scheduleDBDriver=new clinic_scheduleDBDriver();
	
	/** Add New Allergy For particular Visit
	 * @param ajson A Json Object that contains New Allergy Details
	 * @return If Data Inserted Successfully return is True else False
	 */
	@POST
	@Path("/addclinic_patient_attachment")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addclinic_schedule(JSONObject ajson) {

		try {
			clinic_schedule objclinic_schedule =new clinic_schedule();
 
			int patientID = ajson.getInt("pid");
			int userid = ajson.getInt("userid");
			
			objclinic_schedule.setMobile_no(ajson.getInt("attachment_type"));					 
			objclinic_scheduleDBDriver.saveclinic_schedule(objclinic_schedule,userid, patientID);
			return "True";
		}		
		catch (JSONException e) {
			e.printStackTrace();
			return "False";
		}		
		catch (Exception e) {
			return "False";
		}
	}
	
	
	
	/**
	 * Update Allergy details 
	 * @param ajson A Json Object that contains New Allergy Details
	 * @return Is A String and If Data Updated Successfully return is True else False
	 *
	 */
	@PUT
	@Path("/updateclinic_patient_attachment")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateclinic_schedule(JSONObject ajson) {

		try {
			  
			clinic_schedule objclinic_schedule=new clinic_schedule();
			int userid = ajson.getInt("userid");
			
			objclinic_schedule.setMobile_no(ajson.getInt("attachment_type"));	
	
			objclinic_scheduleDBDriver.updateclinic_schedule(objclinic_schedule,userid);
			
			return "True";
		}catch (JSONException e) {
			e.printStackTrace();
			return "False";
		} 
		catch (Exception e) {		 
			return "False" ;
		}

	}
	
	
	/**Get Allergy Details By Patient ID
	 * @param patientID Is A Integer Value	
	 * @return A JSON String that contains all the Allergy Details
	 */
	@GET
	@Path("/getclinic_patient_attachmentbyattachment_ID/{PID}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getclinic_scheduleschedule_id(@PathParam("PID")int pID) {

		List<clinic_schedule> clinic_scheduleList=objclinic_scheduleDBDriver.retrieveclinic_scheduleschedule_id(pID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.serialize(clinic_scheduleList);
	}
	
	
	/**Get Allergy Details By Allergy ID
	 * @param allergyID Is A Integer Value
	 * @return A JSON String that contains all the Allergy Details
	 */
	@GET
	@Path("/getclinic_patient_attachmentbyclinic_visitid/{clinic_visitid}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getclinic_scheduleclinic_visit_id(@PathParam("clinic_visitid")int aID) {

		List<clinic_schedule> clinic_scheduleRecord=objclinic_scheduleDBDriver.retrieveclinic_scheduleclinic_visit_id(aID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.serialize(clinic_scheduleRecord);
	
	}
	
	 
}
