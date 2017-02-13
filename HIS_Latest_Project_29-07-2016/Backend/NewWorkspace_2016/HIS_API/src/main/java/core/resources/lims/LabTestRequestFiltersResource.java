package core.resources.lims;

import java.util.Date;
import java.util.List;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;






import org.apache.log4j.Logger;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;
import org.hibernate.jdbc.Expectations;

import core.ErrorConstants;
import core.classes.lims.LabTestRequest;
import core.classes.opd.OutPatient;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
import lib.driver.lims.driver_class.LabTestRequestFiltersDBDriver;


@Path("LabTestRequestFilters")
public class LabTestRequestFiltersResource {

	final static Logger log = Logger.getLogger(LabTestRequestFiltersResource.class);
	
	LabTestRequestFiltersDBDriver requestDBDriver= new LabTestRequestFiltersDBDriver();
	
	@GET
	@Path("/getAllPatients")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllPatients() throws JSONException
	{
		log.info("Entering the get all Patients method");
		try{
		List<OutPatient> testsList =  requestDBDriver.getPatientList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("patientID","patientFullName","patientNIC","patientPassport").exclude("*.class","patientCreateUser.*","patientLastUpdateUser.*","visits.*","allergies.*","attachments.*","exams.*","records.*","answerSets.*","labtestrequest.*",
			"patientTitle","patientPersonalUsedName","patientNIC","patientPersonalUsedName","patientHIN","patientPhoto","patientDateOfBirth","patientTelephone","patientGender","patientCivilStatus","patientPreferredLanguage","patientCitizenship","patientContactPName",
			"patientContactPNo","patientAddress","patientCreateDate","patientLastUpdate","patientRemarks","patientActive").serialize(testsList);
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in getting all patients, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while getting all patients, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}

	}

	@GET
	@Path("/getRequestsByPatientID/{patientID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllLabTestRequestByPID(@PathParam("patientID")int patientID) throws JSONException
	{
		log.info("Entering the get request by Patient ID method");
		try{
			List<LabTestRequest> testRequestsList =   requestDBDriver.getLabTestRequestsByPid(patientID);
			JSONSerializer serializer = new JSONSerializer();
			return  serializer.include("ftest_ID.test_ID","ftest_ID.test_IDName","ftest_ID.test_Name","fpatient_ID.patientID","fpatient_ID.patientFullName","fspecimen_ID.specimen_ID.*","flab_ID.lab_ID.*","flab_ID.lab_Name.*","ftest_RequestPerson.userID.*","ftest_RequestPerson.userName.*"
				,"fsample_CenterID.sampleCenter_ID.*","fsample_CenterID.sampleCenter_Name.*").exclude("*.class","fspecimen_ID.*","flab_ID.*","ftest_RequestPerson.*","fsample_CenterID.*","fpatient_ID.*","ftest_ID.*","ftest_RequestPerson.*").transform(new DateTransformer("yyyy-MM-dd"),"test_RequestDate","test_DueDate").serialize(testRequestsList);
	
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in getting all patients, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while getting requests by Patient ID, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}

	}
	
	@GET
	@Path("/getRequestsByLabLocationID/{locationID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllLabTestRequestByLabLocationID(@PathParam("locationID")int locationID) throws JSONException
	{
		log.info("Entering the get request by Lab location method");
		try
		{
			List<LabTestRequest> testRequestsList =   requestDBDriver.getLabTestRequestsByLabLocationid(locationID);
			JSONSerializer serializer = new JSONSerializer();
			return  serializer.include("ftest_ID.test_ID","ftest_ID.test_IDName","ftest_ID.test_Name","fpatient_ID.patientID","fpatient_ID.patientFullName","fspecimen_ID.specimen_ID.*","flab_ID.lab_ID.*","flab_ID.lab_Name.*","ftest_RequestPerson.userID.*","ftest_RequestPerson.userName.*"
				,"fsample_CenterID.sampleCenter_ID.*","fsample_CenterID.sampleCenter_Name.*").exclude("*.class","fspecimen_ID.*","flab_ID.*","ftest_RequestPerson.*","fsample_CenterID.*","fpatient_ID.*","ftest_ID.*","ftest_RequestPerson.*").transform(new DateTransformer("yyyy-MM-dd"),"test_RequestDate","test_DueDate").serialize(testRequestsList);
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in requests by lab location, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while getting requests by lab location, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}

	}
	
	@GET
	@Path("/getRequestsBySampleCenterLocationID/{locationID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllLabTestRequestBySampleCenterLocationID(@PathParam("locationID")int locationID) throws JSONException
	{
		log.info("Entering the get request by sample center location ID method");
		try{
			List<LabTestRequest> testRequestsList =   requestDBDriver.getLabTestRequestsBySampleCenterLocationid(locationID);
			JSONSerializer serializer = new JSONSerializer();
			return  serializer.include("ftest_ID.test_ID","ftest_ID.test_IDName","ftest_ID.test_Name","fpatient_ID.patientID","fpatient_ID.patientFullName","fspecimen_ID.specimen_ID.*","flab_ID.lab_ID.*","flab_ID.lab_Name.*","ftest_RequestPerson.userID.*","ftest_RequestPerson.userName.*"
				,"fsample_CenterID.sampleCenter_ID.*","fsample_CenterID.sampleCenter_Name.*").exclude("*.class","fspecimen_ID.*","flab_ID.*","ftest_RequestPerson.*","fsample_CenterID.*","fpatient_ID.*","ftest_ID.*","ftest_RequestPerson.*").transform(new DateTransformer("yyyy-MM-dd"),"test_RequestDate","test_DueDate").serialize(testRequestsList);
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in requests by Sample Center Location ID, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while getting requests by Sample Center Location ID, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}

	}
}
