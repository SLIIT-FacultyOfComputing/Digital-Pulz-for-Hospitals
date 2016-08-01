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

import lib.driver.clinic.driver_class.clinic_xrayDBDriver;
import lib.driver.opd.driver_class.AllergyDBDriver;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.classes.clinic.clinic_patient_attachment;
import core.classes.clinic.clinic_xray;
import core.classes.opd.Allergy;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
 

/**
* This class define all the generic REST Services necessary for handling patient's allergies
* @author 
* @version 1.0
*/
@Path("clinic_patient_attachment_7")
public class clinic_xrayResource {

	clinic_xrayDBDriver clinic_xrayDBDriver=new clinic_xrayDBDriver();
	
	/** Add New Allergy For particular Visit
	 * @param ajson A Json Object that contains New Allergy Details
	 * @return If Data Inserted Successfully return is True else False
	 */
	@POST
	@Path("/addclinic_xray")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addclinic_xray(JSONObject ajson) {

		try {
			clinic_xray objclinic_xray =new clinic_xray();
 
			int patientID = ajson.getInt("pid");
			int userid = ajson.getInt("userid");
			
			objclinic_xray.setClinic_patient_name(ajson.get("clinic_patient_name").toString());
			objclinic_xray.setClinic_problem(ajson.get("description").toString());	
			objclinic_xray.setClinic_remarks(ajson.get("clinic_remarks").toString());	
			//objclinic_xray.setclinic_image(ajson.get("clinic_image"));
			clinic_xrayDBDriver.saveclinic_xray(objclinic_xray,userid, patientID);
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
	@Path("/updateclinic_xray")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateclinic_xray(JSONObject ajson) {

		try {
			  
			clinic_xray objclinic_xray=new clinic_xray();
			int patientID = ajson.getInt("pid");
			int userid = ajson.getInt("userid");
			
			objclinic_xray.setClinic_patient_name(ajson.get("clinic_patient_name").toString());
			objclinic_xray.setClinic_problem(ajson.get("description").toString());	
			objclinic_xray.setClinic_remarks(ajson.get("clinic_remarks").toString());	
			//objclinic_xray.setclinic_image(ajson.get("clinic_image"));;
	
			clinic_xrayDBDriver.updateclinic_xray(objclinic_xray,userid);
			
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
	@Path("/getclinic_xrayxray_id/{PID}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getclinic_xrayxray_id(@PathParam("PID")int pID) {

		List<clinic_xray> clinic_xrayList=clinic_xrayDBDriver.retrieveclinic_xraybyxray_id(pID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.serialize(clinic_xrayList);
	}
	
	
	/**Get Allergy Details By Allergy ID
	 * @param allergyID Is A Integer Value
	 * @return A JSON String that contains all the Allergy Details
	 */
	@GET
	@Path("/getclinic_xraybyclinic_visit_id/{clinic_visitid}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getclinic_xraybyclinic_visit_id(@PathParam("clinic_visitid")int aID) {

		List<clinic_xray> clinic_xrayRecord=clinic_xrayDBDriver.retrieveclinic_xraybyclinic_visit_id(aID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.serialize(clinic_xrayRecord);
	
	}
	
	 
}
