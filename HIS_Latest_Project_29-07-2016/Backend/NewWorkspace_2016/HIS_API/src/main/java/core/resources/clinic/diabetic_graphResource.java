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
import lib.driver.clinic.driver_class.diabetic_graphDBDriver;
import lib.driver.opd.driver_class.AllergyDBDriver;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.classes.clinic.clinic_patient_attachment;
import core.classes.clinic.diabetic_graph;
import core.classes.opd.Allergy;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
 

/**
* This class define all the generic REST Services necessary for handling patient's allergies
* @author 
* @version 1.0
*/
@Path("clinic_patient_attachment_6")
public class diabetic_graphResource {

	diabetic_graphDBDriver diabetic_graphDBDriver=new diabetic_graphDBDriver();
	
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
			diabetic_graph objdiabetic_graph =new diabetic_graph();
 
			int patientID = ajson.getInt("pid");
			int userid = ajson.getInt("userid");
			objdiabetic_graph.setDate(new Date());
			objdiabetic_graph.setBlood_glucose_level(ajson.getInt("blood_glucose_level"));					 
			diabetic_graphDBDriver.savediabetic_graph(objdiabetic_graph,userid, patientID);
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
	@Path("/updatediabetic_graph")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updatediabetic_graph(JSONObject ajson) {

		try {
			  
			diabetic_graph objdiabetic_graph=new diabetic_graph();
			int userid = ajson.getInt("userid");
			
			objdiabetic_graph.setBlood_glucose_level(ajson.getInt("blood_glucose_level"));	
			objdiabetic_graph.setDate(new Date());	
			diabetic_graphDBDriver.updatediabetic_graph(objdiabetic_graph,userid);
			
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
	@Path("/getdiabetic_graphgraph_id/{PID}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getdiabetic_graphgraph_id(@PathParam("PID")int pID) {

		List<diabetic_graph> diabetic_graphList=diabetic_graphDBDriver.retrievediabetic_graphgraph_id(pID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.serialize(diabetic_graphList);
	}
	
	
	/**Get Allergy Details By Allergy ID
	 * @param allergyID Is A Integer Value
	 * @return A JSON String that contains all the Allergy Details
	 */
	@GET
	@Path("/getclinic_patient_attachmentbyclinic_visitid/{clinic_visitid}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getdiabetic_graphbyclinic_visit_id(@PathParam("clinic_visitid")int aID) {

		List<diabetic_graph> diabetic_graphRecord=diabetic_graphDBDriver.retrievediabetic_graphbyclinic_visit_id(aID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.serialize(diabetic_graphRecord);
	
	}
	
	 
}
