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

import lib.driver.clinic.driver_class.clinic_patient_attachmentDBDriver;
import lib.driver.clinic.driver_class.clinic_patient_queueDBDriver;
import lib.driver.opd.driver_class.AllergyDBDriver;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.classes.clinic.clinic_patient_attachment;
import core.classes.clinic.clinic_patient_queue;
import core.classes.opd.Allergy;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
 

/**
* This class define all the generic REST Services necessary for handling patient's allergies
* @author 
* @version 1.0
*/
@Path("clinic_patient_attachment_2")
public class clinic_patient_queueResource {

	clinic_patient_queueDBDriver objclinic_patient_queueDBDriver=new clinic_patient_queueDBDriver();
	
	/** Add New Allergy For particular Visit
	 * @param ajson A Json Object that contains New Allergy Details
	 * @return If Data Inserted Successfully return is True else False
	 */
	@POST
	@Path("/addclinic_patient_queue")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addclinic_patient_queue(JSONObject ajson) {

		try {
			clinic_patient_queue objclinic_patient_queue =new clinic_patient_queue();
 
			int patientID = ajson.getInt("pid");
			int userid = ajson.getInt("userid");
			
			objclinic_patient_queue.setClinic_visit_type(ajson.get("clinic_visit_type").toString());
			objclinic_patient_queue.setClinic_queue_status(ajson.get("clinic_queue_status").toString());
			//objclinic_patient_queue.setClinic_queue_assign_date(new Date());
			 						 
			objclinic_patient_queueDBDriver.saveclinic_patient_queue(objclinic_patient_queue,userid, patientID);
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
	@Path("/updateclinic_patient_queue")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateclinic_patient_queue(JSONObject ajson) {

		try {
			  
			clinic_patient_queue objclinic_patient_queue=new clinic_patient_queue();
			int userid = ajson.getInt("userid");
			
			objclinic_patient_queue.setClinic_visit_type(ajson.get("clinic_visit_type").toString());
			objclinic_patient_queue.setClinic_queue_status(ajson.get("clinic_queue_status").toString());
			//objclinic_patient_queue.setClinic_queue_assign_date(new Date());
			
			objclinic_patient_queueDBDriver.updateclinic_patient_queue(objclinic_patient_queue,userid);
			
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
	@Path("/getclinic_patient_queueclinic_queue_token_no/{PID}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getclinic_patient_queueclinic_queue_token_no(@PathParam("PID")int pID) {

		List<clinic_patient_queue> clinic_patient_queueList=objclinic_patient_queueDBDriver.retrieveclinic_patient_queueclinic_queue_token_no(pID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.serialize(clinic_patient_queueList);
	}
	
	
	/**Get Allergy Details By Allergy ID
	 * @param allergyID Is A Integer Value
	 * @return A JSON String that contains all the Allergy Details
	 */
	@GET
	@Path("/getclinic_patient_queue")
	@Produces (MediaType.APPLICATION_JSON)
	public String getclinic_patient_queue(@PathParam("clinic_visitid")int aID) {

		List<clinic_patient_queue> clinic_patient_queueRecord=objclinic_patient_queueDBDriver.retrieveclinic_patient_queue();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("patient.patientID").serialize(clinic_patient_queueRecord);
	
	}
	
	 
}
