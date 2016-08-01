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
	
	@POST
	@Path("/generateNewReport")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String GenerateNewReport(JSONObject pJson)
	{
		
		try {
			
			Reports report = new Reports();
			
			int patientID = pJson.getInt("fPatient_ID");
			int requestID = pJson.getInt("fTestRequest_ID");
			report.setIssued_Date(new Date());
				
		reportDBDriver.GenerateNewReport(report, patientID, requestID);
			
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("report_ID").serialize(report);
			//return "success";
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return null; 
		}

	}
	
	@GET
	@Path("/getAllReports")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSubCategories()
	{
		List<Reports> reportsList =   reportDBDriver.getReportsList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("fTestRequest_ID.fpatient_ID.patientFullName","fTestRequest_ID.fpatient_ID.patientDateOfBirth","fTestRequest_ID.fpatient_ID.patientGender",
				"fTestRequest_ID.flab_ID.lab_Name","fTestRequest_ID.wardCOP_ID","fTestRequest_ID.labTestRequest_ID","fTestRequest_ID.ftest_ID.test_Name","fTestRequest_ID.ftest_ID.fTest_CategoryID.category_Name",
				"fTestRequest_ID.ftest_ID.fTest_Sub_CategoryID.sub_CategoryName","fTestRequest_ID.labMainresultses").exclude("*.class","fPatient_ID.*","fTestRequest_ID.*").transform(new DateTransformer("yyyy-MM-dd"),"issued_Date").serialize(reportsList);
	}
	
	
}