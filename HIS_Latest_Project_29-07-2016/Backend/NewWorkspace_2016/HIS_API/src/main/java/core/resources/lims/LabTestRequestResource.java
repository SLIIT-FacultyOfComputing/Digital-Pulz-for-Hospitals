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

import com.sun.org.apache.xerces.internal.impl.xpath.regex.ParseException;

import core.classes.lims.Category;
import core.classes.lims.LabTestRequest;
import core.classes.lims.MainResults;
import core.classes.lims.ParentTestFields;
import core.classes.lims.Reports;
import core.classes.lims.Specimen;
import core.classes.lims.SpecimenRetentionType;
import core.classes.lims.SpecimenType;
import core.classes.lims.SubCategory;
import core.classes.opd.OutPatient;
import core.classes.opd.Patient;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.LabTestRequestDBDriver;
import lib.driver.lims.driver_class.SubCategoryDBDriver;

@Path("LabTestRequest")
public class LabTestRequestResource {

LabTestRequestDBDriver requestDBDriver= new LabTestRequestDBDriver();
	
	@POST
	@Path("/addLabTestRequest")
	@Produces(MediaType.APPLICATION_JSON)
	//@Consumes(MediaType.APPLICATION_JSON)
	public String addNewLabTest(JSONObject pJson)
	{
		

		

		try {
			LabTestRequest testRequest = new LabTestRequest();
			
			int testID = pJson.getInt("ftest_ID");
			int patientID = pJson.getInt("fpatient_ID");
			int labID = pJson.getInt("flab_ID");
			int userid = pJson.getInt("ftest_RequestPerson");
			
			testRequest.setComment(pJson.getString("comment").toString());
			testRequest.setPriority(pJson.getString("priority").toString());
			testRequest.setStatus(pJson.getString("status").toString());
			testRequest.setTest_RequestDate(new Date());
			testRequest.setTest_DueDate(new Date());
			
			
			requestDBDriver.addNewLabTestRequest(testRequest, testID, patientID, labID, userid);
			
			 
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("labTestRequest_ID").serialize(testRequest);
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return null; 
		}

	}
	
	@GET
	@Path("/getAllLabTestRequests")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllTestRequests()
	{
		
		List<List> testRequestsList =   requestDBDriver.getTestRequestsList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("ftest_ID.test_ID","priority","status","ftest_ID.test_IDName","ftest_ID.test_Name","fpatient_ID.patientID","fpatient_ID.patientFullName","fspecimen_ID.specimen_ID.*","flab_ID.lab_ID.*","flab_ID.lab_Name.*","ftest_RequestPerson.userID.*","ftest_RequestPerson.userName.*"
				,/*"fsample_CenterID.sampleCenter_ID.*","fsample_CenterID.sampleCenter_Name.*"*/ "test_RequestDate","test_DueDate").exclude("*.class","fspecimen_ID.*","flab_ID.*","ftest_RequestPerson.*","fsample_CenterID.*","fpatient_ID.*","ftest_ID.*","ftest_RequestPerson.*").transform(new DateTransformer("yyyy-MM-dd"),"test_RequestDate","test_DueDate").serialize(testRequestsList);
	}
	
	@GET
	@Path("/getRequestsByPatientID/{patientID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSubCategories(@PathParam("patientID")int patientID)
	{
		List<LabTestRequest> testRequestsList =   requestDBDriver.getLabTestRequestsByPid(patientID);
		for (LabTestRequest labTestRequest : testRequestsList) {
			System.out.print(labTestRequest.getFlab_ID().getLab_Name());
		}
		System.out.print(testRequestsList.get(0));
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("ftest_ID.test_ID","ftest_ID.test_IDName","ftest_ID.test_Name","fpatient_ID.patientID","fpatient_ID.patientFullName","fspecimen_ID.specimen_ID.*","flab_ID.lab_ID.*","flab_ID.lab_Name.*","ftest_RequestPerson.userID.*","ftest_RequestPerson.userName.*"
				,"fsample_CenterID.sampleCenter_ID.*","fsample_CenterID.sampleCenter_Name.*").exclude("*.class","fspecimen_ID.*","flab_ID.*","ftest_RequestPerson.*","fsample_CenterID.*","fpatient_ID.*","ftest_ID.*","ftest_RequestPerson.*").transform(new DateTransformer("yyyy-MM-dd"),"test_RequestDate","test_DueDate").serialize(testRequestsList);
	}
	
	
	
	
	@GET
	@Path("/getTestRequestByRequestID/{labTestRequest_ID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getTestRequestByRequestID(@PathParam("labTestRequest_ID")int labTestRequest_ID){
		 
		LabTestRequest  requestRecord = requestDBDriver.retrieveTestRequestByRequestID(labTestRequest_ID);
		JSONSerializer serializer = new JSONSerializer(); 
  
		return  serializer.include("labTestRequest_ID","fpatient_ID.patientID","fpatient_ID.patientFullName",
				"fpatient_ID.patientDateOfBirth","fpatient_ID.patientGender",
				"ftest_ID.test_Name","ftest_ID.fTest_CategoryID.category_Name",
				"ftest_ID.fTest_Sub_CategoryID.sub_CategoryName").
				
				exclude("*").serialize(requestRecord);
	}
	
	@GET
	@Path("/getSpecimenIDByRequestID/{flabtestrequest_ID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getSpecimenIDByRequestID(@PathParam("flabtestrequest_ID") int flabtestrequest_ID){
		 
		Specimen  requestRec = requestDBDriver.retrieveSpecimenByRequestID(flabtestrequest_ID);
		JSONSerializer serializer = new JSONSerializer(); 
  
		return  serializer.include("specimen_ID").
				
				exclude("*").serialize(requestRec);
	}
	
	@GET
	@Path("/getSpecimenByRequestID/{flabtestrequest_ID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getSpecimenByRequestID(@PathParam("flabtestrequest_ID") int flabtestrequest_ID){
		 
		Specimen  requestRec = requestDBDriver.retrieveSpecimenByRequestID(flabtestrequest_ID);
		JSONSerializer serializer = new JSONSerializer(); 
  
		return  serializer.include("specimen_ID","specimen_CollectedDate","specimen_stored_destroyed_date","remarks","stored_location","stored_or_destroyed","fSpecimentType_ID.specimen_TypeName","fRetentionType_ID.retention_TypeName").
				
				exclude("*").serialize(requestRec);
	}
	
	
	//@POST
	@POST
	@Path("/addSpecimenInfo")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addSpecimenInfo(JSONObject pJson)
	{
		SimpleDateFormat dateFormatter = new SimpleDateFormat ( "dd/MM/yyyy" );
		java.util.Date collected_date = null;
		java.util.Date stored_destroyed_date = null;
		try{
			 collected_date = dateFormatter.parse (pJson.getString("collected_date") );
			 stored_destroyed_date = dateFormatter.parse (pJson.getString("stored_destroyed_date") );
		}catch(ParseException | java.text.ParseException | JSONException ex){}
		try {
			Specimen speci = new Specimen();
			
			
			
			int useridC = pJson.getInt("fSpecimen_CollectedBy");
			int useridR = pJson.getInt("fSpecimen_ReceivededBy");
			int useridD = pJson.getInt("fSpecimen_DeliveredBy");
			int retID = pJson.getInt("fRetentionType_ID");
			int specID = pJson.getInt("fSpecimentType_ID");
			int reqID = pJson.getInt("flabtestrequest_ID");
			speci.setSpecimen_CollectedDate(collected_date);
			speci.setSpecimen_ReceivedDate(collected_date);
			speci.setSpecimen_stored_destroyed_date(stored_destroyed_date);
			speci.setSpecimen_DeliveredDate(collected_date);
			speci.setRemarks(pJson.getString("remarks").toString());
			speci.setStored_location(pJson.getString("stored_location").toString());
			speci.setStored_or_destroyed(pJson.getString("stored_or_destroyed").toString());
			
			
			requestDBDriver.addSpecimenInfo(speci, useridC, useridR, useridD, retID, specID, reqID);
			
			 
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("specimen_ID").serialize(speci);
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return null; 
		}

	}
			
			@POST
			@Path("/setStatus")
			@Produces(MediaType.APPLICATION_JSON)
			@Consumes(MediaType.APPLICATION_JSON)
			public void setStatus(JSONObject pJson)
			{
				int reqID = 0;
				String status = null;
				try {
					reqID = pJson.getInt("reqID");
					status = pJson.getString("status");
				} catch (JSONException e) {
					System.out.println(e.getMessage());
				}
				requestDBDriver.updateStatus(reqID, status);
			}
			
			@GET
			@Path("/getAllSpecimenTypes")
			@Produces(MediaType.APPLICATION_JSON)
			public String getAllSpecimenType()
			{
				List<SpecimenType> specimentypeList =   requestDBDriver.getSpecimenTypeList();
				JSONSerializer serializer = new JSONSerializer();
				return  serializer.include("specimenType_ID","specimen_TypeName").exclude("*").serialize(specimentypeList);
			}
			
			
			@GET
			@Path("/getAllSpecimenRetentionTypes")
			@Produces(MediaType.APPLICATION_JSON)
			public String getAllSpecimenRetType()
			{
				List<SpecimenRetentionType> specimenretentiontypeList =   requestDBDriver.getSpecimenRetentionTypeList();
				JSONSerializer serializer = new JSONSerializer();
				return  serializer.include("retention_TypeID","retention_TypeName").exclude("*").serialize(specimenretentiontypeList);
			}
			
			
			/*@POST
			@Path("/addTestParentField")
			@Produces("text/plain")
			@Consumes(MediaType.APPLICATION_JSON)
			public String addTestParentField(JSONObject obj)
			{
				ParentTestFields testParentFields = new ParentTestFields();
				try {
					testParentFields.set(obj.getInt("lab_test_id"));
					testParentFields.setTestParentFieldName(obj.getString("test_field_name"));
					boolean res=mriTestFieldsDBDriver.addParentTestField(testParentFields);
					if(res)
						return "true";
				} catch (JSONException e) {
					e.printStackTrace();
				}
				return "false";
			}*/
}