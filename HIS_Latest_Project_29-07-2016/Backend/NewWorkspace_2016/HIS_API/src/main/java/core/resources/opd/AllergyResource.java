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

import org.apache.log4j.Logger;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.ErrorConstants;
import core.classes.opd.Allergy;
import core.resources.lims.ReportResource;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
 

/**
* This class define all the generic REST Services necessary for handling patient's allergies
* @author 
* @version 1.0
*/
@Path("Allergy")
public class AllergyResource {

	final static Logger log = Logger.getLogger(AllergyResource.class);
	AllergyDBDriver allergyDBDriver=new AllergyDBDriver();
	
	/** Add New Allergy For particular Visit
	 * @param ajson A Json Object that contains New Allergy Details
	 * @return If Data Inserted Successfully return is True else False
	 * @throws JSONException 
	 */
	@POST
	@Path("/addAllergy")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addAllergy(JSONObject ajson) throws JSONException {

		log.info("Entering the add Allergy method");
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
			
			log.info("Adding Allergy Successful, patientID = "+patientID);
			
			return patientID + "";

		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in adding new allergy, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (JSONException e) {

			log.error("JSONException while adding new allergy, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString(); 
		}
		catch(Exception e)
		{
			log.error("Error while adding new allergy, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			
			return jsonErrorObject.toString(); 
			
		}
		
		
	}
	
	
	
	/**
	 * Update Allergy details 
	 * @param ajson A Json Object that contains New Allergy Details
	 * @return Is A String and If Data Updated Successfully return is True else False
	 * @throws JSONException 
	 *
	 */
	@PUT
	@Path("/updateAllergy")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateAllergy(JSONObject ajson) throws JSONException {

		log.info("Entering the update Allergy method");
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
			
			log.info("Updating Allergy Successful, allergyID = "+allergy.getAllergyID());
			
			return allergy.getAllergyID() + "";
			
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in updating allergy, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (JSONException e) {

			log.error("JSONException while updating allergy, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString(); 
		}
		catch(Exception e)
		{
			log.error("Error while updating allergy, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			
			return jsonErrorObject.toString(); 
			
		}

	}
	
	
	/**Get Allergy Details By Patient ID
	 * @param patientID Is A Integer Value	
	 * @return A JSON String that contains all the Allergy Details
	 * @throws JSONException 
	 */
	@GET
	@Path("/getAllergiesByPatient/{PID}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getAllergiesByPatientID(@PathParam("PID")int pID) throws JSONException {
		
		log.info("Entering the get Allergies by Patient ID method");
		try{
			List<Allergy> allergyList=allergyDBDriver.retrieveAllergiesByPatientID(pID);
			JSONSerializer serializer = new JSONSerializer();
			return 	serializer.include("patient.patientID").exclude("*.class","patient.*","adminUserroles.*").transform(new DateTransformer("yyyy-MM-dd"),"allergyLastUpdate","allergyCreateDate").serialize(allergyList);
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in getting Allergies by Patient ID, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch(Exception e)
		{
			log.error("Error while getting Allergies by Patient ID, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			
			return jsonErrorObject.toString(); 
			
		}
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
	 * @throws JSONException 
	 */
	@GET
	@Path("/getAllergy/{allergyID}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getAllergy(@PathParam("allergyID")int aID) throws JSONException {

		log.info("Entering the get Allergy by allergy ID method");
		try{
			List<Allergy> allergyRecord=allergyDBDriver.retrieveAllergy(aID);
			JSONSerializer serializer = new JSONSerializer();
			return  serializer.exclude("*.class","patient.*",
				"allergyLastUpDateUser.specialPermissions","allergyLastUpDateUser.userRoles","allergyLastUpDateUser.employees.department","allergyLastUpDateUser.employees.leaves",
				"allergyCreateUser.specialPermissions", "allergyCreateUser.userRoles","allergyCreateUser.employees.department","allergyCreateUser.employees.leaves"
				).include("patient.patientID").transform(new DateTransformer("yyyy-MM-dd"),"allergyLastUpdate","allergyCreateDate").serialize(allergyRecord);
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in getting Allergy by allergy ID, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch(Exception e)
		{
			log.error("Error while getting Allergy by allergy ID, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			
			return jsonErrorObject.toString(); 
			
		}

	}
	
	 
}
