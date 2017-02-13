package core.resources.lims;

import java.util.Date;
import java.util.HashSet;
import java.util.List;
import java.util.Set;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.apache.log4j.Logger;
import org.apache.log4j.spi.ErrorCode;
import org.codehaus.jettison.json.JSONArray;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;
import org.hibernate.cfg.annotations.Nullability;

import com.google.gson.JsonObject;

import core.ErrorConstants;
import core.classes.lims.Category;
import core.classes.lims.MainResults;
import core.classes.lims.SubCategory;
import core.classes.lims.SubFieldResults;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.LabTestRequestDBDriver;
import lib.driver.lims.driver_class.MainResultsDBDriver;
import lib.driver.lims.driver_class.ParentTestFieldsDBDriver;
import lib.driver.lims.driver_class.SubCategoryDBDriver;

@Path("MainResults")
public class MainResultsResource {

	MainResultsDBDriver mrDBDriver= new MainResultsDBDriver();
	ParentTestFieldsDBDriver pDBDriver = new ParentTestFieldsDBDriver();
	LabTestRequestDBDriver lrDBDriver = new LabTestRequestDBDriver();
	
	final static Logger log = Logger.getLogger(MainResultsResource.class);

	@POST
	@Path("/addMainResults")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addMainResults(JSONObject pJson) throws JSONException
	{
		log.info("Entering the add MainResults method");
		try {
			int count = 0;
			JSONArray data = pJson.getJSONArray("Parentresults");
			//System.out.println("Hello");
			Set<MainResults> MainresultsList = new HashSet<MainResults>();
			for (int curr = 0; curr < data.length(); curr++){
					MainResults mr = new MainResults();
					mr.setfParentF_ID(pDBDriver.getParentFieldByID(Integer.parseInt(data.getJSONObject(curr).getString("fParentF_ID"))));
					mr.setMainResult(data.getJSONObject(curr).getString("mainResult"));
					mr.setfTestRequest_ID(lrDBDriver.getTestRequestByID(Integer.parseInt(data.getJSONObject(curr).getString("fTestRequest_ID"))));
					mr.setResult_FinalizedDate(new Date());
					MainresultsList.add(mr);
	
			}				
			for (MainResults mr1 : MainresultsList) {
				mrDBDriver.addMainResults(mr1);
				count++;
			}	
	
			log.info("Insert MainResults Successful");
			
			return String.valueOf(count);
			
		} catch (JSONException e) {
			log.error("JSON exception in adding MainResults, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			
			
			return jsonErrorObject.toString(); 
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in get adding MainResults, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			System.out.println(e.getMessage());
			log.error("Error while adding MainResults, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			
			return jsonErrorObject.toString();
		}
	
	}
	
	@GET
	@Path("/getAllMainResults")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllMainReslts() throws JSONException
	{
		List<MainResults> mainresultsList;
		log.info("Entering the get all MainResults method");
		try{
			mainresultsList =   mrDBDriver.getMainResultsList();
			JSONSerializer serializer = new JSONSerializer();
			
			
			return  serializer.include("fTestRequest_ID.labTestRequest_ID","fTestRequest_ID.ftest_ID.test_ID","fTestRequest_ID.ftest_ID.test_Name","fTestRequest_ID.fpatient_ID.patientID","fTestRequest_ID.fpatient_ID.patientFullName","fTestRequest_ID.flab_ID.lab_ID","fTestRequest_ID.flab_ID.lab_Name","fTestRequest_ID.ftest_RequestPerson.userName").exclude("*.class","fTestRequest_ID.*","fParentF_ID.*").transform(new DateTransformer("yyyy-MM-dd"),"result_FinalizedDate").serialize(mainresultsList);
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in get all MainResults, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch(Exception e)
		{
			log.error("Error while getting all MainResults, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			
			return jsonErrorObject.toString(); 
			
		}
	}
	
	@GET
	@Path("/getMainResultsByReqID/{reqID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSubCategories(@PathParam("reqID")int reqID) throws JSONException
	{
		log.info("Entering the get all MainResults By ReqID method");
		try{
		List<MainResults> mainResultsList =   mrDBDriver.getMainResultsListTest(reqID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("fTestRequest_ID.labTestRequest_ID","fTestRequest_ID.ftest_ID.test_ID","fTestRequest_ID.ftest_ID.test_Name","fTestRequest_ID.fpatient_ID.patientID","fTestRequest_ID.fpatient_ID.patientDateOfBirth","fTestRequest_ID.fpatient_ID.patientGender","fTestRequest_ID.fpatient_ID.patientFullName","fTestRequest_ID.flab_ID.lab_ID","fTestRequest_ID.flab_ID.lab_Name","fTestRequest_ID.ftest_RequestPerson.userName").exclude("*.class","fTestRequest_ID.*").transform(new DateTransformer("yyyy-MM-dd"),"result_FinalizedDate").serialize(mainResultsList);
	
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in get all MainResults by ReqID, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			System.out.println(e.getMessage());
			log.error("Error while getting all MainResults by ReqID, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			
			return jsonErrorObject.toString();
		}
	}
	
	
}