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
import lib.driver.clinic.driver_class.clinic_visitDBDriver;
import lib.driver.opd.driver_class.AllergyDBDriver;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.classes.clinic.clinic_patient_attachment;
import core.classes.clinic.clinic_visit;
import core.classes.opd.Allergy;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
 

/**
* This class define all the generic REST Services necessary for handling patient's allergies
* @author 
* @version 1.0
*/
@Path("clinic_patient_attachment_5")
public class clinic_visitResource {

	clinic_visitDBDriver objclinic_visitDBDriver=new clinic_visitDBDriver();
	
	/** Add New Allergy For particular Visit
	 * @param ajson A Json Object that contains New Allergy Details
	 * @return If Data Inserted Successfully return is True else False
	 */
	@POST
	@Path("/addclinic_visit")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addclinic_visit(JSONObject ajson) {

		try {
			clinic_visit objclinic_visit =new clinic_visit();
 
			int patientID = ajson.getInt("pid");
			int userid = ajson.getInt("userid");
			
			objclinic_visit.setClinic_visit_type(ajson.get("clinic_visit_type").toString());				 
			objclinic_visitDBDriver.saveclinic_visit(objclinic_visit,userid, patientID);
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
	@Path("/updateclinic_visit")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateclinic_visit(JSONObject ajson) {

		try {
			  
			clinic_visit objclinic_visit=new clinic_visit();
			int userid = ajson.getInt("userid");

			objclinic_visit.setClinic_visit_type(ajson.get("clinic_visit_type").toString());
			objclinic_visitDBDriver.updateclinic_visit(objclinic_visit,userid);
			
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
	@Path("/retrieveclinic_visitbypatient/{PID}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getretrieveclinic_visitbypatient(@PathParam("PID")int pID) {

		List<clinic_visit> clinic_visitList=objclinic_visitDBDriver.retrieveclinic_visitbypatient(pID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.serialize(clinic_visitList);
	}
	
	
	/**Get Allergy Details By Allergy ID
	 * @param allergyID Is A Integer Value
	 * @return A JSON String that contains all the Allergy Details
	 */
	@GET
	@Path("/getretrieveclinic_visitclinic_visit_id/{clinic_visitid}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getretrieveclinic_visitclinic_visit_id(@PathParam("clinic_visitid")int aID) {

		List<clinic_visit> clinic_visitRecord=objclinic_visitDBDriver. retrieveclinic_visitclinic_visit_id(aID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.serialize(clinic_visitRecord);
	
	}
	
	 
}
