package core.resources.lims;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;
import org.apache.log4j.Logger;

import core.ErrorConstants;
import core.classes.lims.Category;
import core.classes.lims.InwardLabTestRequest;
import core.classes.lims.LabTestRequest;
import core.classes.lims.MainResults;
import core.classes.lims.PcuLabTestRequest;
import core.classes.lims.Reports;
import core.classes.lims.SubCategory;
import core.classes.opd.OutPatient;
import core.classes.opd.Patient;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.LabTestRequestDBDriver;
import lib.driver.lims.driver_class.PcuLabTestRequestDBDriver;
import lib.driver.lims.driver_class.SubCategoryDBDriver;

@Path("PcuLabTestRequest")
public class PcuLabTestRequestResource {



	PcuLabTestRequestDBDriver requestDBDriver = new PcuLabTestRequestDBDriver();
	final static Logger logger=Logger.getLogger(PcuLabTestRequestResource.class);
	
	
	@POST
	@Path("/addPcuLabTestRequest")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addPcuLabTestRequest(JSONObject pJson) throws JSONException
	{
		

		try {
			
			PcuLabTestRequest request = new PcuLabTestRequest();
					
			int testID = pJson.getInt("ftest_ID");
			int labID = pJson.getInt("flab_ID");
			int admissionID = pJson.getInt("admintionID");
			int userid = pJson.getInt("ftest_RequestPerson");
			int patientID = pJson.getInt("fpatient_ID");
			
			request.setComment(pJson.getString("comment").toString());
			request.setPriority(pJson.getString("priority").toString());
			request.setStatus(pJson.getString("status").toString());
			request.setTest_RequestDate(new Date());
			request.setTest_DueDate(new SimpleDateFormat("yyyy-MM-dd")
			.parse(pJson.getString("due_date")));
			
			requestDBDriver.addNewLabTestRequest(request, testID, admissionID, labID,patientID, userid);
			logger.info("New Lab Request Added: "+request);
			
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("pcu_lab_test_request_id").serialize(request);
			
		} catch (Exception e) {
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			
			return jsonErrorObject.toString(); 
			
			 /*System.out.println(e.getMessage());
			 logger.error("Error in adding new PCU Lab request"+e.getMessage());
			return e.getMessage();*/ 
		}

	}
	
	@GET
	@Path("/getAllPcuLabTestRequests")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllTestRequests()
	{
		
		List<PcuLabTestRequest> testRequestsList =   requestDBDriver.getTestRequestsList();
		
		logger.info("PUC Lab Test Requests "+testRequestsList);
		
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("admintionID.admitionId","ftest_ID.test_ID","ftest_ID.test_IDName","ftest_ID.test_Name","admintionID.patientId.patientID","admintionID.patientId.patientFullName","fspecimen_ID.specimen_ID.*","flab_ID.lab_ID.*","flab_ID.lab_Name.*","ftest_RequestPerson.userID.*","ftest_RequestPerson.userName.*"
				,"fsample_CenterID.sampleCenter_ID.*","fsample_CenterID.sampleCenter_Name.*").exclude("*.class","fspecimen_ID.*","flab_ID.*","ftest_RequestPerson.*","fsample_CenterID.*","admintionID.*","ftest_ID.*","ftest_RequestPerson.*").transform(new DateTransformer("yyyy-MM-dd"),"test_RequestDate","test_DueDate").serialize(testRequestsList);
	}
	
	@GET
	@Path("/getPcuRequestById/{request_id}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getrquestsById(@PathParam("request_id")int RequestId)
	{
		PcuLabTestRequest testRequestsList =  requestDBDriver.getTestRequestByID(RequestId);
		
		logger.info("PUC Lab Test Requests "+testRequestsList);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("admintionID.admitionId","ftest_ID.test_ID","ftest_ID.test_IDName","ftest_ID.test_Name","admintionID.patientId.patientID","admintionID.patientId.patientFullName","fspecimen_ID.specimen_ID.*","flab_ID.lab_ID.*","flab_ID.lab_Name.*","ftest_RequestPerson.userID.*","ftest_RequestPerson.userName.*"
				,"fsample_CenterID.sampleCenter_ID.*","fsample_CenterID.sampleCenter_Name.*").exclude("*.class","fspecimen_ID.*","flab_ID.*","ftest_RequestPerson.*","fsample_CenterID.*","admintionID.*","ftest_ID.*","ftest_RequestPerson.*").transform(new DateTransformer("yyyy-MM-dd"),"test_RequestDate","test_DueDate").serialize(testRequestsList);
	}
	
	@GET
	@Path("/getPcuRequestByPatientID/{patientID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllrquestsByPid(@PathParam("patientID")int patientID)
	{
		List<PcuLabTestRequest> testRequestsList =  requestDBDriver.getLabTestRequestsByPid(patientID);
		logger.info("PUC Lab Test Requests by Patient Id "+testRequestsList);
		
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("admintionID.admitionId","ftest_ID.test_ID","ftest_ID.test_IDName","ftest_ID.test_Name","admintionID.patientId.patientID","admintionID.patientId.patientFullName","fspecimen_ID.specimen_ID.*","flab_ID.lab_ID.*","flab_ID.lab_Name.*","ftest_RequestPerson.userID.*","ftest_RequestPerson.userName.*"
				,"fsample_CenterID.sampleCenter_ID.*","fsample_CenterID.sampleCenter_Name.*").exclude("*.class","fspecimen_ID.*","flab_ID.*","ftest_RequestPerson.*","fsample_CenterID.*","admintionID.*","ftest_ID.*","ftest_RequestPerson.*").transform(new DateTransformer("yyyy-MM-dd"),"test_RequestDate","test_DueDate").serialize(testRequestsList);
	}
	
	@GET
	@Path("/getPcuRequestByAdminID/{pcuadminId}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllrquestsByBht(@PathParam("pcuadminId")int pcuadminId)
	{
		List<PcuLabTestRequest> testRequestsList =  requestDBDriver.getLabTestRequestsByAdmissionID(pcuadminId);
		logger.info("PUC Lab Test Requests by Admin Id "+testRequestsList);
		
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("admintionID.admitionId","ftest_ID.test_ID","ftest_ID.test_IDName","ftest_ID.test_Name","admintionID.patientId.patientID","admintionID.patientId.patientFullName","fspecimen_ID.specimen_ID.*","flab_ID.lab_ID.*","flab_ID.lab_Name.*","ftest_RequestPerson.userID.*","ftest_RequestPerson.userName.*"
				,"fsample_CenterID.sampleCenter_ID.*","fsample_CenterID.sampleCenter_Name.*").exclude("*.class","fspecimen_ID.*","flab_ID.*","ftest_RequestPerson.*","fsample_CenterID.*","admintionID.*","ftest_ID.*","ftest_RequestPerson.*").transform(new DateTransformer("yyyy-MM-dd"),"test_RequestDate","test_DueDate").serialize(testRequestsList);
	}
	
	@POST
	@Path("/updatePCURequestTest")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updatePCURequestDetailsTest(JSONObject pJson) throws JSONException
	{
		
		
		try {
			
			PcuLabTestRequest request = new PcuLabTestRequest();
			
			int requestid = pJson.getInt("labTestRequest_ID");			
			request.setComment(pJson.getString("comment").toString());
			request.setPriority(pJson.getString("priority").toString());
			request.setTest_DueDate(new SimpleDateFormat("yyyy-MM-dd")
			.parse(pJson.getString("due_date")));
			
			
	
			requestDBDriver.updateInwardTestRequest(requestid, request);
			
			logger.info("PCU lab request with request Id"+requestid+" updated");
			return String.valueOf(requestid);	
			
		} catch (Exception e) {
			 
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			return jsonErrorObject.toString(); 
			/*logger.error("Error in updating PCU lab test request: "+e.getMessage());
			return e.getMessage();*/
		}
	}
	
	@GET
	@Path("/deletePCUTestRequest/{Reqid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String deletePCURequest(@PathParam("Reqid") int Reqid) throws JSONException {
		//String status="";
		try {
			
			requestDBDriver.DeletePCUTestRequest(Reqid);
			logger.info("PCU lab request with request Id:"+Reqid+" deleted");
			
			return String.valueOf(Reqid);
			
		} catch (Exception e) {
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.DELETE_ERROR.getCode());
			jsonErrorObject.put("message", ErrorConstants.DELETE_ERROR.getMessage());
			
			return jsonErrorObject.toString(); 
			/*logger.error("Error in deleting PCU Lab test request with request id "+Reqid+": "+e.getMessage());
			return e.getMessage();*/
		}
	}
}
