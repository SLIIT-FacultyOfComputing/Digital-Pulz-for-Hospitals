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
import lib.driver.clinic.driver_class.clinic_patient_historyDBDriver;
import lib.driver.opd.driver_class.AllergyDBDriver;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.classes.clinic.clinic_patient_attachment;
import core.classes.clinic.clinic_patient_history;
import core.classes.opd.Allergy;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
 

/**
* This class define all the generic REST Services necessary for handling patient's allergies
* @author 
* @version 1.0
*/
@Path("clinic_patient_history")
public class clinic_patient_historyResource {

	clinic_patient_historyDBDriver objclinic_patient_historyDBDriver=new clinic_patient_historyDBDriver();
	
	/** Add New Allergy For particular Visit
	 * @param ajson A Json Object that contains New Allergy Details
	 * @return If Data Inserted Successfully return is True else False
	 */
	@POST
	@Path("/addclinic_patient_attachment")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addclinic_patient_attachment(JSONObject ajson) {

		try {
			clinic_patient_history objclinic_patient_history =new clinic_patient_history();
 
			int patientID = ajson.getInt("pid");
			int userid = ajson.getInt("userid");
									 
			objclinic_patient_historyDBDriver.saveclinic_patient_history(objclinic_patient_history,userid, patientID);
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
	@Path("/updateclinic_patient_history")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateclinic_patient_history(JSONObject ajson) {

		try {
			  
			clinic_patient_history objclinic_patient_history=new clinic_patient_history();
			int userid = ajson.getInt("userid");
			
			objclinic_patient_historyDBDriver.updateclinic_patient_history(objclinic_patient_history,userid);
			
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
	@Path("/getclinic_patient_historyBytreatment/{PID}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getclinic_patient_historyBytreatment(@PathParam("PID")int pID) {

		List<clinic_patient_history> clinic_patient_historyList=objclinic_patient_historyDBDriver.retrieveclinic_patient_historysBytreatment(pID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.serialize(clinic_patient_historyList);
	}
	
	
	/**Get Allergy Details By Allergy ID
	 * @param allergyID Is A Integer Value
	 * @return A JSON String that contains all the Allergy Details
	 */
	@GET
	@Path("/getclinic_patient_attachmentbyclinic_visitid/{clinic_visitid}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getclinic_patient_attachmentbyclinic_visitid(@PathParam("clinic_visitid")int aID) {

		List<clinic_patient_history> clinic_patient_historyRecord=objclinic_patient_historyDBDriver.retrieveclinic_patient_historybyclinic_history_ID(aID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.serialize(clinic_patient_historyRecord);
	
	}
	
	 
}
