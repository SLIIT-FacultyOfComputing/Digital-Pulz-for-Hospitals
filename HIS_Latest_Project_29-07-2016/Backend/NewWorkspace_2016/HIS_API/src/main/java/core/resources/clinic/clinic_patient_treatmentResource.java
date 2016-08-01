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
import lib.driver.clinic.driver_class.clinic_patient_treatmentDBDriver;
import lib.driver.opd.driver_class.AllergyDBDriver;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.classes.clinic.clinic_patient_attachment;
import core.classes.clinic.clinic_patient_treatment;
import core.classes.opd.Allergy;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
 

/**
* This class define all the generic REST Services necessary for handling patient's allergies
* @author 
* @version 1.0
*/
@Path("clinic_patient_attachment_3")
public class clinic_patient_treatmentResource {

	clinic_patient_treatmentDBDriver objclinic_patient_treatmentDBDriver=new clinic_patient_treatmentDBDriver();
	
	/** Add New Allergy For particular Visit
	 * @param ajson A Json Object that contains New Allergy Details
	 * @return If Data Inserted Successfully return is True else False
	 */
	@POST
	@Path("/addclinic_patient_attachment")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addclinic_patient_treatment(JSONObject ajson) {

		try {
			clinic_patient_treatment objclinic_patient_treatment =new clinic_patient_treatment();
 
			int patientID = ajson.getInt("pid");
			int userid = ajson.getInt("userid");
			
			objclinic_patient_treatment.setClinic_doc(ajson.get("clinic_doc").toString());
			objclinic_patient_treatment.setClinic_remarks(ajson.get("clinic_remarks").toString());
			objclinic_patient_treatment.setClinic_diagnosis(ajson.get("clinic_diagnosis").toString());						 
			objclinic_patient_treatmentDBDriver.saveclinic_patient_treatment(objclinic_patient_treatment,userid, patientID);
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
	public String updateclinic_patient_treatment(JSONObject ajson) {

		try {
			  
			clinic_patient_treatment objclinic_patient_treatment=new clinic_patient_treatment();
			int patientID = ajson.getInt("pid");
			int userid = ajson.getInt("userid");
			
			objclinic_patient_treatment.setClinic_doc(ajson.get("clinic_doc").toString());
			objclinic_patient_treatment.setClinic_remarks(ajson.get("clinic_remarks").toString());
			objclinic_patient_treatment.setClinic_diagnosis(ajson.get("clinic_diagnosis").toString());						 
			
			objclinic_patient_treatmentDBDriver.updateclinic_patient_treatmentt(objclinic_patient_treatment,userid,patientID);
			
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
	@Path("/getclinic_patient_treatmenttreatment_id/{PID}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getclinic_patient_treatmenttreatment_id(@PathParam("PID")int pID) {

		List<clinic_patient_treatment> clinic_patient_treatmentList=objclinic_patient_treatmentDBDriver.retrieveclinic_patient_treatmenttreatment_id(pID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.serialize(clinic_patient_treatmentList);
	}
	
	
	/**Get Allergy Details By Allergy ID
	 * @param allergyID Is A Integer Value
	 * @return A JSON String that contains all the Allergy Details
	 */
	@GET
	@Path("/clinic_patient_treatmentbyclinic_visit_id/{clinic_visitid}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getclinic_patient_treatmentbyclinic_visit_id(@PathParam("clinic_visitid")int aID) {

		List<clinic_patient_treatment> clinic_patient_treatmentRecord=objclinic_patient_treatmentDBDriver.retrieveclinic_patient_treatmentbyclinic_visit_id(aID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("patient.patientID").serialize(clinic_patient_treatmentRecord);
	
	}
	
	 
}
