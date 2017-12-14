package core.resources.inward.WardAdmission;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
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

import org.codehaus.jettison.json.JSONObject;
import org.jboss.logging.Logger;

import core.ErrorConstants;
import core.classes.inward.WardAdmission.Admission;
import core.resources.lims.LabResource;
import flexjson.JSONException;
import flexjson.JSONSerializer;
import lib.driver.inward.driver_class.WardAdmission.AdmissionDBDriver;


@Path("Admission")
public class AdmissionResource {
	
	AdmissionDBDriver wardadmissiondbDriver = new AdmissionDBDriver();
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");
	
	final static Logger log = Logger.getLogger(AdmissionResource.class);
	
	
	@POST
	@Path("/addWardAdmission")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addWard(JSONObject wJson) throws org.codehaus.jettison.json.JSONException
	{
		log.info("Entering the add Ward Admission method");
		
		try {
 			Admission wardadmission  =  new Admission();
			
			wardadmission.setBhtNo(wJson.getString("bhtNo"));	
			
			
			//non allcation bed patient insert bed no = -99
			wardadmission.setBedNo(wJson.getInt("bedNo"));
			
			
			wardadmission.setWardNo(wJson.getString("wardNo"));
			wardadmission.setDailyNo(wJson.getInt("dailyNo"));
			wardadmission.setMonthlyNo(wJson.getInt("monthlyNo"));	
			wardadmission.setYearlyNo(wJson.getInt("yearlyNo"));
			//wardadmission.setAdmitDateTime(dateformat.parse(wJson.get("admitDateTime").toString())); 
			wardadmission.setAdmitDateTime(dateformat.parse(wJson.getString("admitDateTime").toString()));
			wardadmission.setPatientComplain(wJson.getString("patientComplain").toString());	
			wardadmission.setPreviousHistory(wJson.getString("previousHistory"));
			wardadmission.setCreatedDateTime(dateformat.parse(wJson.getString("createdDateTime")));
			wardadmission.setLastUpdatedDateTime(dateformat.parse(wJson.getString("LastUpdatedDateTime").toString()));	
			int pid=wJson.getInt("patientID");
			int docID=wJson.getInt("DoctorID");
			int createUser=wJson.getInt("createdUser");
			int UpdateUser=wJson.getInt("LastUpdatedUser");
			
			wardadmission.setDischargeType("none");
			wardadmission.setRemark("");
			wardadmission.setStatus("");
			wardadmission.setSign("");
			wardadmission.setOutcomes("");
			wardadmission.setReferredto("");
			wardadmission.setDischargediagnosis("");
			wardadmission.setAdmissionUnit(wJson.getString("AdmissionUnit"));
			
		
			wardadmissiondbDriver.insertWardAdmission(wardadmission,pid,docID,createUser,UpdateUser);
			 			
			//return "true";
			
			
		log.info("Add Ward Admission Successful : "+wardadmission.getBhtNo());	
		JSONSerializer serializor=new JSONSerializer();
		return serializor.exclude("*.class").serialize(wardadmission);
			
		}
		catch(JSONException e){
			log.error("JSON exception in adding Ward Admission, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jSONError.put("Message",ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			return jSONError.toString();
		}
		catch (RuntimeException e)
		{
			log.error("Runtime exception in adding Ward Admission, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.NO_CONNECTION.getCode());
			jSONError.put("Message",ErrorConstants.NO_CONNECTION.getMessage());
			return jSONError.toString();
		}
		catch (Exception e) {
			log.error("Add Ward Admission error : "+ e.getMessage());
			System.out.println(e.getMessage());
			return null; 
		}

	}
	
	
	
	@GET
	@Path("/getWardAdmission")
	@Produces(MediaType.APPLICATION_JSON)
	public String getWard() throws org.codehaus.jettison.json.JSONException
	{
		log.info("Entering the get Ward Admission method");
		try{
		List<Admission> wardAdmissionList =wardadmissiondbDriver.getWardAdmissionList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("Inpatient.patientID","Inpatient.patientTitle","Inpatient.patientFullName","AdminEmployee.empEmpId","AdminEmployee.empTitle","AdminEmployee.empFName","AdminEmployee.empLName","User.userID").exclude("*.class","Inpatient.*","AdminEmployee.*","User.*").serialize(wardAdmissionList);
		}
		catch (RuntimeException e)
		{
			log.error("Runtime exception in getting Ward Admission, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.NO_CONNECTION.getCode());
			jSONError.put("Message",ErrorConstants.NO_CONNECTION.getMessage());
			return jSONError.toString();
		}
		catch (Exception e)
		{
			log.error("get ward admission error : "+ e.getMessage());
			System.out.println(e.getMessage());
			return null; 
		}
	}
	
	@GET
	@Path("/getWardAdmissionDetails/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getWardAdmissionDetails(@PathParam("bhtNo")  String bhtNo) throws org.codehaus.jettison.json.JSONException{
		log.info("Entering the get Ward Admission Details By BHT No method");
		try{
		 List<Admission> wardlist =wardadmissiondbDriver.getWardAdmissionDetails(bhtNo);
		 JSONSerializer serializor=new JSONSerializer();
		 return  serializor.include("Inpatient.patientID","AdminEmployee.empEmpId","User.userID").exclude("*.class","Inpatient.*","AdminEmployee.*","User.*").serialize(wardlist);
		}
		
		catch (RuntimeException e)
		{
			log.error("Runtime exception in getting Ward Admission Details By BHT No, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.NO_CONNECTION.getCode());
			jSONError.put("Message",ErrorConstants.NO_CONNECTION.getMessage());
			return jSONError.toString();
		}
		catch (Exception e)
		{
			log.error("get ward admission Details  error : "+ e.getMessage());
			System.out.println(e.getMessage());
			return null; 
		}
		
	}
	
	@GET
	@Path("/getWardAdmissionByPatientID/{patientID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getWardAdmissionByPatientID(@PathParam("patientID")  int patientID) throws org.codehaus.jettison.json.JSONException{
		log.info("Entering the get Ward Admission By Patient ID method");
		
		try{
		 List<Admission> wardlist =wardadmissiondbDriver.getWardAdmissionByPatientID(patientID);
		 JSONSerializer serializor=new JSONSerializer();
		 return  serializor.include("Inpatient.patientID","AdminEmployee.empEmpId","User.userID").exclude("*.class","Inpatient.*","AdminEmployee.*","User.*").serialize(wardlist);
		}
		
		catch (RuntimeException e)
		{
			log.error("Runtime exception in getting Ward Admission by Patient Id, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.NO_CONNECTION.getCode());
			jSONError.put("Message",ErrorConstants.NO_CONNECTION.getMessage());
			return jSONError.toString();
		}
		catch (Exception e)
		{
			log.error("get ward admission by Patient ID  error : "+ e.getMessage());
			System.out.println(e.getMessage());
			return null; 
		}
	
	}

	
	
	@PUT
	@Path("/updateDischarge")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String updateDischarge(JSONObject wJson) throws org.codehaus.jettison.json.JSONException{
		log.info("Entering the update Discharge method");
		String result="false";
		boolean r=false;
		
		try{
			String BhtNo=wJson.getString("bhtNo");
			String discharjType=wJson.getString("discharjType");	
			String remark=wJson.getString("remark");
			
			
			String outcomes=wJson.getString("outcomes");	
			String dischargediagnosis=wJson.getString("dischargediagnosis");
			String referredto=wJson.getString("referredto");
			
			int LastUpdatedUser=wJson.getInt("LastUpdatedUser");
			Date LastUpdatedDateTime=dateformat.parse(wJson.getString("LastUpdatedDateTime"));
			//r=wardadmissiondbDriver.updateDischarge(BhtNo,discharjType,remark,LastUpdatedUser,LastUpdatedDateTime,status,sign);
			r=wardadmissiondbDriver.updateDischarge(BhtNo,discharjType,remark,LastUpdatedUser,LastUpdatedDateTime,outcomes,dischargediagnosis,referredto);
			result=String.valueOf(r);
		
			log.info("Update Discharge Successful");
			return result;
			

			
		}
		catch(JSONException e){
			log.error("JSON exception in updating discharge, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jSONError.put("Message",ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			return jSONError.toString();
		}
		catch (RuntimeException e)
		{
			log.error("Runtime exception in updating discharge, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.NO_CONNECTION.getCode());
			jSONError.put("Message",ErrorConstants.NO_CONNECTION.getMessage());
			return jSONError.toString();
		}
		catch (Exception e) {
			 
			log.error(e.getMessage());
			return e.getMessage();
		}

	}
	
	@POST
	@Path("/updateDischargeSign")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String updateDischargeSign(JSONObject wJson) throws org.codehaus.jettison.json.JSONException{
		log.info("Entering the update Discharge Sign method");
		String result="false";
		boolean r=false;
		
		try{
			String BhtNo=wJson.getString("bhtNo");
			
			
		String status=wJson.getString("status");
		String sign=wJson.getString("sign");
		sign=sign+".jpg";
			
			String path = "\\home\\his\\Desktop\\dilhara\\";
			int LastUpdatedUser=wJson.getInt("LastUpdatedUser");
			//Date LastUpdatedDateTime=dateformat.parse(wJson.getString("LastUpdatedDateTime"));
			r=wardadmissiondbDriver.updateDischargeSign(BhtNo,status,path+sign,LastUpdatedUser);
			//r=wardadmissiondbDriver.updateDischarge(BhtNo,discharjType,remark,LastUpdatedUser,LastUpdatedDateTime,status,sign,outcomes,dischargediagnosis,referredto);
			result=String.valueOf(r);
			log.info("Update Discharge Sign Successful");
			return result;
			
		}
		catch(JSONException e){
			log.error("JSON exception in updating discharge sign, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jSONError.put("Message",ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			return jSONError.toString();
		}
		catch (RuntimeException e)
		{
			log.error("Runtime exception in updating discharge sign, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.NO_CONNECTION.getCode());
			jSONError.put("Message",ErrorConstants.NO_CONNECTION.getMessage());
			return jSONError.toString();
		}
		catch (Exception e) {
			 
			log.error(e.getMessage());
			return e.getMessage();
		}

	}
	
	
	@GET
	@Path("/getWardAdmissionByWardNo/{wardNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getWardAdmissionByWardNo(@PathParam("wardNo")  String wardNo) throws org.codehaus.jettison.json.JSONException{
		log.info("Entering the get Ward Admission By Ward No method");
		
		try{
		 List<Admission> wardlist =wardadmissiondbDriver.getWardAdmissionByWardNo(wardNo);
		 JSONSerializer serializor=new JSONSerializer();
		 
		 return  serializor.include("Inpatient.patientID","AdminEmployee.empEmpId","User.userID").exclude("*.class","Inpatient.*","AdminEmployee.*","User.*").serialize(wardlist);
		}
		catch (RuntimeException e)
		{
			log.error("Runtime exception in getting Ward Admission by Ward No, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.NO_CONNECTION.getCode());
			jSONError.put("Message",ErrorConstants.NO_CONNECTION.getMessage());
			return jSONError.toString();
		}
		catch (Exception e)
		{
			log.error("get ward admission by Ward No  error : "+ e.getMessage());
			System.out.println(e.getMessage());
			return null; 
		}
		
	
	}
	
	@PUT
	@Path("/updateAdmissionBedNo")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String updateAdmissionBedNo(JSONObject wJson) throws org.codehaus.jettison.json.JSONException{
		log.info("Entering the update Admission Bed No method");
		String result="false";
		boolean r=false;
		
		try{
			String BhtNo=wJson.getString("bhtNo");
			int newBed=wJson.getInt("bedNo");
			int LastUpdatedUser=wJson.getInt("LastUpdatedUser");
			Date LastUpdatedDateTime=dateformat.parse(wJson.getString("LastUpdatedDateTime"));
			r=wardadmissiondbDriver.updateAdmissionBedNo(BhtNo,newBed,LastUpdatedUser,LastUpdatedDateTime);
			result=String.valueOf(r);
			log.info("Update Admission Bed No Successful");
			return result;
			
		}
		catch(JSONException e){
			log.error("JSON exception in updating admission bed no, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jSONError.put("Message",ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			return jSONError.toString();
		}
		catch (RuntimeException e)
		{
			log.error("Runtime exception in updating admission bed no, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.NO_CONNECTION.getCode());
			jSONError.put("Message",ErrorConstants.NO_CONNECTION.getMessage());
			return jSONError.toString();
		}
		catch (Exception e) {
			 
			log.error(e.getMessage());
			return e.getMessage();
		}

	}
	@GET
	@Path("/getOnlyPatientInformations/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getOnlyPatientInformations(@PathParam("bhtNo")  String bhtNo) throws org.codehaus.jettison.json.JSONException{
		log.info("Entering the get Patient Information by BHT No method");
		
		try{
		 List<Admission> wardlist =wardadmissiondbDriver.getOnlyPatientDetails(bhtNo);
		 JSONSerializer serializor=new JSONSerializer();
		 return  serializor.include("User.userID").exclude("*.class","Inpatient.*","AdminEmployee.*","User.*","createdUser.*","lastUpdatedUser.*","patientID.patientCreateUser.*","doctorID.*","patientID.patientLastUpdateUser.*").serialize(wardlist);
		}
		catch (RuntimeException e)
		{
			log.error("Runtime exception in getting Patient Information by BHT No, message:"+ e.getMessage());
			JSONObject jSONError = new JSONObject();
			jSONError.put("Error Code",ErrorConstants.NO_CONNECTION.getCode());
			jSONError.put("Message",ErrorConstants.NO_CONNECTION.getMessage());
			return jSONError.toString();
		}
		catch (Exception e)
		{
			log.error("get ward Patient Information by BHT No  error : "+ e.getMessage());
			System.out.println(e.getMessage());
			return null; 
		}
	
		
	}
	
}