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

import org.apache.log4j.Logger;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.ErrorConstants;
import core.classes.lims.Category;
import core.classes.lims.Reports;
import core.classes.lims.SubCategory;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.ReportsDBDriver;
import lib.driver.lims.driver_class.SubCategoryDBDriver;

@Path("Reports")
public class ReportResource {

ReportsDBDriver reportDBDriver = new ReportsDBDriver();
	
	final static Logger log = Logger.getLogger(ReportResource.class);
	
	@POST
	@Path("/generateNewReport")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String GenerateNewReport(JSONObject pJson) throws JSONException
	{
		log.info("Entering the Generate New Report method");
		try {
			
			Reports report = new Reports();
			
			int patientID = pJson.getInt("fPatient_ID");
			int requestID = pJson.getInt("fTestRequest_ID");
			report.setIssued_Date(new Date());
				
			reportDBDriver.GenerateNewReport(report, patientID, requestID);
			
			log.info("Generate New Report Successful");
			
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("report_ID").serialize(report);
			//return "success";
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in generate new report, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while generate new report, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}


	}
	
	@GET
	@Path("/getAllReports")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllReports() throws JSONException
	{
		log.info("Entering the get All reports method");
		try{
			List<Reports> reportsList =   reportDBDriver.getReportsList();
			JSONSerializer serializer = new JSONSerializer();
			return  serializer.include("fTestRequest_ID.fpatient_ID.patientFullName","fTestRequest_ID.fpatient_ID.patientDateOfBirth","fTestRequest_ID.fpatient_ID.patientGender",
				"fTestRequest_ID.flab_ID.lab_Name","fTestRequest_ID.wardCOP_ID","fTestRequest_ID.labTestRequest_ID","fTestRequest_ID.ftest_ID.test_Name","fTestRequest_ID.ftest_ID.fTest_CategoryID.category_Name",
				"fTestRequest_ID.ftest_ID.fTest_Sub_CategoryID.sub_CategoryName","fTestRequest_ID.labMainresultses").exclude("*.class","fPatient_ID.*","fTestRequest_ID.*").transform(new DateTransformer("yyyy-MM-dd"),"issued_Date").serialize(reportsList);
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in getting all report, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while getting all report, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}
	}
	
}