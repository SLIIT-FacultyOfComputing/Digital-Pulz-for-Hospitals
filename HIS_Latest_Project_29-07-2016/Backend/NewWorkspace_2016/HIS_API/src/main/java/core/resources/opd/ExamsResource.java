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

import org.apache.log4j.Logger;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;
 
 


import core.ErrorConstants;
import core.classes.opd.Exams;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
import lib.driver.opd.driver_class.ExamDBDriver;

/**
 * This class define all the generic REST Services necessary for handling patient's examination.
 * @author 
 * @version 1.0
 */
@Path("Exams")
public class ExamsResource {

	final static Logger log = Logger.getLogger(ExamsResource.class);
	ExamDBDriver examDBDriver =new ExamDBDriver();
	
	/**
	 * Add New Examination Result Details on a visit
	 * @param exJson A Json Object that contains New Examination Details
	 * @return Is A String and If Data inserted Successfully return is True else False
	 * @throws JSONException 
	 */
	@POST
	@Path("/addExamination")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addExamination(JSONObject exJson) throws JSONException {
		Exams exam =  new Exams();
		
		log.info("Entering the add Examination method");
		try{
			exam.setExamDisatBP(exJson.getDouble("DiastBP"));
			exam.setExamHeight(exJson.getDouble("Height"));
			exam.setExambmi(exJson.getDouble("bmi"));
			exam.setExamSysBP(exJson.getDouble("SysBP"));
			exam.setExamTemp(exJson.getDouble("Temperature"));
			exam.setExamWeight(exJson.getDouble("Weight"));
			exam.setExamDate(new Date());
			exam.setExamActive(1);
			exam.setExamCreateDate(new Date());
			
			exam.setExamLastUpdate(new Date());
			
			int visitID=exJson.getInt("visitid");
			int userid= exJson.getInt("userid");
		
			examDBDriver.saveExam(exam, userid, visitID);
			
			log.info("Adding examination Successful, VisitID = "+visitID);
			return visitID + "";
			
		}
		catch (JSONException e) {
			log.error("Runtime Exception in adding new examination, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in adding new examination, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch(Exception e)
		{
			log.error("Error while adding new examination, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			
			return jsonErrorObject.toString(); 
			
		}
	}
	
	
	/**
	 * Add New Examination Result Details on a visit
	 * @param exJson A Json Object that contains New Examination Details
	 * @return  Is A String and If Data updated Successfully return is True else False
	 * @throws JSONException 
	 */
	@POST
	@Path("/updateExamination")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateExamination(JSONObject exJson) throws JSONException {
		Exams exam = new Exams(); 
		
		log.info("Entering the update Examination method");
		
		try{
			System.out.println(exJson.toString());
			
			exam.setExamDisatBP( Double.parseDouble( exJson.getString("DiastBP")));
			exam.setExamHeight(Double.parseDouble(exJson.getString("Height")));
			exam.setExambmi(Double.parseDouble(exJson.getString("bmi")));
			exam.setExamSysBP(Double.parseDouble(exJson.getString("SysBP")));
			exam.setExamTemp(Double.parseDouble(exJson.getString("Temperature")));
			exam.setExamWeight(Double.parseDouble(exJson.getString("Weight")));
			exam.setExamLastUpdate(new Date());
			 
			exam.setExamActive(Integer.parseInt(exJson.getString("active")));
			int userid= exJson.getInt("userid");
			
			examDBDriver.updateExam(Integer.parseInt(exJson.getString("patexamid")),userid,exam);
			
			log.info("Adding examination Successful, examID = "+exam.getExamID());
			
			return exam.getExamID() + "";
			
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in updating examination, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch(Exception e)
		{
			log.error("Error while updating examination, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			
			return jsonErrorObject.toString(); 
			
		}

	 
	}
	
	/**Get Examine Details By Visit Id.
	 * @param visitID Is an Integer Value.
	 * @return JSON String that contains all the Examine Details
	 * @throws JSONException 
	 */
	@GET
	@Path("/getExamsByVisit/{VISITID}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getExamsByVisit(@PathParam("VISITID")int visitID) throws JSONException {
		
		log.info("Entering the get Exams by visit ID method");
		try{
			List<Exams> examRecords=examDBDriver.retriveExamsByVisit(visitID);
			JSONSerializer serializer=new JSONSerializer();
			return serializer.include("visit.visitID").exclude("visit.*").transform(new DateTransformer("yyyy-MM-dd"),"examDate","examLastUpdate","examCreateDate").serialize(examRecords);
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in getting Exams by Visit, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch(Exception e)
		{
			log.error("Error while getting Exams by Visit, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			
			return jsonErrorObject.toString(); 
			
		}
		
	}
	
	 
	
	/**Get Examine Details By Exam ID
	 * @param exmID Is An Integer Value
	 * @return JSON String that contains all the Examine Details
	 * @throws JSONException 
	 */
	@GET
	@Path("/getexamByExamID/{EXAMID}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getExamByExamID(@PathParam("EXAMID")int exmID) throws JSONException {
		
		log.info("Entering the get Exams by exam ID method");
		try 
		{ 
			List<Exams> examRecord=examDBDriver.retriveExamsByExamID(exmID);
			JSONSerializer serializer = new JSONSerializer();
			return  serializer.include("visit.visitID").exclude("*.class","visit.*",
					"examLastUpDateUser.specialPermissions","examLastUpDateUser.userRoles","examLastUpDateUser.employees.department","examLastUpDateUser.employees.leaves",
					"examCreateUser.specialPermissions", "examCreateUser.userRoles","examCreateUser.employees.department","examCreateUser.employees.leaves"
					).transform(new DateTransformer("yyyy-MM-dd"),"examDate","examLastUpdate","examCreateDate").serialize(examRecord);
			
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in getting Exams by Visit, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch(Exception e)
		{
			log.error("Error while getting Exams by exam ID, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			
			return jsonErrorObject.toString(); 
			
		}

	}
	
	
	
	
	
}
