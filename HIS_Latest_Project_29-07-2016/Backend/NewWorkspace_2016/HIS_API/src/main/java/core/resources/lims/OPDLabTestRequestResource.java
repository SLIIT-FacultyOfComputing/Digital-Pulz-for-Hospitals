package core.resources.lims;

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
import core.classes.lims.Laboratories;
import core.classes.lims.MainResults;
import core.classes.lims.OPDLabTestRequest;
import core.classes.lims.Reports;
import core.classes.lims.SubCategory;
import core.classes.opd.OutPatient;
import core.classes.opd.Patient;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.InwardLabTestRequestDBDriver;
import lib.driver.lims.driver_class.LabTestRequestDBDriver;
import lib.driver.lims.driver_class.OpdLabTestRequestDBDriver;
import lib.driver.lims.driver_class.SubCategoryDBDriver;

@Path("OPDLabTestRequest")
public class OPDLabTestRequestResource {

	final static Logger logger=Logger.getLogger(PcuLabTestRequestResource.class);

	OpdLabTestRequestDBDriver requestDBDriver = new OpdLabTestRequestDBDriver();
	
	@POST
	@Path("/addOPDLabTestRequest")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addReferalLabTestRequest(JSONObject pJson) throws JSONException
	{
		
		
		try {
			
			logger.info("Entering Add OPD Lab Test Request Method");
			OPDLabTestRequest request = new OPDLabTestRequest();
					
			int testID = pJson.getInt("ftest_ID");
			//int specimenID = pJson.getInt("fspecimen_ID");
			int labID = pJson.getInt("flab_ID");
			int visitid = pJson.getInt("visitID");
			int userid = pJson.getInt("ftest_RequestPerson");
			int patientID = pJson.getInt("fpatient_ID");
			
			request.setComment(pJson.getString("comment").toString());
			request.setPriority(pJson.getString("priority").toString());
			request.setStatus(pJson.getString("status").toString());
			request.setTest_RequestDate(new Date());
			request.setTest_DueDate(new Date());
			
			requestDBDriver.addNewLabTestRequest(request, testID, visitid, labID, userid,patientID);
			
			logger.info("New Lab Request Added in requestDB Driver: "+request);
			
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("opdLabtestrequest_ID").serialize(request);
			
		} catch (Exception e) {
		
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			
			return jsonErrorObject.toString(); 
			 /*logger.error("Error: "+e.getMessage());
			 return e.getMessage(); */
		}

	}
	
	@GET
	@Path("/getAllOPDLabTestRequests")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllTestRequests()
	{
		logger.info("Entering get all Lab Test Request Method ");
		List<OPDLabTestRequest> testRequestsList =   requestDBDriver.getTestRequestsList();
		
		logger.info("All OPD Test Request List: "+testRequestsList);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("visitID.visitID","ftest_ID.test_ID","ftest_ID.test_IDName","ftest_ID.test_Name","visitID.patient.patientID","visitID.patient.patientFullName","flab_ID.lab_ID.*","flab_ID.lab_Name.*","ftest_RequestPerson.userID.*","ftest_RequestPerson.userName.*"
				,"fsample_CenterID.sampleCenter_ID.*","fsample_CenterID.sampleCenter_Name.*").exclude("*.class","fspecimen_ID.*","flab_ID.*","ftest_RequestPerson.*","fsample_CenterID.*","visitID.*","ftest_ID.*").transform(new DateTransformer("yyyy-MM-dd"),"test_RequestDate","test_DueDate").serialize(testRequestsList);
	}
	
	@GET
	@Path("/getOPDRequestByPatientID/{patientID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllrquestsByPid(@PathParam("patientID")int patientID)
	{
		logger.info("Entering get OPD Lab Test Request by patient ID Method ");
		List<OPDLabTestRequest> testRequestsList =  requestDBDriver.getLabTestRequestsByPid(patientID);
		logger.info("OPD Test Request List of Patient Id "+patientID+":"+testRequestsList);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("visitID.visitID","ftest_ID.test_ID","ftest_ID.test_IDName","ftest_ID.test_Name","visitID.patient.patientID","visitID.patient.patientFullName","flab_ID.lab_ID.*","flab_ID.lab_Name","ftest_RequestPerson.userID","ftest_RequestPerson.userName"
				,"fsample_CenterID.sampleCenter_ID","fsample_CenterID.sampleCenter_Name").exclude("*.class","fspecimen_ID.*","flab_ID.*","ftest_RequestPerson.*","fsample_CenterID.*","visitID.*","ftest_ID.*").transform(new DateTransformer("yyyy-MM-dd"),"test_RequestDate","test_DueDate").serialize(testRequestsList);
	}
	
	@GET
	@Path("/getOPDRequestByVisitID/{visitid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllrquestsByBht(@PathParam("visitid")int visitid)
	{
		List<OPDLabTestRequest> testRequestsList =  requestDBDriver.getLabTestRequestsByVisitID(visitid);
		logger.info("OPD Test Request List of Patient Id "+visitid+":"+testRequestsList);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("visitID.visitID","ftest_ID.test_ID","ftest_ID.test_IDName","ftest_ID.test_Name","visitID.patient.patientID","visitID.patient.patientFullName","flab_ID.lab_ID.*","flab_ID.lab_Name","ftest_RequestPerson.userID","ftest_RequestPerson.userName"
				,"fsample_CenterID.sampleCenter_ID","fsample_CenterID.sampleCenter_Name").exclude("*.class","fspecimen_ID.*","flab_ID.*","ftest_RequestPerson.*","fsample_CenterID.*","visitID.*","ftest_ID.*").transform(new DateTransformer("yyyy-MM-dd"),"test_RequestDate","test_DueDate").serialize(testRequestsList);
	}
	
	//@POST
		@GET
		@Path("/addOpdLabTestRequestTest")
		@Produces(MediaType.APPLICATION_JSON)
		//@Consumes(MediaType.APPLICATION_JSON)
		public String addReferalLabTestRequestTest() throws JSONException
		{
			JSONObject pJson= new JSONObject();
			try {
				pJson.put("ftest_ID", "1");
				pJson.put("fpatient_ID", "1");
				pJson.put("fspecimen_ID", "1");
				pJson.put("flab_ID", "3");
				//pJson.put("fsample_CenterID", "2");
				pJson.put("comment", "Please test");
				pJson.put("priority", "High");
				pJson.put("status", "Sample");
				pJson.put("ftest_RequestPerson", "1");
				pJson.put("visitID", "1");
				
				//pJson.put("fpatient_ID", "1");
				//pJson.put("wardCOP_ID", "01");
				
				logger.info("Sample JSON values are put into jsn object"+pJson);
			} 
			//catch (JSONException e1) {
				//TODO Auto-generated catch block
				//e1.printStackTrace();
			//}
			
			catch (Exception e) {
				
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
				jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
				return jsonErrorObject.toString(); 
				 /*System.out.println(e.getMessage());
				 logger.error("Error in putting sample json values "+e.getMessage());
				 
				return e.getMessage(); */
			}

			

			try {
				//LabTestRequest testRequest = new LabTestRequest();
				OPDLabTestRequest request = new OPDLabTestRequest();
				
				
				
				int testID = pJson.getInt("ftest_ID");
				int patientID = pJson.getInt("fpatient_ID");
			
				int labID = pJson.getInt("flab_ID");
				int visitid = pJson.getInt("visitID");
				int userid = pJson.getInt("ftest_RequestPerson");
	
				request.setComment(pJson.getString("comment").toString());
				request.setPriority(pJson.getString("priority").toString());
				request.setStatus(pJson.getString("status").toString());
				request.setTest_RequestDate(new Date());
				request.setTest_DueDate(new Date());
				
				//requestDBDriver.addNewLabTestRequest(testRequest, testID, patientID, specimenID, labID, sampleCenterID, userid);
				requestDBDriver.addNewLabTestRequest(request, testID, visitid, labID,userid, patientID);
				
				logger.info("OPD lab Test Request is added using sample"+request);
				
				JSONSerializer jsonSerializer = new JSONSerializer();
				return jsonSerializer.include("opdLabtestrequest_ID").serialize(request);
				
			} catch (Exception e) {
				
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
				jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
				return jsonErrorObject.toString(); 
				 /*logger.error("Error in adding new OPD Lab test request using sample "+e.getMessage());
				 
				 return e.getMessage(); */
			}

		}
		
		@GET
		@Path("/updateOpdRequestTest")
		@Produces(MediaType.TEXT_PLAIN)
		//@Consumes(MediaType.APPLICATION_JSON)
		public String updateOpdRequestDetailsTest() throws JSONException
		{
			
			JSONObject pJson= new JSONObject();
			try {
				pJson.put("labTestRequest_ID", "12");
				pJson.put("ftest_ID", "1");
				pJson.put("fpatient_ID", "3");
				pJson.put("fspecimen_ID", "1");
				pJson.put("flab_ID", "3");
				//pJson.put("fsample_CenterID", "2");
				pJson.put("comment", "Please test7u");
				pJson.put("priority", "High7u");
				pJson.put("status", "Sample7u");
				pJson.put("ftest_RequestPerson", "3");
				pJson.put("visitID", "1");
				
				logger.info("JSON values are inserted for update in json object"+pJson);
				
			} 
			catch (JSONException e1) {
				// TODO Auto-generated catch block
				logger.error(" Error in passing JSON values:"+e1.getMessage());
				e1.printStackTrace();
			}
			catch (Exception e) {
				
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
				jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
				return jsonErrorObject.toString(); 
				/*logger.error(" Error:"+e.getMessage());
				System.out.println(e.getMessage());
				return null; */
			}
			try {
				
				OPDLabTestRequest request = new OPDLabTestRequest();
				
				int requestid = pJson.getInt("labTestRequest_ID");
				int testID = pJson.getInt("ftest_ID");
				//int specimenID = pJson.getInt("fspecimen_ID");
				int labID = pJson.getInt("flab_ID");
				int visitid = pJson.getInt("visitID");
				int userid = pJson.getInt("ftest_RequestPerson");
				int patientID = pJson.getInt("fpatient_ID");
				
				request.setComment(pJson.getString("comment").toString());
				request.setPriority(pJson.getString("priority").toString());
				request.setStatus(pJson.getString("status").toString());
				request.setTest_RequestDate(new Date());
				request.setTest_DueDate(new Date());
				
		
				requestDBDriver.updateTestRequest(requestid, request, testID, visitid, labID, userid, patientID);
				logger.info("OPD Lab Test Request with request ID- "+requestid+" is updated");
				
				return String.valueOf(requestid);	
				
			} catch (Exception e) {
				
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
				jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
				return jsonErrorObject.toString(); 
				/*logger.error("Error in updating with sample data"+e.getMessage());
				return e.getMessage();*/
			}
		}
		
		@GET
		@Path("/deleteTestRequestOPD/{Reqid}")
		@Produces(MediaType.APPLICATION_JSON)
		public String deleteRequestOPD(@PathParam("Reqid") int Reqid) throws JSONException {
			//String status="";
			try {
				
				requestDBDriver.DeleteOpdTestRequest(Reqid);
				logger.info("OPD Lab Test Request with request ID: "+Reqid+"deleted");
				
				return String.valueOf(Reqid);	
			} catch (Exception e) {
				
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.DELETE_ERROR.getCode());
				jsonErrorObject.put("message", ErrorConstants.DELETE_ERROR.getMessage());
				
				return jsonErrorObject.toString(); 
			}
		}
	
}
