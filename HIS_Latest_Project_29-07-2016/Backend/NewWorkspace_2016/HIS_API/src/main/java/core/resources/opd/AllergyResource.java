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
import lib.driver.opd.driver_class.AllergyDBDriver;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;
import core.classes.opd.Allergy;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
 

/**
* This class define all the generic REST Services necessary for handling patient's allergies
* @author 
* @version 1.0
*/
@Path("Allergy")
public class AllergyResource {

	AllergyDBDriver allergyDBDriver=new AllergyDBDriver();
	
	/** Add New Allergy For particular Visit
	 * @param ajson A Json Object that contains New Allergy Details
	 * @return If Data Inserted Successfully return is True else False
	 */
	@POST
	@Path("/addAllergy")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addAllergy(JSONObject ajson) {

		try {
			Allergy allergy =new Allergy();
 
			int patientID = ajson.getInt("pid");
			int userid = ajson.getInt("userid");
			
			allergy.setAllergyName(ajson.get("name").toString());
			allergy.setAllergyStatus(ajson.get("status").toString());
			allergy.setAllergyRemarks(ajson.get("remarks").toString());
			allergy.setAllergyCreateDate(new Date());
		 
			allergy.setAllergyActive(1);
			allergy.setAllergyLastUpdate(new Date());
			 
			allergyDBDriver.saveAllergy(allergy,userid, patientID);
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
	@Path("/updateAllergy")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateAllergy(JSONObject ajson) {

		try {
			  
			Allergy allergy =new Allergy();
			int userid = ajson.getInt("userid");
			
			allergy.setAllergyID(ajson.getInt("allergyid"));  
			allergy.setAllergyName(ajson.get("name").toString());
			allergy.setAllergyStatus(ajson.get("status").toString());
			allergy.setAllergyRemarks(ajson.get("remarks").toString());
			allergy.setAllergyLastUpdate(new Date()); 
			allergy.setAllergyActive(ajson.getInt("active"));
			allergyDBDriver.updateAllergy(allergy,userid);
			
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
	@Path("/getAllergiesByPatient/{PID}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getAllergiesByPatientID(@PathParam("PID")int pID) {
		
		List<Allergy> allergyList=allergyDBDriver.retrieveAllergiesByPatientID(pID);
		JSONSerializer serializer = new JSONSerializer();
		return 	serializer.include("patient.patientID").exclude("*.class","patient.*","adminUserroles.*").transform(new DateTransformer("yyyy-MM-dd"),"allergyLastUpdate","allergyCreateDate").serialize(allergyList);
		
	/*	
		try{		
		
		}
		catch(Exception ex){
			
		}*/
		
		/*for (Allergy allergy : allergyList) {
			System.out.println(allergy.getAllergyName());
		}*/
		
		//return  //(allergyList.get(0).getPatient().getPatientFullName());
			
		}
	
	
	/**Get Allergy Details By Allergy ID
	 * @param allergyID Is A Integer Value
	 * @return A JSON String that contains all the Allergy Details
	 */
	@GET
	@Path("/getAllergy/{allergyID}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getAllergy(@PathParam("allergyID")int aID) {

		List<Allergy> allergyRecord=allergyDBDriver.retrieveAllergy(aID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.exclude("*.class","patient.*",
				"allergyLastUpDateUser.specialPermissions","allergyLastUpDateUser.userRoles","allergyLastUpDateUser.employees.department","allergyLastUpDateUser.employees.leaves",
				"allergyCreateUser.specialPermissions", "allergyCreateUser.userRoles","allergyCreateUser.employees.department","allergyCreateUser.employees.leaves"
				).include("patient.patientID").transform(new DateTransformer("yyyy-MM-dd"),"allergyLastUpdate","allergyCreateDate").serialize(allergyRecord);
	
	}
	
	 
}
